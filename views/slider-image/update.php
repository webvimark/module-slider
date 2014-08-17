<?php

use yii\helpers\Html;

/**
 * @var yii\web\View                          $this
 * @var webvimark\modules\slider\models\SliderImage $model
 */

$this->title = 'Редактирование картинки слайдера: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Слайдер',
				  'url'   => [
					  'index',
					  'slider' => $model->slider->code
				  ]
];
$this->params['breadcrumbs'][] = ['label' => $model->id,
				  'url'   => [
					  'view',
					  'id' => $model->id
				  ]
];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="slider-image-update">

	<div class="panel panel-default">
		<div class="panel-heading">
			<strong>
				<span class="glyphicon glyphicon-th"></span> <?= Html::encode($this->title) ?>
			</strong>
		</div>
		<div class="panel-body">

			<?= $this->render('_form', compact('model')) ?>
		</div>
	</div>

</div>
