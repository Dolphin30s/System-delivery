<template>
<div class="page-shop relative clearfix" id="page-shop">
    <vs-sidebar
        class="items-no-padding vs-sidebar-rounded background-absolute non-height"
        parent="#page-shop"
        :click-not-close="clickNotClose"
        :hidden-background="clickNotClose"
        v-model="isFilterSidebarActive">

        <div class="p-6 filter-container">

            <!-- MULTI RANGE -->
            <h6 class="font-bold mb-3">Multi Range</h6>
            <div>
                <ul>
                    <li
                        v-for="item in numericItems"
                        :key="item.value"
                        class="flex items-center cursor-pointer py-1"
                        @click="onChangeFilter('price', item.value)">

                        <feather-icon icon="CircleIcon" :svgClasses="[{ 'text-primary fill-current': isSelectPriceFilter(item.value)}, 'h-5 w-5']" />
                        <span class="ml-2" :class="{'text-primary': isSelectPriceFilter(item.value)}">{{ item.label }}</span>
                    </li>
                </ul>
            </div>

            <vs-divider />

            <!-- CATEGORIES -->
            <h6 class="font-bold mb-4">Category</h6>
            <div>
                <ul>
                    <li v-for="item in categories" :key="item.value" class="flex items-center cursor-pointer py-1" @click="onChangeFilter('category', item.value)">
                        <feather-icon icon="CircleIcon" :svgClasses="[{ 'text-primary fill-current': isSelectCategoryFilter(item.value)}, 'h-5 w-5']" />
                        <span class="ml-2" :class="{'text-primary': isSelectCategoryFilter(item.value)}">{{ item.label }}</span>
                    </li>
                </ul>
            </div>

            <vs-divider />

            <div class="flex justify-center">
                <vs-button class="w-full" @click.prevent="onResetFilter()" :disabled="searching">Remove Filters</vs-button>
            </div>
        </div>
    </vs-sidebar>

    <!-- RIGHT COL -->
    <div :class="{'sidebar-spacer-with-margin': clickNotClose}">

        <!-- SEARCH BAR -->
<!--        <div>-->
<!--            <div class="relative mb-8">-->

<!--                &lt;!&ndash; SEARCH INPUT &ndash;&gt;-->
<!--                <vs-input class="w-full vs-input-shadow-drop vs-input-no-border d-theme-input-dark-bg" placeholder="Search here" v-model="currentRefinement" @input="refine($event)" @keyup.esc="refine('')" size="large" />-->

<!--                &lt;!&ndash; SEARCH LOADING &ndash;&gt;-->
<!--                <p :hidden="!isSearchStalled" class="mt-4 text-grey">-->
<!--                    <feather-icon icon="ClockIcon" svgClasses="w-4 h-4" class="mr-2 align-middle" />-->
<!--                    <span>Loading...</span>-->
<!--                </p>-->

<!--                &lt;!&ndash; SEARCH ICON &ndash;&gt;-->
<!--                <div slot="submit-icon" class="absolute top-0 right-0 py-4 px-6" v-show="!currentRefinement">-->
<!--                    <feather-icon icon="SearchIcon" svgClasses="h-6 w-6" />-->
<!--                </div>-->

<!--                &lt;!&ndash; CLEAR INPUT ICON &ndash;&gt;-->
<!--                <div slot="reset-icon" class="absolute top-0 right-0 py-4 px-6" v-show="currentRefinement">-->
<!--                    <feather-icon icon="XIcon" svgClasses="h-6 w-6 cursor-pointer" @click="refine('')" />-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <!-- SEARCH RESULT -->

            <div>
                <!-- GRID VIEW -->
                <div class="items-grid-view vx-row match-height">
                    <div class="vx-col lg:w-1/3 sm:w-1/2 w-full" v-for="item in products" :key="item.id">
                        <item-grid-view :item="item">

                            <!-- SLOT: ACTION BUTTONS -->
                            <template slot="action-buttons">
                                <div class="flex flex-wrap">

                                    <!-- PRIMARY BUTTON: ADD TO WISH LIST -->
                                    <div
                                        class="item-view-primary-action-btn p-3 flex flex-grow items-center justify-center cursor-pointer"
                                        @click="toggleItemInWishList(item)">
                                        <feather-icon icon="HeartIcon" :svgClasses="[{'text-danger fill-current' : isInWishList(item.id)}, 'h-4 w-4']" />

                                        <span class="text-sm font-semibold ml-2">WISHLIST</span>
                                    </div>

                                    <!-- SECONDARY BUTTON: ADD-TO/VIEW-IN CART -->
                                    <div
                                        class="item-view-secondary-action-btn bg-primary p-3 flex flex-grow items-center justify-center text-white cursor-pointer"
                                        @click="cartButtonClicked(item)">
                                        <feather-icon icon="ShoppingBagIcon" svgClasses="h-4 w-4" />

                                        <span class="text-sm font-semibold ml-2" v-if="isInCart(item.id)">VIEW IN CART</span>
                                        <span class="text-sm font-semibold ml-2" v-else>ADD TO CART</span>
                                    </div>
                                </div>
                            </template>
                        </item-grid-view>
                    </div>
                </div>
            </div>


        <!-- PAGINATION -->

            <div>
                <vs-pagination
                    :total="nbPages"
                    :max="7"
                    v-model="currentPage"/>
            </div>
    </div>
</div>
</template>

<script>
export default {
    name: "ShopPage",
    components: {
        ItemGridView: () => import('./ItemGridView.vue'),
    },
    data(){
        return {
            isFilterSidebarActive: true,
            clickNotClose: true,
            searching: false,
            numericItems: [
                { label: 'All', value: 0},
                { label: '<= $10', value: 1, end: 10 },
                { label: '$10 - $100', value: 2, start: 10, end: 100 },
                { label: '$100 - $500', value: 3, start: 100, end: 500 },
                { label: '>= $500', value: 4, start: 500 }
            ],
            filter: {
                f_price: 0,
                f_category: []
            },
            nbPages: 10,
            currentPage: 1
        }
    },
    computed: {
        // GRID VIEW
        isInCart () {
            return (itemId) => this.$store.getters['eCommerce/isInCart'](itemId)
        },
        isInWishList () {
            return (itemId) => this.$store.getters['eCommerce/isInWishList'](itemId)
        },
        categories () {
            return this.$store.state.categories.map(c => ({ label: c.name, value: c.id}));
        },
        products () {
            return this.$store.getters.productList;
        }
    },
    methods: {
        isSelectPriceFilter: function (value) {
            return this.filter.f_price === value;
        },
        isSelectCategoryFilter: function (value) {
            return this.filter.f_category.includes(value);
        },
        onChangeFilter: function(attr, value){
            switch (attr){
                case 'price':
                    this.filter.f_price = value;
                    break;
                case 'category':
                    if(this.filter.f_category.includes(value)){
                        this.filter.f_category = this.filter.f_category.filter(c => c !== value);
                    } else {
                        this.filter.f_category.push(value);
                    }
                    break;
            }
        },
        onResetFilter: function (){
            this.filter = {
                f_price: 0,
                f_category: []
            }
        },
        onChangePage: function (value){
            console.log('page', value);
            this.currentPage = value;
        },
        toggleItemInWishList (item) {
            this.$store.dispatch('eCommerce/toggleItemInWishList', item)
        },
        addItemInCart (item) {
            this.$store.dispatch('eCommerce/addItemInCart', item)
        },
        cartButtonClicked (item) {
            this.isInCart(item.id) ? this.$router.push('/home/cart').catch(() => {}) : this.addItemInCart(item)
        }
    }
}
</script>

<style scoped>

</style>
