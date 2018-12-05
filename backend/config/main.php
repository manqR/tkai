<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
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
				
				//---------------------------------- STUDENT -----------------------------//
				'siswa'=>'siswa/index',								
				'class'=>'kelas-group/index',								
				'billing'=>'tagihan-siswa/index',
				'spp' => 'spp/index',
				'upload' => 'upload/index',
				'upload-upload' => 'upload/upload',
				'tagihan_siswa-print-<idsiswa>-<idbilling>' => 'tagihan-siswa/print',
				//---------------------------------- </STUDENT -----------------------------//
				
				//---------------------------------- SETUP -----------------------------//
				'tagihan'=>'tagihan/index',				
				'kelas'=>'kelas/index',
				'jurusan'=>'jurusan/index',				
				'registration'=>'siswa/index',
				'ajaran'=>'tahun-ajaran/index',
				'biaya_tidak_tetap'=>'biaya-tidak-tetap/index',								
				//---------------------------------- /SETUP -----------------------------//


				//---------------------------------- <PENCATATAN KEUANGAN> -----------------------------//
				'pencatatan'=>'pencatatan-keuangan/index',

				//---------------------------------- </PENCATATAN KEUANGAN> -----------------------------//

				//---------------------------------- <KASIR> -----------------------------//
				'kasir'=>'kasir/index',
				//---------------------------------- </KASIR> -----------------------------//
				
				//---------------------------------- CREATE -----------------------------//
				'jurusan-create'=>'jurusan/create',
				'kelas-create'=>'kelas/create',
				'tagihan-create'=>'tagihan/create',
				'registration-add'=>'siswa/create',
				'tagihan-siswa-create'=>'tagihan_siswa/create',
				'class-create'=>'kelas-group/create',
				'ajaran-create'=>'tahun-ajaran/create',
				'biaya_tidak_tetap-create'=>'biaya-tidak-tetap/create',
				'pencatatan-create'=>'pencatatan-keuangan/create',
				
				//---------------------------------- VIEW -----------------------------//				
				'kelas-view-<kode>-<idajaran>-<idjurusan>' => 'kelas/view',
				'jurusan-view-<id>' => 'jurusan/view',
				'tagihan-view-<idtagihan>-<idkelas>' => 'tagihan/view',
				'class-view-<id>' => 'kelas-group/view',
				'ajaran-view-<id>'=>'tahun-ajaran/view',
				'biaya_tidak_tetap-view-<id>'=>'biaya-tidak-tetap/view',
				'pencatatan-view-<id>'=>'pencatatan-keuangan/view',
				
				//---------------------------------- UPDATE -----------------------------//				
				'kelas-update-<kode>-<idajaran>-<idjurusan>' => 'kelas/update',
				'jurusan-update-<id>' => 'jurusan/update',
				'tagihan-update-<idtagihan>-<idkelas>' => 'tagihan/update',
				'class-update-<id>' => 'kelas-group/update',
				'ajaran-update-<id>' => 'tahun-ajaran/update',
				'biaya_tidak_tetap-update-<id>' => 'biaya-tidak-tetap/update',
				'pencatatan-update-<id>' => 'pencatatan-keuangan/update',
				
				//---------------------------------- DELETE -----------------------------//				
				'kelas-delete-<kode>-<idajaran>-<idjurusan>' => 'kelas/delete',
				'jurusan-delete-<id>' => 'jurusan/delete',
				'tagihan-delete-<idtagihan>-<idkelas>' => 'tagihan/delete',
				'class-delete-<id>' => 'kelas-group/delete',
				'ajaran-delete-<id>' => 'tahun-ajaran/delete',
				'biaya_tidak_tetap-delete-<id>' => 'biaya-tidak-tetap/delete',
				'pencatatan-delete-<id>' => 'pencatatan-keuangan/delete',
				
				//---------------------------------- API -----------------------------//
				// 'class-apigroup-<id>' => 'kelas-group/apigroup',
				// 'class-data-<id>' => 'kelas-group/arraydata',
				
				//---------------------------------- Login -----------------------------//
				'login'=>'site/login',



				// ------------------------------------- REPORT ------------------------//
				'keuangan'=>'keuangan/index',
				'tunggakan'=>'tunggakan/index',

		

			],
		],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
