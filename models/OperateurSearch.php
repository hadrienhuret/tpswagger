<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Operateur;

/**
 * OperateurSearch represents the model behind the search form of `app\models\Operateur`.
 */
class OperateurSearch extends Operateur
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'id_client'], 'integer'],
            [['emission_reception_appels_silmutanes', 'predecroche', 'message_repondeur', 'svi', 'svi_message_accueil', 'choix'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Operateur::find();

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
            'id_user' => $this->id_user,
            'id_client' => $this->id_client,
        ]);

        $query->andFilterWhere(['like', 'emission_reception_appels_silmutanes', $this->emission_reception_appels_silmutanes])
            ->andFilterWhere(['like', 'predecroche', $this->predecroche])
            ->andFilterWhere(['like', 'message_repondeur', $this->message_repondeur])
            ->andFilterWhere(['like', 'svi', $this->svi])
            ->andFilterWhere(['like', 'svi_message_accueil', $this->svi_message_accueil])
            ->andFilterWhere(['like', 'choix', $this->choix]);

        return $dataProvider;
    }
}
