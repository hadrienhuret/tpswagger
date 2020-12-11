<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reseaucablage".
 *
 * @property int $id
 * @property int $id_client
 * @property int $id_user
 * @property string $nb_employe
 * @property string $nb_utilisateurs_postes
 * @property string $nb_postes
 * @property string $postes
 * @property string|null $passage_cables
 * @property string|null $metre_lineaire_cable
 * @property string|null $metre_lineaire_goulotte_total
 * @property string|null $metre_lineaire_faux_plafond
 * @property string|null $metre_lineaire_tube_iro
 * @property string|null $metre_lineaire_goulotte4
 * @property string|null $metre_lineaire_goulotte8
 * @property string|null $metre_lineaire_goulotte10
 *
 * @property Client $client
 * @property User $user
 */
class Reseaucablage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reseaucablage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_client', 'id_user', 'nb_employe', 'nb_utilisateurs_postes', 'nb_postes', 'postes'], 'required'],
            [['id_client', 'id_user'], 'integer'],
            [['nb_employe', 'nb_utilisateurs_postes', 'nb_postes', 'metre_lineaire_cable', 'metre_lineaire_goulotte_total', 'metre_lineaire_faux_plafond', 'metre_lineaire_tube_iro', 'metre_lineaire_goulotte4', 'metre_lineaire_goulotte8', 'metre_lineaire_goulotte10'], 'string', 'max' => 10],
            [['postes'], 'string', 'max' => 3000],
            [['passage_cables'], 'string', 'max' => 200],
            [['id_client'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['id_client' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_client' => 'Id Client',
            'id_user' => 'Id User',
            'nb_employe' => 'Nb Employe',
            'nb_utilisateurs_postes' => 'Nb Utilisateurs Postes',
            'nb_postes' => 'Nb Postes',
            'postes' => 'Postes',
            'passage_cables' => 'Passage Cables',
            'metre_lineaire_cable' => 'Metre Lineaire Cable',
            'metre_lineaire_goulotte_total' => 'Metre Lineaire Goulotte Total',
            'metre_lineaire_faux_plafond' => 'Metre Lineaire Faux Plafond',
            'metre_lineaire_tube_iro' => 'Metre Lineaire Tube Iro',
            'metre_lineaire_goulotte4' => 'Metre Lineaire Goulotte4',
            'metre_lineaire_goulotte8' => 'Metre Lineaire Goulotte8',
            'metre_lineaire_goulotte10' => 'Metre Lineaire Goulotte10',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'id_client']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
