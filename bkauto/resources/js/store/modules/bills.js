import baseUrl from "../baseUrl";
import router from '../../router'

const state = {
    bills: [],
    billsOrigin: [],
    carts: [],
}

const getters = {
    // bills
    bills:state => state.bills,
    carts:state => state.carts,
    searchBill:state => billName => state.bills.filter(bill => bill.name.includes(billName)),
}

const mutations = {
    SET_BILLS(state, bills) {
        state.bills = bills; 
        state.billsOrigin = bills;
    },

    SET_CARTS(state, carts) {
        state.carts = carts; 
    },

    ADD_BILL(state, bill){
        state.bills.unshift(bill);
    },

    UPDATE_BILL(state, id, newBill) {
        state.bills = state.bills.map( bill => {
            if(bill.id === id) bill = newBill;
            return bill;
        });
    },

    SEARCH_BILL(state, billName){
        if(billName != '') {
            state.bills = state.bills.filter(bill => bill.name.includes(billName));
        }
        else state.bills = state.billsOrigin;
    },

    CART_TO_BILL(state) {
        const bills = state.billsOrigin;
        bills.forEach(bill => {
            const carts = state.carts.filter(cart => cart.bill_id === bill.id);
            bill.cartItems = carts;
        })
    },

    CONFIRM_BILL(state, id) {
        state.bills = state.bills.filter(bill => bill.id !== id)
    }
}

const actions = {
    getBills({commit}) {
        baseUrl.adminGet('bills/index').then((result) => {
            var bills = result.data; 
            bills.forEach(bill => {
                bill.cartItems = []
            });
            commit('SET_BILLS', bills)
        }).catch((err) => {
            console.log(err);
        });
    },

    getCarts({commit}) {
        baseUrl.adminGet('carts').then((result) => {
            var carts = result.data;
            commit('SET_CARTS', carts)
            commit('CART_TO_BILL')
        }).catch((err) => {
            console.log(err);
        });
    },

    confirmBill({commit}, id) {
        baseUrl.adminPostId('bills/confirm/', id).then( (result) => {
            commit('CONFIRM_BILL', id);
            window.history.go();
        }).catch(err => {
            console.log(err);
        })
    }
}

export default {
    namespaced: true,
    state,
    getters, 
    actions,
    mutations
}