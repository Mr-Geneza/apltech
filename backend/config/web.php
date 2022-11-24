<?php
/* Include debug functions */
require_once(__DIR__ . '/functions.php');

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
	'id' => 'basic',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	'aliases' => [
		'@bower' => '@vendor/bower-asset',
		'@npm'   => '@vendor/npm-asset',
	],
	'as corsFilter' => [
		'class' => \yii\filters\Cors::class,
		'only' => ['api/*'],
	],
	'components' => [
		'request' => [
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => 'YEzt2113H3CT_PiAwAVPrxLtMt021l21',
			'enableCsrfValidation' => false,
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'user' => [
			'identityClass' => 'app\models\User',
			'enableAutoLogin' => true,
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'mailer' => [
			'class' => \yii\symfonymailer\Mailer::class,
			'viewPath' => '@app/mail',
			// send all mails to a file by default.
			'useFileTransport' => true,
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
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'enableStrictParsing' => true,
			'rules' => [
				'/' => '/',
				'logout' => '/site/logout',
				'login' => '/site/login',
				// Товары
				'products' => 'product',
				'products' => 'product/index',
				'product/create' => 'product/create',
				'product/<id>' => 'product/view',
				'product/update/<id>' => 'product/update',
				'product/delete/<id>' => 'product/delete',
				// Бренды
				'product/brand/<brand>' => 'product/brand',
				'brands' => 'product/brands',

				// REST API FOR VUE
				'rest/products' => 'product/rest-products',
				'rest/product/<id>' => 'product/rest-product',
				'rest/product/update/<id>' => 'product/rest-product-update',
				'rest/product/delete/<id>' => 'product/rest-product-delete',
			],
		],
		'db' => $db,
	],
	'params' => $params,
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
		// uncomment the following to add your IP if you are not connecting from localhost.
		//'allowedIPs' => ['127.0.0.1', '::1'],
	];

	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
		// uncomment the following to add your IP if you are not connecting from localhost.
		//'allowedIPs' => ['127.0.0.1', '::1'],
	];
}

return $config;
