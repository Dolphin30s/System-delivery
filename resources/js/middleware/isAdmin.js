import Vue from 'vue'
import auth from './auth'

export default function isAdmin ({ to, from, next, next_middleware}){
    const user = Vue.auth.user();
    //console.log('subscibe Middleware go to subscribe page', user);
    if(user && ( user.role !== 'admin' )){
        return next({
            name: 'error-404'
        })
    }

    return next_middleware()
}
