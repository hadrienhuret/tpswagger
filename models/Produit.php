<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "produit".
 *
 * @property string $reference_produit Référence du produit
 * @property string $designation Désignation du produit
 * @property int $quantite Quantité de ce produit
 * @property float $prix_ht Prix HT du produit
 * @property int $checked Checked
 *
 * @property Devisproduit[] $devisproduits
 * @property Devis[] $devis
 */
class Produit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['designation', 'quantite', 'prix_ht'], 'required'],
            [['quantite', 'checked'], 'integer'],
            [['prix_ht'], 'number'],
            [['reference_produit'], 'string', 'max' => 30],
            [['designation'], 'string', 'max' => 50],
            [['reference_produit'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'reference_produit' => 'Reference Produit',
            'designation' => 'Designation',
            'quantite' => 'Quantite',
            'prix_ht' => 'Prix Ht',
	    'checked' => 'Checked',
        ];
    }

    /**
     * Gets query for [[Devisproduits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevisproduits()
    {
        return $this->hasMany(Devisproduit::className(), ['reference_produit' => 'reference_produit']);
    }

    /**
     * Gets query for [[Devis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevis()
    {
        return $this->hasMany(Devis::className(), ['id_devis' => 'id_devis'])->viaTable('devisproduit', ['reference_produit' => 'reference_produit']);
    }
}
