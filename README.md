AdminLTE 3 for Yii 2.0 Framework
================================
AdminLTE 3 for Yii 2.0 Framework

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist potime/yii2-adminlte3 "^1.0"
```

or add

```
"potime/yii2-adminlte3": "^1.0"
```

to the require section of your `composer.json` file.

Usage
-----

Once the extension is installed, you can have a preview by reconfiguring the path mappings of the view component.

```php
'components' => [
    'view' => [
         'theme' => [
             'pathMap' => [
                '@app/views' => '@vendor/potime/yii2-adminlte3/src/example/yii2-views'
             ],
         ],
    ],
],
```
This asset bundle provides sample files for layout and view (see folder `examples/`), they are **not meant to be customized directly in the `vendor/` folder**.

Therefore it is recommended to **copy the views into your application** and adjust them to your needs.

Customization
-------------

#### Widget Menu (Left Sidebar)

```php
'items' => [
    [
        'label' => 'YII Tools',
        'iconType' => 'far',
        'icon' => 'share',
        'badge' => ['message' => 'New', 'badgeType' => 'danger'],
        'items' => [
            ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
            ['label' => 'Gii', 'url' => ['/gii'], 'icon' => 'file-code', 'target' => '_blank'],
            ['label' => 'Debug', 'url' => ['/debug'], 'icon' => 'bug', 'target' => '_blank', 'badge' => ['badgeType' => 'warning', 'message' => 2]],
        ]
    ],
]
```

#### Layouts (login)

Use the code in your controller.
```php
$this->layout = '/main-login';
```

#### Template for Gii CRUD generator

Tell Gii about our template. The setting is made in the config file:

```php
if (!YII_ENV_TEST) {
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'adminlte3' => '@vendor/potime/yii2-adminlte3/src/gii/generators/crud/adminlte3'
                ]
            ]
        ]
    ];
}
```

Plugin
---
### bs-custom-file-input
A little plugin which makes Bootstrap 4 custom file input dynamic with no dependencies.

[bs-custom-file-input](https://github.com/Johann-S/bs-custom-file-input).

##### How to use it
```php
<?php
\potime\adminlte3\assets\plugin\CustomFileInputAsset::register($this);
?>

$(document).ready(function () {
  bsCustomFileInput.init()
})
```

Thx
---

[ColorlibHQ/AdminLTE](https://github.com/ColorlibHQ/AdminLTE).
 
[dmstr/yii2-adminlte-asset](https://github.com/dmstr/yii2-adminlte-asset).

[hail812/yii2-adminlte3](https://github.com/hail812/yii2-adminlte3).
