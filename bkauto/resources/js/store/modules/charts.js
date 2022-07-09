import baseUrl from "../baseUrl";
import router from '../../router'
import { proxyRefs, pushScopeId } from "vue";
import Vue from 'vue';
import ls from 'localstorage-slim';

const state = {
   turnover: [],
//    jan: [],
//    feb: [],
//    mar: [],
//    apr: [],
//    may: [],
//    jun: [],
//    jul: [],
//    aug: [],
//    sep: [],
//    oct: [],
//    nov: [],
//    dec: []
}

const getters = {
    turnover:state => state.turnover,
    jan:state => state.turnover.jan,
    feb:state => state.turnover.feb,
    mar:state => state.turnover.mar,
    apr:state => state.turnover.apr,
    may:state => state.turnover.may,
    jun:state => state.turnover.jun,
    jul:state => state.turnover.jul,
    aug:state => state.turnover.aug,
    sep:state => state.turnover.sep,
    oct:state => state.turnover.oct,
    nov:state => state.turnover.nov,
    dec:state => state.turnover.dec,
}

const mutations = {
    SET_TURNOVER(state, total) {
        state.turnover.jan = total.jan;
        state.turnover.feb = total.feb;
        state.turnover.mar = total.mar;
        state.turnover.apr = total.apr;
        state.turnover.may = total.may;
        state.turnover.jun = total.jun;
        state.turnover.jul = total.jul;
        state.turnover.aug = total.aug;
        state.turnover.sep = total.sep;
        state.turnover.oct = total.oct;
        state.turnover.nov = total.nov;
        state.turnover.dec = total.dec;
    }
   
}

const actions = {
   setTurnOver({commit}) {
        baseUrl.adminGet('bills/turnover').then((result) => {
            const total = result.data;
            commit('SET_TURNOVER', total);
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