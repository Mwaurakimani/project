<template>
    <div class="user-create" key="count">
        <div class="modal-heading">
            <h3>Create  User</h3>
            <button @click.stop="close_modal">Close</button>
        </div>
        <div class="module-body">
            <div class="account-stats pl-[20px]">
<!--                <h2>Account Statistics:</h2>-->
                <div class="stats-group pl-[50px]">
                    <label for="">ID :</label>
                    <p>02220</p>
                </div>
                <div class="stats-group pl-[50px]">
                    <label for="">Date created :</label>
                    <p>02220</p>
                </div>
                <div class="stats-group pl-[50px]">
                    <label for="">Date Updated :</label>
                    <p>02220</p>
                </div>
            </div>
            <div class="splitter">
                <input v-model="user.firstName" placeholder="First Name">
                <input v-model="user.lastName" placeholder="Last Name">
            </div>
            <div class="splitter">
                <input v-model="user.email" placeholder="Email">
            </div>
            <div class="splitter">
                <select v-model="user.designation">
                    <option value="" disabled selected style="color: lightgrey">Select Designation</option>
                    <option value="TempEmployee">TempEmployee</option>
                    <option value="Contract">Contract</option>
                    <option value="Intern">Intern</option>
                    <option value="PnPEmployee">PnPEmployee</option>
                    <option value="Manager">Manager</option>
                    <option value="Director">Detractor</option>
                    <option value="Administrator">Administrator</option>
                </select>
            </div>
            <div class="splitter">
                <select v-model="user.department">
                    <option value="" disabled selected>Select Department</option>
                    <option value="Research">Research</option>
                    <option value="Legal">Legal</option>
                    <option value="ICT">ICT</option>
                    <option value="Placement">Placement</option>
                    <option value="Procurement">Procurement</option>
                </select>
            </div>
            <div class="splitter">
                <select v-model="user.accountType">
                    <option value="" disabled selected>Account Type</option>
                    <option value="Administrative">Administrative</option>
                    <option value="Managerial">Managerial</option>
                    <option value="Normal">Normal</option>
                </select>
            </div>
        </div>
        <div class="module-footer">
            <div class="button-holder">
                <button @click.stop="collectUserData" class="bg-green-500">Create New</button>
                <button @close.stop.prevent="closeModal" class="bg-blue-600">Update</button>
                <button @close.stop.prevent="closeModal" class="bg-red-600">Delete</button>
            </div>
        </div>

    </div>
</template>

<script>
import {mapActions} from "pinia";
import {ModalStore} from "../../../../Pinia/ModalController";

export default {
    name: "UserCreateModal",
    props:['componentData'],
    data(){
        return {
            user: this.$inertia.form({
                firstName:'test',
                lastName:'test',
                email:'test',
                designation:'Contract',
                department:'Research',
                accountType:'Managerial',
            }),
            count:0
        }
    },
    methods:{
        ...mapActions(ModalStore,{
            closeUserModal:'setState'
        }),
        collectUserData(){
            this.user.post(route("apiCreateUser"),{
                onSuccess: () => {
                    alert(this.$page.props.flash.message)
                    this.close_modal()
                }
            })
        },
        close_modal(){
            this.closeUserModal(false)
        }
    },
}
</script>

<style scoped lang="scss">
.user-create{
    width: 800px;
    height: 600px;
    border-radius: 8px;
    background-color: white;
    overflow: auto;
}
.modal-heading{
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    height: 60px;
    border-bottom: 1px solid lightgrey;
    h3{
        margin-left: 20px;
        font-size: 1.4em;
    }
    button{
        background-color: red;
        margin-right: 20px;
        color: white;
    }
}
.module-body{
    padding-top: 20px;
    width: 100%;
    height: 450px;
    background-color: #f5f5f5;
    overflow: auto;
}
.module-footer{
    border-top: 1px solid lightgrey;
    width: 100%;
    height: calc(100% - 60px - 450px);
    .button-holder{
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }
}
button{
    margin-right: 20px;
    color: white;
}
.splitter{
    padding: 0 80px;
    gap: 20px;
    width: 100%;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: space-around;
    margin-bottom: 10px;
}
input,select{
    width: 100%;
    height: 44px;
    align-self: center;
    justify-self: center;
    border: 1px solid lightgrey;
    padding: 5px 5px;
    border-radius: 3px!important;
}

.account-stats{
    width: 100%;
    margin-bottom: 20px;
    padding-bottom: 10px;
    display: flex;
    h2{
        font-size: larger;
        margin-bottom: 20px;
        font-weight: bolder;
        text-decoration: underline;
    }
    .stats-group{
        display: flex;
        margin-bottom: 3px;
    }
    label{
        margin-right: 10px;
        font-weight: bolder;
        color: grey;
    }

}
</style>
