<?php

use webvimark\modules\slider\models\Slider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use webvimark\extensions\GridBulkActions\GridBulkActions;
use webvimark\extensions\GridPageSize\GridPageSize;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var Slider $sliderModel
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var webvimark\modules\slider\models\search\SliderImageSearch $searchModel
 */

$this->title = 'Слайдер';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-image-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<strong>
				<span class="glyphicon glyphicon-th"></span>  <?= Html::encode($this->title) ?>
			</strong>

			<?= GridPageSize::widget(['pjaxId'=>'slider-image-grid-pjax']) ?>
		</div>

		<div class="panel-body">

			<div class="row">
				<div class="col-sm-6">
					<p>
						<?= Html::a(
							'<span class="glyphicon glyphicon-plus-sign"></span> ' . 'Создать',
							['create', 'slider'=>$sliderModel->code],
							['class' => 'btn btn-sm btn-success']
						) ?>
					</p>
				</div>

				<div class="col-sm-6 text-right">
					<?= GridBulkActions::widget(['gridId'=>'slider-image-grid']) ?>
				</div>
			</div>


			<?php Pjax::begin([
				'id'=>'slider-image-grid-pjax',
			]) ?>

			<?= GridView::widget([
				'id'=>'slider-image-grid',
				'dataProvider' => $dataProvider,
				'pager'=>[
					'options'=>['class'=>'pagination pagination-sm'],
					'hideOnSinglePage'=>true,
					'lastPageLabel'=>'>>',
					'firstPageLabel'=>'<<',
				],
				'layout'=>'{items}<div class="row"><div class="col-sm-8">{pager}</div><div class="col-sm-4 text-right">{summary}</div></div>',
				'filterModel' => $searchModel,
				'columns' => [
					['class' => 'yii\grid\SerialColumn', 'options'=>['style'=>'width:10px'] ],

					[
						'value'=>function($model){
								return Html::a(
									Html::img($model->getImageUrl('medium', 'image')),
									['update', 'id'=>$model->id],
									['data-pjax'=>0]
								);
							},
						'format'=>'raw',
					],
					[
						'attribute'=>'link',
						'visible'=>$sliderModel->has_link == 1,
					],
					[
						'class'=>'webvimark\components\StatusColumn',
						'attribute'=>'active',
						'toggleUrl'=>Url::to(['toggle-attribute', 'attribute'=>'active', 'id'=>'_id_']),
					],
					['class' => 'webvimark\components\SorterColumn'],

					['class' => 'yii\grid\CheckboxColumn', 'options'=>['style'=>'width:10px'] ],
					[
						'class' => 'yii\grid\ActionColumn',
						'contentOptions'=>['style'=>'width:70px; text-align:center;'],
					],
				],
			]); ?>
		
			<?php Pjax::end() ?>
		</div>
	</div>
</div>
