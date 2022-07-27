/*=========================================================================================
  File Name: moduleEcommerceActions.js
  Description: Ecommerce Module Actions
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

import apiCall from "../../apiCall";

export default {
    fetchCart({commit}){
        return new Promise((resolve, reject) => {
            apiCall.getCall(
                'cart/index',
                {},
                (response) => {
                    commit('SET_CART', response)
                    resolve(response)
                },
                (error) => {
                    reject(error)
                });
        })
    },
    toggleItemInWishList({commit}, item) {
        commit('TOGGLE_ITEM_IN_WISH_LIST', item)
    },
    toggleItemInCart({getters, commit, dispatch}, item) {
        getters.isInCart(item.id) ? dispatch('removeItemInCart', item) : dispatch('addItemInCart', item)
    },
    addItemInCart({commit}, item) {
        let params = {
            'product_id' : item.id,
            'quantity': 1
        }

        return new Promise((resolve, reject) => {
            apiCall.postCall(
                'cart/add_product',
                params,
                (response) => {
                    commit('ADD_ITEM_IN_CART', item)
                    resolve(response)
                },
                (error) => {
                    reject(error)
                });
        })
    },
    removeItemInCart({commit}, item) {
        let params = {
            'product_id' : item.id,
            'quantity': 1
        }

        return new Promise((resolve, reject) => {
            apiCall.postCall(
                'cart/remove_product',
                params,
                (response) => {
                    commit('REMOVE_ITEM_FROM_CART', item)
                    resolve(response)
                },
                (error) => {
                    reject(error)
                });
        })
    },
    updateItemQuantity({commit}, payload) {
        commit('UPDATE_ITEM_QUANTITY', payload)
    },

    //////////////////////////////////////////
    // Address
    //////////////////////////////////////////

    fetchAddress({commit}){
        return new Promise((resolve, reject) => {
            apiCall.getCall(
                'address/list',
                {},
                (response) => {
                    commit('SET_ADDRESS', response)
                    resolve(response)
                },
                (error) => {
                    reject(error)
                });
        });
    },

}
