<template>
	<div v-if="currentProduct">
		<h4>Товар</h4>
		<form>
			<div class="form-group">
				<label for="name">Название</label>
				<input type="text" class="form-control" id="name" v-model="currentProduct.name" />
			</div>
			<div class="form-group">
				<label for="category_name">Категория</label>
				<input disabled type="text" class="form-control" id="category_name"
					v-model="currentProduct.category_name" />
			</div>
			<div class="form-group">
				<label for="brand_name">Бренд</label>
				<input disabled type="text" class="form-control" id="brand_name" v-model="currentProduct.brand_name" />
			</div>
			<div class="form-group">
				<label for="price">Цена</label>
				<input type="text" class="form-control" id="price" v-model="currentProduct.price" />
			</div>
			<div class="form-group">
				<label for="rrp_price">Rrp цена</label>
				<input type="text" class="form-control" id="rrp_price" v-model="currentProduct.rrp_price" />
			</div>
			<a class="btn btn-success mr-3" @click="updateProduct">
				Сохранить
			</a>
			<a class="btn btn-danger" @click="deleteProduct">
				Удалить
			</a>
		</form>
		<p>{{ message }}</p>
	</div>
</template>

<script>
import ProductDataService from "../services/ProductDataService";

export default {
	name: "product",
	data() {
		return {
			currentProduct: null,
			message: ''
		};
	},
	methods: {
		getProduct(id) {
			ProductDataService.getProduct(id)
				.then(response => {
					this.currentProduct = response.data;
					console.log(response.data);
				})
				.catch(e => {
					console.log(e);
				});
		},

		updateProduct() {
			ProductDataService.updateProduct(this.currentProduct.id, this.currentProduct)
				.then(response => {
					console.log(response.data);
					this.message = 'Информация успешно обновлена!';
				})
				.catch(e => {
					console.log(e);
				});
		},

		deleteProduct() {
			ProductDataService.deleteProduct(this.currentProduct.id)
				.then(response => {
					console.log(response.data);
					this.$router.push({ name: "products" });
				})
				.catch(e => {
					console.log(e);
				});
		}
	},
	mounted() {
		this.message = '';
		this.getProduct(this.$route.params.id);
	}
};
</script>