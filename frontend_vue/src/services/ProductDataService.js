import http from "../http-axios";

class ProductDataService {
	getProducts() {
		return http.get("/products");
	}

	getProduct(id) {
		return http.get(`/product/${id}`);
	}

	createProduct(data) {
		return http.post("/product/create", data);
	}

	updateProduct(id, data) {
		return http.put(`http://localhost/appltech/backend/api/rest/product/update/${id}`, data);
	}

	deleteProduct(id) {
		return http.delete(`/product/delete/${id}`);
	}
}

export default new ProductDataService();