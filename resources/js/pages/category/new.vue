<template>
<div class="add-category">
    <div class="vx-row justify-center">
        <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-2/5 sm:m-0 m-4">
            <vx-card title="New Category">
                <vs-input
                    label="Name"
                    v-validate="'required|min:3'"
                    data-vv-validate-on="blur"
                    name="name"
                    v-model="name"
                    class="w-full"/>
                <span class="text-danger text-sm">{{ errors.first('name') }}</span>

                <p class="vs-input--label mt-5">Short Description</p>
                <vs-textarea
                    v-validate="'required|min:3'"
                    v-model="short_description"
                    class="w-full"
                    name="short_description"
                    height="80px"
                />
                <span class="text-danger text-sm">{{ errors.first('short_description') }}</span>

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
    name: "NewCategory",
    components: {
        CsFileInput
    },
    data(){
        return {
            id: null,
            name: '',
            short_description: '',
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
                    short_description: this.short_description,
                    description: this.description
                };
                if(this.image){
                    params.file = this.image;
                }
                this.$store.dispatch('updateCategory', params).then(() => {
                    this.$router.replace('/admin/category/list');
                    showNotify(this.$vs, 'Action Success', '');
                }).catch(() => {
                    showNotify(this.$vs, 'Action Failed','',false);
                });
            } else {
                this.$store.dispatch('addCategory', {
                    name: this.name,
                    short_description: this.short_description,
                    description: this.description,
                    file: this.image
                }).then(() => {
                    this.$router.replace('/admin/category/list');
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
            this.$store.dispatch('fetchCategory', {id: this.id})
                .then((category) => {
                    if(category){
                        this.name = category.name;
                        this.short_description = category.short_description;
                        this.description = category.description;
                        this.image_url = category.image_url;
                    }
                });
        }
    }
}
</script>

<style scoped>

</style>
