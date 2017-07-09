<?php

namespace app\controllers;


use yii\web\Controller;

class LoggedUserController extends Controller
{
    /**
     * Displays adminPanel page.
     *
     * @return string
     */
    public function actionLogged_user_panel()
    {
        return $this->render('logged_user_panel');
    }
}