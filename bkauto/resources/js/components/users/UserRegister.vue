<template>
    <div class="login-form row">
       <form @submit.prevent="register(user)" class="col-lg-3 col-sm-6">
           <h2>REGISTER USER</h2>
           <hr>

           <div class="form-group">
            <label for="exampleInputPassword1">Name</label>
            <input type="text"  name="name" 
            class="form-control"  :class="{'is-invalid' : errors.name}"
            id="exampleInputPassword1"  v-model="user.name">
            <div class="invalid-feedback">
               {{errors.name}}
            </div>
         </div>

         <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="email" 
            class="form-control" :class="{'is-invalid' : errors.email}"
            id="exampleInputEmail1" 
            aria-describedby="emailHelp" v-model="user.email">
            <div class="invalid-feedback">
               {{errors.email}}
            </div>
         </div>

         <div class="form-group">
            <label for="exampleInputPassword2">Password</label>
            <input type="password"  name="password" 
            class="form-control"  :class="{'is-invalid' : errors.password}"
            id="exampleInputPassword2"  v-model="user.password">
            <div class="invalid-feedback">
               {{errors.password}}
            </div>
         </div>

          <div class="form-group">
            <label for="exampleInputPassword3">Phone</label>
            <input type="text"  name="phone" 
            class="form-control"  :class="{'is-invalid' : errors.phone}"
            id="exampleInputPassword3"  v-model="user.phone">
            <div class="invalid-feedback">
               {{errors.phone}}
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
            user: {
                email: '',
                password: '',
                name: '',
                phone: ''
            },
            errors: {}
        }
    },

    methods: {
       register(user) {
          baseUrl.userPost('register',user).then((response) => {
            router.push({name: 'login-user'});
        }).catch((err) => {
            this.errors = err.response.data.errors;
           console.log(this.errors)
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

    .login-form button:hover{
        background-color: blue;
    }

    @media (max-width: 768px) {
        .login-form form{
            width: 80%;
            font-size: large;
        }
    }
</style>