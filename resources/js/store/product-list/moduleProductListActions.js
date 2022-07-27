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
    addItem({commit, dispatch}, item) {
        return new Promise((resolve, reject) => {
            apiCall.uploadCall(
                'product/add',
                item,
                (response) => {
                    dispatch('fetchItems');
                    resolve(response)
                },
                (error) => {
                    reject(error)
                });
        })
    },
    fetchItems({commit}) {
        return new Promise((resolve, reject) => {
            apiCall.getCall(
                'product/list',
                {},
                (response) => {
                    commit('SET_PRODUCTS', response)
                    resolve(response)
                },
                (error) => {
                    reject(error)
                });
        })
    },
    fetchItem({}, params) {
        return new Promise((resolve, reject) => {
            apiCall.getCall(
                'product/index',
                {params},
                (response) => {
                    resolve(response)
                },
                (error) => {
                    reject(error)
                });
        })
    },
    // fetchEventLabels({ commit }) {
    //   return new Promise((resolve, reject) => {
    //     axios.get("/api/apps/calendar/labels")
    //       .then((response) => {
    //         commit('SET_LABELS', response.data)
    //         resolve(response)
    //       })
    //       .catch((error) => { reject(error) })
    //   })
    // },
    updateItem({commit}, item) {
        return new Promise((resolve, reject) => {
            apiCall.uploadCall(
                `product/update`,
                item,
                (response) => {
                    resolve(response)
                },
                (error) => {
                    reject(error)
                });
        })
    },
    removeItem({commit, dispatch}, itemId) {
        return new Promise((resolve, reject) => {
            apiCall.postCall(
                `product/delete`,
                { id: itemId },
                (response) => {
                    dispatch('fetchItems');
                    resolve(response)
                },
                (error) => {
                    reject(error)
                })
        })
    }
    // eventDragged({ commit }, payload) {
    //   return new Promise((resolve, reject) => {
    //     axios.post(`/api/apps/calendar/event/dragged/${payload.event.id}`, {payload: payload})
    //       .then((response) => {

    //         // Convert Date String to Date Object
    //         let event = response.data
    //         event.startDate = new Date(event.startDate)
    //         event.endDate = new Date(event.endDate)

    //         commit('UPDATE_EVENT', event)
    //         resolve(response)
    //       })
    //       .catch((error) => { reject(error) })
    //   })
    // },
}
