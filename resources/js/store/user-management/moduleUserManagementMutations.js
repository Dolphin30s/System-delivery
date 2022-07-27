/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default {
    SET_USERS(state, users) {
        state.users = users
    },
    UPDATE_USER(state, params) {
        state.users = state.users.map(u => {
            if(u.id === params.id){
                return {
                    ...u,
                    ...params
                }
            }
            return u;
        })
    },
    REMOVE_USER(state, params) {
        const userIndex = state.users.findIndex((u) => u.id === params.id)
        state.users.splice(userIndex, 1)
    }
}
