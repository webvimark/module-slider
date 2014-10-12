<?php

use app\webvimark\extensions\Cropper\Cropper;
use webvimark\extensions\ckeditor\CKEditor;
use webvimark\modules\slider\models\Slider;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use webvimark\extensions\BootstrapSwitch\BootstrapSwitch;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\slider\models\SliderImage $model
 * @var yii\bootstrap\ActiveForm $form
 * @var Slider $sliderModel
 */
?>
<div class="slider-image-form">

	<?php $form = ActiveForm::begin([
		'id'      => 'slider-image-form',
		'layout'  => 'horizontal',
		'options' => [
			'enctype' => "multipart/form-data",
		]
	]); ?>

	<?= $form->field($model->loadDefaultValues(), 'active')->checkbox(['class'=>'b-switch'], false) ?>

	<div class='form-group'>
		<div class='col-sm-3'></div>
		<div class='col-sm-6'>
			<div id='slider-image'>
				<?php if ( ! $model->isNewRecord AND is_file($model->getImagePath('full', 'image'))): ?>
					<?= Html::img(
						$model->getImageUrl('full', 'image'),
						[
							'alt'=>'image',
							'style'=>'max-width: 100%',
						]
					) ?>
				<?php endif; ?>

			</div>

		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-sm-3"><?= $model->getAttributeLabel('image') ?></label>
		<div class="col-sm-6">
			<input type="file" name="cropperFileUpload" class='form-control'>
		</div>
	</div>


<!--	--><?//= $form->field($model, 'image', ['enableClientValidation'=>false, 'enableAjaxValidation'=>false])->fileInput(['class'=>'form-control']) ?>

	<?php if ( $model->isNewRecord ): ?>

		<?php if ( $sliderModel->has_link == 1 ): ?>
			<?= $form->field($model, 'link') ?>
		<?php endif; ?>

		<?php if ( $sliderModel->has_body == 1 ): ?>
			<?= $form->field($model, 'body')->textarea(['rows'=>5]) ?>
		<?php endif; ?>


	<?php else: ?>

		<?php if ( $model->slider->has_link == 1 ): ?>
			<?= $form->field($model, 'link') ?>
		<?php endif; ?>

		<?php if ( $model->slider->has_body == 1 ): ?>
			<?= $form->field($model, 'body')->textarea(['rows'=>5]) ?>
		<?php endif; ?>

	<?php endif; ?>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<?php if ( $model->isNewRecord ): ?>
				<?= Html::submitButton(
					'<span class="glyphicon glyphicon-plus-sign"></span> Создать',
					['class' => 'btn btn-success']
				) ?>
			<?php else: ?>
				<?= Html::submitButton(
					'<span class="glyphicon glyphicon-ok"></span> Сохранить',
					['class' => 'btn btn-primary']
				) ?>
			<?php endif; ?>
		</div>
	</div>

	<?php ActiveForm::end(); ?>

</div>

<?php BootstrapSwitch::widget() ?>
<?php CKEditor::widget() ?>

<?php if ( !$model->isNewRecord ): ?>

	<?= Cropper::widget([
		'acceptUrl'     => Url::to(['/slider/slider-image/crop']),
		'fileInputName' => 'cropperFileUpload',
		'imageSelector' => '#slider-image',
		'resultSize'    => array($model->slider->width, $model->slider->height),
		'cropParams'=>array(
	//		'minSize'     => array($model->slider->width, $model->slider->height),
			'setSelect'   => array(0,0,$model->slider->width, $model->slider->height),
			'aspectRatio' => $model->slider->width/$model->slider->height,
		),
		'customParams'=>array(
			'modelId'=>$model->id,
		),
	]) ?>
<?php endif; ?>

<?php
$this->registerCss(<<<CSS
#slider-image img {
	max-width: 100%
}
CSS
);
?>