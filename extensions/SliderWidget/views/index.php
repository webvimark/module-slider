<?php
/**
 * @var $this yii\web\View
 * @var $code string
 * @var $slides SliderImage[]
 */

use modules\slider\models\SliderImage;
use yii\helpers\Html;

?>

<div class="slider-widget slider-widget-<?= $code ?>">

	<ul class="bxslider">
		<?php foreach ($slides as $slide): ?>

			<li>
				<?php if ( $slide->slider->has_link == 1 ): ?>

					<?= Html::a(
						Html::img($slide->getImageUrl(), ['alt'=>$slide->slider->name]),
						$slide->link
					) ?>

				<?php else: ?>

					<?= Html::img($slide->getImageUrl()) ?>

				<?php endif; ?>
			</li>

		<?php endforeach ?>
	</ul>

</div>
