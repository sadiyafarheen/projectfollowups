<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Updates;

/**
 * UpdatesSearch represents the model behind the search form about `app\models\Updates`.
 */
class UpdatesSearch extends Updates
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_close'], 'integer'],
            [['update_type', 'update_text', 'response', 'due_date', 'date'], 'safe'],
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
    public function search($params, $project_id)
    {
        $query = Updates::find()->joinWith(['projectUpdate'])
            ->where(['project_id' => $project_id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'is_close' => $this->is_close,
            'due_date' => $this->due_date,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'update_type', $this->update_type])
            ->andFilterWhere(['like', 'update_text', $this->update_text])
            ->andFilterWhere(['like', 'response', $this->response]);

        return $dataProvider;
    }
}
