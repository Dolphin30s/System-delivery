<template>
    <vs-chip :color="getRoleColor(role)" class="user-role">
        {{ getRoleLabel(role) }}
    </vs-chip>
</template>

<script>
import {USER_ROLE_ADMIN, USER_ROLE_CUSTOMER, USER_ROLE_DELIVERER} from "../../../const";

export default {
    name: 'CellRendererRole',
    props: {
        role : {type: String, required: true}
    },
    computed: {
        getRoleColor() {
            return (role) => {
                switch (role){
                    case USER_ROLE_ADMIN:
                        return 'warning';
                    case USER_ROLE_DELIVERER:
                        return 'primary';
                    case USER_ROLE_CUSTOMER:
                        return 'success';
                }
                return 'success';
            }
        },
        getRoleLabel() {
            return (role) => {
                switch (role){
                    case USER_ROLE_ADMIN:
                        return 'Admin';
                    case USER_ROLE_DELIVERER:
                        return 'Deliverer';
                    case USER_ROLE_CUSTOMER:
                        return 'Customer';
                }
                return 'Customer'
            }
        },
    }
}
</script>
