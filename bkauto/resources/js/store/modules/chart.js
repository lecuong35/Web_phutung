import baseUrl from "../baseUrl";
import router from '../../router'
import { proxyRefs, pushScopeId } from "vue";
import Vue from 'vue';
import ls from 'localstorage-slim';

const state = {
   turnover: [],
   jan: [],
   feb: [],
   mar: [],
   apr: [],
   may: [],
   jun: [],
   jul: [],
   aug: [],
   sep: [],
   oct: [],
   nov: [],
   dec: []
}

const getters = {
    turnover:state => state.turnover,
    jan:state => state.jan,
    feb:state => state.feb,
    mar:state => state.mar,
    apr:state => state.apr,
    may:state => state.may,
    jun:state => state.jun,
    jul:state => state.jul,
    aug:state => state.aug,
    sep:state => state.sep,
    oct:state => state.oct,
    nov:state => state.nov,
    dec:state => state.dec,
}

const mutations = {
   
}

const actions = {
   
}

export default {
    namespaced: true,
    state,
    getters, 
    actions,
    mutations
}