import baseUrl from "../baseUrl";
import router from '../../router';

const state = {
    admin: [],
    login: false,
}

const getters = {
    // admin
    // admin_auth:state => state.login,
    admin:state => state.admin,
    email:state => state.admin.email,
    password:state => state.admin.password,
    facebook:state => state.admin.facebook,
    bank:state => state.admin.bank,
    phone:state => state.admin.phone,
}

const mutations = {
    SET_ADMIN(state, admin) {
        state.admin = admin; 
    },

    LOGIN(state){
        state.login = true;
    },
}

const actions = {
    getAdmin({commit}) {
        baseUrl.adminGet('me').then((result) => {
            var admin = result.data;
            commit('SET_ADMIN', admin);
        }).catch((err) => {
            console.log(err);
        });
    },
    
    // loginAdmin({commit, getters}, admin) {
    //     baseUrl.adminLogin('login', admin)
    //     // .then((result) => {
    //     //     var token = result.data;
    //     //     window.localStorage.setItem('token_admin', token);
    //     //     commit('LOGIN');
    //     //     commit('SET_ADMIN', admin);
    //     //     router.push({name: 'admin'});
    //     //     console.log(getters.email);
    //     // }).catch((err) => {
    //     //     console.log(err);
    //     // });
    // },

    updateAdmin({commit}, admin) {
        window.confirm("Ban co muon sua thong tin ?")
        baseUrl.adminPost('update', admin).then((result) => {
            var newAdmin = result.data;
            commit('SET_ADMIN', newAdmin);
            router.push({name: 'login'})
        }).catch((err) => {
            console.log(err);
        });
    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}