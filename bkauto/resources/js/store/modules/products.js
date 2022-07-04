import baseUrl from "../baseUrl";
import router from '../../router'

const state = {
    products: [],
    productsOrigin: []
}

const getters = {
    // products
    products:state => state.products,
    productName:state => id => state.products.filter(product => {
        if(product.id === id) return product.name;
    }),
    searchProduct:state => productName => state.products.filter(product => product.name.includes(productName)),
}

const mutations = {
    SET_PRODUCTS(state, products) {
        state.products = products; 
        state.productsOrigin = products;
    },

    ADD_PRODUCT(state, product){
        state.products.unshift(product);
    },

    UPDATE_PRODUCT(state, id, newProduct) {
        state.products = state.products.map( product => {
            if(product.id === id) product = newProduct;
            return product;
        });
    },

    SEARCH_PRODUCT(state, productName){
        state.products = state.productsOrigin;
        if(productName != '') {
            state.products = state.products.filter(product => product.name.includes(productName));
        }
        else state.products = state.productsOrigin;
    },

    SEARCH_BY_TYPE(state, type){
        state.products = state.productsOrigin;
        if(type != '') {
            state.products = state.products.filter(product => product.name.includes(type));
        }
        else state.products = state.productsOrigin;
    },

    SEARCH_BY_BRAND(state, brand){
        state.products = state.productsOrigin;
        if(brand != '') {
            state.products = state.products.filter(product => product.name.includes(brand));
        }
        else state.products = state.productsOrigin;
    },

    RESTORE(state) {
        state.products = state.productsOrigin;
    }
}

const actions = {
    getProducts({commit}) {
        baseUrl.adminGet('products/index').then((result) => {
            var products = result.data;
            console.log(products);
            commit('SET_PRODUCTS', products);
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