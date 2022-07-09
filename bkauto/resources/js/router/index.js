import AdminInfoVue from "../components/admin/AdminInfo.vue";
import AdminLoginVue from "../components/admin/AdminLogin.vue";

import * as VueRouter from 'vue-router'
import LeftBarVue from "../components/admin/layouts/LeftBar.vue";
import ProductMangeVue from "../components/products/ProductMange.vue";
import ProductAddVue from "../components/products/ProductAdd.vue";
import TypesManageVue from "../components/types/TypesManage.vue";
import TypeAddVue from "../components/types/TypeAdd.vue";
import BillManageVue from "../components/bills/BillManage.vue"
import LoginUserVue from "../components/users/LoginUser.vue";
import HeaderUserVue from "../components/users/HeaderUser.vue";
import UserManageVue from "../components/users/UserManage.vue";
import UserRegisterVue from "../components/users/UserRegister.vue";
import CartManageVue from "../components/carts/CartManage.vue";
import CartHistoryVue from "../components/carts/CartHistory.vue";
import IndexPageVue from "../components/users/IndexPage.vue";
import BarChartVue from "../components/admin/BarChart.vue";

const routes = [
    {
        name: 'home',
        path: '/',
        component: LoginUserVue,
    },
    {
        name: 'admin',
        path: '/admin',
        component: AdminInfoVue,
    },
    {
        name: 'login',
        path: '/login',
        component: AdminLoginVue
    },
    {
        name: 'leftbar',
        path: '/leftbar',
        component: LeftBarVue
    },
    {
        name: 'product-manage',
        path: '/product',
        component: ProductMangeVue
    },
    {
        name: 'product-add',
        path: '/product-add',
        component: ProductAddVue
    },
    {
        name: 'type-manage',
        path: '/type',
        component: TypesManageVue
    },
    {
        name: 'type-add',
        path: '/type-add',
        component: TypeAddVue
    },
    {
        name: 'bill',
        path: '/bill-manage',
        component: BillManageVue
    },

    //user 
    {
        name: 'login-user',
        path: '/login-user',
        component: LoginUserVue
    },
    {
        name: 'header-user',
        path: '/header-user',
        component: HeaderUserVue
    },
    {
        name: 'manage-user',
        path: '/manage-user',
        component: UserManageVue
    },
    {
        name: 'user-register',
        path: '/user-register',
        component: UserRegisterVue
    },
    {
        name: 'cart-manage',
        path: '/cart-manage',
        component: CartManageVue
    },
    {
        name: 'cart-history',
        path: '/cart-history',
        component: CartHistoryVue
    },
    {
        name: 'index',
        path: '/index',
        component: IndexPageVue
    },
    {
        name: 'barchart ',
        path: '/barchart',
        component: BarChartVue
    },
    // {
    //     name: 'export-excel ',
    //     path: '/admin/products/export-excel',
    // },
    
];

const router = VueRouter.createRouter({
    history:VueRouter.createWebHashHistory(),
    routes,
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active"
});

export default router 