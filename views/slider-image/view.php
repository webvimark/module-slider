<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\slider\models\SliderImage $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Слайдер', 'url' => ['index', 'slider'=>$model->slider->code]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-image-view">


	<div class="panel panel-default">
		<div class="panel-heading">
			<strong>
				<span class="glyphicon glyphicon-th"></span> <?= Html::encode($this->title) ?>
			</strong>
		</div>
		<div class="panel-body">

			<p>
				<?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
				<?= Html::a('Создать', ['create', 'slider'=>$model->slider->code], ['class' => 'btn btn-sm btn-success']) ?>
				<?= Html::a('Удалить', ['delete', 'id' => $model->id], [
					'class' => 'btn btn-sm btn-danger pull-right',
					'data' => [
						'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
						'method' => 'post',
					],
				]) ?>
			</p>

			<?= DetailView::widget([
				'model' => $model,
				'attributes' => [
									'id',
					[
						'attribute'=>'active',
						'value'=>($model->active == 1) ?
								'<span class="label label-success">Да</span>' :
								'<span class="label label-warning">Нет</span>',
						'format'=>'raw',
					],
					[
						'attribute'=>'image',
						'value'=>Html::img(
								$model->getImageUrl('full', 'image'),
								['style'=>'max-width:700px']
							),
						'visible'=>is_file($model->getImagePath('full', 'image')),
						'format'=>'raw',
					],
					[
						'attribute'=>'link',
						'visible'=>$model->slider->has_link == 1,
						'format'=>'url',
					],
					[
						'attribute'=>'body',
						'visible'=>$model->slider->has_body == 1,
						'format'=>'raw',
					],
					'created_at:datetime',
					'updated_at:datetime',
				],
			]) ?>

		</div>
	</div>
</div>
