<!-- =========================================================================================
File Name: RegisterJWT.vue
Description: Register Page for JWT
----------------------------------------------------------------------------------------
Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div class="clearfix">
        <vs-input
            v-validate="'required|alpha_dash|min:3'"
            data-vv-validate-on="blur"
            label-placeholder="Name"
            name="displayName"
            placeholder="Name"
            v-model="displayName"
            class="w-full"/>
        <span class="text-danger text-sm">{{ errors.first('displayName') }}</span>

        <vue-tel-input defaultCountry="US" v-model="phone" @validate="this.onValidPhone"></vue-tel-input>
        <span class="text-danger text-sm">{{ invalidPhone ? 'PhoneNumber is invalid' : '' }}</span>

        <vs-input
            v-validate="'required|email'"
            data-vv-validate-on="blur"
            name="email"
            type="email"
            label-placeholder="Email"
            placeholder="Email"
            v-model="email"
            v-if="withEmail"
            class="w-full mt-6"/>
        <span class="text-danger text-sm">{{ errors.first('email') }}</span>

        <vs-input
            ref="password"
            type="password"
            data-vv-validate-on="blur"
            v-validate="'required|min:6|max:10'"
            name="password"
            label-placeholder="Password"
            placeholder="Password"
            v-model="password"
            class="w-full mt-6"/>
        <span class="text-danger text-sm">{{ errors.first('password') }}</span>

        <vs-input
            type="password"
            v-validate="'min:6|max:10|confirmed:password'"
            data-vv-validate-on="blur"
            data-vv-as="password"
            name="confirm_password"
            label-placeholder="Confirm Password"
            placeholder="Confirm Password"
            v-model="confirm_password"
            class="w-full mt-6"/>
        <span class="text-danger text-sm">{{ errors.first('confirm_password') }}</span>

        <div class="text-sm mt-1 color-gray">Birthday</div>
        <div class="w-full">
            <datepicker format="yyyy-MM-dd" v-model="birthday" class="date-time--input" @selected="selectToDate($event)"></datepicker>
        </div>

        <div class="text-sm mt-1 color-gray">Gender</div>
        <div class="w-full justify-around">
            <vs-radio v-model="gender" vs-name="gender" vs-value='Male'>Male</vs-radio>
            <vs-radio v-model="gender" vs-name="gender" vs-value='Female'>Female</vs-radio>
        </div>

        <div class="flex flex-wrap justify-between mt-2">
            <vs-checkbox v-model="isTermsConditionAccepted" class="mb-3">I accept the terms & conditions.</vs-checkbox>
        </div>

        <div class="flex flex-wrap justify-between mb-3 text-center">
            <vs-button class="w-full" @click="registerUserJWt" :disabled="!validateForm">Register</vs-button>
            <router-link to="/login" class="mt-4 link-label">Already Has Account</router-link>
        </div>
    </div>
</template>

<script>
import {VueTelInput} from 'vue-tel-input';
import Datepicker from 'vuejs-datepicker';
import {date_str_format, showNotify} from "../../../helper";

export default {
    data() {
        return {
            displayName: '',
            email: '',
            phone: '',
            cc2: '',
            password: '',
            confirm_password: '',
            birthday: new Date(),
            gender: 'Male',
            invalidPhone: false,
            isTermsConditionAccepted: false
        }
    },
    components: {
        VueTelInput,
        Datepicker
    },
    computed: {
        validateForm() {
            return !this.errors.any() && this.displayName !== '' && (!this.withEmail || this.email !== '') && this.password !== '' && this.confirm_password !== '' && this.isTermsConditionAccepted === true
        }
    },
    props: {
        withEmail: {
            type: Boolean,
            default: false,
        },
    },
    methods: {
        onValidPhone(object) {
            console.log('valid', object)
            this.invalidPhone = !object.valid;
            this.cc2 = object.countryCode??'';
        },
        selectToDate(value){
            this.birthday=value;
        },
        checkLogin() {
            // If user is already logged in notify
            if (this.$store.state.auth.check()) {

                // Close animation if passed as payload
                // this.$vs.loading.close()

                this.$vs.notify({
                    time: 5000,
                    title: 'Login',
                    text: 'You are already logged in!',
                    iconPack: 'feather',
                    icon: 'icon-alert-circle',
                    color: 'warning',
                    position: 'top-right'
                })

                return false
            }
            return true
        },
        registerUserJWt() {
            // If form is not validated or user is already login return
            if (!this.validateForm || !this.checkLogin()) return

            const payload = {
                body: {
                    name: this.displayName,
                    email: this.email,
                    phone: this.phone,
                    password: this.password,
                    confirmPassword: this.confirm_password,
                    birthday: date_str_format(this.birthday, 'yy-mm-dd'),
                    cc2: this.cc2,
                    gender: this.gender
                },
                autoLogin: true
            }
            this.$store.dispatch('auth/register', payload)
                .then(() => { showNotify(this.$vs, 'Action Success', ''); })
                .catch(err => { showNotify(this.$vs, 'Action Failed','',false); })
        }
    }
}
</script>

<style lang="scss">
.vue-tel-input {
    margin-top: 1.5rem;
    .vti__input {
        padding: 0.7rem 1rem 0.7rem 0.4rem !important;
    }
}
.link-label{
    margin: 0 auto;
    font-size: 1.1rem;
}
</style>
