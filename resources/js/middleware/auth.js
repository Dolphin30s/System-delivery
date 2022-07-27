import Vue from 'vue'

export default function auth ({ to, from, next, next_middleware}){
    if(!Vue.auth.check()){
        //console.log('auth Middleware go to login page');
        return next({
            name: 'login'
        })
    }
    return next_middleware()
}
