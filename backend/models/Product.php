<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property string $category_name
 * @property string $brand_name
 * @property int|null $price
 * @property int|null $rrp_price
 * @property int $status
 */
class Product extends \yii\db\ActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'products';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['name', 'category_name', 'brand_name', 'status'], 'required'],
			[['price', 'rrp_price', 'status'], 'integer'],
			[['name', 'category_name', 'brand_name'], 'string', 'max' => 255],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Название',
			'category_name' => 'Категория',
			'brand_name' => 'Бренд',
			'price' => 'Цена',
			'rrp_price' => 'Rrp цена',
			'status' => 'Статус',
		];
	}
}
