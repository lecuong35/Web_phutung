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
            </div>
            <hr>
            <div class="products">
                <div class="container">
                  <h2>Quản Lý Đơn Hàng</h2>
                    <!--Table-->
                    <table class="table table-hover table-fixed">

                      <!--Table head-->
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Tên Người Dùng</th>
                          <!-- <th>Số điện thoại</th> -->
                          <th>Thời gian nhận</th>
                          <!-- <th>Địa chỉ</th>
                          <th>Items</th> -->
                          <th>Giá trị đơn hàng</th>
                          <th>Trạng thái</th>
                          <th>Hành động</th>
                        </tr>
                      </thead>
                      <!--Table head-->

                      <!--Table body-->
                      <tbody>
                        <tr v-for="bill in bills" :key="bill.id">
                          <th scope="row">{{bill.id}}</th>
                          <td>{{bill.name}}</td>
                          <!-- <td>{{bill.phone}}</td> -->
                          <td>{{bill.able_receive}}</td>
                          <!-- <td>{{bill.address}}</td>
                          <td >
                            <p v-for="item in bill.cartItems" :key="item.id">{{item.name}} -- SL:{{item.quantity}} </p> 
                            </td>  -->
                          <td>
                            {{bill.total}}
                          </td>
                          <td>
                            {{bill.handled}}
                          </td>
                          <td>
                            <button class="btn btn-success" @click="confirmBill(bill.id)">Xác Nhận</button>
                            <div>
                                   <button type="button" class="btn btn-primary" data-toggle="modal" :data-target="'#exampleModal'+bill.id">
                                        Xem chi tiết
                                    </button>
                                        <!-- Modal -->
                                        <div class="modal fade" :id="'exampleModal'+bill.id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết đơn hàng</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    
                                                    <p>
                                                      <b>Tên khách: </b>{{bill.name}}
                                                    </p>
                                                   <p>
                                                      <b>SĐT: </b>{{bill.phone}}
                                                    </p>
                                                    <p>
                                                      <b>Thời gian nhận: </b>{{bill.able_receive}}
                                                    </p>
                                                    <p>
                                                      <b>Địa chỉ: </b>{{bill.address}}
                                                    </p>
                                                    <p>
                                                      <b>Items: </b><p v-for="item in bill.cartItems" :key="item.id">{{item.name}} -- Số Lượng: {{item.quantity}} </p> 
                                                    </p>
                                                    <p>
                                                      <b>Tổng : </b>{{bill.total}}
                                                    </p>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-success" @click="confirmBill(bill.id)">
                                                        Xác nhận
                                                    </button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                      <!--Table body-->

                    </table>
                </div>
            </div>
        </div>
        <hr style="color: black;">
        <h2 class="barchart" id="barchart123">
          DOANH THU TRONG NĂM</h2>
        <BarChartVue class="barchart"/>
    </div>


    <!-- <BarChartVue class="barchart"/> -->
    
</template>

<script>
import LeftBarVue from '../admin/layouts/LeftBar.vue'
import BarChartVue from '../admin/BarChart.vue'
// import baseUrl from '../../store/baseUrl'
import {  mapActions, mapGetters, mapMutations, useStore } from 'vuex';
import {  computed } from 'vue';
import router from '../../router';
import baseUrl from '../../store/baseUrl';
export default {
    name: 'product-manage',

    components: { LeftBarVue, BarChartVue },
    created: baseUrl.checkAdminLogin,

    setup() {
      const store = useStore();
      store.dispatch('bills/getBills')
      store.dispatch('bills/getCarts')
      const bills = computed( () => store.getters['bills/bills'])
       return {
          bills,
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
         search: 'bills/SEARCH_BILL'
      })
       
    },

    methods: {
      cartItems(carts) {
         carts.forEach(cart => {
           return cart.name + " - " + cart.quantity;
         });
      },

      ...mapActions({
        confirmBill : 'bills/confirmBill'
      })
    }
    
}
</script>

<style scoped lang="scss">
    .wrapper { 
        display: flex;
        flex-direction: column;
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

    .barchart{
      position: relative;
      left: 40%;
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