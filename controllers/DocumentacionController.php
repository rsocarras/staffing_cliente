<?php

namespace app\controllers;

use yii\web\Controller;

class DocumentacionController extends Controller
{
    public function actionManualUsuario()
    {
        $this->layout = 'main';
        return $this->render('manual-usuario');
    }

    public function actionCrearRequisicion()
    {
        $this->layout = 'main';
        return $this->render('crear-requisicion');
    }
}

