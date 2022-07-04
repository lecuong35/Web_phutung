<template>
    
      <div class="wrapper row">
        <div class="leftbarvue">
            <HeaderUserVue />
        </div>
        <div class="content">
            <div class="search row">
                <div class="search-items col-sm-12 col-lg-8">
                  <input type="search" class="input-search" v-model="search" placeholder="Search" />
                  <button type="button" class="btn btn-outline-primary" >search</button>
                </div>
                <div class="add-item col-lg-4 col-sm-12">
                  <button class="btn btn-primary" @click="showOrderForm">Quay lại trang chủ</button>
                </div>
            </div>
            <hr>
            <div class="products">
                <div class="container">
                  <h2>Các sản phẩm đã thêm vào giỏ</h2>
                    <!--Table-->
<table class="table table-hover table-fixed">

  <!--Table head-->
  <thead>
    <tr>
      <th>Chọn</th>
      <th>Id</th>
      <th>Tên sản phẩm</th>
      <th>Ảnh sản phẩm</th>
      <th>Số lượng</th>
      <th>Trạng thái</th>
      <th>Giá thành</th>
      <th>Xóa</th>
    </tr>
  </thead>
  <!--Table head-->

  <!--Table body-->
  <tbody>
    <tr v-for="cart in carts" :key="cart.id">
      <th><input type="checkbox" @change="selected(cart.id)"></th>
      <td scope="row">{{cart.id}}</td>
      <td class="td">
           {{cart.name}}
      </td>
      <td style="width: fit-content;"><img :src="getImage(cart.image)" style="width: 150px; height: 150px"></td>
      <td class="td">
        <div class="quantity-change">
          <button class="btn btn-warning" @click.prevent="addQuantity(cart.id)"> + </button>
          <div style="margin: 0px 10px 0px 10px;">
            {{cart.quantity}}
          </div>
          <button class="btn btn-warning" @click.prevent="subQuatity(cart.id)"> - </button>

        </div>
      </td >
      <td class="td">{{cart.ordered}}</td>
      <td class="td">{{cart.quantity * cart.price}}</td>
      <td class="td">
        <button class="btn btn-danger" @click="delCart(cart.id)">Xóa</button>
      </td>
    </tr>
  </tbody>
  <!--Table body-->

</table>
<!--Table-->
                </div>
            </div>

             
        <button class="btn btn-primary" type="button" style="margin-left: 450px; width:fit-content;"
          @click.prevent="getSum">
            Đặt hàng
        </button>
        </div> 
    </div>

     <div id="form-order">
      <div class=" order-form col-lg-4 col-sm-8">
          <h2>ĐẶT HÀNG</h2>
            <form>
              <div class="form-group">
               <label for="address">Địa chỉ</label>
               <div>
                <input type="text" class="form-control is-invalid" id="address" aria-describedby="emailHelp"
                v-model="info.address">
                <p class="invalid-feedback">hello</p>
               </div>
           </div>
           <div class="form-group">
               <label for="address">Thời gian nhận</label>
               <div>
                <input type="date" class="form-control is-invalid" id="address" aria-describedby="emailHelp" v-model="info.able_receive">
                <p class="invalid-feedback">hello</p>
               </div>
           </div>
           <div>
            <p>Tổng tiền: {{sum}} đồng</p>
           </div>

           <div>
            <button class="btn btn-success" @click="orderBill(info)">Order</button>
           </div>
            </form>
           
      </div>
    </div>
    
    
</template>

<script>
import HeaderUserVue from '../users/HeaderUser.vue';
// import baseUrl from '../../store/baseUrl'
import {  mapActions, mapGetters, mapMutations, useStore } from 'vuex';
import { computed } from 'vue';
import router from '../../router';
import baseUrl from '../../store/baseUrl';
import store from '../../store';
export default {
    name: 'cart-manage',

    components: { HeaderUserVue },
    created: baseUrl.checkUserLogin,

    setup() {
      const store = useStore();
      store.dispatch('carts/getCarts')
      const carts = computed( () => store.getters['carts/carts'])
      const sum = computed( () => store.getters['carts/sum']);
      const showForm = computed( () => store.state['carts/showForm'])
       return {
          carts,
          sum,
          showForm
       }
    },  

    data() {
      return {
        search: '',
        info: {
           address: '',
           able_receive: '',
           total: 0
        }
      }
    },

    watch: {
      ...mapMutations({
         search: 'carts/SEARCH_CART'
      })
       
    },

   methods: {
      ...mapMutations({
        addQuantity : 'carts/ADD_CART',
        subQuatity: 'carts/SUB_CART',
        selected : 'carts/CHANGE_SELECTED',
        getSum : 'carts/GET_SUM'

      }),

      ...mapActions({
        delCart: 'carts/deleteCart',
        updateCart: 'carts/updateCarts',
        order: 'carts/orderBill'
      }),

      orderBill(info) {
        info.total = this.sum;
        this.order(info);
        this.updateCart();
        router.push({name: 'cart-manage'});
      },

      getImage(src){
          return "storage/images/products/"+src;
        },
   }
    
}
</script>

<style scoped lang="scss">
    .wrapper { 
        display: flex;
        flex-direction: column;
        height: 100vh;
    }
    
    .leftbarvue{ 
        // flex: 1;
        position: fixed;
    }

    .content { 
        // flex: 5;
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

   .td { 
       align-items: center;
       text-align: start;
   }
    .quantity-change {
      display: flex;
      align-items: center;
    }

    #form-order{ 
      display: none;
    }

    .order-form{ 
      background-color: #fafafa;
      border: solid 1px #000;
      border-radius: 10px;
      text-align: center;
      display: block;
      padding: 20px 10px 20px 10px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .activeForm{ 
      display: none;
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