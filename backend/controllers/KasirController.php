<?php

namespace backend\controllers;

use Yii;
use yii\web\Response;
use backend\models\Cart;
use backend\models\Kuitansi;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class KasirController extends \yii\web\Controller
{

    public static function allowedDomains(){
		return [
			'*',				
		];
	}
	
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
		return array_merge(parent::behaviors(), [
			'corsFilter'  => [
				'class' => \yii\filters\Cors::className(),
				'cors'  => [					
					'Origin'                           => static::allowedDomains(),					
					'Access-Control-Allow-Credentials' => true,
					'Access-Control-Max-Age'           => 3600,    
				],
			],

		]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCheckout(){
        
        
        
    }

    public function actionPrint($no_kuitansi){
        include 'inc/pdf.php';
     

        // var_dump($_POST);
        // die;
        
        PrintKasir($no_kuitansi);

    }

  

}
