<?php

namespace webvimark\modules\slider\models;

use webvimark\image\Image;
use Yii;
use yii\helpers\Inflector;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "slider_image".
 *
 * @property integer $id
 * @property integer $active
 * @property integer $sorter
 * @property string $image
 * @property integer $slider_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $link
 * @property string $body
 *
 * @property Slider $slider
 */
class SliderImage extends \webvimark\components\BaseActiveRecord
{
	public $thumbs = [
		'full' => null,
	];

	/**
	* @inheritdoc
	*/
	public static function tableName()
	{
		return 'slider_image';
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
			[['active', 'sorter', 'slider_id', 'created_at', 'updated_at'], 'integer'],
			[['body'], 'string'],
			[['link'], 'string', 'max' => 255],
			[['image'], 'image', 'maxSize' => 1024*1024*5, 'extensions'=>['gif', 'png', 'jpg', 'jpeg']]
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
			'sorter' => 'Порядок',
			'image' => 'Изображение',
			'created_at' => 'Создано',
			'updated_at' => 'Обновлено',
			'link' => 'Ссылка',
			'body' => 'Текст',
		];
	}


	/**
	 * saveImage
	 *
	 * @param UploadedFile $file
	 * @param string        $imageName
	 */
	public function saveImage($file, $imageName)
	{
		if ( ! $file )
			return;

		$uploadDir = $this->getUploadDir();

		$this->prepareUploadDir($uploadDir);

		if ( is_array($this->thumbs) AND !empty($this->thumbs) )
		{
			foreach ($this->thumbs as $dir => $size)
			{
				$img = Image::factory($file->tempName);

				// If $size is array of dimensions - resize, else - just save
				if ( ! is_array($size) )
				{
					$size = [
						$this->slider->width,
						$this->slider->height,
					];
				}

				$img->resize(implode(',', $size))->save($uploadDir . '/'. $dir . '/' . $imageName);

			}

			@unlink($file->tempName);
		}
		else
		{
			$file->saveAs($uploadDir . '/' . $imageName);

		}
	}


	/**
	* @return \yii\db\ActiveQuery
	*/
	public function getSlider()
	{
		return $this->hasOne(Slider::className(), ['id' => 'slider_id']);
	}

	public function afterDelete()
	{
		$this->deleteImage($this->image);

		parent::afterDelete();
	}
}
