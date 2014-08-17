<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\slider\models\Slider $model
 */

$this->title = 'Редактирование списка слайдеров: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Список слайдеров', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="slider-update">

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
