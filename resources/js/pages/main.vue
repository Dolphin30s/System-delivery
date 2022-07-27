<template>
    <div class="main">
        <div class="vx-row row-cards row-deck">
            <div class="vx-col lg:w-1/3 w-full" v-for="item in menuItems" :key="item.path">
                <div
                    class="card"
                    style="cursor: pointer"
                    @click="browseTo(item.path)"
                >
                    <div class="card-body p-4 text-center">
						<span
                            class="avatar avatar-xl mb-4"
                            :style="menuItemStyles(item)"
                        ></span>
                        <h3 class="mb-0">{{$t(item.label)}}</h3>
                        <p
                            class="text-muted"
                            v-if="item.sub_title"
                            v-i18n="item.sub_title"
                        ></p>
                    </div>
                    <div class="progress card-progress">
                        <div
                            class="progress-bar"
                            style="width: 100%"
                            role="progressbar"
                            aria-valuenow="100"
                            aria-valuemin="0"
                            aria-valuemax="100"
                        >
                            <span class="sr-only"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="vx-row row-cards row-deck">
            <div class="vx-col lg:w-1/3 w-full" v-for="stat in stats" :key="stat.label">
                <div class="card">
                    <div class="card-body p-2 text-center">
                        <div class="text-right text-red">
							<span
                                class="text-red d-inline-flex align-items-center lh-1"
                            ></span>
                        </div>
                        <div class="h1 m-0">{{ getSummary(stat.label) }}</div>
                        <div class="text-muted mb-4">{{$t(stat.label)}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MAIN_MENU_ITEMS_LIST from './dashboard';

export default {
    name: "main",
    data() {
        return {
            menuItems : MAIN_MENU_ITEMS_LIST.filter((item)=> item.show),
            stats: [
                {
                    label: 'restaurants'
                },
                {
                    label: 'items'
                },
                {
                    label: 'orders'
                },
            ]
        }
    },
    methods: {
        browseTo(path){
            this.$router.replace(path);
        },
        menuItemStyles(item) {
            return {
                backgroundImage: `url(${item.icon})`,
                backgroundPosition: 'center',
                backgroundSize: 'contain',
                backgroundColor: 'transparent',
                borderRadius: '0',
            };
        },
    },
    computed:{
        getSummary(){
            return (key) => {
                switch (key){
                    case 'restaurants':
                        return this.$store.state.restaurants.length;
                    case 'items':
                        return this.$store.getters.productList.length;
                    case 'orders':
                        return this.$store.getters.orderList.length;
                }
                return 0;
            }
        }
    }
}
</script>

<style scoped>
.avatar-xl {
    width: 6rem !important;
    height: 6rem !important;
    font-size: 3rem !important;
    line-height: 6rem !important;
}
.avatar {
    position: relative;
    width: 2rem;
    height: 2rem;
    font-size: .75rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 400;
    color: #6e7582;
    text-align: center;
    text-transform: uppercase;
    vertical-align: bottom;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background: #f1f3f8 no-repeat center/cover;
    border-radius: 50%;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(110,117,130,.2);
    border-radius: 3px;
}
.card {
    margin-bottom: 1.25rem;
    box-shadow: rgb(53 64 82 / 4%) 0 2px 4px 0;
}
.progress{
    height: 0.4rem !important;
}
.progress-bar {
    height: 100%;
}
</style>
