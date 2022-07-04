import baseUrl from "../baseUrl";
import router from '../../router'
import { proxyRefs, pushScopeId } from "vue";
import Vue from 'vue';
import ls from 'localstorage-slim';

const state = {
    carts: [],
    cartsOrigin: [],
    products: [],
    sum_price: 0,
    showForm: false,
    cartsHistory: [],
    cartsHistoryOrigin: []
}

const getters = {
    // carts
    carts:state => state.carts,
    searchCart:state => cartName => state.carts.filter(cart => cart.name.includes(cartName)),
    products: state => id => state.products.filter(pro => pro.id === id),
    sum:state => state.sum_price,
    cartsHistory:state => state.cartsHistory,
    searchCartHistory:state => cartName => state.cartsHistory.filter(cart => cart.name.includes(cartName)),
}

const mutations = {
    SET_CARTS(state, carts) {
        state.carts = carts; 
        state.cartsOrigin = carts;
    },

    SET_CARTS_HISTORY(state, carts) {
        state.cartsHistory = carts; 
        state.cartsHistoryOrigin = carts;
    },

    ADD_CART(state, id){
        state.carts.map(cart => {
            if(cart.id === id) {
                cart.quantity += 1;
                cart.changed = true
            }
        })
    },

    SUB_CART(state, id){
        state.carts.map(cart => {
            if(cart.id === id && cart.quantity > 1){
                cart.quantity -= 1;
                cart.changed = true;
            }
        })
    },

    CHANGE_SELECTED(state,id) {
        state.carts = state.carts.map(cart => {
            if(cart.id === id) {
                cart.selected = !cart.selected;
                if(cart.selected) cart.ordered = "Đang đặt";
                else cart.ordered = "Chưa được đặt";
            }
            return cart
        })        
    },

    UPDATE_CART(state, id, newcart) {
        state.carts = state.carts.map( cart => {
            if(cart.id === id) cart = newcart;
            return cart;
        });
    },

    SEARCH_CART(state, id){
        if(id != '') {
            state.carts = state.carts.filter(cart => cart.id == id); 
        }
        else state.carts = state.cartsOrigin;
    },

    SEARCH_CART_HISTORY(state, id){
        if(id != '') {
            state.cartsHistory = state.cartsHistory.filter(cart => cart.id == id); 
        }
        else state.cartsHistory = state.cartsHistoryOrigin;
    },

    PRICE(state) {
        state.cartsHistory = state.cartsHistory.map(cart => {
            cart.sumCost = cart.price * cart.quantity;
        })
    },

    GET_SUM(state) {
        state.sum_price = 0;
       const form = document.getElementById("form-order");
       form.style.display = "block";
        state.carts.map(cart => {
            if(cart.selected === true) {
                state.sum_price += cart.price * cart.quantity;
            }
        });
    }
}

const actions = {
    getCarts({commit}) {
        baseUrl.userGet('carts/index').then((result) => {
            var carts = result.data;
            carts.forEach(cart => {
                cart.selected = false;
                cart.changed = false;
            });
            commit('SET_CARTS', carts);
        }).catch((err) => {
            console.log(err);
        });
    },

    getCartsHistory({commit}) {
        baseUrl.userGet('carts/history').then((result) => {
            var carts = result.data;
            commit('SET_CARTS_HISTORY', carts);
            // commit('PRICE');
        }).catch((err) => {
            console.log(err);
        });
    },

    deleteCart({commit}, id) {
        window.confirm("Bạn có muốn xóa sản phẩm này khỏi giỏ hàng không ?")
        baseUrl.userDelete('carts/delete/', id);
        this.getCarts;
        window.history.go();
    },

    updateCarts({state}){
        state.carts.map(cart => {
            console.log(cart.changed)
            if(cart.selected == true) {
                baseUrl.userPostHasId('carts/update/', cart.id, {quantity: cart.quantity})
            }
        })
    },

    orderBill({state}, info) {
        const sum = state.sum_price;
        baseUrl.userPost('bills/update', info)
    },

    addCart({commit}, id){
        const token = ls.get('token_user');
        if(token != null){
            baseUrl.userPostHasId('carts/create/', id);
            router.push({name: 'index'});
        } else 
           router.push({name: login-user});
    }
}

export default {
    namespaced: true,
    state,
    getters, 
    actions,
    mutations
}