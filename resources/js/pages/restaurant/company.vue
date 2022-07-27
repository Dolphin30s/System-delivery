<template>
	<div class="restaurant-item vx-col w-full sm:w-1/2 lg:w-1/3 mb-base">
        <vx-card>
            <div slot="no-body">
                <img :src="restaurant.image_url" alt="content-img" class="responsive card-img-top">
            </div>
            <a :href="viewLink"><h5 class="mb-2">{{ restaurant.name }}</h5></a>
            <p class="text-grey">{{ restaurant.location }}</p>
            <p class="text-grey">{{ restaurant.description }}</p>
            <div class="flex justify-between flex-wrap">
                <vs-button class="mt-4 mr-2 shadow-lg" type="gradient" color="#7367F0" gradient-color-secondary="#CE9FFC" @click="editItem">{{ $t('edit')}}</vs-button>
                <vs-button class="mt-4" type="border" color="#b9b9b9" @click="deleteItem">{{ $t('delete')}}</vs-button>
            </div>
        </vx-card>
    </div>
</template>

<script>

import {showNotify} from "../../helper";

export default {
	name: 'CompanyCard',
    date(){
	    return{

        }
    },
	props: {
		restaurant: { type: Object, required: true },
	},
    computed: {
        canEdit: function(){
            //return this.company.owner_id === currentUser.id || store.isAdmin
            return true;
        },
        canDelete: function(){
            return true;
        },
        canAddProduct: function(){
            return true;
        },
	    editLink: function(){
	        return `/admin/restaurant/edit?id=${this.restaurant.id}`;
        },
        viewLink: function(){
            return `/admin/restaurant/view?id=${this.restaurant.id}`;
        },
    },
    methods: {
        editItem: function(){
            this.$router.replace(this.editLink);
        },
        deleteItem: function(){
            this.$vs.dialog({
                type: 'confirm',
                color: 'danger',
                title: `Delete Restaurant`,
                text: `Are you sure？`,
                accept: () => {
                    this.$store.dispatch('removeRestaurant', {id: this.restaurant.id}).catch(() => {
                        showNotify(this.$vs, 'Action Failed', '', false);
                    })
                },
                acceptText: 'Delete',
                cancelText: 'Cancel'
            });
        }
    }
};
</script>
