import router from '../router' ;
import ls from 'localstorage-slim'

const URL_user = 'http://127.0.0.1:8000/api/user/';
const URL_admin = 'http://127.0.0.1:8000/api/admin/';
const URL_product = 'http://127.0.0.1:8000/api/products/';
const axios = require('axios')

export default {

    // user
    getUserHeader() 
    {
        let token = ls.get('token_user');
        if(token == null) {
            return {}
        }
        console.log(token)
        return {Authorization: 'Bearer ' + token}
    },

    userGet(url) 
    {
        return axios.get(URL_user + url,
        { headers: this.getUserHeader() }
        );
    },

    userLogout(url) 
    {
        return axios.post(URL_user + url,
        { headers: this.getUserHeader() }
        );

    },

    userPost(url, data) 
    {
        return axios.post(URL_user + url,
        data,
        { headers: this.getUserHeader() }
        );
    },

    userPostHasId(url, id, data)
    {
        return axios.post(URL_user + url + id,
            data,
            { headers: this.getUserHeader() });
    },

    userDelete(url,id) 
    {
        return axios.delete(URL_user + url + id,
        { headers: this.getUserHeader() }
        );
    },
    
    userLogin(url, user) 
    {
        return axios.post(URL_user+url,user);
    },

    userRegister(url, {name, email, password, phone}) 
    {
        return axios.post(URL+url, {name, email, password, phone});
    },


    // admin
    getAdminHeader() 
    {
        let token = ls.get('token_admin');
        if(token == null) {
            return {}
        }
        return {Authorization: 'Bearer ' + token}
    },

    adminGet(url) 
    {
        return axios.get(URL_admin + url,
        { headers: this.getAdminHeader() }
        );
    },

    adminGetWithParams(url, params) 
    {
        return axios.get(URL_admin + url + params,
        { headers: this.getAdminHeader() }
        );
    },

    // logout - update - create products, types
    adminPost(url, data) 
    {
        return axios.post(URL_admin + url,
        data,
        { headers: this.getAdminHeader() }
        );
    },

    adminPostId(url, id) 
    {
        return axios.post(URL_admin + url + id,
        { headers: this.getAdminHeader() }
        );
    },

    // update products, types
    adminPostHasId(url, id, data) 
    {
        return axios.post(URL_admin + url + id,
        data,
        { headers: this.getAdminHeader() });
    },

    // delete products, types, bills
    adminDelete(url,id) 
    {
        return axios.delete(URL_admin + url + id,
        { headers: this.getAdminHeader() }
        );
    },
    
    adminLogin(url, admin) 
    {
        return axios.post(URL_admin+url,admin);
    },

    adminRegister(url, {email, password, phone, facebook, bank}) 
    {
        return axios.post(URL_admin+url, {phone, facebook, bank, email, password});
    },

    // product :search - sort - show by Id
    getProduct(url,nameOrId) 
    {
        return axios.get(URL_product + url + nameOrId);
    },

    // get type
    getType() {
        return axios.get('http://127.0.0.1:8000/api/types/index');
    },

    // check login by admin 
    checkAdminLogin() {
        const token = ls.get('token_admin');
        if( token == null) {
            router.push({name: 'login'});
        }
    },

    //chekc user login
    checkUserLogin() {
        const token = ls.get('token_user');
        if( token == null) {
            router.push({name: 'login-user'});
        }
    }

}