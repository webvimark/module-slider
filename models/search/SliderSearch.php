<?php

namespace webvimark\modules\slider\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use webvimark\modules\slider\models\Slider;

/**
 * SliderSearch represents the model behind the search form about `webvimark\modules\slider\models\Slider`.
 */
class SliderSearch extends Slider
{
	public function rules()
	{
		return [
			[['id', 'active', 'width', 'height', 'created_at', 'updated_at', 'has_link', 'has_body'], 'integer'],
			[['name', 'code'], 'safe'],
		];
	}

	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	public function search($params)
	{
		$query = Slider::find();

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
			'slider.id' => $this->id,
			'slider.active' => $this->active,
			'slider.width' => $this->width,
			'slider.height' => $this->height,
			'slider.created_at' => $this->created_at,
			'slider.updated_at' => $this->updated_at,
			'slider.has_link' => $this->has_link,
			'slider.has_body' => $this->has_body,
		]);

        	$query->andFilterWhere(['like', 'slider.name', $this->name])
			->andFilterWhere(['like', 'slider.code', $this->code]);

		return $dataProvider;
	}
}
