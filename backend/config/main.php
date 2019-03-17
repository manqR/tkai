<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
	'id' => 'app-backend',
	'name' => 'TKAI',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
		'urlManager' => [
            'class' => 'yii\web\UrlManager',
			
            'showScriptName' => false,
            'enablePrettyUrl' => true,
			'rules'=>[
				
				//---------------------------------- index -----------------------------//
				'registrasi'=>'registrasi/index',
				'siswa'=>'siswa/index',
				'kelassiswa'=>'kelas-siswa/index',				
				'kelas'=>'kelas/index',				
				'tahun-ajaran'=>'tahun-ajaran/index',				
				'tagihan'=>'tagihan/index',				
				
                //---------------------------------- Create -----------------------------//
                'kelas-create'=>'kelas/create',			
                'tahun-ajaran-create'=>'tahun-ajaran/create',			
                'tagihan-create'=>'tagihan/create',			
                'registrasi-create'=>'registrasi/create',			


                //---------------------------------- Update -----------------------------//
                'registrasi-update-<id>'=>'registrasi/update',	
                'siswa-update-<id>'=>'siswa/update',	
                
                
                //---------------------------------- View -----------------------------//
                'registrasi-view-<id>'=>'registrasi/view',			
                'siswa-view-<id>'=>'siswa/view',			

                //---------------------------------- Print -----------------------------//

                'registrasi-print-<id>'=>'registrasi/print',		

                //---------------------------------- Kasir -----------------------------//
                'kasir'=>'kasir/index',		

                //---------------------------------- Kwitansi -----------------------------//
                'kwitansi'=>'kwitansi/index',		

                
                //---------------------------------- REGISTRASI POST -----------------------------//
                'registrasi-proses'=>'registrasi/proses',

                //---------------------------------- Billing -----------------------------//
                'billing-<page:\d+>'=>'billing/index',
                'billing-detail-<id>'=>'billing/detail',
                
				//---------------------------------- Login -----------------------------//
				'login'=>'site/login',

			],
		],
        'request' => [
            'csrfParam' => '_csrf-tkai',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'tkai-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],        
              
    ],
    'params' => $params,
];
