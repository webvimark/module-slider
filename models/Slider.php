<?php

namespace webvimark\modules\slider\models;

use Yii;
use yii\helpers\Inflector;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "slider".
 *
 * @property integer $id
 * @property integer $active
 * @property string $name
 * @property string $code
 * @property integer $width
 * @property integer $height
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $has_link
 * @property integer $has_body
 *
 * @property SliderImage[] $sliderImages
 */
class Slider extends \webvimark\components\BaseActiveRecord
{
	/**
	* @inheritdoc
	*/
	public static function tableName()
	{
		return 'slider';
	}

	/**
	* @inheritdoc
	*/
	public function behaviors()
	{
		return [
			TimestampBehavior::className(),
		];
	}

	/**
	* @inheritdoc
	*/
	public function rules()
	{
		return [
			[['active', 'width', 'height', 'created_at', 'updated_at', 'has_link', 'has_body'], 'integer'],
			[['name', 'code', 'width', 'height'], 'required'],
			[['name', 'code'], 'string', 'max' => 255]
		];
	}

	/**
	* @inheritdoc
	*/
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'active' => 'Активно',
			'name' => 'Название',
			'code' => 'Код',
			'width' => 'Width',
			'height' => 'Height',
			'created_at' => 'Создано',
			'updated_at' => 'Обновлено',
			'has_link' => 'Has Link',
			'has_body' => 'Has Body',
		];
	}

	/**
	* @return \yii\db\ActiveQuery
	*/
	public function getSliderImages()
	{
		return $this->hasMany(SliderImage::className(), ['slider_id' => 'id']);
	}


	/**
	 * Удаляем связанные SliderImage (а они удалят в свою очередь картинки)
	 *
	 * @return bool
	 */
	public function beforeDelete()
	{
		if ( parent::beforeDelete() )
		{
			foreach ($this->sliderImages as $sliderImage)
			{
				$sliderImage->delete();
			}

			return true;
		}

		return false;
	}
}
