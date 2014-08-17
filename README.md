Slider modules for Yii 2
=====


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist webvimark/module-slider "*"
```

or add

```
"webvimark/module-slider": "*"
```

to the require section of your `composer.json` file.

Configuration
-------------

In your config/web.php

```php
	'modules'=>[
		...

		'slider' => [
			'class' => 'webvimark\webvimark\modules\slider\SliderModule',
		],

		...
	],
```


Usage
-----

Go to http://site.com/slider/slider/index
Go to http://site.com/slider/slider-image/index

and finally use widget

```php

<?= SliderWidget::widget([
	'code'=>'main',
	'pluginOptions'=>[
		'auto'=>true,
		'pause'=>5000,
	],
]) ?>

```