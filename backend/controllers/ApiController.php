<?php

namespace backend\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Siswa;


class ApiController extends Controller
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
    public function actionSiswa(){
 
        if(Yii::$app->user->identity->auth_key){
            $connection = \Yii::$app->db;
            $query = $connection->createCommand("SELECT * FROM v_siswa");
            $data = $query->queryAll();
            
            $output = array();
            
            $obj = new Siswa();
            $arrFields = array_keys($obj->attributes); 
            
            foreach($arrFields as $Fields):
                foreach($data as $key => $models):              
                    $output[$key] = $models[$Fields];                   
                endforeach;
            endforeach;		
            
          
            $data = json_encode($output);
            $data = [
                'data'=>$output
            ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }else{           
            $data = [
                'msg'=>'Auth not allowed'
            ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $data;
        }
    }
}

?>