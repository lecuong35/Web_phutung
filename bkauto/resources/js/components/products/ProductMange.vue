<template>
    <div class="wrapper">
        <div class="leftbarvue">
            <LeftBarVue />
        </div>
        <div class="content">
            <div class="search row">
                <div class="search-items col-sm-12 col-lg-8">
                  <input type="search" class="input-search" v-model="search" placeholder="Search" />
                  <button type="button" class="btn btn-outline-primary">search</button>
                </div>
                <div class="add-item col-lg-4 col-sm-12">
                  <button class="btn btn-primary" @click="goToAdd">Thêm sản phẩm</button>
                  <button class="btn btn-info" @click="exportExcel">
                    <a href="http://127.0.0.1:8000/api/admin/products/export-excel" 
                    target="__blank"
                    style="text-decoration: none; color: #fafafa;">
                    Xuất file báo giá</a>
                  </button>
                </div>
            </div>
            <hr>
            <div class="products">
                <div class="container">
                  <h2>Quản Lý Sản Phẩm</h2>
                    <!--Table-->
<table class="table table-hover table-fixed">

  <!--Table head-->
  <thead>
    <tr>
      <th>Id</th>
      <th>Tên</th>
      <th>Giá</th>
      <th>Miêu Tả</th>
      <th>Hình Ảnh</th>
      <th>Mã loại</th>
      <th>Quản lý</th>
    </tr>
  </thead>
  <!--Table head-->

  <!--Table body-->
  <tbody>
    <tr v-for="product in products" :key="product.id">
      <th scope="row">{{product.id}}</th>
      <td>{{product.name}}</td>
      <td>{{product.price}}</td>
      <td>{{product.describe}}</td>
      <td style="width: fit-content;"><img :src="getImage(product.image)" style="width: 200px; height: 200px"></td>
      <td>{{product.type_id}}</td>
      <td>
        <button class="btn btn-primary" @click="goToUpdate(product.id)">Sửa</button>
      </td>
    </tr>
  </tbody>
  <!--Table body-->

</table>
<!--Table-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LeftBarVue from '../admin/layouts/LeftBar.vue'
// import baseUrl from '../../store/baseUrl'
import {  mapActions, mapGetters, mapMutations, useStore } from 'vuex';
import {  computed } from 'vue';
import router from '../../router';
import baseUrl from '../../store/baseUrl';
export default {
    name: 'product-manage',

    components: { LeftBarVue },
    created: baseUrl.checkAdminLogin,

    setup() {
      const store = useStore();
      store.dispatch('products/getProducts')
      const products = computed( () => store.getters['products/products'])
       return {
          products,
       }
    },  

    data() {
      return {
        search: '',
        // products: this.products
      }
    },

    watch: {
      ...mapMutations({
         search: 'products/SEARCH_PRODUCT'
      })
       
    },

    methods: {
        ...mapActions({
          exportExcel: 'products/exportExcel',
        }),

        getImage(src){
          return "storage/images/products/"+src;
        },

        goToAdd() {
          router.push({name: 'product-add'});
        },

        goToUpdate(id) {
           router.push({name: 'product-add', params: {postId : id} });
        },


    }
    
}
</script>

<style scoped lang="scss">
    .wrapper { 
        display: flex;
    }
    
    .leftbarvue{ 
        flex: 1;
        position: fixed;
    }

    .content { 
        flex: 5;
        align-items: center;
        justify-content: center;
        margin-left: 250px;
    }

    .search { 
        display: flex;
        justify-content:center;
        margin-top: 15px;
    }

    .search-items { 
      display: flex;
      align-items: center;
      text-align: center;
      justify-content: center;
    }

    .search input{ 
        border-radius: 5px;
        border: solid 1px rgb(16, 16, 211);
        width: 75%;
        height: 100%;
    }

    @media (max-width: 768px) {
      .content {
        margin-left: 0px;
      }

     .add-item {
       display: flex;
       justify-content: center;
       align-items: center;
       margin-top: 10px;
     }
    }
</style>