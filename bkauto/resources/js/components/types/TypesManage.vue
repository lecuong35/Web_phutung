<template>
    <div class="wrapper">
        <div class="leftbarvue">
            <LeftBarVue />
        </div>
        <div class="content">
            <div class="search row">
                <div class="search-items col-sm-12 col-lg-8">
                  <input type="search" class="input-search" v-model="search" placeholder="Search" />
                  <button type="button" class="btn btn-outline-primary" >search</button>
                </div>
                <div class="add-item col-lg-4 col-sm-12">
                  <button class="btn btn-primary" @click="goToAdd">Add Types</button>

                </div>
            </div>
            <hr>
            <div class="products">
                <div class="container">
                  <h2>Quản Lý Loại Sản Phẩm</h2>
                    <!--Table-->
<table class="table table-hover table-fixed">

  <!--Table head-->
  <thead>
    <tr>
      <th>Id</th>
      <th>Tên</th>
      <th>Code</th>
      <th>Miêu Tả</th>
      <th>Nhãn Hàng</th>
      <th>Sửa</th>
    </tr>
  </thead>
  <!--Table head-->

  <!--Table body-->
  <tbody>
    <tr v-for="type in types" :key="type.id">
      <th scope="row">{{type.id}}</th>
      <td>{{type.name}}</td>
      <td>{{type.code}}</td>
      <td>{{type.describe}}</td>
      <td>{{type.branch}}</td>
      <td>
        <button class="btn btn-primary" @click="goToUpdate(type.id)">Sửa</button>
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
import baseUrl from '../../store/baseUrl'
import LeftBarVue from '../admin/layouts/LeftBar.vue'
import { useStore, mapMutations } from 'vuex';
import { computed } from 'vue' 
import router from '../../router';
export default {
    components: {LeftBarVue},
    created: baseUrl.checkAdminLogin,

    setup() {
      const store = useStore();
      store.dispatch('types/getTypes')
      const types = computed( () => store.getters['types/types'])
       return {
          types,
       }
    },  

    data() {
      return {
        search: ''
      }
    },

    watch: {
      ...mapMutations({
         search: 'types/SEARCH_TYPE'
      })
       
    },

    methods: {
        goToAdd() {
          router.push({name: 'type-add'});
        },

        goToUpdate(id) {
           router.push({name: 'type-add', params: {postId : id} });
        }
    }
}
</script>
<style scpoed lang="scss">
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