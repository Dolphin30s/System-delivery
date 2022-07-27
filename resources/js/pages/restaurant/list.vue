<template>
<div class="restaurants">
    <!-- ADD NEW -->
    <div class="flex flex-wrap-reverse items-center data-list-btn-container mb-6">
        <div
            class="btn-add-new p-3 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary"
            @click="addNewData">
            <feather-icon icon="PlusIcon" svgClasses="h-4 w-4"/>
            <span class="ml-2 text-base text-primary">Add New</span>
        </div>
    </div>

    <cs-loader v-if="loading && !allItems.length" :full="true" />

    <vs-alert v-if="!allItems.length" color="danger" :title="$t('company.list')" active="true">
        {{ $t('company.list_empty') }}
    </vs-alert>

    <div v-else class="vx-row">
        <CompanyCard :key="item.id" :restaurant="item" v-for="item in allItems"/>
    </div>
</div>
</template>

<script>
import CsLoader from '@/components/CsLoader.vue';
import CompanyCard from './company.vue';

export default {
    name: "Restaurants",
    data(){
        return {
            loading: false
        }
    },
    components:{
        CsLoader,
        CompanyCard
    },
    computed: {
        allItems: function(){
            return this.$store.state.restaurants??[];
        },
    },
    methods: {
        addNewData() {
            this.$router.replace('/admin/restaurant/add');
        },
    },
    created() {
        this.$store.dispatch('fetchRestaurants');
    }
}
</script>

<style scoped>

</style>
