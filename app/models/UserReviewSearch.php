<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserReview;


class UserReviewSearch extends UserReview
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'review', 'rating'], 'required'],
            [['name'], 'string', 'max' => 30],
            [['email', 'review', 'advantage', 'disadvantage'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['email'], 'unique']
        ];
    }

    /**
     * @return array|array[]
     * @inheritdoc
     */
    public function scenarios() : array
    {
        return Model::scenarios();
    }

    /***
     * @param array $params
     * @return ActiveDataProvider
     * @inheritdoc
     */
    public function search($params)
    {
        $query = UserReview::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 25
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'review', $this->review])
            ->andFilterWhere(['like', 'rating', $this->rating])
            ->andFilterWhere(['like', 'advantage', $this->advantage])
            ->andFilterWhere(['like', 'disadvantage', $this->disadvantage])
        ;

        return $dataProvider;
    }
}