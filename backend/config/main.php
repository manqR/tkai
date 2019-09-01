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
                'tagihan-lain'=>'tagihan-lain/index',		
                'upload'=>'upload/index',		
                'karyawan' => 'user/index',
                'role' => 'role/index',
                
                //---------------------------------- Create -----------------------------//
                'kelas-create'=>'kelas/create',			
                'tahun-ajaran-create'=>'tahun-ajaran/create',			
                'tagihan-create'=>'tagihan/create',			
                'tagihan-lain-create'=>'tagihan-lain/create',			
                'registrasi-create'=>'registrasi/create',			
                'karyawan-create' => 'user/create',
                'role-create' => 'role/create',


                //---------------------------------- Update -----------------------------//
                'registrasi-update-<id>'=>'registrasi/update',	
                'siswa-update-<id>'=>'siswa/update',	
                'kelas-update-<urutan>'=>'kelas/update',	
                'tahun-ajaran-update-<id>'=>'tahun-ajaran/update',	
                'tagihan-update-<id>'=>'tagihan/update',	
                'tagihan-lain-<id>'=>'tagihan/lain',	
                'karyawan-update-<id>' => 'user/update',
                'role-update' => 'role/update',
                
                
                //---------------------------------- View -----------------------------//
                'registrasi-view-<id>'=>'registrasi/view',			
                'siswa-view-<id>'=>'siswa/view',	


                //---------------------------------- Export -----------------------------//
                'kelassiswa-export-<key>'=>'kelas-siswa/export',	


                //---------------------------------- Delete -----------------------------//
                'kelas-delete-<urutan>'=>'kelas/delete',				
                'karyawan-delete-<id>'=>'user/delete',				
                'siswa-delete-<kode_siswa>'=>'siswa/delete',				

                //---------------------------------- Print -----------------------------//

                'registrasi-print-<id>'=>'registrasi/print',		
                'kasir-print-<no_kuitansi>'=>'kasir/print',		
                'admin-keuangan_print'=>'keuangan/print',		

                //---------------------------------- Kasir -----------------------------//
                'kasir'=>'kasir/index',		

                //---------------------------------- Kwitansi -----------------------------//
                'kuitansi'=>'kuitansi/index',		

                //---------------------------------- Role -----------------------------//
                'role-menu'=>'role/menu',		


                //---------------------------------- Report -----------------------------//
                'admin-keuangan'=>'keuangan/index',		

                
                //---------------------------------- REGISTRASI POST -----------------------------//
                'registrasi-proses'=>'registrasi/proses',

                //---------------------------------- Billing -----------------------------//
                'billing-<page:\d+>'=>'billing/index',
                'billing-detail-<id>'=>'billing/detail',
                
				//---------------------------------- Login -----------------------------//
                'login'=>'site/login',
                'tunggakan-list-<thn>-<grade>'=>'site/tunggakan-list'

			],
		],
        'request' => [
            'csrfParam' => '_csrf-tkai',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 30000,
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
