<?php

namespace webvimark\modules\slider\controllers;

use app\webvimark\extensions\Cropper\CropperHelper;
use webvimark\modules\slider\models\Slider;
use Yii;
use webvimark\modules\slider\models\SliderImage;
use webvimark\modules\slider\models\search\SliderImageSearch;
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
	public $modelClass = 'webvimark\modules\slider\models\SliderImage';

	/**
	 * @var SliderImageSearch
	 */
	public $modelSearchClass = 'webvimark\modules\slider\models\search\SliderImageSearch';

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
		$model->save(false);

		$this->redirect(['update', 'id'=>$model->id]);

	}

	/**
	 * actionCrop
	 */
	public function actionCrop()
	{

		if ( isset($_REQUEST['modelId']) )
		{
			$model = SliderImage::findOne((int)$_REQUEST['modelId']);

			$uploadDir = $model->getUploadDir() . '/full';

			$model->prepareUploadDir($model->getUploadDir());

			$helper = new CropperHelper(
				'cropperFileUpload',
				Yii::$app->request->baseUrl . "/images/slider_image/full/",
				$uploadDir
			);

			if ( isset($_GET['cropper-data']) )
			{
				if ( $model )
				{
					$newImageName = uniqid() . '_' . $helper->_getData('originalName');

					$helper->crop($uploadDir . '/' . $newImageName);
					$helper->deleteTmpImage();

					@unlink($uploadDir . '/' . $model->image);

					$model->image = $newImageName;
					$model->save(false);
				}
			}

			$tmpImage = $helper->getTmpImage();
			if ( $tmpImage )
			{
				$model->image = $tmpImage;

				if ( $model->validate('image') )
				{
					$helper->saveTmpImage($tmpImage);
				}
				else
				{
					$errors_tmp = $model->getErrors('image');
					$helper->throwError($errors_tmp[0]);
				}
			}
		}

		if ( isset($_GET['cropper-deleteTmpImage']) )
		{
			$model = new SliderImage();
			$uploadDir = $model->getUploadDir() . '/full';

			$helper = new CropperHelper(
				'cropperFileUpload',
				Yii::$app->request->baseUrl . "/images/slider_image/full/",
				$uploadDir
			);

			$helper->deleteAllTmpImages();
		}

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
