<template>
<div class="page-categories">
    <vs-table ref="table" multiple v-model="selected" pagination :max-items="itemsPerPage" :data="categories">

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
                                categories.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : categories.length
                            }} of {{ queriedItems }}</span>
                    <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4"/>
                </div>
                <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
                <vs-dropdown-menu>
                    <vs-dropdown-item @click="itemsPerPage=10">
                        <span>10</span>
                    </vs-dropdown-item>
                    <vs-dropdown-item @click="itemsPerPage=15">
                        <span>15</span>
                    </vs-dropdown-item>
                    <vs-dropdown-item @click="itemsPerPage=20">
                        <span>20</span>
                    </vs-dropdown-item>
                </vs-dropdown-menu>
            </vs-dropdown>
        </div>

        <template slot="thead">
            <vs-th sort-key="name">Name</vs-th>
            <vs-th sort-key="category">Short Description</vs-th>
            <vs-th sort-key="popularity">Description</vs-th>
            <vs-th sort-key="price">Products</vs-th>
            <vs-th>Action</vs-th>
        </template>

        <template slot-scope="{data}">
            <tbody>
            <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">

                <vs-td>
                    <div class="flex items-center">
                        <img :src="tr.image_url" width="64" height="64" alt="" />
                        <router-link :to="'/category/edit?id=' + tr.id"><p class="product-name font-medium truncate ml-4">{{ tr.name }}</p></router-link>
                    </div>
                </vs-td>

                <vs-td>
                    <p class="product-short-description">{{ tr.short_description }}</p>
                </vs-td>

                <vs-td>
                    <p class="category-description">{{ tr.description }}</p>
                </vs-td>

                <vs-td>
                    <p class="product-count">{{ tr.product_count?tr.product_count:0 }}</p>
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
    name: "Categories",
    data(){
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
        categories() {
            return this.$store.state.categories
        },
        queriedItems() {
            return this.$refs.table ? this.$refs.table.queriedResults.length : this.categories.length
        }
    },
    methods: {
        addNewData() {
            this.$router.replace('/admin/category/add');
        },
        deleteData(id) {
            this.$vs.dialog({
                type: 'confirm',
                color: 'danger',
                title: `Delete Category`,
                text: `Are you sure？`,
                accept: () => {
                    this.$store.dispatch('removeCategory', {id}).catch(() => {
                        showNotify(this.$vs, 'Action Failed', '', false);
                    })
                },
                acceptText: 'Delete',
                cancelText: 'Cancel'
            });
        },
        editData(id) {
            this.$router.replace(`/category/edit?id=${id}`);
        },
    },
    created() {
        this.$store.dispatch('fetchCategories');
    },
    mounted() {
        this.isMounted = true
    }
}
</script>

<style scoped>

</style>
