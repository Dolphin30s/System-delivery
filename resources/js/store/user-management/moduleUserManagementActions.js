/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

import apiCall from "../../apiCall";

export default {
    // addItem({ commit }, item) {
    //   return new Promise((resolve, reject) => {
    //     axios.post("/api/data-list/products/", {item: item})
    //       .then((response) => {
    //         commit('ADD_ITEM', Object.assign(item, {id: response.data.id}))
    //         resolve(response)
    //       })
    //       .catch((error) => { reject(error) })
    //   })
    // },
    fetchUsers({commit}) {
        return new Promise((resolve, reject) => {
            apiCall.getCall(
                'users/list',
                {},
                (response) => {
                    commit('SET_USERS', response)
                    resolve(response)
                },
                (error) => {
                    reject(error)
                })
        })
    },
    fetchUser(context, params) {
        return new Promise((resolve, reject) => {
            apiCall.getCall(
                `users/index`,
                { params },
                (response) => {
                    resolve(response)
                },
                (error) => {
                    reject(error)
                })
        })
    },
    fetchProfile(context){
        return new Promise((resolve, reject) => {
            apiCall.getCall(
                `users/profile`,
                {},
                (response) => {
                    resolve(response)
                },
                (error) => {
                    reject(error)
                })
        })
    },
    updateUser({commit}, params){
        return new Promise((resolve, reject) => {
            apiCall.uploadCall(`users/update`,
                params,
                (response) => {
                    commit('UPDATE_USER', params)
                    resolve(response)
                },
                (error) => {
                    reject(error)
                })
        })
    },
    removeRecord({commit}, params) {
        return new Promise((resolve, reject) => {
            apiCall.postCall(`users/remove`,
                params,
                (response) => {
                    commit('REMOVE_USER', params)
                    resolve(response)
                },
                (error) => {
                    reject(error)
                })
        })
    }
}
