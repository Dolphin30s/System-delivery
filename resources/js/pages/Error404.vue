<!-- =========================================================================================
    File Name: Error404.vue
    Description: 404 Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div class="h-screen flex w-full bg-img">
        <div class="vx-col flex items-center justify-center flex-col sm:w-1/2 md:w-3/5 lg:w-3/4 xl:w-1/2 mx-auto text-center">
            <img src="/assets/main/images/404.png" alt="graphic-404" class="mx-auto mb-4 max-w-full">
            <h1 class="sm:mx-0 mx-4 mb-12 text-5xl d-theme-heading-color">404 - Page Not Found。</h1>
            <vs-button size="large" :to="homeUrl">Back to Home</vs-button>
        </div>
    </div>
</template>
<script>
export default {
    name: "Error404",
    computed: {
        user(){
            return this.$store.getters['auth/user'];
        },
        homeUrl(){
            if(this.user.role === 'admin'){
                return '/admin';
            }
            if(this.user.role === 'deliverer'){
                return '/deliverer';
            }
            return '/home'
        }
    }
}

</script>
