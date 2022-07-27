/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default {
    ADD_ORDER(state, item) {
        state.orders.unshift(item)
    },
    SET_ORDERS(state, orders) {
        state.orders = orders
    },
    // SET_LABELS(state, labels) {
    //   state.eventLabels = labels
    // },
    UPDATE_ORDER_STATUS(state, order) {
        state.orders = state.orders.map((o) => {
            if (o.id === order.order_id){
                return {...o, order_status: order.order_status};
            }
            return o;
        });
    },
    // REMOVE_ITEM (state, itemId) {
    //   const ItemIndex = state.products.findIndex((p) => p.id === itemId)
    //   state.products.splice(ItemIndex, 1)
    // }
}
