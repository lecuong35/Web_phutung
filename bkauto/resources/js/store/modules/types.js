import baseUrl from "../baseUrl";
import router from '../../router';

const state = {
   types: [],
   types_origin: []
}

const getters = {
    // types
    types:state => state.types,
}

const mutations = {
    SET_TYPES(state, types) {
        state.types = types; 
        state.types_origin = types;
    }, 

   ADD_TYPE(state, type){
       state.types.unshift(type);
   },

   SEARCH_TYPE(state, typeName){
    if(typeName != '') {
        state.types = state.types.filter(type => type.name.includes(typeName));
    }
    else state.types = state.types_origin;
   }
 }

const actions = {
    getTypes({commit}) {
        baseUrl.getType().then((result) => {
            commit('SET_TYPES', result.data)
            console.log(result)
        }).catch((err) => {
            console.log(err)
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