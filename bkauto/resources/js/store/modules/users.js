import baseUrl from "../baseUrl";
import router from '../../router';
import ls from 'localstorage-slim';

const state = {
    user: [],
    login: false,
}

const getters = {
    // user
    // user_auth:state => state.login,
    user:state => state.user,
    email:state => state.user.email,
    password:state => state.user.password,
    name:state => state.user.name,
    phone:state => state.user.phone,

    login:state => state.login,
}

const mutations = {
    SET_USER(state, user) {
        state.user = user; 
        state.login = true;

        // ls.set('user', user, {ttl: 7200});
    },

    LOGIN(state){
        state.login = true;
    },
}

const actions = {
    getUser({commit}) {
        baseUrl.userGet('me').then((result) => {
            var user = result.data;
            commit('SET_USER', user);
        }).catch((err) => {
            console.log(err);
        });
    },

    logout(){
        ls.remove('token_user');
        ls.remove('user');
        router.push({name: 'login-user'});
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}