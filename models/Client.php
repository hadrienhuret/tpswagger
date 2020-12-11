<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string $nom
 * @property string $societe
 * @property string $siret
 * @property string $adresse
 * @property int $codepostal
 * @property string $ville
 * @property string $telephone
 * @property string $telephone2
 * @property string $email
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nom', 'societe', 'siret', 'adresse', 'codepostal', 'ville', 'telephone', 'email'], 'required'],
            [['codepostal'], 'string', 'max' => 10],
            [['nom', 'societe', 'adresse', 'ville', 'email'], 'string', 'max' => 255],
            [['siret'], 'string', 'max' => 17],
            [['telephone', 'telephone2'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nom' => 'Nom',
            'societe' => 'Societe',
            'siret' => 'Siret',
            'adresse' => 'Adresse',
            'codepostal' => 'Codepostal',
            'ville' => 'Ville',
            'telephone' => 'Telephone',
            'telephone2' => 'Telephone2',
            'email' => 'Email',
        ];
    }
}
