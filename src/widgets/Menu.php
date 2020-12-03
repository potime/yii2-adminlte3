<?php

namespace potime\adminlte3\widgets;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * Menu displays a multi-level menu using nested HTML lists.
 *
 * The main property of Menu is [[items]], which specifies the possible items in the menu.
 * A menu item can contain sub-items which specify the sub-menu under that menu item.
 *
 * Menu checks the current route and request parameters to toggle certain menu items
 * with active state.
 *
 * Note that Menu only renders the HTML tags about the menu. It does do any styling.
 * You are responsible to provide CSS styles to make it look like a real menu.
 *
 * The following example shows how to use Menu:
 *
 * ```php
 * echo Menu::widget([
 *     'items' => [
 *         // Important: you need to specify url as 'controller/action',
 *         // not just as 'controller' even if default action is used.
 *         ['label' => 'Home', 'url' => ['site/index']],
 *         // 'Products' menu item will be selected as long as the route is 'product/index'
 *         ['label' => 'Products', 'url' => ['product/index'], 'items' => [
 *             ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
 *             ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
 *         ]],
 *         ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
 *     ],
 * ]);
 * ```
 */
class Menu extends \yii\widgets\Menu
{
    /**
     * @inheritdoc
     */
    public $linkTemplate = '<a class="nav-link {active}" href="{url}" {target}>{icon} {label}</a>';

    /**
     * {@inheritdoc}
     * Styles all labels of items on sidebar by AdminLTE
     */
    public $labelTemplate = '<p>{label} {submenu} {badge}</p>';

    /**
     * @var string treeview wrapper
     */
    public $treeTemplate = "\n<ul class='nav nav-treeview'>\n{items}\n</ul>\n";

    /**
     * @var string
     */
    public static $iconDefault = 'circle';

    /**
     * @var string is type that will be added to $item['icon'] if it exist.
     * Font Awesome 5 added different icon types intead of everything starting with "fas fa-"
     * Possible types are fab (brand), fas (solid), far (regular), fal (light), fad (duotone).
     * Some of them are only available for pro version of FA so check the https://fontawesome.com website
     * @since 3.0
     */
    public static $iconType = 'fas';
    /**
     * @var string
     */
    public static $iconPrefix = 'fa-';

    /**
     * @inheritdoc
     */
    public $itemOptions = ['class' => 'nav-item'];

    /**
     * @inheritdoc
     */
    public $activateParents = true;

    /**
     * @var string[]
     */
    public $options = [
        'class' => 'nav nav-pills nav-sidebar flex-column',
        'data-widget' => 'treeview',
        'role' => 'menu',
        'data-accordion' => 'false'
    ];

    /**
     * Recursively renders the menu items (without the container tag).
     * @param array $items the menu items to be rendered recursively
     * @return string the rendering result
     * @throws \Exception
     */
    protected function renderItems($items)
    {
        $n = count($items);
        $lines = [];
        foreach ($items as $i => $item) {
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));

            if (isset($item['items'])) {
                Html::addCssClass($options, 'has-treeview');
            }

            if (isset($item['header']) && $item['header']) {
                Html::removeCssClass($options, 'nav-item');
                Html::addCssClass($options, 'nav-header');
            }

            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];
            if ($item['active']) {
                $class[] = $this->activeCssClass;
            }
            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }
            Html::addCssClass($options, $class);

            $menu = $this->renderItem($item);
            if (!empty($item['items'])) {
                $treeTemplate = ArrayHelper::getValue($item, 'treeTemplate', $this->treeTemplate);
                $menu .= strtr($treeTemplate, [
                    '{items}' => $this->renderItems($item['items']),
                ]);
                if ($item['active']) {
                    $options['class'] .= ' menu-open';
                }
            }

            $lines[] = Html::tag($tag, $menu, $options);
        }

        return implode("\n", $lines);
    }

    /**
     * Renders the content of a menu item.
     * Note that the container and the sub-menus are not rendered here.
     * @param array $item the menu item to be rendered. Please refer to [[items]] to see what data might be in the item.
     * @return string the rendering result
     * @throws \Exception
     */
    protected function renderItem($item)
    {
        if (isset($item['header']) && $item['header']) {
            return $item['label'];
        }

        if (isset($item['iconClass'])) {
            $iconClass = $item['iconClass'];
        } else {
            $iconType = $item['iconType'] ?? static::$iconType;
            $icon = $item['icon'] ?? static::$iconDefault;
            $iconClassArr = ['nav-icon', $iconType, static::$iconPrefix . $icon];
            isset($item['iconClassAdded']) && $iconClassArr[] = $item['iconClassAdded'];
            $iconClass = implode(' ', $iconClassArr);
        }
        $iconHtml = '<i class="' . $iconClass . '"></i>';

        $submenu = '';
        if (isset($item['items'])) {
            $submenu = '<i class="right fas fa-angle-left"></i>';
        }

        $badge = '';
        if (isset($item['badge']) && $item['badge'] && isset($item['badge']['message'])) {
            $badgeType = $item['badge']['badgeType'] ?? 'info';
            $badge = '<span class="right badge badge-' . $badgeType . '">' . $item['badge']['message'] . '</span>';
        }

        $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);
        return strtr($template, [
            '{label}' => strtr($this->labelTemplate, [
                '{label}' => $item['label'],
                '{badge}' => $badge,
                '{submenu}' => $submenu
            ]),
            '{url}' => isset($item['url']) ? Url::to($item['url']) : '#',
            '{icon}' => $iconHtml,
            '{active}' => $item['active'] ? $this->activeCssClass : '',
            '{target}' => isset($item['target']) ? 'target="' . $item['target'] . '"' : ''
        ]);
    }
}