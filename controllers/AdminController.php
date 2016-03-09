<?php

namespace app\controllers;

use Yii;
use app\models\UserLoginForm;

class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if(!\Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }
        
        $model = new UserLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        
        return $this->render('index', ['model'=> $model]);
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();
        
        return $this->goHome();
    }

}
