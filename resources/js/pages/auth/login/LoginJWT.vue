<template>
    <div>
        <vs-input
            ref="input_email"
            v-validate="'required|email|min:3'"
            data-vv-validate-on="blur"
            name="email"
            icon-no-border
            icon="icon icon-user"
            icon-pack="feather"
            label-placeholder="Email"
            v-model="email"
            v-if="withEmail"
            v-on:keyup="inputKey"
            class="w-full"/>
        <span class="text-danger text-sm">{{ errors.first('email') }}</span>

        <vue-tel-input v-model="phone" defaultCountry="US" @validate="this.onValidPhone"></vue-tel-input>
        <span class="text-danger text-sm">{{ invalidPhone ? 'PhoneNumber is invalid' : '' }}</span>

        <vs-input
            ref="input_pwd"
            data-vv-validate-on="blur"
            v-validate="'required|min:6|max:32'"
            type="password"
            name="password"
            icon-no-border
            icon="icon icon-lock"
            icon-pack="feather"
            placeholder="Password"
            v-model="password"
            v-on:keyup="inputKey"
            class="w-full mt-6"/>
        <span class="text-danger text-sm">{{ errors.first('password') }}</span>

        <div class="flex flex-wrap justify-between mt-2">
            <vs-checkbox v-model="checkbox_remember_me" class="mb-3">{{ 'Remember Me' }}</vs-checkbox>
            <!--            <router-link to="/forgot-password">Forgot Password?</router-link>-->
        </div>
        <div class="flex flex-wrap justify-between mb-3 text-center">
            <vs-button :disabled="!validateForm" @click="loginJWT" class="w-full">{{ 'Login' }}</vs-button>
            <router-link class="mt-4 link-label" to="/register">Create New Account</router-link>
        </div>
    </div>
</template>

<script>
import {VueTelInput} from 'vue-tel-input';

export default {
    data() {
        return {
            email: '',
            phone: '',
            password: '',
            invalidPhone: false,
            checkbox_remember_me: false,
        }
    },
    components: {
        VueTelInput
    },
    props: {
        withEmail: {
            type: Boolean,
            default: false,
        },
    },
    computed: {
        validateForm() {
            return !this.errors.any() && this.phone !== '' && this.password !== '' && (!this.withEmail || this.email !== '')
        }
    },
    methods: {
        onValidPhone(object) {
            this.invalidPhone = !object.valid;
        },
        checkLogin() {
            // If user is already logged in notify
            if (this.$store.state.auth.check()) {

                // Close animation if passed as payload
                // this.$vs.loading.close()

                this.$vs.notify({
                    time: 5000,
                    title: 'Login',
                    text: 'You are already logged in',
                    iconPack: 'feather',
                    icon: 'icon-alert-circle',
                    color: 'warning',
                    position: 'top-right'
                })

                return false
            }
            return true
        },
        loginJWT() {

            if (!this.checkLogin()) return

            // Loading
            this.$vs.loading()

            const body = this.withEmail ? {
                email: this.email,
                phone: this.phone,
                password: this.password
            } : {
                phone: this.phone,
                password: this.password
            };

            const payload = {
                remember: this.checkbox_remember_me,
                staySignedIn: true,
                body
            }

            this.$store.dispatch('auth/login', payload)
                .then((res) => {
                    //console.log('res', res);
                    this.$vs.loading.close();
                })
                .catch(error => {
                    this.$vs.loading.close()
                    this.$vs.notify({
                        time: 5000,
                        title: 'Error',
                        text: 'Login Failed',
                        iconPack: 'feather',
                        icon: 'icon-alert-circle',
                        color: 'danger',
                        position: 'top-right'
                    })
                })
        },
        registerUser() {
            if (!this.checkLogin()) return
            this.$router.push('/register').catch(() => {
            })
        },
        inputKey: function (event) {
            if (event.keyCode === 13) {
                if (this.withEmail && !this.email.trim().length) {
                    this.$refs.input_email.focusInput();
                    return;
                }
                if (!this.phone.trim().length) {
                }
                if (!this.password.trim().length) {
                    this.$refs.input_pwd.focusInput();
                    return;
                }
                this.loginJWT();
            }
        }
    }
}
</script>

<style lang="scss">
.vue-tel-input {
    .vti__input {
        padding: 0.7rem 1rem 0.7rem 0.4rem !important;
    }
}
.link-label{
    margin: 0 auto;
    font-size: 1.1rem;
}
</style>

