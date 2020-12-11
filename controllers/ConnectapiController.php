<?php

namespace app\controllers;

use app\models\Connectapi;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;
use yii\web\Response;

class ConnectapiController extends ActiveController
{
    public $modelClass = 'app\models\Connectapi';

    public function behaviors()
    {
    }

    public function beforeAction($action)
    {
        try {
            if (parent::beforeAction($action)) {
                \Yii::$app->response->format = Response::FORMAT_JSON;
                return true;
            }
        } catch (BadRequestHttpException $e) {
        }
        return false;
    }

    public function actions()
    {
        $actions = parent::actions();
        $actions['index'] = [

            'class' => 'yii\rest\IndexAction',

            'modelClass' => $this->modelClass,

            'checkAccess' => [$this, 'checkAccess'],

            'prepareDataProvider' => function () {

                $model = new $this->modelClass;

                $query = $model::find();

                return new ActiveDataProvider([

                    'query' => $query,

                    'pagination' => false,
                ]);
            },
        ];
        return $actions;
    }

}