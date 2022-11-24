<template>
	<div class="row">
		<div class="col-md-12" v-if="goProduct">
			<h4>Товары</h4>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Название</th>
						<th scope="col">Цена</th>
						<th scope="col">Просмотреть</th>
					</tr>
				</thead>
				<tbody v-for="(product, index) in products" :key="index">
					<tr :class="{ active: index == currentIndex }">
						<th scope="row">{{ product.id }}</th>
						<td>{{ product.name }}</td>
						<td>{{ product.brand_name == 'Lenovo' ? product.rrp_price : product.price }}</td>
						<td @click="getProductById(product, index)">
							<button class="btn btn-primary">
								Просмотреть
							</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-12" v-if="currentProduct">
			<table class="table table-bordered text-center">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Название</th>
						<th scope="col">Категория</th>
						<th scope="col">Бренд</th>
						<th scope="col">Цена</th>
						<th scope="col">Редактирование</th>
						<th scope="col">Удалить</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">{{ currentProduct.id }}</th>
						<td>{{ currentProduct.name }}</td>
						<td>{{ currentProduct.category_name }}</td>
						<td>{{ currentProduct.brand_name }}</td>
						<td>{{ currentProduct.brand_name == 'Lenovo' ? currentProduct.rrp_price : currentProduct.price }}</td>
						<td>
							<router-link :to="'/product/' + currentProduct.id">
								<button class="btn btn-primary">
									Редактировать
								</button>
							</router-link>
						</td>
						<td>
							<router-link :to="'/product/delete/' + currentProduct.id">
								<button class="btn btn-danger">
									Удалить
								</button>
							</router-link>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
import ProductDataService from "../services/ProductDataService";

export default {
	name: "products-list",
	data() {
		return {
			products: [],
			currentProduct: null,
			currentIndex: -1,
			title: "",
			goProduct: true,
		};
	},
	methods: {
		getProducts() {
			ProductDataService.getProducts()
				.then(response => {
					this.products = response.data;
					console.log(response.data);
				})
				.catch(e => {
					console.log(e);
				});
		},

		getProductById(product, index) {
			this.currentProduct = product;
			this.goProduct = false
			this.currentIndex = product ? index : -1;
		}
	},
	mounted() {
		this.getProducts();
	}
};
</script>

<style>
.list {
	text-align: left;
	max-width: 750px;
	margin: auto;
}
</style>