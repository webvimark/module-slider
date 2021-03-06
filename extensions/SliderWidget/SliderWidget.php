<?php

namespace webvimark\modules\slider\extensions\SliderWidget;


use webvimark\modules\slider\models\SliderImage;
use yii\base\Widget;
use yii\helpers\Json;

/**
 * Class SliderWidget
 *
 * To see plugin options visit http://bxslider.com/options
 *
 * @package app\webvimark\extensions\SliderWidget
 */
class SliderWidget extends Widget
{
	/**
	 * @var string
	 */
	public $code;

	/**
	 * @var array
	 */
	public $pluginOptions = [];

	public function run()
	{
		$slides = SliderImage::find()
			->innerJoinWith('slider')
			->andWhere([
				'slider.active'=>1,
				'slider.code'=>$this->code,
				'slider_image.active'=>1,
			])
			->orderBy([
				'slider_image.sorter'=>SORT_ASC,
				'slider_image.id'=>SORT_DESC,
			])
			->all();

		if ( $slides )
		{
			return $this->render('index', [
				'slides'=>$slides,
				'code'=>$this->code,
			]);
		}
	}

} 