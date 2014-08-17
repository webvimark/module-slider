<?php

namespace modules\slider\controllers;

use modules\slider\models\Slider;
use Yii;
use modules\slider\models\SliderImage;
use modules\slider\models\search\SliderImageSearch;
use webvimark\components\AdminDefaultController;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * SliderImageController implements the CRUD actions for SliderImage model.
 */
class SliderImageController extends AdminDefaultController
{
	/**
	 * @var SliderImage
	 */
	public $modelClass = 'modules\slider\models\SliderImage';

	/**
	 * @var SliderImageSearch
	 */
	public $modelSearchClass = 'modules\slider\models\search\SliderImageSearch';

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


	/**
	 * Lists all models.
	 *
	 * @param null|int $slider - Slider ID
	 *
	 * @throws \yii\web\NotFoundHttpException
	 * @return mixed
	 */
	public function actionIndex($slider = null)
	{
		if ( !$slider OR !$sliderModel = Slider::findOne(['code'=>$slider, 'active'=>1]) )
		{
			throw new NotFoundHttpException('Page not found');
		}

		$searchModel = new SliderImageSearch;

		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $sliderModel->id);

		return $this->render('index', compact('dataProvider', 'searchModel', 'sliderModel'));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param null|string $slider
	 *
	 * @throws \yii\web\NotFoundHttpException
	 * @return mixed
	 */
	public function actionCreate($slider = null)
	{
		if ( !$slider OR !$sliderModel = Slider::findOne(['code'=>$slider, 'active'=>1]) )
		{
			throw new NotFoundHttpException('Page not found');
		}

		$model = new SliderImage();
		$model->slider_id = $sliderModel->id;

		if ( $model->load(Yii::$app->request->post()) && $model->save() )
		{
			return $this->redirect($this->getRedirectPage('create', $model));
		}

		return $this->renderIsAjax('create', compact('model', 'sliderModel'));
	}

	/**
	 * Define redirect page after update, create, delete, etc
	 *
	 * @param string       $action
	 * @param SliderImage $model
	 *
	 * @return string|array
	 */
	protected function getRedirectPage($action, $model = null)
	{
		switch ($action)
		{
			case 'delete':
				return ['index', 'slider'=>$model->slider->code];
				break;
			case 'update':
				return ['view', 'id'=>$model->id];
				break;
			case 'create':
				return ['view', 'id'=>$model->id];
				break;
			default:
				return ['index', 'slider'=>$model->slider->code];
		}
	}
}
