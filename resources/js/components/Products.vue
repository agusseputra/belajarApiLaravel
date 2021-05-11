<template>
    <div>
        <h2>Product</h2>
        <div class="col-lg-6 ">
            <div class="row">
            <div class="col-xs-8">
                <input type="text" class="form-control" v-model="s">
            </div>
            <div class="col-xs-4">
                <button class="btn btn-primary" @click="searchData">Cari</button>
            </div>
            </div>
            <hr>
        </div>
        <div class="col-lg-12">
            <table class="table">
                <thead>
                    <th>Kode</th>
                    <th>Nama Product</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Cover</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                     <tr  v-for="(item, index) in products.data" :key="index">
                         <td>{{ item.code }}</td>
                         <td>{{ item.name }}</td>
                         <td>{{ item.category }}</td>
                         <td>{{ item.description }}</td>
                         <td><img :src="'/'+item.cover" width="50px"></td>
                         <td><div class="btn-group" role="group">
                                <router-link
                                    :to="{name: 'product.edit', params: { id: item.product_id }}"
                                    class="btn btn-success">Edit</router-link>
                                <button
                                    class="px-2 py-1 text-sm rounded text-red-600 border border-red-200 hover:text-white hover:bg-red-600"
                                    @click="deleteData(item.product_id)">Delete</button>
                            </div></td>
                     </tr>
                </tbody>
            </table>
            <pagination :data="products" @pagination-change-page="table" class="justify-center py-2"></pagination>
        </div>
    </div>
</template>
<script>
 export default {
        data() {
            return {
                products: {},
                msg:'',
                s:''
                }
        },
        created() {
            this.table();
        },
        methods: {
            table(page=1){
                this
                .axios
                .get('/api/product?page='+page+'&s='+this.s)
                .then(response => {
                    //this.msg = response.data.message;
                    this.products = response.data;

                });
            },
            deleteData(id) {
                this
                    .$swal
                    .fire({
                        title: 'Apakah kamu yakin?',
                        text: "Jika kamu hapus, maka data tidak akan kembali lagi.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Delete',
                        cancelButtonText: 'Batal'
                    })
                    .then((result) => {
                        if (result.value) {
                            let uri = `/api/product/${id}`;
                            this
                                .axios
                                .delete(uri)
                                .then(response => {
                                    this
                                    .$swal
                                    .fire(
                                        {title: 'Success!', text: 'Article deleted successfully', icon: 'success', timer: 1000}
                                    );
                                    this
                                        .products.data
                                        .splice(this.products.data.indexOf(id), 1);
                                        //this.table();
                                });
                        }
                    })
            },
            searchData(e){
                this.table();
            }
        }
    }
</script>
