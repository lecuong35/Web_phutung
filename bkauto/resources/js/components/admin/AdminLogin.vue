<template>
    <div class="login-form row">
       <form @submit.prevent="login(admin)" class="col-lg-3 col-sm-6">
           <h2>LOGIN ADMIN</h2>
           <hr>
         <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" 
            class="form-control" :class="{'is-invalid' : errors.email}"
            id="exampleInputEmail1" 
            aria-describedby="emailHelp" v-model="admin.email">
            <div class="invalid-feedback">
               {{errors.email}}
            </div>
         </div>
         <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password"  name="password" 
            class="form-control"  :class="{'is-invalid' : errors.password}"
            id="exampleInputPassword1"  v-model="admin.password">
            <div class="invalid-feedback">
               {{errors.password}}
            </div>
         </div>
         <button type="submit" class="btn btn-primary">Submit</button>
       </form>
    </div>
</template>
<script>
import router from '../../router';
import baseUrl from '../../store/baseUrl';
import ls from 'localstorage-slim';

export default {
    data() {
        return {
            admin: {
                email: '',
                password: ''
            },
            errors: {}
        }
    },

    methods: {
       login(admin) {
          baseUrl.adminLogin('login',admin).then((response) => {
            var token = response.data;
            // window.localStorage.setItem('token_admin', token);
            ls.set('token_admin', token, {ttl: 7200})
            router.push({name: 'product-manage'});
        }).catch((err) => {
            this.errors = err.response.data.errors;
           console.log(this.errors);
           window.alert("Sai tài khoản hoặc mật khẩu")
        });
       }
    },
}
</script>
<style scoped>

    .login-form {
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        left: 0px;
        top: 0px;
        right: 0px;
        bottom: 0px;
        background-image: url(../../../css/assets/draw2.webp);
    }

    .login-form form { 
        text-align: center;
        border: solid 1px rgb(73, 73, 245) ;
        border-radius: 15px;
        padding: 10px 10px 10px 10px;
        box-shadow: 5px 7px rgba(0,0,0,0.15);
        background-color: rgb(112, 114, 247);
        
    }

    .login-form button { 
        border-radius: 10px;
        background-color: rgb(25, 4, 107);
    }

    @media (max-width: 768px) {
        .login-form form{
            width: 80%;
            font-size: large;
        }
    }
</style>