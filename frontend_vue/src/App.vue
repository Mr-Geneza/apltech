<template>
	<div id="app">
		<nav class="navbar navbar-expand navbar-dark bg-dark">
			<div class="container">
				<router-link to="/" class="navbar-brand">
					<img src="https://www.apltech.kz/img/logo.png" alt="">
				</router-link>
				<div class="navbar-nav mr-auto">
					<li class="nav-item">
						<router-link to="/products" class="nav-link">Товары</router-link>
					</li>
					<li class="nav-item">
						<router-link to="/add" class="nav-link">Добавление</router-link>
					</li>
				</div>
			</div>
		</nav>
		<div class="container mt-3">
			<router-view />
		</div>
	</div>
</template>

<script>
export default {
	name: "app"
};
</script>