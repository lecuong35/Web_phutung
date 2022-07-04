<template>
    
       <div class="admin_page">
            
            <div class="leftbarvue">
                <LeftBarVue />
            </div>
               
            <div class="form_info">
             <form @submit.prevent="addProduct" id="formdata">
                  <!-- @submit.prevent="addProduct(product)" -->
                <h2>PRODUCT INFOMATION</h2>
                <hr>
                <div class="name item form-group">
                    <label for="product_name">Tên</label>
                   <div  class="input">
                        <input type="text" id="product_name" 
                    class="form-control" :class="{'is-invalid' : errors.name}"
                    v-model="name"
                    aria-describedby="emailHelp">
                    <div class="invalid-feedback">
                        {{errors.name}}
                    </div>
                   </div>
                </div>

                <div class="name item form-group">
                    <label for="product_price">Giá</label>
                    <div  class="input">
                        <input type="text" id="product_price" 
                        class="form-control" :class="{'is-invalid' : errors.price}"
                        v-model="price"
                        aria-describedby="emailHelp">
                        <div class="invalid-feedback">
                           {{errors.price}}
                       </div>
                   </div>
                </div>

                <div class="describe item form-group">
                    <label for="product_describe">Miêu tả</label>
                    <div class="input">
                        <textarea id="product_describe" 
                        class="form-control" :class="{'is-invalid' : errors.describe}"
                        v-model="describe" 
                        aria-describedby="emailHelp"
                        cols="10" rows="6"></textarea>
                       <div class="invalid-feedback">
                          {{errors.describe}}
                       </div>
                    </div>
                </div>

                <div class="image item" >
                    <label for="product_image">Hình Ảnh</label>
                    <input type="file" id="product_image" 
                    class="input" name="image"
                    style="background-color: #fafafa;"
                    @change="getImage">
                </div>

                <div class="type_id item">
                    <label for="product_type">Hãng</label>
                    <!-- <input type="text"  
                    id="product_type" class="input" 
                    v-model="type_id"> -->
                    <div class="input-group mb-3 input" id="product_type">
                        <select class="custom-select" id="inputGroupSelect01" :class="{'is-invalid' : errors.type_id}"
                           v-model="type_id">
                           <option selected>Choose...</option>
                            <option   v-for="type in types" :key="type.id" 
                            :value="type.id">{{type.name}}</option>
                        </select>
                        <div id="validationServer04Feedback" class="invalid-feedback">
                            Chọn loại sản phẩm !
                       </div>
                   </div>
                </div>

                <button type="submit" class="submit">Thêm</button>
             </form>
            </div>
            
       </div>
    
</template>
<script>
import LeftBarVue from '../admin/layouts/LeftBar.vue'
import { mapActions, useStore } from 'vuex'
import { computed } from 'vue'
import baseUrl from '../../store/baseUrl'
import router from '../../router'
// import { onMounted } from 'vue'
export default {
   name: 'product-add',
   components: { LeftBarVue },
   created: baseUrl.checkAdminLogin,

   data() {
       return {
           
            name: '',
            image: null,
            price: '',
            describe: '',
            type_id: '',
            selected: '',

            errors: {},
           
       }
   },

   setup() {
        const store = useStore();
        store.dispatch('types/getTypes');

        const types = computed( () => store.getters['types/types']);

        return {
            types
        }
   },

   methods: {
       addProduct() {
           const id = this.$route.params.postId;
            // console.log(id);
           const dt = new FormData();
           dt.append('image', this.image);
           dt.append('describe', this.describe);
           dt.append('price', this.price);
           dt.append('type_id', this.type_id);
           dt.append('name', this.name)
           if(id != null) {
               baseUrl.adminPostHasId('products/update/', id, dt).then(response => {
                    console.log(response);
                    router.push({name: 'product-manage'})
               }).catch((err) => {
                  this.errors = err.response.data.errors;
                  console.log(this.errors)
        });
           }
           baseUrl.adminPost('products/create', dt).then(response => {
               console.log(response);
               router.push({name: 'product-manage'})
           }).catch((err) => {
               this.errors = err.response.data.errors;
               console.log(this.errors)
           });
       },

       getImage(event) {
           this.image = event.target.files[0];
           console.log(this.image);
       }
   }
}
</script>
<style scoped>

@import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";

input {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1em;
    font-weight: 300;
    line-height: 1.7em;
    color: #999;
}
    .admin_page{
        height: 100vh;
        display: flex;
    }
    .form_info{
        background-color: #fafafa;
        background-image:url(../../../css/assets/draw2.webp);
       display: flex;
       flex: 2;
       justify-content: center;
       align-items: center;
       /* position: absolute */
     }

    .form_info form { 
        border: solid 1px rgb(73, 73, 245) ;
        border-radius: 15px;
        padding: 10px 10px 10px 10px;
        width: 350px;
        text-align: center;
        box-shadow: 5px 7px rgba(0,0,0,0.15);
        background-color: rgb(112, 114, 247);
    }

    .form_info button { 
        background-color: rgb(30, 5, 139);
        color: #ffff;
        border-radius: 10px;
    }

    .form_info button:hover{ 
        background-color: rgb(107, 97, 240);
    }

    .item { 
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
    }

    .input { 
        width: 70%;
        border-radius: 5px;
    }

    .input-group {
        width: 70%;
        border-radius: 5px;
    }

    .leftbarvue{
        flex: 1;
        position: fixed;
    }

@media (max-width: 768px) {
   .form_info form { 
       width: 60%;
   }

   .form_info h2 { 
       width: 90%;
       margin-left: 5%;
       font-size: 16px;
   }

   .item{ 
       display: block;
       text-align: center;
       align-items: center;
   }

   .input { 
       display: block;
       width: 90%;
       margin-left: 5%;
   }
   .custom-select {
       width: 100%;
   }
}

    
</style>