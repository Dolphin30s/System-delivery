<template>
    <div class="page-product-list">

        <vs-table ref="table" multiple v-model="selected" pagination :max-items="itemsPerPage" search :data="products">

            <div slot="header" class="flex flex-wrap-reverse items-center flex-grow justify-between">

                <div class="flex flex-wrap-reverse items-center data-list-btn-container">
                    <!-- ADD NEW -->
                    <div
                        class="btn-add-new p-3 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary"
                        @click="addNewData">
                        <feather-icon icon="PlusIcon" svgClasses="h-4 w-4"/>
                        <span class="ml-2 text-base text-primary">Add New</span>
                    </div>
                </div>

                <!-- ITEMS PER PAGE -->
                <vs-dropdown vs-trigger-click class="cursor-pointer p-4 items-per-page-handler">
                    <div
                        class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
                        <span class="mr-2">{{
                                currentPage * itemsPerPage - (itemsPerPage - 1)
                            }} - {{
                                products.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : products.length
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
                <vs-th sort-key="title">Title</vs-th>
                <vs-th sort-key="sku">Sku</vs-th>
                <vs-th sort-key="category">Category</vs-th>
                <vs-th sort-key="restaurant">Restaurant</vs-th>
                <vs-th sort-key="price">Price</vs-th>
                <vs-th sort-key="stock">Stock</vs-th>
                <vs-th>Action</vs-th>
            </template>

            <template slot-scope="{data}">
                <tbody>
                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">

                    <vs-td>
                        <div class="flex items-center">
                            <img :src="tr.image_url" width="64" height="64" alt="" />
                            <router-link :to="'/admin/product/edit?id=' + tr.id"><p class="product-name font-medium truncate ml-4">{{ tr.title }}</p></router-link>
                        </div>
                    </vs-td>

                    <vs-td>
                        <p class="product-category">{{ tr.sku }}</p>
                    </vs-td>

                    <vs-td>
                        <p class="product-category">{{ tr.category }}</p>
                    </vs-td>

                    <vs-td>
                        <p class="product-category">{{ tr.restaurant }}</p>
                    </vs-td>

                    <vs-td>
                        <p class="product-price">${{ tr.price }}</p>
                    </vs-td>

                    <vs-td>
                        <p class="product-price">{{ tr.stock }}</p>
                    </vs-td>

                    <vs-td class="whitespace-no-wrap">
                        <feather-icon icon="EditIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current"
                                      @click.stop="editData(tr.id)"/>
                        <feather-icon icon="TrashIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current"
                                      class="ml-2" @click.stop="deleteData(tr.id)"/>
                    </vs-td>

                </vs-tr>
                </tbody>
            </template>
        </vs-table>
    </div>
</template>

<script>
import {showNotify} from "../../helper";

export default {
    name: "ProductList",
    data() {
        return {
            selected: [],

            itemsPerPage: 10,
            isMounted: false,

            // Data Sidebar
            addNewDataSidebar: false,
            sidebarData: {}
        }
    },
    computed: {
        currentPage() {
            if (this.isMounted) {
                return this.$refs.table.currentx
            }
            return 0
        },
        products() {
            return this.$store.getters.productList;
        },
        queriedItems() {
            return this.$refs.table ? this.$refs.table.queriedResults.length : this.products.length
        }
    },
    methods: {
        addNewData() {
            this.$router.push('/admin/product/add');
        },
        deleteData(id) {
            this.$store.dispatch('productList/removeItem', id)
                .then(() => { showNotify(this.$vs, 'Action Success', ''); })
                .catch(err => { showNotify(this.$vs, 'Action Failed','',false); })
        },
        editData(id) {
            this.$router.push(`/admin/product/edit?id=${id}`);
        },
        getOrderStatusColor(status) {
            if (status === 'on_hold') return 'warning'
            if (status === 'delivered') return 'success'
            if (status === 'canceled') return 'danger'
            return 'primary'
        },
        getPopularityColor(num) {
            if (num > 90) return 'success'
            if (num > 70) return 'primary'
            if (num >= 50) return 'warning'
            if (num < 50) return 'danger'
            return 'primary'
        },
        toggleDataSidebar(val = false) {
            this.addNewDataSidebar = val
        }
    },
    created() {
        this.$store.dispatch('productList/fetchItems')
    },
    mounted() {
        this.isMounted = true
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
