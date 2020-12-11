<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "operateur".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_client
 * @property string $emission_reception_appels_silmutanes
 * @property string $predecroche 0 : Non / 1 : Oui
 * @property string $message_repondeur 0 : Non / 1 : Oui
 * @property string $svi 0 : Non / 1 : Oui
 * @property string $svi_message_accueil
 * @property string $choix
 *
 * @property Client $client
 * @property User $user
 */
class Operateur extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operateur';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_client', 'emission_reception_appels_silmutanes', 'predecroche', 'message_repondeur', 'svi', 'svi_message_accueil', 'choix'], 'required'],
            [['id_user', 'id_client'], 'integer'],
            [['emission_reception_appels_silmutanes'], 'string', 'max' => 20],
            [['predecroche', 'message_repondeur', 'svi'], 'string', 'max' => 10],
            [['svi_message_accueil'], 'string', 'max' => 255],
            [['choix'], 'string', 'max' => 3000],
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
            'id_user' => 'Id User',
            'id_client' => 'Id Client',
            'emission_reception_appels_silmutanes' => 'Emission Reception Appels Silmutanes',
            'predecroche' => 'Predecroche',
            'message_repondeur' => 'Message Repondeur',
            'svi' => 'Svi',
            'svi_message_accueil' => 'Svi Message Accueil',
            'choix' => 'Choix',
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
