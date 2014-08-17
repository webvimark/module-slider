<?php

use yii\db\Migration;

class m140809_185636_add_link_and_text_to_slider extends Migration
{
	public function safeUp()
	{
		$this->addColumn('slider_image', 'link', 'varchar(255) not null');
		$this->addColumn('slider_image', 'body', 'text');

		$this->addColumn('slider', 'has_link', 'tinyint(1) not null default 1');
		$this->addColumn('slider', 'has_body', 'tinyint(1) not null default 0');

		Yii::$app->cache->flush();


	}

	public function safeDown()
	{
		$this->dropColumn('slider_image', 'link');
		$this->dropColumn('slider_image', 'body');

		$this->dropColumn('slider', 'has_link');
		$this->dropColumn('slider', 'has_body');

		Yii::$app->cache->flush();

	}
}
