<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "generationfichier".
 *
 * @property int $id_fichier Id du fichier généré
 * @property string $date Date de génération du fichier
 * @property string $emplacement_pdf Emplacement du pdf généré
 * @property int $id_devis Id du devis (Clé étrangère)
 *
 * @property Devis $devis
 */
class Generationfichier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'generationfichier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'emplacement_pdf', 'id_devis'], 'required'],
            [['date'], 'safe'],
            [['id_devis'], 'integer'],
            [['emplacement_pdf'], 'string', 'max' => 50],
            [['id_devis'], 'exist', 'skipOnError' => true, 'targetClass' => Devis::className(), 'targetAttribute' => ['id_devis' => 'id_devis']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_fichier' => 'Id Fichier',
            'date' => 'Date',
            'emplacement_pdf' => 'Emplacement Pdf',
            'id_devis' => 'Id Devis',
        ];
    }

    /**
     * Gets query for [[Devis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevis()
    {
        return $this->hasOne(Devis::className(), ['id_devis' => 'id_devis']);
    }
}
