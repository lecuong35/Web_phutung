import toyotaSlide from '../../../css/assets/toyotaslide.jpg'
import superCarSlide from '../../../css/assets/spcar.jpg'
import hondaSlide from '../../../css/assets/hondaslide.jpg'
const state = {
   source: toyotaSlide,
}

const getters = {
   source:state => state.source,
   img:state=> state.img
}

const mutations = {
   CLICK_1(state) {
        state.source = toyotaSlide;
   },
   CLICK_2(state) {
        state.source = superCarSlide;
    },
    CLICK_3(state) {
        state.source = hondaSlide;
    },

    CLICK_NEXT(state) {
        if(state.source === toyotaSlide) state.source = superCarSlide;
        else if(state.source === superCarSlide) state.source = hondaSlide;
        else state.source = toyotaSlide;
    },

    CLICK_PREV(state) {
        if(state.source === toyotaSlide) state.source = hondaSlide;
        else if(state.source === superCarSlide) state.source = toyotaSlide;
        else state.source = superCarSlide;
    },

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