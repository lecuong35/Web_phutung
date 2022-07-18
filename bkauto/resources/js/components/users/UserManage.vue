<template>
    
       <div class="user_page">
            
            <div class="leftbarvue">
                <HeaderUserVue />
            </div>
               
            <div class="form_info">
             <form @submit.prevent="update(user)">
                <h2>USER INFOMATION</h2>
                <hr>

                <div class="facebook item form-group">
                    <label for="user_facebook">Name</label>
                    <div class="input">
                        <input type="text" id="user_facebook" 
                        class=" form-control" :class="{'is-invalid' : errors.name}" 
                        v-model="user.name">
                       <div class="invalid-feedback">
                           {{errors.name}}
                       </div>
                    </div>
                </div>

                <div class="email item form-group"> 
                    <label for="user_email">Email</label>
                    <div class="input">
                        <input type="text" id="user_email" 
                    class=" form-control" :class="{'is-invalid' : errors.email}" 
                    v-model="user.email">
                     <div class="invalid-feedback">
                        {{errors.email}}
                   </div>
                    </div>
                </div>

                <div class="password item form-group">
                    <label for="user_password">Password</label>
                    <div class="input">
                        <input type="text" id="user_password" 
                    class=" form-control" :class="{'is-invalid' : errors.password}" 
                     placeholder="abc123"
                    v-model="user.password">
                     <div class="invalid-feedback">
                        {{errors.password}}
                   </div>
                    </div>
                </div>

               <div class="phone item form-group">
                    <label for="user_phone">Phone</label>
                    <div class="input">
                        <input type="text" id="user_phone" 
                    class=" form-control" :class="{'is-invalid' : errors.phone}" 
                    v-model="user.phone">
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
import HeaderUserVue from './HeaderUser.vue';
import { mapActions, mapGetters, mapState, useStore } from 'vuex'
import baseUrl from '../../store/baseUrl'
import { computed, onMounted } from 'vue';
import router from '../../router';
// import { onMounted } from 'vue'
export default {
   name: 'users',
   components: { HeaderUserVue },
   created: baseUrl.checkUserLogin,

   setup() {
      const store = useStore();
      store.dispatch('users/getUser');
      const  old_email = computed( () => JSON.parse(JSON.stringify(store.getters['users/user'][0][0].email)) );
      const  old_password = computed( () => JSON.parse(JSON.stringify(store.getters['users/user'][0][0].password)) );
      const  old_name = computed( () => JSON.parse(JSON.stringify(store.getters['users/user'][0][0].name)) );
      const  old_phone = computed( () => JSON.parse(JSON.stringify(store.getters['users/user'][0][0].phone)) );
      return {
          old_email,
          old_name,
          old_password, 
          old_phone
      };
   },


   data() {
       return {
           user: {
               email: '',
               password: '',
               name: '',
               phone: '',
           },
           errors: {}
       }
   },


   methods: {
      update(user) {
           window.confirm("Ban co muon sua thong tin ?")
            baseUrl.userPost('update', user).then((result) => {
                router.push({name: 'login-user'});
            }).catch((err) => {
                window.alert("Không thành công !");
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
    .user_page{
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
        background-color: blue;
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