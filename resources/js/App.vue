<template>
    <div >
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/vue/product" class="nav-item nav-link">Products List</router-link>
                    <router-link to="/vue/product/create" class="nav-item nav-link">Create Product</router-link>
                </div>
            </div>
        </nav>

        <router-view> </router-view>
    </div>
</template>

