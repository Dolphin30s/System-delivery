<template>
    <div class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center" id="page-login">
        <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-2/5 sm:m-0 m-4">
            <vx-card>
                <div class="vx-row no-gutter justify-center items-center">

                    <div class="vx-col sm:w-full md:w-full lg:w-full d-theme-dark-bg">
                        <div class="px-8 pt-8 login-tabs-container">

                            <div class="text-center mb-4">
                                <span class="logo-title">LUTHORR LLC</span>
                            </div>

                            <vs-tabs>
                                <vs-tab :label="'Login'">
                                    <login-jwt></login-jwt>
                                </vs-tab>
                            </vs-tabs>
                        </div>
                    </div>
                </div>
            </vx-card>
        </div>
    </div>
</template>


<script>
import LoginJwt from './login/LoginJWT.vue'

export default {
    components: {
        LoginJwt,
    }
}
</script>

<style lang="scss">
.login-tabs-container {
    min-height: 505px;
    .logo-title{
        font-weight: bold;
        font-size: 36px;
    }

    .con-tab {
        padding-bottom: 14px;
    }

    .con-slot-tabs {
        margin-top: 1rem;
    }
}

// Card
.vx-card__title{
    background: #10163a;
    width: 100%;
    padding: 16px;
    border-radius: 8px;
    color: white;
}
</style>
