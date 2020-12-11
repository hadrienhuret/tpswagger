<?php

namespace app\controllers;

use app\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;
use yii\web\Response;

class ClientController extends ActiveController
{
    public $modelClass = 'app\models\Client';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => '\yii\filters\Cors',
            'cors' => [
                'Origin' => ['http://localhost:19006'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => function ($username, $password) {
                \Yii::info("Le systeme tente de se connecter avec un nom d'utilisateur et un token d'accès", 'auth');
                return User::find()->andWhere([
                    'username' => $username,
                    'password' => $password,
                ])->one();
            }
        ];

        $behaviors['authenticator']['except'] = ['options'];
        return $behaviors;
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
        $actions['index']['dataFilter'] = [
            'class' => 'yii\data\ActiveDataFilter',
            'searchModel' => 'app\models\ClientSearch'
        ];
        return $actions;
    }

    public function actionSearch()
    {
        if (!empty($_GET)) {
            $model = new $this->modelClass;
            foreach ($_GET as $key => $value) {
                if (!$model->hasAttribute($key)) {
                    throw new \yii\web\HttpException(404, 'Invalid attribute:' . $key);
                }
            }
            try {
                $provider = new ActiveDataProvider([
                    'query' => $model->find()->where($_GET),
                    'pagination' => false
                ]);
            } catch (Exception $ex) {
                throw new \yii\web\HttpException(500, 'Internal server error');
            }

            if ($provider->getCount() <= 0) {
                throw new \yii\web\HttpException(404, 'No entries found with this query string');
            } else {
                return $provider;
            }
        } else {
            throw new \yii\web\HttpException(400, 'There are no query string');
        }
    }

}
