<?php

namespace modules\slider\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use modules\slider\models\SliderImage;

/**
 * SliderImageSearch represents the model behind the search form about `modules\slider\models\SliderImage`.
 */
class SliderImageSearch extends SliderImage
{
	public function rules()
	{
		return [
			[['id', 'active', 'sorter', 'link', 'created_at', 'updated_at'], 'integer'],
		];
	}

	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	public function search($params, $slider_id)
	{
		$query = SliderImage::find();

		$query->andWhere(['slider_image.slider_id' => $slider_id]);

		if ( ! Yii::$app->request->get('sort') )
		{
			$query->orderBy('slider_image.sorter');
		}

		$query->joinWith(['slider']);

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => Yii::$app->request->cookies->getValue('_grid_page_size', 20),
			],
			'sort'=>[
				'defaultOrder'=>['id'=> SORT_DESC],
			],
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
			'slider_image.id' => $this->id,
			'slider_image.active' => $this->active,
			'slider_image.sorter' => $this->sorter,
			'slider_image.slider_id' => $this->slider_id,
			'slider_image.created_at' => $this->created_at,
			'slider_image.updated_at' => $this->updated_at,
		]);

		$query->andFilterWhere(['like', 'slider_image.link', $this->link]);


		return $dataProvider;
	}
}
