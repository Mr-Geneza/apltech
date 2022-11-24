<template>
	<div class="submit-form">
		<div v-if="!submitted">
			<div class="form-group">
				<label for="name">Название</label>
				<input type="text" class="form-control" id="name" required v-model="product.name" name="name" />
			</div>

			<div class="form-group">
				<label for="category_name">Категория</label>
				<input class="form-control" id="category_name" required v-model="product.category_name" name="category_name" />
			</div>

			<div class="form-group">
				<label for="brand_name">Бренд</label>
				<input class="form-control" id="brand_name" required v-model="product.brand_name" name="brand_name" />
			</div>

			<div class="form-group">
				<label for="price">Цена</label>
				<input class="form-control" id="price" required v-model="product.price" name="price" />
			</div>

			<div class="form-group">
				<label for="rrp_price">Rrp цена</label>
				<input class="form-control" id="rrp_price" required v-model="product.rrp_price" name="rrp_price" />
			</div>
			
			<div class="form-group">
				<label for="status">Статус</label>
				<input class="form-control" id="rrp_pricstatuse" required v-model="product.status" name="status" />
			</div>

			<a @click="saveProduct" class="btn btn-success">Submit</a>
		</div>

		<div v-else>
			<h4>You submitted successfully!</h4>
			<button class="btn btn-success" @click="newProduct">Add</button>
		</div>
	</div>
</template>

<script>
import ProductDataService from "../services/ProductDataService";

export default {
	name: "add-product",
	data() {
		return {
			product: {
				id: null,
				name: "",
				category_name: "",
				brand_name: "",
				price: "",
				rrp_price: "",
				status: "",
			},
			submitted: false
		};
	},
	methods: {
		saveProduct() {
			var data = {
				name: this.product.name,
				category_name: this.product.category_name,
				brand_name: this.product.brand_name,
				price: this.product.price,
				rrp_price: this.product.rrp_price,
				status: this.product.status
			};

			ProductDataService.createProduct(data)
				.then(response => {
					this.product.id = response.data.id;
					console.log(response.data);
					this.submitted = true;
				})
				.catch(e => {
					console.log(e);
				});
		},

		newProduct() {
			this.submitted = false;
			this.product = {};
		}
	}
};
</script>