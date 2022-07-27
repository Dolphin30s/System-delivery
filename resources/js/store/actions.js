import apiCall from "../apiCall";
const actions = {

    // /////////////////////////////////////////////
    // COMPONENTS
    // /////////////////////////////////////////////

    // Vertical NavMenu
    updateVerticalNavMenuWidth({ commit }, width) {
        commit('UPDATE_VERTICAL_NAV_MENU_WIDTH', width)
    },

    // The Navbar
    arrangeStarredPagesLimited ({ commit }, list) {
        commit('ARRANGE_STARRED_PAGES_LIMITED', list)
    },
    arrangeStarredPagesMore ({ commit }, list) {
        commit('ARRANGE_STARRED_PAGES_MORE', list)
    },

    // /////////////////////////////////////////////
    // UI
    // /////////////////////////////////////////////

    toggleContentOverlay ({ commit }) {
        commit('TOGGLE_CONTENT_OVERLAY')
    },

    // /////////////////////////////////////////////
    // User/Account
    // /////////////////////////////////////////////

    updateUserInfo ({ commit }, payload) {
        commit('UPDATE_USER_INFO', payload)
    },
    updateUserRole ({ dispatch }, payload) {
        // Change client side
        payload.aclChangeRole(payload.userRole)

        // Make API call to server for changing role

        // Change userInfo in localStorage and store
        dispatch('updateUserInfo', {userRole: payload.userRole})
    },

    // /////////////////////////////////////////////
    // Category
    // /////////////////////////////////////////////
    fetchCategories({commit}){
        return new Promise((resolve, reject) => {
            apiCall.getCall(
                'category/list',
                {},
                (response) => {
                    commit('SET_CATEGORIES', response)
                    resolve(response)
                },
                () => {
                    reject('API Call Failed');
                });
        })
    },
    fetchCategory({commit}, params){
        return new Promise((resolve, reject) => {
            apiCall.getCall(
                'category/index',
                { params },
                (response) => {
                    resolve(response)
                },
                () => {
                    reject('API Call Failed');
                });
        })
    },
    addCategory({commit}, params){
        return new Promise((resolve, reject) => {
            apiCall.uploadCall('category/add',
                params,
                (response) => {
                    resolve();
                },
                () => { reject('API Call Failed'); }
            )
        })
    },
    updateCategory({commit}, params){
        return new Promise((resolve, reject) => {
            apiCall.uploadCall('category/update',
                params,
                (response) => {
                    resolve();
                },
                () => { reject('API Call Failed'); }
            )
        })
    },
    removeCategory({commit, dispatch}, params){
        return new Promise((resolve, reject) => {
            apiCall.postCall('category/remove',
                params,
                (response) => {
                    dispatch('fetchCategories');
                    resolve();
                },
                () => { reject('API Call Failed'); }
            )
        })
    },


    // /////////////////////////////////////////////
    // Restaurant
    // /////////////////////////////////////////////
    fetchRestaurants({commit}){
        return new Promise((resolve, reject) => {
            apiCall.getCall(
                'restaurant/list',
                {},
                (response) => {
                    commit('SET_RESTAURANTS', response)
                    resolve(response)
                },
                () => {
                    reject('API Call Failed');
                });
        })
    },
    fetchRestaurant({commit}, params){
        return new Promise((resolve, reject) => {
            apiCall.getCall(
                'restaurant/index',
                { params },
                (response) => {
                    resolve(response)
                },
                () => {
                    reject('API Call Failed');
                });
        })
    },
    addRestaurant({commit}, params){
        return new Promise((resolve, reject) => {
            apiCall.uploadCall('restaurant/add',
                params,
                (response) => {
                    resolve();
                },
                () => { reject('API Call Failed'); }
            )
        })
    },
    updateRestaurant({commit}, params){
        return new Promise((resolve, reject) => {
            apiCall.uploadCall('restaurant/update',
                params,
                (response) => {
                    resolve();
                },
                () => { reject('API Call Failed'); }
            )
        })
    },
    removeRestaurant({commit, dispatch}, params){
        return new Promise((resolve, reject) => {
            apiCall.postCall('restaurant/remove',
                params,
                (response) => {
                    dispatch('fetchRestaurants');
                    resolve();
                },
                () => { reject('API Call Failed'); }
            )
        })
    },

    getAddressFromCoordinate({commit}, params){
        return new Promise((resolve, reject) => {
            apiCall.postCall('address/getAddress',
                params,
                (response) => {
                    resolve(response);
                },
                () => { reject('API Call Failed'); }
            )
        })
    }
};

export default actions;
