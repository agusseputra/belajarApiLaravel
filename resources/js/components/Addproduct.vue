<template>
    <div>
        <h2>Add Product s</h2>
        <form @submit.prevent="saveData" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group row">
                        <div class="col-lg-4">
                            Kode Produk
                        </div>
                        <div class="col-lg-8">
                            <input type="text" v-model="code" class="form-control">
                                <span v-if="allerros.code" class="text-sm text-red-600">{{ allerros.code[0] }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                Nama Produk
                            </div>
                            <div class="col-lg-8">
                                <input type="text" v-model="name" class="form-control">
                                    <span v-if="allerros.name" class="text-sm text-red-600">{{ allerros.name[0] }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    Kategory Produk
                                </div>
                                <div class="col-lg-8">
                                    <select class='form-control' v-model='category_id'>
                                        <option value=''>Pilih Kategori</option>
                                        <option v-for='item in categories' :value='item.category_id'>{{ item.category }}</option>
                                    </select>
                                    <span v-if="allerros.category_id" class="text-sm text-red-600">{{ allerros.category_id[0] }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    Keterangan
                                </div>
                                <div class="col-lg-8 ">
                                    <input type="text" v-model="description" class="form-control">
                                        <span v-if="allerros.description" class="text-sm text-red-600">{{ allerros.description[0] }}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        Sampul
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="file" v-on:change="onFileChange" class="form-control">
                                            <span v-if="allerros.cover" class="text-sm text-red-600">{{ allerros.cover[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <router-link :to="{name: 'product'}" class="btn btn-default">Batal</router-link>
                                        <button type="submit" class="btn btn-primary">SAVE</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </template>
                <script>
                    export default {
                        data() {
                            return {
                                categories: {},
                                errors: [],
                                allerros: [],
                                success: false,
                                message: '',
                                code: '',
                                name: '',
                                description: '',
                                category_id: '',
                                cover: ''
                            }
                        },
                        created() {
                            this
                                .axios
                                .get('/api/product/create')
                                .then(response => {
                                    //this.msg = response.data.message;
                                    this.categories = response.data.categories;

                                });
                            if (this.$route.params.id) {
                                this
                                    .axios
                                    .get('/api/product/'+this.$route.params.id+'/edit')
                                    .then((response) => {
                                        this.code = response.data.code;
                                        this.name = response.data.name;
                                        this.description = response.data.description;
                                        this.category_id = response.data.category_id;
                                        this.cover = response.data.cover;
                                    });
                            }
                        },
                        methods: {
                            onFileChange(e) {
                                this.cover = e
                                    .target
                                    .files[0];
                            },
                            saveData(e) {
                                e.preventDefault();
                                let formData = new FormData();
                                formData.append('code', this.code);
                                formData.append('name', this.name);
                                formData.append('description', this.description);
                                formData.append('category_id', this.category_id);
                                formData.append('cover', this.cover);
                                // this.axios     .post('/api/patient', this.patient)     .then(response => (
                                // this.$router.push({ name: 'patient' })     ))
                                //update
                                if (this.$route.params.id) {
                                    //menggunakan method post dikarenakan error pada method put
                                    //sebaiknya gunaka method put/pacth
                                    this
                                        .axios
                                        .post('/api/product/'+this.$route.params.id, formData, {
                                            headers: {
                                                'content-type': 'multipart/form-data'
                                            }
                                        })
                                        .then(response => {
                                            this
                                                .$swal
                                                .fire(
                                                    {title: 'Success!', text: response.data.message, icon: 'success', timer: 1000}
                                                );
                                            this
                                                .$router
                                                .push({name: 'product'});
                                        })
                                        .catch((error) => {
                                            console.log(error);
                                            this.allerros = error.response.data.errors;
                                            this.success = false;
                                        })
                                        . finally(() => this.loading = false)
                                } else {
                                    this
                                        .axios
                                        .post('/api/product', formData, {
                                            headers: {
                                                'content-type': 'multipart/form-data'
                                            }
                                        })
                                        .then(response => {
                                            this
                                                .$swal
                                                .fire(
                                                    {title: 'Success!', text: response.data.message, icon: 'success', timer: 1000}
                                                );
                                            this
                                                .$router
                                                .push({name: 'product'});
                                        })
                                        .catch((error) => {
                                            console.log(error);
                                            this.allerros = error.response.data.errors;
                                            this.success = false;
                                        })
                                        . finally(() => this.loading = false)
                                }
                            }
                        }
                    }
                </script>
