/*=========================================================================================
  File Name: moduleEcommerceMutations.js
  Description: Ecommerce Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

export default {
    SET_CART(state, items) {
        state.cartItems = items;
    },
    TOGGLE_ITEM_IN_WISH_LIST(state, item) {
        const index = state.wishList.findIndex(i => i.id === item.id)
        if (index < 0) {
            state.wishList.push(item)
        } else {
            state.wishList.splice(index, 1)
        }
    },
    REMOVE_ITEM_FROM_CART(state, item) {
        const index = state.cartItems.findIndex(i => i.id === item.id)
        if (index > -1) {
            state.cartItems.splice(index, 1)
        }
    },
    ADD_ITEM_IN_CART(state, item) {
        const addCartItem = {
            ...item,
            quantity: 1
        };
        state.cartItems.push(Object.assign({}, addCartItem));
    },
    UPDATE_ITEM_QUANTITY(state, payload) {
        state.cartItems[payload.index].quantity = payload.quantity
        state.cartItems = [...state.cartItems];
    },
    SET_ADDRESS(state, items){
        state.addresses = items;
    }
}

