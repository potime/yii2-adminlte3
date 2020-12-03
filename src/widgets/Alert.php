<?php

namespace potime\adminlte3\widgets;

use Yii;
use yii\bootstrap4\Widget;

/**
 * Alert widget renders a message from session flash for AdminLTE alerts. All flash messages are displayed
 * in the sequence they were assigned using setFlash. You can set message as following:
 *
 * ```php
 * \Yii::$app->getSession()->setFlash('error', '<b>Alert!</b> Danger alert preview. This alert is dismissable.');
 * ```
 *
 * Multiple messages could be set as follows:
 *
 * ```php
 * \Yii::$app->getSession()->setFlash('error', ['Error 1', 'Error 2']);
 * ```
 */
class Alert extends Widget
{
    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - $key is the name of the session flash variable
     * - $value is the array:
     *       - class of alert type (i.e. danger, success, info, warning)
     *       - icon for alert AdminLTE
     */
    public $types = [
        'error' => [
            'class' => 'alert-danger',
            'icon' => '<i class="icon fas fa-ban"></i>',
        ],
        'danger' => [
            'class' => 'alert-danger',
            'icon' => '<i class="icon fas fa-ban"></i>',
        ],
        'success' => [
            'class' => 'alert-success',
            'icon' => '<i class="icon fas fa-check"></i>',
        ],
        'info' => [
            'class' => 'alert-info',
            'icon' => '<i class="icon fas fa-info"></i>',
        ],
        'warning' => [
            'class' => 'alert-warning',
            'icon' => '<i class="icon fas fa-exclamation-triangle"></i>',
        ],
        'light' => [
            'class' => 'alert-light',
            'icon' => '',
        ],
        'dark' => [
            'class' => 'alert-dark',
            'icon' => '',
        ]
    ];

    /**
     * @var array|false the options for rendering the close button tag.
     * The close button is displayed in the header of the modal window. Clicking
     * on the button will hide the modal window. If this is false, no close button will be rendered.
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'button'.
     * - label: string, the label of the button. Defaults to '&times;'.
     *
     * The rest of the options will be rendered as the HTML attributes of the button tag.
     * Please refer to the [Alert documentation](http://getbootstrap.com/components/#alerts)
     * for the supported HTML attributes.
     */
    public $closeButton = [];


    /**
     * @var bool whether to removed flash messages during AJAX requests
     */
    public $isAjaxRemoveFlash = true;

    /**
     * @throws \Exception
     */
    public function init()
    {
        parent::init();

        $session = Yii::$app->getSession();
        $allFlashes = $session->getAllFlashes();
        if ($this->isAjaxRemoveFlash && !Yii::$app->request->isAjax) {
            $session->removeAllFlashes();
        }

        $addCssClass = isset($this->options['class']) ? ' ' . $this->options['class'] : '';

        foreach ($allFlashes as $key => $data) {
            if (isset($this->types[$key])) {
                $data = (array)$data;
                foreach ($data as $message) {
                    echo \yii\bootstrap4\Alert::widget([
                        'body' => ($this->types[$key]['icon'] ?? '') . $message,
                        'closeButton' => $this->closeButton,
                        'options' => [
                            'id' => $this->getId() . '-' . $key,
                            'class' => ($this->types[$key]['class'] ?? 'alert-info') . $addCssClass,
                        ],
                    ]);
                }
            }
        }
    }
}