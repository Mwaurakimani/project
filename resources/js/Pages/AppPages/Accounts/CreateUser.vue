<template>
    <Layout :active_page="'Users'">
        <div class="main-body">
            <page-header :attrs="$attrs"/>
            <div class="page-heading">
                <h1>Create User</h1>
            </div>

            <AccountActionTab></AccountActionTab>

            <div class="user-pan" >
                <div class="form-input">
                    <section>
                        <article class="sub-section">
                            <h2>Title</h2>
                            <div class="form-input-section">
                                <div class="input-group">
                                    <label>Username</label>
                                    <input v-model="userData.username" >
                                    <span>{{ $attrs.errors.username }}</span>
                                </div>
                                <div class="input-group">
                                    <label>Email</label>
                                    <input v-model="userData.email" >
                                    <span>{{ $attrs.errors.email }}</span>
                                </div>
                                <div class="input-group">
                                    <label>Phone</label>
                                    <input v-model="userData.phone" >
                                    <span>{{ $attrs.errors.phone }}</span>
                                </div>
                                <div class="input-group">
                                    <label>Account Type</label>
                                    <select v-model="userData.account_type" >
                                        <option value=""> - </option>
                                        <option value="TENANT">Tenant</option>
                                        <option value="AGENT">Agent</option>
                                        <option value="ADMIN">Admin</option>
                                    </select>
                                    <span>{{ $attrs.errors.account_type }}</span>
                                </div>
                            </div>
                        </article>
                    </section>
                    <section>
                        <div class="button-section">
                            <button class="create" @click=" create_user ">Create</button>
                            <button class="update">Update</button>
                            <button class="delete">Delete </button>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </Layout>

</template>

<script>
import ActionBar from "../../../AppComponents/PageComponents/ActionBar.vue";
import {mapState} from 'pinia';
import {mapActions} from "pinia";
import {ModalStore} from "../../../Pinia/ModalController";
import AccountActionTab from "../Accounts/Components/AccountActionTab.vue";



export default {
    provide:{
        tab_name: 'Accounts'
    },
    components: {
        ActionBar,
        AccountActionTab
    },
    data(){
        return {
            userData:this.$inertia.form({
                username : null,
                email : null,
                phone : null,
                account_type : null
            }),
        }
    },
    methods:{
        create_user(){
            this.userData.post(route('postUser'));
        }
    },

}
</script>
<style src="./res/index.scss" lang="scss" scoped></style>
<style lang="scss">

</style>
