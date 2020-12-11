<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Reseaucablage;

/**
 * ReseaucablageSearch represents the model behind the search form of `app\models\Reseaucablage`.
 */
class ReseaucablageSearch extends Reseaucablage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_client', 'id_user'], 'integer'],
            [['nb_employe', 'nb_utilisateurs_postes', 'nb_postes', 'postes', 'passage_cables', 'metre_lineaire_cable', 'metre_lineaire_goulotte_total', 'metre_lineaire_faux_plafond', 'metre_lineaire_tube_iro', 'metre_lineaire_goulotte4', 'metre_lineaire_goulotte8', 'metre_lineaire_goulotte10'], 'safe'],
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
        $query = Reseaucablage::find();

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
            'id_client' => $this->id_client,
            'id_user' => $this->id_user,
        ]);

        $query->andFilterWhere(['like', 'nb_employe', $this->nb_employe])
            ->andFilterWhere(['like', 'nb_utilisateurs_postes', $this->nb_utilisateurs_postes])
            ->andFilterWhere(['like', 'nb_postes', $this->nb_postes])
            ->andFilterWhere(['like', 'postes', $this->postes])
            ->andFilterWhere(['like', 'passage_cables', $this->passage_cables])
            ->andFilterWhere(['like', 'metre_lineaire_cable', $this->metre_lineaire_cable])
            ->andFilterWhere(['like', 'metre_lineaire_goulotte_total', $this->metre_lineaire_goulotte_total])
            ->andFilterWhere(['like', 'metre_lineaire_faux_plafond', $this->metre_lineaire_faux_plafond])
            ->andFilterWhere(['like', 'metre_lineaire_tube_iro', $this->metre_lineaire_tube_iro])
            ->andFilterWhere(['like', 'metre_lineaire_goulotte4', $this->metre_lineaire_goulotte4])
            ->andFilterWhere(['like', 'metre_lineaire_goulotte8', $this->metre_lineaire_goulotte8])
            ->andFilterWhere(['like', 'metre_lineaire_goulotte10', $this->metre_lineaire_goulotte10]);

        return $dataProvider;
    }
}
