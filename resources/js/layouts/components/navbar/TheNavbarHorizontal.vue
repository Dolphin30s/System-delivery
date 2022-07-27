<!-- =========================================================================================
  File Name: TheNavbar.vue
  Description: Navbar component
  Component Name: TheNavbar
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div class="relative">
        <div class="vx-navbar-wrapper navbar-full p-0">
            <vs-navbar class="navbar-custom navbar-skelton" :class="navbarClasses" :style="navbarStyle"
                       :color="navbarColor">

                <!--      <bookmarks :navbarColor="navbarColor" v-if="windowWidth >= 992" />-->

                <div @click="gotoHome" class="vx-logo cursor-pointer px-4">
                    <span class="logo-title">Luthorr</span>
                </div>

                <h-nav-menu
                    :class="[
                      {'text-white' : isNavbarDark  && !isThemedark},
                      {'text-base'  : !isNavbarDark && isThemedark}
                    ]"
                    :navMenuItems="navMenuItems"/>
                <!--      <i18n />-->

                <!--      <search-bar />-->

                <cart-drop-down/>

                <!--      <notification-drop-down />-->

                <profile-drop-down/>

            </vs-navbar>
        </div>
    </div>
</template>

<script>
import I18n from './components/I18n.vue'
import CartDropDown from './components/CartDropDown.vue'
import NotificationDropDown from './components/NotificationDropDown.vue'
import ProfileDropDown from './components/ProfileDropDown.vue'
import Logo from '../Logo.vue'
import HNavMenu from '@/layouts/components/horizontal-nav-menu/HorizontalNavMenu.vue'

export default {
    name: 'the-navbar-horizontal',
    props: {
        logo: {type: String},
        navbarType: {
            type: String,
            required: true
        },
        navMenuItems: {type: Array, required: true}
    },
    components: {
        Logo,
        I18n,
        CartDropDown,
        NotificationDropDown,
        ProfileDropDown,
        HNavMenu
    },
    computed: {
        navbarColor() {
            let color = '#fff'
            if (this.navbarType === 'sticky') color = '#f7f7f7'
            else if (this.navbarType === 'static') {
                if (this.scrollY < 50) {
                    color = '#f7f7f7'
                }
            }

            if (this.isThemedark === 'dark') {
                if (color === '#fff') {
                    color = '#10163a'
                } else {
                    color = '#262c49'
                }
            }

            return color
        },
        isThemedark() {
            return this.$store.state.theme
        },
        isNavbarDark(){
            return false;
        },
        navbarStyle() {
            return this.navbarType === 'static' ? {transition: 'all .25s ease-in-out'} : {}
        },
        navbarClasses() {
            return this.scrollY > 5 && this.navbarType === 'static' ? null : 'd-theme-dark-light-bg shadow-none'
        },
        scrollY() {
            return this.$store.state.scrollY
        },
        verticalNavMenuWidth() {
            return this.$store.state.verticalNavMenuWidth
        },
        windowWidth() {
            return this.$store.state.windowWidth
        }
    },
    methods: {
        gotoHome(){
            document.location = '/';
        }
    }
}

</script>

<style lang="scss">
.logo-title{
    font-weight: bold;
    font-size: 36px;
    margin-right: 20px;
    color: #0067f4;
}
</style>
