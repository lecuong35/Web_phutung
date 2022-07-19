<template>
    
       <div class="admin_page">
            
            <div class="leftbarvue">
                <LeftBarVue />
            </div>
               
            <div class="form_info">
             <form @submit.prevent="update(admin)" >
                <h2>ADMIN INFOMATION</h2>
                <hr>
                <div class="email item form-group"> 
                    <label for="admin_email">Email</label>
                    <div class="input">
                        <input type="text" id="admin_email" 
                    class=" form-control" :class="{'is-invalid' : errors.email}" 
                    :placeholder= "origin_email"
                    v-model="admin.email">
                     <div class="invalid-feedback">
                        {{errors.email}}
                   </div>
                    </div>
                </div>

                <div class="password item form-group">
                    <label for="admin_password">Password</label>
                    <div class="input">
                        <input type="text" id="admin_password" 
                    class=" form-control" :class="{'is-invalid' : errors.password}" 
                     placeholder="abc123"
                    v-model="admin.password">
                     <div class="invalid-feedback">
                        {{errors.password}}
                   </div>
                    </div>
                </div>

               <div class="facebook item form-group">
                    <label for="admin_facebook">Facebook</label>
                    <div class="input">
                        <input type="text" id="admin_facebook" 
                    class=" form-control" :class="{'is-invalid' : errors.facebook}" 
                    :placeholder= "origin_facebook"
                    v-model="admin.facebook">
                     <div class="invalid-feedback">
                        {{errors.facebook}}
                   </div>
                    </div>
                </div>

               <div class="bank item form-group">
                    <label for="admin_bank">Bank</label>
                    <div class="input">
                        <input type="text" id="admin_bank" 
                    class=" form-control" :class="{'is-invalid' : errors.bank}" 
                    :placeholder= "origin_bank"
                    v-model="admin.bank">
                     <div class="invalid-feedback">
                        {{errors.bank}}
                   </div>
                    </div>
                </div>

               <div class="phone item form-group">
                    <label for="admin_phone">Phone</label>
                    <div class="input">
                        <input type="text" id="admin_phone" 
                        class=" form-control" :class="{'is-invalid' : errors.phone}" 
                        :placeholder= "origin_phone"
                        v-model="admin.phone">
                     <div class="invalid-feedback">
                        {{errors.phone}}
                   </div>
                    </div>
                </div>

                <button type="submit" class="submit">Update</button>
             </form>
            </div>
            
       </div>
    
</template>
<script>
import LeftBarVue from './layouts/LeftBar.vue'
import { mapActions, mapGetters, mapState, useStore } from 'vuex'
import baseUrl from '../../store/baseUrl'
import { computed, onMounted } from 'vue';
// import { onMounted } from 'vue'
export default {
   name: 'admin',
   components: { LeftBarVue },
   created: baseUrl.checkAdminLogin,

   setup() {
      const store = useStore();
      store.dispatch('admin/getAdmin');
      const  origin_email = computed( () => JSON.parse(JSON.stringify(store.getters['admin/admin'][0][0].email)) );
      const  origin_password = computed( () => JSON.parse(JSON.stringify(store.getters['admin/admin'][0][0].password)) );
      const  origin_facebook = computed( () => JSON.parse(JSON.stringify(store.getters['admin/admin'][0][0].facebook)) );
      const  origin_bank = computed( () => JSON.parse(JSON.stringify(store.getters['admin/admin'][0][0].bank)) );
      const  origin_phone = computed( () => JSON.parse(JSON.stringify(store.getters['admin/admin'][0][0].phone)) );
      return {
          origin_email,
          origin_bank,
          origin_facebook,
          origin_password, 
          origin_phone
      };
   },

   data() {
       return {
           admin: {
               email: '',
               password: '',
               facebook: '',
               bank: '',
               phone: '',
           },
           errors: {}
       }
   },


   methods: {
      update(admin) {
           window.confirm("Ban co muon sua thong tin ?")
            baseUrl.adminPost('update', admin).then((response) => {
                var newAdmin = response.data;
                commit('SET_ADMIN', newAdmin);
                router.push({name: 'login'})
            }).catch((err) => {
                this.errors = err.response.data.errors;
                console.log(this.errors)
            });
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
}

    
</style>