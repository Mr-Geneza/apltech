<?php

namespace app\controllers;

use app\models\Product;
use Yii;
use yii\data\ActiveDataProvider;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
	/**
	 * @inheritDoc
	 */
	public function behaviors()
	{
		return array_merge(
			parent::behaviors(),
			[
				'verbs' => [
					'class' => VerbFilter::className(),
					'actions' => [
						'delete' => ['POST'],
					],
				],
			]
		);
	}

	/**
	 * Lists all Product models.
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		$dataProvider = new ActiveDataProvider([
			'query' => Product::find(),
			/*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
		]);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Product model.
	 * @param int $id ID
	 * @return string
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Product model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return string|\yii\web\Response
	 */
	public function actionCreate()
	{
		// Проверяем на авторизованность
		if (Yii::$app->user->isGuest) {
			return $this->redirect(['site/login']);
		}

		$model = new Product();

		if ($this->request->isPost) {
			if ($model->load($this->request->post()) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->id]);
			}
		} else {
			$model->loadDefaultValues();
		}

		return $this->render('create', [
			'model' => $model,
		]);
	}

	/**
	 * Updates an existing Product model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param int $id ID
	 * @return string|\yii\web\Response
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id)
	{
		// Проверяем на авторизованность
		if (Yii::$app->user->isGuest) {
			return $this->redirect(['site/login']);
		}

		$model = $this->findModel($id);

		if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing Product model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param int $id ID
	 * @return \yii\web\Response
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Product model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param int $id ID
	 * @return Product the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Product::findOne(['id' => $id])) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}

	/**
	 * Lists all Product models.
	 *
	 * @return string
	 */
	public function actionBrands()
	{
		$query = new Query;
		$query->select('brand_name')
		->from('products')
		->distinct()
		->all();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => false,
			'sort' => false
		]);

		return $this->render('brand/index', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Product model.
	 * @param int $brand NAME
	 * @return string
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionBrand($brand)
	{
		$lowPrice = new Query;
		$highPrice = new Query;
		
		$lowPrice->select('id, name, category_name, brand_name, price, rrp_price, status')
			->from('products')
			->where(['brand_name' => $brand])
			->orderBy(['price' => SORT_ASC])
			->limit(1);
		$highPrice->select('id, name, category_name, brand_name, price, rrp_price, status')
			->from('products')
			->where(['brand_name' => $brand])
			->orderBy(['price' => SORT_DESC])
			->limit(1);

		$query = $lowPrice->union($highPrice);	

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => false,
			'sort' => false
		]);

		return $this->render('brand/view', [
			'dataProvider' => $dataProvider,
		]);
	}


	// REST API FOR VUE

	/**
	 * Lists all Product models.
	 *
	 * @return string
	 */
	public function actionRestProducts()
	{
		$rows = (new \yii\db\Query())
			->select(['*'])
			->from('products')
			->all();
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $rows;
	}

	/**
	 * Displays a single Product model.
	 * @param int $id ID
	 * @return string
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionRestProduct($id)
	{
		$product = (new \yii\db\Query())
			->select(['*'])
			->from('products')
			->where(['id' => $id])
			->one();

		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

		return $product;
	}

	public function beforeAction($action)
	{
		if (in_array($action->id, ['login'])) {
			$this->enableCsrfValidation = false;
		}
		return parent::beforeAction($action);
	}

	/**
	 * Updates an existing Product model.
	 * @param int $id ID
	 * @return string|\yii\web\Response
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionRestProductUpdate($id)
	{
		$request = Yii::$app->request;
		dd($request);
		/* $product = Product::findOne($id);
		$product->name = $data->name;
		$product->category_name = $data->category_name;
		$product->brand_name = $data->brand_name;
		$product->rrp_price = $data->rrp_price;
		$product->price = $data->price;
		$product->status = $data->status;
		$product->save(); */

		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

		return $product;
	}

	/**
	 * Deletes an existing Product model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param int $id ID
	 * @return \yii\web\Response
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionRestProductDelete($id)
	{
		$this->findModel($id)->delete();

		return true;
	}
}
