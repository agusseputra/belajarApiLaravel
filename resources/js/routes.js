import Product from './components/Products.vue';
import AddProduct from './components/Addproduct.vue';
export const routes = [{
        name: 'product',
        path: '/vue/product',
        component: Product
    },
    {
        name: 'product.create',
        path: '/vue/product/create',
        component: AddProduct
    },
    {
        name: 'product.edit',
        path: '/vue/product/edit/:id',
        component: AddProduct
    }
];