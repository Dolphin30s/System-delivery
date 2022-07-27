import bearer from "@websanova/vue-auth/drivers/auth/bearer";
import axios from "@websanova/vue-auth/drivers/http/axios.1.x";
import router from '@websanova/vue-auth/drivers/router/vue-router.2.x'

const config = {
    auth: bearer,
    http: axios,
    router: router,
    tokenDefaultKey: 'token',
    //tokenStore: ['localStorage', 'cookie'],
    authRedirect: {path : '/login'},
    forbiddenRedirect:{path: '/error-403'},
    notFoundRedirect :{path: '/home'},
    redirect: '/home',
    // API endpoints used in Vue Auth
    registerData: {
        url: 'auth/register',
        method: 'POST',
        redirect: '/login'
    },
    loginData: {
        url: 'auth/login',
        method: 'POST',
        redirect: '/home',
        fetchUser: true
    },
    logoutData: {
        url: 'auth/logout',
        method: 'POST',
        redirect: '/login',
        makeRequest: true
    },
    fetchData: {
        url: 'auth/me',
        method: 'GET',
        enabled: true
    },
    refreshData: {
        url: 'auth/refresh',
        method: 'GET',
        enabled: true,
        interval: 30
    }
}

export default config
