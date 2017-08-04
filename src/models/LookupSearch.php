<?php

namespace zacksleo\yii2\lookup\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use zacksleo\yii2\lookup\models\Lookup;

/**
 * LookupSearch represents the model behind the search form about `backend\modules\lookup\models\Lookup`.
 */
class LookupSearch extends Lookup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'code', 'active', 'order', 'created_at', 'updated_at'], 'integer'],
            [['type', 'name', 'comment'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Lookup::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'code' => $this->code,
            'active' => $this->active,
            'order' => $this->order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
