<template>
    <Layout>
        <div class="main-body">
            <page-header :attrs="$attrs" />
            <div class="page-heading">
                <h1>Payments</h1>
            </div>
            <div class="form-action-tab">
                <div class="action-button-wrapper">
                    <Link as="button" :href="'/Deposits'">Deposits</Link>
                    <Link as="button" :href="'/Payments'">Payments</Link>
                    <Link as="button" :href="'/Arrears'">Arrears</Link>
                </div>
            </div>
            <div class="user-pan">
                <div class="holder">
                    <div class="table-bolder">
                        <div class="table-header">
                            <h4>Payments</h4>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Deposit ID</th>
                                <th scope="col">Arrears ID</th>
                                <th scope="col">Amount</th>
                                <th scope="col" style="text-align: start">Time Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr :href="'#'"  v-for="item in payments">
                                <th scope="col"> {{ item.id }}</th>
                                <td>{{ item.deposit_id }}</td>
                                <td>{{ item.arrears_id }}</td>
                                <td>Ksh {{ item.amount }}</td>
                                <td>{{ item.date_created }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="input-form">
                    <h3>Payment</h3>
                    <div class="input-2-split">
                        <div class="inp_grp">
                            <label>Deposit Reference</label>
                            <input>
                        </div>
                        <div class="inp_grp">
                            <label>Arrears Reference</label>
                            <input>
                        </div>
                    </div>
                    <div class="input-2-split">
                        <div class="inp_grp">
                            <label>Amount</label>
                            <input>
                        </div>
                    </div>
                    <div class="input-2-split">
                        <div class="inp_grp">
                            <label>Notes</label>
                            <textarea></textarea>
                        </div>
                    </div>
                    <div class="input-2-split">
                        <div class="inp_grp">
                            <button>Save</button>
                        </div>
                        <div class="inp_grp">
                            <button>Delete</button>
                        </div>
                        <div class="inp_grp">
                            <button>Clear</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </Layout>

</template>

<script>
import ActionBar from "../../../../AppComponents/PageComponents/ActionBar.vue";

export default {
    provide:{
        tab_name: 'Payments'
    },
    name: "Dashboard",
    props:['payments'],
    components: {
        ActionBar,
    },


}
</script>

<style lang="scss" scoped>
@import "index";

.input-form{
    h3{
        padding: 10px;
        font-size: 1.4em;
        font-weight: bolder;
    }
    .input-2-split{
        width: 100%;
        display: flex;
        align-items: start;
        justify-content: space-between;
        margin-bottom: 0px;
        .inp_grp{
            width: 100%;
            padding: 15px;
            display: flex;
            flex-direction: column;
            label{
                height: 40px;
                width: 100%;
            }
            input{
                width: 100%;
                height: 40px;
                border: 1px solid lightgrey;
                padding-left: 5px;
            }
            textarea{
                border: 1px solid lightgrey;
                padding-left: 5px;
                height: 150px;
            }
            button{
                background-color: cornflowerblue;
                color: white;
            }
        }
    }
}
</style>

