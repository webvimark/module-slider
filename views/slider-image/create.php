<?php

use webvimark\modules\slider\models\Slider;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var Slider $sliderModel
 * @var webvimark\modules\slider\models\SliderImage $model
 */

$this->title = 'Создание картинки слайдера';
$this->params['breadcrumbs'][] = ['label' => 'Слайдер', 'url' => ['index', 'slider'=>$sliderModel->code]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-image-create">

	<div class="panel panel-default">
		<div class="panel-heading">
			<strong>
				<span class="glyphicon glyphicon-th"></span> <?= Html::encode($this->title) ?>
			</strong>
		</div>
		<div class="panel-body">

			<?= $this->render('_form', compact('model', 'sliderModel')) ?>
		</div>
	</div>

</div>
