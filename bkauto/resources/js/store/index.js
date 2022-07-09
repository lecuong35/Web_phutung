import { createStore, createLogger } from 'vuex'
import admin from './modules/admin'
import products from './modules/products'
import types from './modules/types'
import users from './modules/users'
import carts from './modules/carts'
import bills from './modules/bills'
import page from './modules/page'
import charts from './modules/charts'

const debug = process.env.NODE_ENV !== 'production'

export default createStore({
    modules: {
       admin,
       products,
       types,
       users,
       carts,
       bills,
       page,
       charts
    },
    strict: debug,
    plugins: debug ? [createLogger()] : []
})