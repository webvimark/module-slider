<?php
/**
 * @var $this yii\web\View
 * @var $code string
 * @var $slides SliderImage[]
 */

use webvimark\modules\slider\models\SliderImage;
use yii\helpers\Html;

?>
<div class="container">
	<div class="slider-widget">

		<div class="carousel slide slider-widget-<?= $code ?>" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<?php $i = 0; ?>
				<?php foreach ($slides as $slide): ?>

					<li data-target=".slider-widget-<?= $code ?>" data-slide-to="<?= $i++ ?>" class="<?= ($i == 1) ? 'active' :'' ?>"></li>

				<?php endforeach ?>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<?php $i = 0; ?>
				<?php foreach ($slides as $slide): ?>

					<div class="item <?= ($i++ == 0) ? 'active' : '' ?>">
						<?php if ( $slide->slider->has_link == 1 ): ?>

							<?= Html::a(
								Html::img($slide->getImageUrl(), ['alt'=>$slide->slider->name]),
								$slide->link
							) ?>

						<?php else: ?>

							<?= Html::img($slide->getImageUrl()) ?>

						<?php endif; ?>
					</div>

				<?php endforeach ?>
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href=".slider-widget-<?= $code ?>" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href=".slider-widget-<?= $code ?>" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>

	</div>

</div>
