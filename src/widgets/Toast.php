<?php

namespace potime\adminlte3\widgets;

use Yii;
use yii\bootstrap4\Widget;
use yii\helpers\Html;

/**
 * Toast widget renders a message from session flash. All flash messages are displayed
 * in the sequence they were assigned using setFlash. You can set message as following:
 *
 * ```php
 * Yii::$app->session->setFlash('error', 'This is the message');
 * Yii::$app->session->setFlash('success', 'This is the message');
 * Yii::$app->session->setFlash('info', 'This is the message');
 * ```
 *
 * Multiple messages could be set as follows:
 *
 * ```php
 * Yii::$app->session->setFlash('error', ['Error 1', 'Error 2']);
 * ```
 */
class Toast extends Widget
{
    /**
     * 弹窗标题
     * @var string
     */
    public $title = '提示信息';

    /**
     * 延时关闭（ms）
     * @var int
     */
    public $delay = 5000;

    /**
     * 位置（默认：右下）
     * @var string
     */
    public $layout = 'toasts-bottom-right';

    /**
     * 图标 与 样式配置
     */
    public $types = [
        'error' => [
            'class' => 'toast-error',
            'icon' => '<i class="icon fas fa-ban mr-2"></i>',
        ],
        'danger' => [
            'class' => 'toast-error',
            'icon' => '<i class="icon fas fa-ban mr-2"></i>',
        ],
        'success' => [
            'class' => 'toast-success',
            'icon' => '<i class="icon fas fa-check mr-2"></i>',
        ],
        'info' => [
            'class' => 'toast-info',
            'icon' => '<i class="icon fas fa-info mr-2"></i>',
        ],
        'warning' => [
            'class' => 'toast-warning',
            'icon' => '<i class="icon fas fa-exclamation-triangle mr-2"></i>',
        ],
        'light' => [
            'class' => 'toast-success',
            'icon' => '',
        ],
        'dark' => [
            'class' => 'toast-info',
            'icon' => '',
        ]
    ];

    /**
     * {@inheritdoc}
     * @throws \Exception
     */
    public function run()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $appendClass = isset($this->options['class']) ? ' ' . $this->options['class'] : '';

        echo Html::beginTag('div', ['id' => 'toast-container', 'class' => $this->layout]) . PHP_EOL;
        foreach ($flashes as $type => $flash) {
            if (!isset($this->types[$type])) {
                continue;
            }

            foreach ((array)$flash as $message) {
                echo \yii\bootstrap4\Toast::widget([
                    'options' => [
                        'data-delay' => $this->delay,
                        'class' => 'shadow ' . $this->types[$type]['class'] ?? 'toast-info' . $appendClass,
                    ],
                    'clientOptions' => 'show',
                    'title' => ($this->types[$type]['icon'] ?? '') . $this->title,
                    'body' => $message,
                ]);
            }
            $session->removeFlash($type);
        }
        echo Html::endTag('div');
    }
}
