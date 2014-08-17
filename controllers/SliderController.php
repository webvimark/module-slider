<?php

namespace webvimark\modules\slider\controllers;

use Yii;
use webvimark\modules\slider\models\Slider;
use webvimark\modules\slider\models\search\SliderSearch;
use webvimark\components\AdminDefaultController;
use yii\filters\VerbFilter;

/**
 * SliderController implements the CRUD actions for Slider model.
 */
class SliderController extends AdminDefaultController
{
	/**
	 * @var Slider
	 */
	public $modelClass = 'webvimark\modules\slider\models\Slider';

	/**
	 * @var SliderSearch
	 */
	public $modelSearchClass = 'webvimark\modules\slider\models\search\SliderSearch';

	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}
}
