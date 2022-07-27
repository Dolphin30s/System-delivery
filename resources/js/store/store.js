import Vue from 'vue'
import Vuex from 'vuex'

import state from './state'
import getters from './getters'
import mutations from './mutations'
import actions from './actions'

Vue.use(Vuex)

import auth from './auth/moduleAuth'
import userManagement from './user-management/moduleUserManagement'
import moduleECommerce from './eCommerce/moduleECommerce'
import productList from './product-list/moduleProductList'
import orderList from './order-list/moduleOrderList'

export default new Vuex.Store({
    getters,
    mutations,
    state,
    actions,
    modules: {
        auth: auth,
        userManagement: userManagement,
        eCommerce: moduleECommerce,
        productList: productList,
        orderList: orderList
    },
    strict: process.env.NODE_ENV !== 'production'
})
