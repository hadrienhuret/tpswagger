<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "devis".
 *
 * @property int $id_devis Id du devis
 * @property string $date_devis Date du devis
 * @property string $reglement_date_limite Date limite de règlement du devis
 * @property string $reglement_mode Mode de règlement du devis
 * @property int $id_user Id de l'user (Clé étrangère)
 * @property int $id_entreprise Id de l'entreprise (Clé étrangère)
 *
 * @property Entreprise $entreprise
 * @property User $user
 * @property Devisproduit[] $devisproduits
 * @property Produit[] $referenceProduits
 * @property Generationfichier[] $generationfichiers
 */
class Devis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'devis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_devis', 'reglement_date_limite', 'reglement_mode', 'id_user', 'id_entreprise'], 'required'],
            [['date_devis', 'reglement_date_limite'], 'safe'],
            [['reglement_mode'], 'string'],
            [['id_user', 'id_entreprise'], 'integer'],
            [['id_entreprise'], 'exist', 'skipOnError' => true, 'targetClass' => Entreprise::className(), 'targetAttribute' => ['id_entreprise' => 'id_entreprise']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_devis' => 'Id Devis',
            'date_devis' => 'Date Devis',
            'reglement_date_limite' => 'Reglement Date Limite',
            'reglement_mode' => 'Reglement Mode',
            'id_user' => 'Id User',
            'id_entreprise' => 'Id Entreprise',
        ];
    }

    /**
     * Gets query for [[Entreprise]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntreprise()
    {
        return $this->hasOne(Entreprise::className(), ['id_entreprise' => 'id_entreprise']);
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

    /**
     * Gets query for [[Devisproduits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevisproduits()
    {
        return $this->hasMany(Devisproduit::className(), ['id_devis' => 'id_devis']);
    }

    /**
     * Gets query for [[ReferenceProduits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReferenceProduits()
    {
        return $this->hasMany(Produit::className(), ['reference_produit' => 'reference_produit'])->viaTable('devisproduit', ['id_devis' => 'id_devis']);
    }

    /**
     * Gets query for [[Generationfichiers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenerationfichiers()
    {
        return $this->hasMany(Generationfichier::className(), ['id_devis' => 'id_devis']);
    }
}
