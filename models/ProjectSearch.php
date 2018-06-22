<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProjectSearch represents the model behind the search form about `app\models\Projects`.
 */
class ProjectSearch extends Projects
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'category_id', 'rating'], 'integer'],
            [['title', 'assigned_to', 'priority', 'sort_order', 'percentage_complete', 'stake_holder', 'phase', 'status', 'start_date', 'end_date', 'custom_field', 'is_hide', 'more_info'], 'safe'],
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
    public function search($params, $category_id = 0, $due = 0, $hidden = 0, $user_id = 0)
    {
        $query = Projects::find()->orderBy('sort_order asc');
        // add conditions that should always apply here
        if ($category_id != '0') {
            $query->andWhere(['category_id' => $category_id]);
        }
        if ($user_id != '0') {
            $query->andWhere(['user_id' => $user_id]);
        }
        if ($hidden != '0') {
            $query->andWhere(['is_hide' => 'No']);
        }
        if ($due != '0') {
            if ($due == "today") {
                $query->andWhere(
                    'CURDATE() = end_date'
                );
            } else if ($due == "tomorrow") {
                $query->andWhere(
                    'date_add(CURDATE(), INTERVAL 1 DAY) = end_date'
                );
            } else if ($due == "week") {
                $query->andWhere(
                    'end_date BETWEEN DATE_ADD(CURDATE(), INTERVAL 2 DAY) AND DATE_ADD(CURDATE(), INTERVAL 8 DAY)'
                );
            } else if ($due == "over") {
                $query->andWhere(
                    'CURDATE() > end_date'
                );
            } else if ($due == "focus") {
                $query->andWhere(
                    'is_focus=1'
                );
            }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
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
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'rating' => $this->rating,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'assigned_to', $this->assigned_to])
            ->andFilterWhere(['like', 'phase', $this->phase])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'custom_field', $this->custom_field])
            ->andFilterWhere(['like', 'more_info', $this->more_info])
            ->andFilterWhere(['like', 'priority', $this->priority])
            ->andFilterWhere(['like', 'sort_order', $this->sort_order])
            ->andFilterWhere(['like', 'percentage_completed', $this->percentage_complete])
            ->andFilterWhere(['like', 'stake_holder', $this->stake_holder])
            ->andFilterWhere(['like', 'is_hide', $this->is_hide]);

        return $dataProvider;
    }

    public function searchAll($params)
    {
        $query = Projects::find()->orderBy('sort_order asc');

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
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'rating' => $this->rating,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'assigned_to', $this->assigned_to])
            ->andFilterWhere(['like', 'phase', $this->phase])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'custom_field', $this->custom_field])
            ->andFilterWhere(['like', 'more_info', $this->more_info])
            ->andFilterWhere(['like', 'priority', $this->priority])
            ->andFilterWhere(['like', 'sort_order', $this->sort_order])
            ->andFilterWhere(['like', 'percentage_completed', $this->percentage_complete])
            ->andFilterWhere(['like', 'stake_holder', $this->stake_holder])
            ->andFilterWhere(['like', 'is_hide', $this->is_hide]);

        return $dataProvider;
    }
}
