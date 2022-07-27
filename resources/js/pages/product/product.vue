<!-- =========================================================================================
  File Name: AddNewDataSidebar.vue
  Description: Add New Data - Sidebar component
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div class="page-product">
        <div class="vx-row justify-center">
            <div class="vx-col sm:w-2/3 md:w-2/3 lg:w-2/3 xl:w-3/5 sm:m-0 m-4">

                <div class="mt-6 flex items-center justify-between px-6">
                    <h4>{{ !this.dataId ? "ADD NEW" : "UPDATE" }} ITEM</h4>
                </div>
                <vs-divider class="mb-0"></vs-divider>

                <component :is="scrollbarTag" class="scroll-area--data-list-add-new" :settings="settings" :key="$vs.rtl">

                    <div class="p-6">

                        <!-- Product Image -->
                        <template v-if="image_url">

                            <!-- Image Container -->
                            <div class="img-container w-64 mx-auto flex items-center justify-center">
                                <img :src="image_url" alt="img" class="responsive">
                            </div>

                            <!-- Image upload Buttons -->
                            <div class="modify-img flex justify-between mt-5">
                                <input type="file" class="hidden" ref="updateImgInput" @change="updateCurrImg" accept="image/*">
                                <vs-button class="mr-4" type="flat" @click="$refs.updateImgInput.click()">Update Image</vs-button>
                                <vs-button type="flat" color="#999" @click="dataImg = null">Remove Image</vs-button>
                            </div>
                        </template>

                        <!-- NAME -->
                        <vs-input label="Name" v-model="dataName" class="mt-5 w-full" name="item-name" v-validate="'required'" />
                        <span class="text-danger text-sm" v-show="errors.has('item-name')">{{ errors.first('item-name') }}</span>

                        <!-- Sku -->
                        <vs-input label="Sku" v-model="dataSku" class="mt-5 w-full" name="item-sku" v-validate="'required'" />
                        <span class="text-danger text-sm" v-show="errors.has('item-sku')">{{ errors.first('item-sku') }}</span>

                        <!-- Description -->
                        <p class="vs-input--label mt-5">Description</p>
                        <vs-textarea
                            v-validate="'required|min:3'"
                            v-model="dataDescription"
                            class="w-full"
                            name="item-description"
                            height="200px"
                        />
                        <span class="text-danger text-sm" v-show="errors.has('item-description')">{{ errors.first('item-description') }}</span>

                        <!-- CATEGORY -->
                        <vs-select v-model="dataCategory" label="Category" class="mt-5 w-full" name="item-category" v-validate="'required'">
                            <vs-select-item :key="item.value" :value="item.value" :text="item.text" v-for="item in category_choices" />
                        </vs-select>
                        <span class="text-danger text-sm" v-show="errors.has('item-category')">{{ errors.first('item-category') }}</span>

                        <!-- RESTAURANT -->
                        <vs-select v-model="dataRestaurant" label="Restaurant" class="mt-5 w-full" name="item-restaurant" v-validate="'required'">
                            <vs-select-item :key="item.value" :value="item.value" :text="item.text" v-for="item in restaurant_choices" />
                        </vs-select>
                        <span class="text-danger text-sm" v-show="errors.has('item-restaurant')">{{ errors.first('item-restaurant') }}</span>

                        <!-- PRICE -->
                        <vs-input
                            icon-pack="feather"
                            icon="icon-dollar-sign"
                            label="Price"
                            v-model="dataPrice"
                            class="mt-5 w-full"
                            v-validate="{ required: true, regex: /\d+(\.\d+)?$/ }"
                            name="item-price" />
                        <span class="text-danger text-sm" v-show="errors.has('item-price')">{{ errors.first('item-price') }}</span>

                        <!-- PRICE -->
                        <vs-input
                            label="Stock"
                            v-model="dataStock"
                            class="mt-5 w-full"
                            v-validate="{ regex: /\d+/ }"
                            name="item-stock" />
                        <span class="text-danger text-sm" v-show="errors.has('item-stock')">{{ errors.first('item-stock') }}</span>

                        <!-- Upload -->
                        <!-- <vs-upload text="Upload Image" class="img-upload" ref="fileUpload" /> -->

                        <div class="upload-img mt-5" v-if="!dataImg">
                            <input type="file" class="hidden" ref="uploadImgInput" @change="updateCurrImg" accept="image/*">
                            <vs-button class="w-full" @click="$refs.uploadImgInput.click()">Upload Image</vs-button>
                        </div>
                    </div>
                </component>

                <div class="flex flex-wrap items-center p-6" slot="footer">
                    <vs-button class="mr-6" @click="submitData" :disabled="!isFormValid">Submit</vs-button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import {showNotify} from "../../helper";

export default {
    name: 'ProductData',
    components: {
        VuePerfectScrollbar
    },
    data () {
        return {
            dataId: null,
            dataName: '',
            dataSku: '',
            dataDescription: '',
            dataRestaurant: null,
            dataCategory: null,
            image_url: null,
            dataImg: null,
            dataPrice: 0,
            dataStock: 0,

            settings: { // perfectscrollbar settings
                maxScrollbarLength: 60,
                wheelSpeed: .60
            }
        }
    },
    watch: {

    },
    computed: {
        isFormValid () {
            return !this.errors.any() && this.dataName && this.dataCategory && this.dataPrice > 0
        },
        scrollbarTag () { return this.$store.getters.scrollbarTag },
        restaurant_choices() {
            return this.$store.state.restaurants.map(c => ({ value: c.id, text: c.name }));
        },
        category_choices() {
            return this.$store.state.categories.map(c => ({ value: c.id, text: c.name }));
        }
    },
    methods: {
        initValues () {
            if (this.dataId) return
            this.dataId = null
            this.dataName = ''
            this.dataSku=''
            this.dataDescription = ''
            this.dataRestaurant = null
            this.dataCategory = null
            this.dataPrice = 0
            this.dataStock = 0
            this.dataImg = null;
            this.image_url = null;
        },
        submitData () {
            this.$validator.validateAll().then(result => {
                if (result) {
                    const obj = {
                        id: this.dataId,
                        title: this.dataName,
                        sku: this.dataSku,
                        restaurant_id: this.dataRestaurant,
                        category_id: this.dataCategory,
                        price: this.dataPrice,
                        stock: this.dataStock,
                        description: this.dataDescription,
                        file: this.dataImg
                    }

                    if (this.dataId !== null && this.dataId >= 0) {
                        this.$store.dispatch('productList/updateItem', obj)
                            .then(() => { showNotify(this.$vs, 'Action Success', ''); this.initValues(); })
                            .catch(err => { showNotify(this.$vs, 'Action Failed','',false); })
                    } else {
                        delete obj.id
                        obj.popularity = 0
                        this.$store.dispatch('productList/addItem', obj)
                            .then(() => { showNotify(this.$vs, 'Action Success', ''); this.initValues(); })
                            .catch(() => { showNotify(this.$vs, 'Action Failed','',false); })
                    }
                }
            })
        },
        updateCurrImg (input) {
            if (input.target.files && input.target.files[0]) {
                const reader = new FileReader()
                reader.onload = e => {
                    this.image_url = e.target.result
                }
                reader.readAsDataURL(input.target.files[0]);
                this.dataImg = input.target.files[0];
            }
        }
    },
    created() {
        if(this.$route.query.id){
            this.dataId = this.$route.query.id;
        }
    },
    mounted() {
        if(this.dataId){
            this.$store.dispatch('productList/fetchItem', { id: this.dataId }).then((product) => {
                this.dataId = product.id;
                this.dataName = product.title;
                this.dataSku = product.sku;
                this.dataRestaurant = product.restaurant_id;
                this.dataCategory = product.category_id;
                this.dataPrice = product.price;
                this.dataStock = product.stock;
                this.dataDescription = product.description;
                this.image_url = product.image_url;
            })
        }
    }
}
</script>

<style lang="scss" scoped>
.add-new-data-sidebar {
    ::v-deep .vs-sidebar--background {
        z-index: 52010;
    }

    ::v-deep .vs-sidebar {
        z-index: 52010;
        width: 400px;
        max-width: 90vw;

        .img-upload {
            margin-top: 2rem;

            .con-img-upload {
                padding: 0;
            }

            .con-input-upload {
                width: 100%;
                margin: 0;
            }
        }
    }
}

.scroll-area--data-list-add-new {
    // height: calc(var(--vh, 1vh) * 100 - 4.3rem);
    height: calc(var(--vh, 1vh) * 100 - 16px - 45px - 82px);

    &:not(.ps) {
        overflow-y: auto;
    }
}
</style>
