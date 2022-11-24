<?php

use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Бренды';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'brand_name',
			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{brand}',
				'buttons' => [
					'class' => ActionColumn::className(),
					'brand' => function ($url, $model, $key) {
						return Html::a('Посмотреть', 'product/brand' . '/' . $model['brand_name']);
					},
				],
			],
		],
	]); ?>


</div>