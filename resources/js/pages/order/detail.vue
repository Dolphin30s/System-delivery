<!-- =========================================================================================
  File Name: AddNewDataSidebar.vue
  Description: Add New Data - Sidebar component
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div id="page-order-detail">
        <cs-loader v-if="loading && this.id" :full="true"/>
        <vs-alert color="danger" title="Error Fetching Order Data" :active.sync="!this.id && !this.loading">
            <span>Order Not Found. </span>
            <span>
            <span>Check </span><router-link :to="'/order/list'"
                                            class="text-inherit underline">All Items</router-link>
          </span>
        </vs-alert>
        <div class="order-detail" v-if="this.id && !this.loading">
            <vx-card>
                <div class="mt-6 flex items-center px-6">
                    <h2>Order #{{ id }} details</h2>
                </div>
                <vs-divider class="mb-0"></vs-divider>

                <div class="vx-row">

                    <div class="vx-col lg:w-1/3 w-full relative">
                        <h5 class="mt-4 detail-title">General</h5>
                        <!-- Created At -->
                        <vs-input label="Date created:" v-model="purchase_date" :disabled="true" class="mt-5 w-full"
                                  name="purchase_date" v-validate="'required'"/>
                        <span class="text-danger text-sm"
                              v-show="errors.has('purchase_date')">{{ errors.first('purchase_date') }}</span>

                        <!-- ORDER STATUS -->
                        <vs-select v-model="status" label="Order Status:" class="mt-5 w-full" :disabled="!is_admin" name="item-category">
                            <vs-select-item :key="item.value" :value="item.value" :text="item.text"
                                            v-for="item in order_status_choices"/>
                        </vs-select>

                    </div>
                    <div class="vx-col lg:w-2/3 w-full relative">
                        <div class="vx-row">
                            <div class="vx-col lg:w-1/2 w-full relative">
                                <h5 class="mt-4 detail-title">Billing</h5>
                                <div class="mt-6">
                                    <div>{{ getPaymentTypeLabel(payment.type) }}</div>
                                    <div>{{ getPaymentStatusLabel(payment.status) }}</div>
                                </div>
                            </div>
                            <div class="vx-col lg:w-1/2 w-full">
                                <h5 class="mt-4 detail-title">Shipping</h5>
                                <div class="mt-6">
                                    <div>{{ shipping.name }}</div>
                                    <div>{{ shipping.phone_number }}</div>
                                    <div class="mt-2">{{ shipping.address }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="vx-row w-full">
                            <div v-if="is_admin" class="vx-col lg:w-2/3">
                                <h5 class="mt-8 detail-title">Delivery Status</h5>
                                <!-- Tracking Number -->
                                <vs-input v-if="is_delivering" label="Tracking Number:" v-model="tracking_number" :disabled="!!(tracking)" class="mt-5 w-full"
                                          name="tracking_number" v-validate="'required'"/>
                                <!-- Shipping Status -->
                                <vs-select v-if="is_delivering" v-model="shipping_status" label="Shipping Status:" class="mt-5 mb-5 w-full" name="item-category">
                                    <vs-select-item :key="item.value" :value="item.value" :text="item.text"
                                                    v-for="item in shipping_status_choices"/>
                                </vs-select>
                                <!-- Shipping Time -->
                                <label v-if="is_delivering"  class="vs-input--label">Date Time</label>
                                <datetime
                                    v-if="is_delivering"
                                    title="Date Time"
                                    type="datetime"
                                    v-model="shipping_date"
                                    input-class="vs-inputx vs-input--input normal hasValue"
                                />
                            </div>
                            <div v-else-if="tracking !== null" class="w-full">
                                <h5 class="mt-8 detail-title">Delivery Status</h5>
                                <div class="shipping-history">
                                    <div class="vx-row">
                                        <div class="vx-col lg:w-1/3">Tracking Number: </div>
                                        <div class="vx-col lg:w-2/3">{{tracking.tracking_number}}</div>
                                    </div>
                                    <div class="vx-row">
                                        <div class="vx-col lg:w-1/3">Shipping Status: </div>
                                        <div class="vx-col lg:w-2/3">{{getShippingLabel(tracking.shipping_status)}}</div>
                                    </div>
                                    <div class="vx-row">
                                        <div class="vx-col lg:w-1/3">DateTime: </div>
                                        <div class="vx-col lg:w-2/3">{{tracking.datetime}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap items-center p-6" slot="footer">
                    <vs-button class="mr-6" @click="submitData" :disabled="!isFormValid">Submit</vs-button>
                </div>
            </vx-card>
            <vs-table ref="items_table" pagination :max-items="itemsPerPage"
                      :data="order_items">

                <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">

                    <div class="flex flex-wrap-reverse items-center data-list-btn-container">
                    </div>

                    <!-- ITEMS PER PAGE -->
                    <vs-dropdown vs-trigger-click class="cursor-pointer p-4 items-per-page-handler">
                        <div
                            class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
                            <span class="mr-2">{{
                                    currentPage * itemsPerPage - (itemsPerPage - 1)
                                }} - {{
                                    order_items.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : order_items.length
                                }} of {{ queriedItems }}</span>
                            <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4"/>
                        </div>
                        <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
                        <vs-dropdown-menu>
                            <vs-dropdown-item @click="itemsPerPage=10">
                                <span>10</span>
                            </vs-dropdown-item>
                            <vs-dropdown-item @click="itemsPerPage=50">
                                <span>50</span>
                            </vs-dropdown-item>
                            <vs-dropdown-item @click="itemsPerPage=100">
                                <span>100</span>
                            </vs-dropdown-item>
                        </vs-dropdown-menu>
                    </vs-dropdown>
                </div>

                <template slot="thead">
                    <vs-th sort-key="name">Item</vs-th>
                    <vs-th sort-key="name">Cost</vs-th>
                    <vs-th sort-key="order_status">Ordered Qty</vs-th>
                    <vs-th sort-key="price">Shipped Qty</vs-th>
                    <vs-th sort-key="order_status">Total</vs-th>
                </template>

                <template slot-scope="{data}">
                    <tbody>
                    <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                        <vs-td>
                            <div class="flex items-center">
                                <img :src="tr.image_url" width="64" height="64" alt="" />
                                <div>
                                    <div class="product-name font-bold truncate ml-4">{{ tr.title }}</div>
                                    <p class="product-name font-medium truncate ml-4">SKU: {{ tr.sku }}</p>
                                </div>
                            </div>
                        </vs-td>

                        <vs-td>
                            <p class="product-name font-medium truncate">{{ tr.item_price }}</p>
                        </vs-td>

                        <vs-td>
                            <p class="product-name font-medium truncate">{{ tr.quantity_ordered }}</p>
                        </vs-td>

                        <vs-td>
                            <p class="product-name font-medium truncate">{{ tr.quantity_shipped }}</p>
                        </vs-td>

                        <vs-td>
                            <p class="product-price">${{ (Number(tr.item_price) * tr.quantity_ordered).toFixed(2) }}</p>
                        </vs-td>

                    </vs-tr>
                    </tbody>
                </template>
            </vs-table>
            <vx-card>
                <div class="vx-row">
                    <div class="vx-col md:w-1/2"></div>
                    <div class="vx-col md:w-1/2 w-full">
                        <div class="flex justify-between mb-2">
                            <span class="text-grey">Items Total</span>
                            <span>${{ items_total }}</span>
                        </div>

                        <div class="flex justify-between mb-2">
                            <span class="text-grey">Delivery Charges</span>
                            <span class="text-success">{{ delivery_fee }}</span>
                        </div>

                        <div class="flex justify-between font-semibold mb-3">
                            <span>Total</span>
                            <span>${{ order_total }}</span>
                        </div>
                    </div>
                </div>

                <vs-divider/>

                <div class="vx-row">
                    <div class="vx-col md:w-1/2"></div>
                    <div class="vx-col md:w-1/2 w-full">
                        <div class="flex justify-between mb-2">
                            <span class="text-grey">Paid:</span>
                            <span>${{ order_total }}</span>
                        </div>

                        <div class="flex justify-between mb-2">
                            <span class="text-grey">Pay via Paypal</span>
                        </div>
                    </div>
                </div>
            </vx-card>
        </div>
    </div>
</template>

<script>

import CsLoader from '@/components/CsLoader.vue';
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import {
    getOrderStatusChoices,
    getPaymentStatusLabel,
    getPaymentTypeLabel, getShippingLabel,
    getShippingStatusChoices, ORDER_STATUS_DELIVERING,
    ORDER_STATUS_NONE, SHIPPING_STATUS_PICKED
} from "../../const";
import { Datetime } from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'
import {showNotify} from "../../helper";

export default {
    name: 'OrderDetail',
    components: {
        VuePerfectScrollbar,
        CsLoader,
        Datetime
    },
    data() {
        return {
            id: null,
            purchase_date: '',
            status: ORDER_STATUS_NONE,
            Billing: 'pending',
            shipping: {},
            payment: {},
            tracking: null,
            items_total: 0,
            order_total: 0,
            delivery_fee: 0,

            order_items: [],
            itemsPerPage: 10,
            shipping_status: SHIPPING_STATUS_PICKED,
            tracking_number: '',
            shipping_date: new Date().toISOString(),
            configdateTimePicker: {
                enableTime: true,
                dateFormat: 'd-m-Y H:i'
            },
            loading: true,
            isMounted: false,
        }
    },
    watch: {

    },
    computed: {
        order_status_choices() {
            return getOrderStatusChoices();
        },
        shipping_status_choices() {
            return getShippingStatusChoices();
        },
        is_delivering(){
            return this.status === ORDER_STATUS_DELIVERING;
        },
        is_admin(){
            return this.$auth.user().role === 'admin';

        },
        currentPage() {
            if (this.isMounted) {
                return this.$refs.items_table?.currentx??1;
            }
            return 0
        },
        isFormValid() {
            return !this.errors.any() > 0
        },
        scrollbarTag() {
            return this.$store.getters.scrollbarTag
        },
        queriedItems() {
            return this.$refs.items_table ? this.$refs.items_table.queriedResults.length : this.order_items.length
        }
    },
    methods: {
        initValues() {
        },
        submitData() {
            this.$validator.validateAll().then(result => {
                if (result) {
                    const obj = {
                        order_id: this.id,
                        order_status: this.status,
                    }

                    if (this.id !== null && this.id >= 0) {
                        this.$store.dispatch('orderList/updateOrderStatus', obj).then(() => {
                            showNotify(this.$vs, 'Action Success', '');
                        }).catch(err => {
                            console.error(err)
                        });
                    }
                    if(this.is_delivering){
                        const shipping = {
                            order_id: this.id,
                            tracking_number: this.tracking_number,
                            shipping_status: this.shipping_status,
                            datetime: this.shipping_date
                        }
                        this.$store.dispatch('orderList/updateShipping', shipping).catch(err => {
                            console.error(err)
                        });
                    }
                    this.initValues()
                }
            })
        },
        getPaymentTypeLabel(type){
            return getPaymentTypeLabel(type);
        },
        getPaymentStatusLabel(type){
            return getPaymentStatusLabel(type);
        },
        getShippingLabel(type){
            return getShippingLabel(type);
        }
    },
    created() {
        if (this.$route.query.id) {
            this.id = this.$route.query.id;
        } else {
            this.loading = false;
        }
    },
    mounted() {
        this.isMounted = true;
        if (this.id) {
            this.$store.dispatch('orderList/getOrderDetail', {id: this.id}).then((response) => {
                if (!response) {
                    this.id = null;
                    this.loading = false;
                    return;
                }
                this.loading = false;
                this.status = response.order_status;
                this.items_total = response.items_total;
                this.delivery_fee = response.delivery_fee;
                this.order_total = response.order_total;
                this.purchase_date = response.purchase_date;
                this.shipping = response.shipping;
                this.payment = response.payment;
                this.tracking = response.tracking;
                if(this.tracking){
                    this.tracking_number = this.tracking.tracking_number;
                    this.shipping_date = new Date(this.tracking.datetime).toISOString();
                    this.shipping_status = this.tracking.shipping_status;
                }
                this.order_items = response.order_items;
                this.customer = response.customer;
            }).catch(() => {
                this.id = null;
                this.loading = false;
            });
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

.shipping-history{
    margin-top: 20px;
}

.detail-title{
    color: #1da1f2;
    font-weight: bold;
}

.scroll-area--data-list-add-new {
    // height: calc(var(--vh, 1vh) * 100 - 4.3rem);
    height: calc(var(--vh, 1vh) * 100 - 16px - 45px - 82px);

    &:not(.ps) {
        overflow-y: auto;
    }
}
</style>
