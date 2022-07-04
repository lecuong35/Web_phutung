<template>
    <div class="wrapper">
        <div class="leftbarvue">
            <HeaderUserVue />
        </div>
        <div class="content">
            <div class="search row">
                <div class="search-items col-sm-12 col-lg-8">
                  <input type="search" class="input-search" v-model="search" placeholder="Search" />
                  <button type="button" class="btn btn-outline-primary">search</button>
                </div>
                <div class="add-item col-lg-4 col-sm-12">
                  <button class="btn btn-primary">Quay lại trang chủ</button>
                </div>
            </div>
            <hr>
            <div class="products">
                <div class="container">
                  <h2>Các sản phẩm đã mua</h2>
                    <!--Table-->
<table class="table table-hover table-fixed">

  <!--Table head-->
  <thead>
    <tr>
      <th>Id</th>
      <th>Ảnh sản phẩm</th>
      <th>Tên sản phẩm</th>
      <th>Giá sản phẩm</th>
      <th>Số lượng</th>
      <th>Trạng thái</th>
    </tr>
  </thead>
  <!--Table head-->

  <!--Table body-->
  <tbody>
    <tr v-for="cart in carts" :key="cart.id">
      <th scope="row">{{cart.id}}</th>
      <td style="width: fit-content;"><img :src="getImage(cart.image)" style="width: 150px; height: 150px"></td>
      <td>
           {{cart.name}}
      </td>
      <td>{{cart.price}}</td>
      <td>
        {{cart.quantity}}
      </td>
      <td>Đã đặt</td>
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
import HeaderUserVue from '../users/HeaderUser.vue';
// import baseUrl from '../../store/baseUrl'
import {  mapActions, mapGetters, mapMutations, useStore } from 'vuex';
import {  computed } from 'vue';
import router from '../../router';
import baseUrl from '../../store/baseUrl';
import store from '../../store';
export default {
    name: 'cart-manage',

    components: { HeaderUserVue },
    created: baseUrl.checkUserLogin,

    setup() {
      const store = useStore();
      store.dispatch('carts/getCartsHistory')
      const carts = computed( () => store.getters['carts/cartsHistory'])
       return {
          carts,
       }
    },  

    data() {
      return {
        search: '',
      }
    },

    watch: {
      ...mapMutations({
         search: 'carts/SEARCH_CART_HISTORY'
      })
       
    },

    methods: {
      getImage(src){
          return "storage/images/products/"+src;
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

    .quantity-change {
      display: flex;
      align-items: center;
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