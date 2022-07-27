<template>
    <div class="page-user-edit">
        <vs-alert color="danger" title="User Not Found" :active.sync="user_not_found">
            <span>User record with id: {{ $route.params.userId }} not found. </span>
            <span>
        <span>Check </span><router-link :to="{name:'page-user-list'}"
                                        class="text-inherit underline">All Users</router-link>
      </span>
        </vs-alert>

        <vx-card v-if="user_data" class="">

            <div slot="no-body" class="tabs-container px-6 pt-6">

                <!-- Avatar Row -->
                <div class="vx-row mb-4">
                    <div class="vx-col w-full">
                        <div class="flex items-center flex-col">
                            <img :src="user_image_url" class="mr-8 rounded h-64 w-64"/>
                            <!-- <vs-avatar :src="data.avatar" size="80px" class="mr-4" /> -->
                            <div class="mt-4">
                                <p class="text-lg font-medium mb-2 mt-4 sm:mt-0">{{ user_data.name }}</p>
                                <input type="file" class="hidden" ref="update_avatar_input" @change="update_avatar" accept="image/*">

                                <vs-button class="mr-4 mb-4" @click="$refs.update_avatar_input.click()">Change Avatar</vs-button>
                                <vs-button type="border" color="danger" @click="reset_avatar">Remove Avatar</vs-button>
                            </div>
                            <div class="flex">
                                <div class="mt-4 mx-8">
                                    <div><label class="vs-input--label">Status</label></div>
                                    <cell-renderer-status :value="data_local.valid"/>
                                </div>

                                <div class="mt-4 mx-8">
                                    <div><label class="vs-input--label">Role</label></div>
                                    <cell-renderer-role :role="data_local.role"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->
                <div class="vx-row">
                    <div class="vx-col md:w-1/2 w-full">
                        <vs-input class="w-full mt-4" label="Name" v-model="data_local.name"
                                  v-validate="'required'" name="name"/>
                        <span class="text-danger text-sm" v-show="errors.has('name')">{{ errors.first('name') }}</span>

                        <div class="mt-4" v-if="data_local.cc2">
                            <label class="vs-input--label">PhoneNumber</label>
                            <vue-tel-input :defaultCountry="data_local.cc2" v-model="data_local.phone" @validate="this.onValidPhone"></vue-tel-input>
                            <span class="text-danger text-sm">{{ invalidPhone ? 'PhoneNumber is invalid' : '' }}</span>
                        </div>
                    </div>

                    <div class="vx-col md:w-1/2 w-full">
                        <div class="text-sm mt-4 color-gray">Birthday</div>
                        <div class="w-full">
                            <datepicker format="yyyy-MM-dd" v-model="data_local.birth_date" class="date-time--input"
                                        @selected="selectToDate($event)"></datepicker>
                        </div>

                        <div class="text-sm mt-4 color-gray">Gender</div>
                        <div class="w-full justify-around">
                            <vs-radio v-model="data_local.gender" vs-name="gender" vs-value='Male'>Male</vs-radio>
                            <vs-radio v-model="data_local.gender" vs-name="gender" vs-value='Female'>Female</vs-radio>
                        </div>

                    </div>
                </div>


                <!-- Save & Reset Button -->
                <div class="vx-row">
                    <div class="vx-col w-full">
                        <div class="my-8 flex flex-wrap items-center justify-end">
                            <vs-button class="ml-auto mt-2" @click="save_changes" :disabled="!validateForm">Save
                                Changes
                            </vs-button>
                            <vs-button class="ml-4 mt-2" type="border" color="warning" @click="reset_data">Reset
                            </vs-button>
                        </div>
                    </div>
                </div>
            </div>
        </vx-card>

    </div>
</template>

<script>
import vSelect from 'vue-select'
import {USER_ROLE_CUSTOMER, USER_ROLE_OPTIONS} from "../../const";
import {VueTelInput} from 'vue-tel-input';
import Datepicker from 'vuejs-datepicker';
import {showNotify} from "../../helper";
import CellRendererStatus from "./cell-renderer/CellRendererStatus";
import CellRendererRole from "./cell-renderer/CellRendererRole";

export default {
    name: "ProfileEdit",
    components: {
        vSelect,
        VueTelInput,
        Datepicker,
        CellRendererStatus,
        CellRendererRole,
    },
    data() {
        return {
            user_data: {},
            data_local: {
                valid: 1,
                role: USER_ROLE_CUSTOMER
            },
            dataImg: null,

            invalidPhone: false,
            user_not_found: false,
            statusOptions: [
                {label: 'Active', value: 1},
                {label: 'Blocked', value: 0},
            ],
            roleOptions: USER_ROLE_OPTIONS
        }
    },
    computed: {
        status_local: {
            get() {
                return {
                    label: this.statusOptions.find(o => o.value === this.data_local.valid).label,
                    value: this.data_local.valid
                }
            },
            set(obj) {
                this.data_local.valid = obj.value
            }
        },
        role_local: {
            get() {
                return {
                    label: this.roleOptions.find(o => o.value === this.data_local.role).label,
                    value: this.data_local.role
                }
            },
            set(obj) {
                this.data_local.role = obj.value
            }
        },
        user_image_url() {
            if (this.data_local.image_url) {
                return this.data_local.image_url;
            }
            if (this.data_local.gender && this.data_local.gender === 'Female') {
                return '/assets/main/images/user-female.png';
            }
            return '/assets/main/images/user-male.png';
        },
        validateForm() {
            return !this.errors.any()
        }
    },
    methods: {
        fetch_user_data() {
            this.$store.dispatch('userManagement/fetchProfile', {})
                .then(res => {
                    this.user_data = res;
                    this.data_local = Object.assign({}, this.user_data);
                    console.log('data', this.data_local);
                })
                .catch(err => {
                    if (err.response.status === 404) {
                        this.user_not_found = true
                        return
                    }
                    console.error(err)
                })
        },
        onValidPhone(object) {
            this.invalidPhone = !object.valid;
            this.data_local.cc2 = object.countryCode ?? '';
        },
        selectToDate(value) {
            this.data_local.birth_date = value;
        },
        save_changes() {
            /* eslint-disable */
            if (!this.validateForm || this.invalidPhone) return;

            const obj = {
                id: this.data_local.id,
                name: this.data_local.name,
                phone: this.data_local.phone,
                cc2: this.data_local.cc2,
                valid: this.data_local.valid,
                role: this.data_local.role,
                birth_date: this.data_local.birth_date,
                gender: this.data_local.gender,
                file: this.dataImg
            }

            this.$store.dispatch('userManagement/updateUser', obj)
                .then(() => {
                    this.$auth.fetch();
                    showNotify(this.$vs, 'Action Success', '');
                })
                .catch(err => { showNotify(this.$vs, 'Action Failed',err,false); })

        },
        reset_data() {
            this.data_local = Object.assign({}, this.user_data);
            this.dataImg = null;
        },
        update_avatar(input) {
            if (input.target.files && input.target.files[0]) {
                const reader = new FileReader()
                reader.onload = e => {
                    this.data_local.image_url = e.target.result
                }
                reader.readAsDataURL(input.target.files[0]);
                this.dataImg = input.target.files[0];
            }
        },
        reset_avatar(){
            this.dataImg = null;
            this.data_local.image_url = this.user_data.image_url;
        }
    },
    created() {
        this.fetch_user_data();
    }
}
</script>

<style scoped>

</style>
