import Vue from 'vue'
import auth from './auth'

export default function isCustomer ({ to, from, next, next_middleware}){
    const user = Vue.auth.user();

    if(!Vue.auth.check()) {
        //console.log('auth Middleware go to login page');
        return next({
            name: 'login'
        })
    }

    if(user && ( user.role === 'admin' )){
        return next({
            name: 'admin'
        })
    }
    if(user && ( user.role === 'deliverer' )){
        return next({
            name: 'deliverer'
        })
    }
    if(!user || ( user.role !== 'customer' )){
        return next({
            name: 'error-404'
        })
    }

    return next_middleware()
}
