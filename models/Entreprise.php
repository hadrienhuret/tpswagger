<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\web\Link;

/**
 * This is the model class for table "entreprise".
 *
 * @property int $id_entreprise Id de l'Entreprise - Clé primaire
 * @property string $nom Nom de l'Entreprise
 * @property string $logo Logo de l'Entreprise
 * @property string $adresse Adresse de l'Entreprise
 * @property string $cp Code Postal de l'Entreprise
 * @property string $ville Ville de l'Entreprise
 * @property string $pays Pays de l'Entreprise
 * @property string $telephone Téléphone de l'Entreprise
 * @property string $fax Fax de l'Entreprise
 * @property string $email Email de l'Entreprise
 * @property string $siret Siret de l'Entreprise
 * @property string $rcs_ville RCS Ville de l'Entreprise
 * @property string $code_naf Code NAF de l'Entreprise
 * @property string $num_tva Numero TVA de l'Entreprise
 *
 * @property Devis[] $devis
 */
class Entreprise extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entreprise';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nom', 'logo', 'adresse', 'cp', 'ville', 'pays', 'telephone', 'fax', 'email', 'siret', 'rcs_ville', 'code_naf', 'num_tva'], 'required'],
            [['siret'], 'string', 'max' => 14],
            [['nom', 'logo', 'adresse', 'ville', 'pays', 'email', 'rcs_ville'], 'string', 'max' => 50],
            [['cp', 'code_naf'], 'string', 'max' => 5],
            [['telephone', 'fax'], 'string', 'max' => 12],
            [['num_tva'], 'string', 'max' => 13],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_entreprise' => 'Id Entreprise',
            'nom' => 'Nom',
            'logo' => 'Logo',
            'adresse' => 'Adresse',
            'cp' => 'Cp',
            'ville' => 'Ville',
            'pays' => 'Pays',
            'telephone' => 'Telephone',
            'fax' => 'Fax',
            'email' => 'Email',
            'siret' => 'Siret',
            'rcs_ville' => 'Rcs Ville',
            'code_naf' => 'Code Naf',
            'num_tva' => 'Num Tva',
        ];
    }

    /**
     * Gets query for [[Devis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDevis()
    {
        return $this->hasMany(Devis::className(), ['id_entreprise' => 'id_entreprise']);
    }

    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['user/view', 'id' => $this->id], true),
            'edit' => Url::to(['user/view', 'id' => $this->id], true),
            'profile' => Url::to(['user/profile/view', 'id' => $this->id], true),
            'index' => Url::to(['users'], true),
        ];
    }
}
