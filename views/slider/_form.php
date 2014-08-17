<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use webvimark\extensions\BootstrapSwitch\BootstrapSwitch;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\slider\models\Slider $model
 * @var yii\bootstrap\ActiveForm $form
 */
?>
<div class="slider-form">

	<?php $form = ActiveForm::begin([
		'id'=>'slider-form',
		'layout'=>'horizontal',
		]); ?>

	<?= $form->field($model->loadDefaultValues(), 'active')->checkbox(['class'=>'b-switch'], false) ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => 255, 'autofocus'=>$model->isNewRecord ? true:false]) ?>

	<?= $form->field($model, 'width')->textInput() ?>

	<?= $form->field($model, 'height')->textInput() ?>

	<?= $form->field($model->loadDefaultValues(), 'has_link')->checkbox(['class'=>'b-switch'], false) ?>

	<?= $form->field($model->loadDefaultValues(), 'has_body')->checkbox(['class'=>'b-switch'], false) ?>

	<?= $form->field($model, 'code')->textInput(['maxlength' => 255]) ?>

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