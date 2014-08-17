<?php

namespace modules\slider\extensions\SliderWidget;


use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Class SliderWidgetAsset
 *
 * Wrapper for http://bxslider.com
 *
 * @package app\webvimark\extensions\SliderWidget
 */
class SliderWidgetAsset extends AssetBundle
{
	public function init()
	{
		$this->sourcePath = __DIR__ . '/assets';
		$this->js = ['jquery.bxslider.min.js'];
		$this->css = ['jquery.bxslider.css'];

		$this->depends = [
			JqueryAsset::className(),
		];

		parent::init();
	}
} 