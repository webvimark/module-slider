<?php

namespace modules\slider\controllers;

use Yii;
use modules\slider\models\Slider;
use modules\slider\models\search\SliderSearch;
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
	public $modelClass = 'modules\slider\models\Slider';

	/**
	 * @var SliderSearch
	 */
	public $modelSearchClass = 'modules\slider\models\search\SliderSearch';

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
