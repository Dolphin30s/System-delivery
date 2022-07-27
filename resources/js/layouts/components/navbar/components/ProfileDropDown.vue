<template>
    <div class="the-navbar__user-meta flex items-center ml-4" v-if="user.name">

        <div class="text-right leading-tight hidden sm:block">
            <p class="font-semibold">{{ user.name }}</p>
            <small>Available</small>
        </div>

        <vs-dropdown vs-custom-content vs-trigger-click class="cursor-pointer">

            <div class="con-img mx-3">
                <img key="onlineImg" :src="user_image_url" alt="user-img" width="40" height="40"
                     class="rounded-full shadow-md cursor-pointer block"/>
            </div>

            <vs-dropdown-menu class="vx-navbar-dropdown">
                <ul style="min-width: 9rem">

                    <li
                        class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white"
                        @click="$router.push('/home/profile').catch(() => {})">
                        <feather-icon icon="UserIcon" svgClasses="w-4 h-4"/>
                        <span class="ml-2">Profile</span>
                    </li>

                    <!--          <li-->
                    <!--            class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white"-->
                    <!--            @click="$router.push('/apps/email').catch(() => {})">-->
                    <!--            <feather-icon icon="MailIcon" svgClasses="w-4 h-4" />-->
                    <!--            <span class="ml-2">Inbox</span>-->
                    <!--          </li>-->

                    <!--          <li-->
                    <!--            class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white"-->
                    <!--            @click="$router.push('/apps/todo').catch(() => {})">-->
                    <!--            <feather-icon icon="CheckSquareIcon" svgClasses="w-4 h-4" />-->
                    <!--            <span class="ml-2">Tasks</span>-->
                    <!--          </li>-->

                    <!--          <li-->
                    <!--            class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white"-->
                    <!--            @click="$router.push('/apps/chat').catch(() => {})">-->
                    <!--            <feather-icon icon="MessageSquareIcon" svgClasses="w-4 h-4" />-->
                    <!--            <span class="ml-2">Chat</span>-->
                    <!--          </li>-->

                    <!--          <li-->
                    <!--            class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white"-->
                    <!--            @click="$router.push('/shop/wish-list').catch(() => {})">-->
                    <!--            <feather-icon icon="HeartIcon" svgClasses="w-4 h-4" />-->
                    <!--            <span class="ml-2">Wish List</span>-->
                    <!--          </li>-->

                    <vs-divider class="m-1"/>

                    <li
                        class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white"
                        @click="logout">
                        <feather-icon icon="LogOutIcon" svgClasses="w-4 h-4"/>
                        <span class="ml-2">Logout</span>
                    </li>
                </ul>
            </vs-dropdown-menu>
        </vs-dropdown>
    </div>
</template>

<script>

import Vue from "vue";

export default {
    data() {
        return {}
    },
    computed: {
        user() {
            return Vue.auth.user();
        },
        user_image_url() {
            if (this.user.image_url) {
                return this.user.image_url;
            }
            if (this.user.gender && this.user.gender === 'Female') {
                return '/assets/main/images/user-female.png';
            }
            return '/assets/main/images/user-male.png';
        },
    },
    methods: {
        logout() {

            // if user is logged in via auth0
            //if (this.$auth.profile) this.$auth.logout()
            this.$auth.logout();

            // If JWT login
            if (localStorage.getItem('token')) {
                localStorage.removeItem('token');
                this.$router.push('/login').catch(() => {
                })
            }

            // Change role on logout. Same value as initialRole of acj.js
            //this.$acl.change('admin')
            localStorage.removeItem('userInfo');

            // This is just for demo Purpose. If user clicks on logout -> redirect
            this.$router.push('/login').catch(() => {
            })
        }
    }
}
</script>
