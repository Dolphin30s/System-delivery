<template>
    <div class="page-user-list">

        <vs-table ref="table" pagination :max-items="itemsPerPage" search :data="usersData">

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
                                usersData.length - currentPage * itemsPerPage > 0 ? currentPage * itemsPerPage : usersData.length
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
                <vs-th sort-key="id">ID</vs-th>
                <vs-th sort-key="name">Name</vs-th>
                <vs-th sort-key="phone">PhoneNumber</vs-th>
                <vs-th sort-key="role">Role</vs-th>
                <vs-th sort-key="gender">Gender</vs-th>
                <vs-th sort-key="birth_date">Birthday</vs-th>
                <vs-th sort-key="valid">valid</vs-th>
                <vs-th>Action</vs-th>
            </template>

            <template slot-scope="{data}">
                <tbody>
                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                    <vs-td>
                        <p class="user-id font-medium truncate">{{ tr.id }}</p>
                    </vs-td>

                    <vs-td>
                        <router-link :to="'/admin/user/detail?id=' + tr.id"><p class="product-name font-medium truncate">{{ tr.name }}</p></router-link>
                    </vs-td>

                    <vs-td>
                        <p class="product-name font-medium truncate">{{ tr.phone }}</p>
                    </vs-td>

                    <vs-td>
                        <cell-renderer-role :role="tr.role"/>
                    </vs-td>

                    <vs-td>
                        <p class="product-price">{{ tr.gender }}</p>
                    </vs-td>
                    <vs-td>
                        <p class="product-price">{{ tr.birth_date }}</p>
                    </vs-td>
                    <vs-td>
                        <cell-renderer-status :value="tr.valid"/>
                    </vs-td>

                    <vs-td class="whitespace-no-wrap">
                        <feather-icon icon="EditIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current"
                                      @click.stop="editData(tr.id)"/>
                        <feather-icon v-show="!isAdmin(tr.role)" icon="TrashIcon" svgClasses="w-5 h-5 hover:text-danger stroke-current"
                                      class="ml-2" @click.stop="deleteData(tr.id)"/>
                    </vs-td>

                </vs-tr>
                </tbody>
            </template>
        </vs-table>
    </div>
</template>

<script>
// Cell Renderer
import CellRendererLink from './cell-renderer/CellRendererLink.vue'
import CellRendererStatus from './cell-renderer/CellRendererStatus.vue'
import CellRendererRole from './cell-renderer/CellRendererRole.vue'
import CellRendererVerified from './cell-renderer/CellRendererVerified.vue'
import CellRendererActions from './cell-renderer/CellRendererActions.vue'
import {showNotify} from "../../helper";
import {USER_ROLE_ADMIN, USER_ROLE_CUSTOMER, USER_ROLE_DELIVERER} from "../../const";

export default {
    name: "UserList",
    components: {
        // Cell Renderer
        CellRendererLink,
        CellRendererStatus,
        CellRendererRole,
        CellRendererVerified,
        CellRendererActions
    },
    data() {
        return {
            itemsPerPage: 10,
            isMounted: false,
        }
    },
    watch: {

    },
    computed: {
        usersData() {
            return this.$store.getters.userList
        },
        currentPage() {
            if (this.isMounted) {
                return this.$refs.table.currentx
            }
            return 1
        },
        queriedItems() {
            return this.$refs.table ? this.$refs.table.queriedResults.length : this.usersData.length
        }
    },
    methods: {
        deleteData(id) {
            this.$store.dispatch('userManagement/removeRecord', id)
                .then(() => { showNotify(this.$vs, 'Action Success', ''); })
                .catch(err => { showNotify(this.$vs, 'Action Failed','',false); })
        },
        editData(id) {
            this.$router.push(`/admin/user/detail?id=${id}&action=edit`);
        },
        isAdmin(role){
            return role === USER_ROLE_ADMIN;
        }
    },
    mounted() {

    },
    created() {
        this.$store.dispatch('userManagement/fetchUsers').catch(err => {
            console.error(err)
        })
    }
}
</script>

<style lang="scss" scoped>
.page-user-list {
    .user-list-filters {
        .vs__actions {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-58%);
        }
    }
}
</style>
