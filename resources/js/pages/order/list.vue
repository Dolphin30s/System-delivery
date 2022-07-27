<template>
    <div class="page-order-list">

        <vs-table ref="table" pagination :max-items="itemsPerPage" search :data="orders">

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
                                orders.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : orders.length
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
                <vs-th sort-key="id">Order</vs-th>
                <vs-th sort-key="purchase_date">Create Date</vs-th>
                <vs-th sort-key="order_status">Order Status</vs-th>
                <vs-th sort-key="order_total">Total</vs-th>
                <vs-th sort-key="payment.type">Billing</vs-th>
                <vs-th sort-key="shipping_address.name">Shipping Address</vs-th>
                <vs-th sort-key="">Delivery</vs-th>
                <vs-th>Action</vs-th>
            </template>

            <template slot-scope="{data}">
                <tbody>
                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                    <vs-td>
                        <router-link :to="'/orders/detail?id=' + tr.id"><p class="product-name font-medium truncate">#{{ tr.id }}</p></router-link>
                    </vs-td>

                    <vs-td>
                        <p class="product-name font-medium truncate">{{ tr.purchase_date }}</p>
                    </vs-td>

                    <vs-td>
                        <vs-chip :color="getOrderStatusColor(tr.order_status)" class="product-order-status">
                            {{ getOrderStatusText(tr.order_status) }}
                        </vs-chip>
                    </vs-td>

                    <vs-td>
                        <p class="product-price">${{ tr.order_total }}</p>
                    </vs-td>
                    <vs-td>
                        <p class="product-price">{{ getPaymentTypeLabel(tr.payment.type) }}</p>
                        <p class="product-price">{{ getPaymentStatusLabel(tr.payment.status) }}</p>
                    </vs-td>
                    <vs-td>
                        <p class="product-category">{{ tr.shipping_address.name }}</p>
                        <p class="product-category">{{ tr.shipping_address.phone_number }}</p>
                        <p class="product-category">{{ tr.shipping_address.address }}</p>
                    </vs-td>

                    <vs-td>
                        <p class="product-delivery"></p>
                    </vs-td>

                    <vs-td class="whitespace-no-wrap">
                        <!--                        <feather-icon icon="EditIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current"-->
                        <!--                                      @click.stop="editData(tr)"/>-->
                        <!--                        <feather-icon icon="TrashIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current"-->
                        <!--                                      class="ml-2" @click.stop="deleteData(tr.id)"/>-->
                    </vs-td>

                </vs-tr>
                </tbody>
            </template>
        </vs-table>
    </div>
</template>

<script>

import {getOrderStatusColorStyle, getOrderStatusLabel, getPaymentStatusLabel, getPaymentTypeLabel} from "../../const";

export default {
    name: "OrderList",
    data() {
        return {
            selected: [],

            itemsPerPage: 10,
            isMounted: false,
        }
    },
    computed: {
        currentPage() {
            if (this.isMounted) {
                return this.$refs.table.currentx
            }
            return 0
        },
        orders() {
            return this.$store.getters.orderList;
        },
        queriedItems() {
            return this.$refs.table ? this.$refs.table.queriedResults.length : this.orders.length
        }
    },
    methods: {
        deleteData(id) {
            this.$store.dispatch('dataList/removeItem', id).catch(err => {
                console.error(err)
            })
        },
        getOrderStatusColor(status) {
            return getOrderStatusColorStyle(status);
        },
        getOrderStatusText(status) {
            return getOrderStatusLabel(status);
        },
        getPaymentTypeLabel(type){
            return getPaymentTypeLabel(type);
        },
        getPaymentStatusLabel(type){
            return getPaymentStatusLabel(type);
        }
    },
    created() {

    },
    mounted() {
        this.isMounted = true;
        this.$store.dispatch('orderList/fetchList');
    }
}
</script>

<style lang="scss">
#data-list-list-view {
    .vs-con-table {

        /*
          Below media-queries is fix for responsiveness of action buttons
          Note: If you change action buttons or layout of this page, Please remove below style
        */
        @media (max-width: 689px) {
            .vs-table--search {
                margin-left: 0;
                max-width: unset;
                width: 100%;

                .vs-table--search-input {
                    width: 100%;
                }
            }
        }

        @media (max-width: 461px) {
            .items-per-page-handler {
                display: none;
            }
        }

        @media (max-width: 341px) {
            .data-list-btn-container {
                width: 100%;

                .dd-actions,
                .btn-add-new {
                    width: 100%;
                    margin-right: 0 !important;
                }
            }
        }

        .product-name {
            max-width: 23rem;
        }

        .vs-table--header {
            display: flex;
            flex-wrap: wrap;
            margin-left: 1.5rem;
            margin-right: 1.5rem;

            > span {
                display: flex;
                flex-grow: 1;
            }

            .vs-table--search {
                padding-top: 0;

                .vs-table--search-input {
                    padding: 0.9rem 2.5rem;
                    font-size: 1rem;

                    & + i {
                        left: 1rem;
                    }

                    &:focus + i {
                        left: 1rem;
                    }
                }
            }
        }

        .vs-table {
            border-collapse: separate;
            border-spacing: 0 1.3rem;
            padding: 0 1rem;

            tr {
                box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .05);

                td {
                    padding: 20px;

                    &:first-child {
                        border-top-left-radius: .5rem;
                        border-bottom-left-radius: .5rem;
                    }

                    &:last-child {
                        border-top-right-radius: .5rem;
                        border-bottom-right-radius: .5rem;
                    }
                }

                td.td-check {
                    padding: 20px !important;
                }
            }
        }

        .vs-table--thead {
            th {
                padding-top: 0;
                padding-bottom: 0;

                .vs-table-text {
                    text-transform: uppercase;
                    font-weight: 600;
                }
            }

            th.td-check {
                padding: 0 15px !important;
            }

            tr {
                background: none;
                box-shadow: none;
            }
        }

        .vs-table--pagination {
            justify-content: center;
        }
    }
}
</style>
