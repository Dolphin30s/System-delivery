<template>
    <div id="page-user-view">

        <vs-alert color="danger" title="User Not Found" :active.sync="user_not_found">
            <span>User record with id: {{ $route.params.userId }} not found. </span>
            <span>
        <span>Check </span><router-link :to="{name:'page-user-list'}"
                                        class="text-inherit underline">All Users</router-link>
      </span>
        </vs-alert>

        <vx-card title="Account" class="mb-base">

            <!-- Avatar -->
            <div class="vx-row">

                <!-- Avatar Col -->
                <div class="vx-col" id="avatar-col">
                    <div class="img-container">
                        <img :src="user_image_url" class="rounded w-full"/>
                    </div>
                </div>

                <!-- Information - Col 1 -->
                <div class="vx-col flex-1" id="account-info-col-1">
                    <table>
                        <tr>
                            <td class="font-semibold">Name</td>
                            <td>{{ user_data.name }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold">PhoneNumber</td>
                            <td>{{ user_data.phone }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold">Role</td>
                            <td>
                                <cell-renderer-role v-if="!editMode && user_data.role" :role="user_data.role"/>
                                <v-select v-if="editMode" v-model="role_local" :clearable="false" :options="roleOptions" v-validate="'required'" name="role" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                                <span class="text-danger text-sm"  v-show="errors.has('role')">{{ errors.first('role') }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-semibold">Status</td>
                            <td>
                                <cell-renderer-status v-if="!editMode && user_data.valid > -1" :value="user_data.valid"/>
                                <v-select v-if="editMode" v-model="status_local" :clearable="false" :options="statusOptions" v-validate="'required'" name="status" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                                <span class="text-danger text-sm"  v-show="errors.has('status')">{{ errors.first('status') }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- /Information - Col 1 -->

                <!-- Information - Col 2 -->
                <div class="vx-col flex-1" id="account-info-col-2">
                    <table>
                        <tr>
                            <td class="font-semibold">Gender</td>
                            <td>{{ user_data.gender }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold">Birthday</td>
                            <td>{{ user_data.birth_date }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Save & Reset Button -->
            <div class="vx-row" v-if="editMode">
                <div class="vx-col w-full">
                    <div class="my-8 flex flex-wrap items-center justify-end">
                        <vs-button class="ml-auto mt-2" @click="save_changes" :disabled="!validateForm">Save Changes</vs-button>
                        <vs-button class="ml-4 mt-2" type="border" color="warning" @click="reset_data">Reset</vs-button>
                    </div>
                </div>
            </div>
        </vx-card>
    </div>
</template>

<script>
import vSelect from 'vue-select'
import CellRendererStatus from './cell-renderer/CellRendererStatus.vue'
import CellRendererRole from './cell-renderer/CellRendererRole.vue'
import {USER_ROLE_CUSTOMER, USER_ROLE_OPTIONS} from "../../const";
import {showNotify} from "../../helper";

export default {
    name: "UserDetail",
    data() {
        return {
            user_data: {},
            user_not_found: false,

            editMode: false,
            data_local: {
                valid: 1,
                role: USER_ROLE_CUSTOMER
            },
            statusOptions: [
                { label: 'Active',  value: 1 },
                { label: 'Blocked',  value: 0 },
            ],
            roleOptions: USER_ROLE_OPTIONS
        }
    },
    components: {
        vSelect,
        CellRendererStatus,
        CellRendererRole
    },
    computed: {
        status_local: {
            get () {
                return { label: this.statusOptions.find(o => o.value === this.data_local.valid).label,  value: this.data_local.valid  }
            },
            set (obj) {
                this.data_local.valid = obj.value
            }
        },
        role_local: {
            get () {
                return { label: this.roleOptions.find(o => o.value === this.data_local.role).label,  value: this.data_local.role  }
            },
            set (obj) {
                this.data_local.role = obj.value
            }
        },
        userAddress() {
            let str = ''
            for (const field in this.user_data.location) {
                str += `${field} `
            }
            return str
        },
        user_image_url() {
            if (this.user_data.image_url) {
                return this.user_data.image_url;
            }
            if (this.user_data.gender && this.user_data.gender === 'Female') {
                return '/assets/main/images/user-female.png';
            }
            return '/assets/main/images/user-male.png';
        },
        validateForm () {
            return !this.errors.any()
        }
    },
    methods: {
        save_changes () {
            /* eslint-disable */
            if (!this.validateForm) return;

            const params = {
                id: this.user_data.id,
                ...this.data_local
            }
            this.$store.dispatch('userManagement/updateUser', params).then(() => {
                showNotify(this.$vs, 'Action Success', '');
            }).catch(() => {
                showNotify(this.$vs, 'Action Failed','',false);
            });
        },
        reset_data () {
            this.data_local.valid = this.user_data.valid;
            this.data_local.role = this.user_data.role;
        },
    },
    created() {
        const userId = this.$route.query.id;
        if(userId && this.$route.query.action === 'edit'){
            this.editMode = true;
        }

        this.$store.dispatch('userManagement/fetchUser', {id: userId})
            .then(res => {
                this.user_data = res;
                this.reset_data();
            })
            .catch(err => {
                if (err.response.status === 404) {
                    this.user_not_found = true
                    return
                }
                console.error(err)
            })
    }
}
</script>

<style lang="scss">
#avatar-col {
    width: 10rem;
}

#page-user-view {
    table {
        td {
            vertical-align: top;
            min-width: 140px;
            padding-bottom: .8rem;
            word-break: break-all;
        }

        &:not(.permissions-table) {
            td {
                @media screen and (max-width: 370px) {
                    display: block;
                }
            }
        }
    }
}


@media screen and (min-width: 1201px) and (max-width: 1211px),
only screen and (min-width: 636px) and (max-width: 991px) {
    #account-info-col-1 {
        width: calc(100% - 12rem) !important;
    }
}
</style>
