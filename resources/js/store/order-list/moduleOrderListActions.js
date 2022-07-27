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
    createOrder({commit}, params) {
        return new Promise((resolve, reject) => {
            apiCall.postCall(
                'order/create',
                params,
                (response) => {
                    resolve(response)
                },
                (error) => {
                    reject(error)
                });
        })
    },
    fetchList({commit}) {
        return new Promise((resolve, reject) => {
            apiCall.getCall(
                'order/list',
                {},
                (response) => {
                    commit('SET_ORDERS', response)
                    resolve(response)
                },
                (error) => {
                    reject(error)
                });
        })
    },
    getOrderDetail({commit}, params){
        return new Promise((resolve, reject) => {
            apiCall.getCall(
                'order/detail',
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
    updateOrderStatus({commit}, params) {
        return new Promise((resolve, reject) => {
            apiCall.postCall(
                `order/updateStatus`,
                params,
                () => {
                    commit('UPDATE_ORDER_STATUS', params)
                    resolve()
                },
                (error) => {
                    reject(error)
                });
        })
    },
    updateShipping({commit}, params) {
        return new Promise((resolve, reject) => {
            apiCall.postCall(
                `order/updateShipping`,
                params,
                () => {
                    resolve()
                },
                (error) => {
                    reject(error)
                });
        })
    },
    // removeItem({commit}, itemId) {
    //     return new Promise((resolve, reject) => {
    //         axios.delete(`order/products/${itemId}`)
    //             .then((response) => {
    //                 commit('REMOVE_ITEM', itemId)
    //                 resolve(response)
    //             })
    //             .catch((error) => {
    //                 reject(error)
    //             })
    //     })
    // }
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

    //////////////////////////////////////////
    // Payment
    //////////////////////////////////////////
    getIntent({commit}, params) {
        return new Promise((resolve, reject) => {
            apiCall.getCall(
                'order/get_intent',
                {params},
                (response) => {
                    resolve(response);
                },
                () => {
                    reject('API Call Failed');
                });
        });
    },
}
