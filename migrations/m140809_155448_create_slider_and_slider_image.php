<?php

use yii\db\Migration;

class m140809_155448_create_slider_and_slider_image extends Migration
{
	public function safeUp()
	{
		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' )
		{
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
		}

		$this->createTable('slider', array(
			'id'         => 'pk',
			'active'     => 'tinyint(1) not null default 1',
			'name'       => 'string not null',
			'code'       => 'string not null',
			'width'      => 'int(4) not null',
			'height'     => 'int(4) not null',
			'created_at' => 'int not null',
			'updated_at' => 'int not null',
		), $tableOptions);


		$this->createTable('slider_image', array(
			'id'         => 'pk',
			'active'     => 'tinyint(1) not null default 1',
			'sorter'     => 'int not null',
			'image'      => 'string not null',
			'slider_id'  => 'int',
			'created_at' => 'int not null',
			'updated_at' => 'int not null',
			0            => 'FOREIGN KEY (slider_id) REFERENCES slider (id) ON DELETE CASCADE ON UPDATE CASCADE',
		), $tableOptions);


	}

	public function safeDown()
	{
		$this->dropTable('slider_image');
		$this->dropTable('slider');

	}
}
