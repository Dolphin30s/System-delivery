<template>
    <div class="add-company">
        <div class="vx-row justify-center">
            <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-2/5 sm:m-0 m-4">
                <vx-card title="New Shop">
                    <vs-input
                        label="Name"
                        v-validate="'required|min:3'"
                        data-vv-validate-on="blur"
                        name="name"
                        v-model="name"
                        class="w-full"/>
                    <span class="text-danger text-sm">{{ errors.first('name') }}</span>

                    <vs-input
                        label="Location"
                        v-validate="'required|min:3'"
                        v-model="location"
                        class="w-full mt-3"
                        name="location"
                        height="80px"
                    />
                    <span class="text-danger text-sm">{{ errors.first('location') }}</span>

                    <p class="vs-input--label mt-5">Description</p>
                    <vs-textarea
                        v-validate="'required|min:3'"
                        v-model="description"
                        class="w-full"
                        name="description"
                        height="200px"
                    />
                    <span class="text-danger text-sm">{{ errors.first('description') }}</span>

                    <cs-file-input
                        :default_url="image_url"
                        label="Choose an image"
                        @onChange="this.onChangeFile"
                    ></cs-file-input>

                    <div class="flex flex-wrap justify-between w-full mt-6 text-center">
                        <vs-button class="w-full" @click="onSubmit" :disabled="!validateForm">{{ this.id?'Update':'Add' }}</vs-button>
                    </div>
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>
import CsFileInput from "@/components/FileInput";
import {showNotify} from "../../helper";

export default {
    name: "NewRestaurant",
    components: {
        CsFileInput
    },
    data() {
        return {
            id: null,
            name: '',
            location: '',
            description: '',
            image: null,
            image_url: null,
        }
    },
    computed: {
        validateForm: function () {
            return !this.errors.any();
        }
    },
    methods: {
        onChangeFile: function ({ file }) {
            this.image = file;
        },
        onSubmit: function () {
            if(this.id){
                let params = {
                    id: this.id,
                    name: this.name,
                    location: this.location,
                    description: this.description
                };
                if(this.image){
                    params.file = this.image;
                }
                this.$store.dispatch('updateRestaurant', params).then(() => {
                    this.$router.replace('/admin/restaurant/list');
                    showNotify(this.$vs, 'Action Success', '');
                }).catch(() => {
                    showNotify(this.$vs, 'Action Failed','',false);
                });
            } else {
                this.$store.dispatch('addRestaurant', {
                    name: this.name,
                    location: this.location,
                    description: this.description,
                    file: this.image
                }).then(() => {
                    this.$router.replace('/admin/restaurant/list');
                    showNotify(this.$vs, 'Action Success', '');
                }).catch(() => {
                    showNotify(this.$vs, 'Action Failed','',false);
                });
            }
        }
    },
    created() {
        const id = this.$route.query.id;
        if(id){
            this.id = id;
        }
    },
    mounted() {
        if(this.id){
            this.$store.dispatch('fetchRestaurant', {id: this.id})
                .then((restaurant) => {
                    if(restaurant){
                        this.name = restaurant.name;
                        this.location = restaurant.location;
                        this.description = restaurant.description;
                        this.image_url = restaurant.image_url;
                    }
                });
        }
    }
}
</script>

<style scoped>

</style>
