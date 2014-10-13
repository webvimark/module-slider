<?php

use yii\db\Migration;

class m140809_172908_insert_main_slider extends Migration
{
	public function safeUp()
	{
		$this->insert('slider', [
			'active'=>1,
			'name'=>'Основной слайдер',
			'code'=>'main',
			'width'=>1280,
			'height'=>450,
			'has_body'=>1,
		]);
	}

	public function safeDown()
	{
		$this->delete('slider', ['code'=>'main']);
	}
}
