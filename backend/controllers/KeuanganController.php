<?php

namespace backend\controllers;

use yii\filters\VerbFilter;

include 'inc/pdf.php';
include 'inc/excel.php';

class KeuanganController extends \yii\web\Controller
{

    public function behaviors(){
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                  // allow authenticated users
                      [
                        'allow' => true,
                        'roles' => ['@'],
                      ],
                  // everything else is denied
                ],
            ],
        ];
    }

    public function actionIndex(){

        return $this->render('index');
    }
    public function actionPrint($periode,$type){
        // if($_POST){
        //     var_dump($_POST);
        //     die;
        //     PrintLapKeuangan($_POST['periode']);
        // }
        // return $this->render('index');
        $type == "pdf" ? PrintLapKeuangan($periode) : printExcel($periode);
        
    }

}
