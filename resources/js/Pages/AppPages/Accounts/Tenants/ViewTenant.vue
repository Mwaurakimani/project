<template>
    <Layout>
        <div class="main-body">
            <page-header :attrs="$attrs"/>
            <div class="page-heading">
                <h1>Tenants</h1>
            </div>
            <AccountActionTab></AccountActionTab>
            <div class="main-tab">
                <div class="tenant-display">
                    <section class="split-3">
                        <div class="user-display">
                            <h3>User Details</h3>
                            <div class="items-content">
                                <div class="layer">
                                    <label>Username</label>
                                    <p>{{ tenant.id }}</p>
                                </div>
                                <div class="layer">
                                    <label>Username</label>
                                    <p>{{ tenant.username }}</p>
                                </div>
                                <div class="layer">
                                    <label>Email</label>
                                    <p>{{ tenant.email }}</p>
                                </div>
                                <div class="layer">
                                    <label>Date Created</label>
                                    <p>{{ tenant.date_created }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="house-display">
                            <h3>House Details</h3>
                            <div v-if="house" class="items-content">
                                <div class="layer">
                                    <label>House No.</label>
                                    <p>{{ house.title }}</p>
                                </div>
                                <div class="layer">
                                    <label>Rent Date</label>
                                    <p>{{ rent_details.start_date }}</p>
                                </div>
                                <div class="layer">
                                    <label>Subscriptions</label>
                                    <p>{{ 0 }}</p>
                                </div>

                            </div>
                        </div>
                        <div class="user-stats">
                            <h3>Stats Details</h3>
                            <div class="items-content">
                                <div class="layer">
                                    <label>Deposit</label>
                                    <p>Ksh {{ page_data.total_deposit.count.length > 0?page_data.total_deposit.count[0].sub_total:0 }}</p>
                                </div>
                                <div class="layer">
                                    <label>Arrears</label>
                                    <p>Ksh {{ page_data.all_arrears ? page_data.all_arrears.count:null }}</p>
                                </div>
                                <div class="layer">
                                    <label>Payments</label>
                                    <p>{{ 0 }}</p>
                                </div>
                                <div class="layer">
                                    <label>Balance</label>
                                    <p>{{balance}}</p>
                                </div>

                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="arrears-display">
                            <h3><p>Arrears</p></h3>
                            <div v-if="page_data.all_arrears" class="table-view" style="overflow: auto">
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Description</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <Link as="tr" :href="'#'" v-for="item in page_data.all_arrears.arrears">
                                        <th scope="col"> {{ item.id }}</th>
                                        <td>Ksh {{ item.amount }}</td>
                                        <td style="width:350px;word-wrap: break-word">{{ item.description }}</td>
                                    </Link>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="deposits-display">
                            <h3><p>Deposit</p></h3>
                            <div v-if="page_data.total_deposit.deposits" class="table-view" style="overflow: auto">
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Time Created</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <Link as="tr" :href="'#'" v-for="item in page_data.total_deposit.deposits">
                                        <th scope="col"> {{ item.id }}</th>
                                        <td>Ksh {{ item.amount }}</td>
                                        <td>{{ item.date_created }}</td>
                                    </Link>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="subscriptions-display">
                            <h3><p>Subscription</p></h3>
                            <div v-if="subscriptions && subscriptions.length > 0" class="table-view">
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Details</th>
                                        <th scope="col">Date Started</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr style="border: none" v-for="sub in subscriptions">
                                        <th scope="col">{{ sub.id }}</th>
                                        <td>{{ sub.servce.name }}</td>
                                        <td>{{sub.date_created}}</td>
                                        <td class="hide_remove">Remove</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="events-display">
                            <h3>Events</h3>
                            <div v-if="this.page_data.invites.length > 0" class="invites-holder">
                                <div v-for="invite in this.page_data.invites" class="ivent-card">
                                    <div class="left-section">
                                        <h4>Dec 25, 2022</h4>
                                        <section>
                                            <label>Invite By:</label>
                                            <p>{{ invite.user.username }}</p>
                                        </section>
                                        <section>
                                            <label>Contribution:</label>
                                            <p><span>Ksh</span>2000</p>
                                        </section>
                                        <section>
                                            <label>Status:</label>
                                            <p>{{ invite.status }}</p>
                                        </section>
                                    </div>
                                    <div class="right-section">
                                        <div class="pending-div" v-if="invite.status == 'Pending'">
                                            <button @click="update_invite('Accepted',invite.id)" >Accept</button>
                                            <button @click="update_invite('Rejected',invite.id)" style="background-color: red">Reject</button>
                                        </div>
                                        <div v-else>
                                            <button @click="update_invite('Accepted',invite.id)" v-if="invite.status == 'Rejected'" >Accept</button>
                                            <button @click="update_invite('Rejected',invite.id)" v-else style="background-color: red">Reject</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="side-tab">
                    <h4><p>Heading</p> <span>close</span></h4>
                    <div v-if="page_data.services && house" class="subscription-tab">
                        <div class="input-block">
                            <label for="Service">Service</label>
                            <select v-model="service_selector.select_service">
                                <option value="null">None</option>
                                <option v-for="service in page_data.services" :value="service.id">{{
                                        service.name
                                    }}
                                </option>
                            </select>
                        </div>
                        <button @click="subscribe">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
    </Layout>

</template>

<script>
import ActionBar from "../../../../AppComponents/PageComponents/ActionBar.vue";
import AccountActionTab from "../Components/AccountActionTab.vue";
import FinanceActionTab from "../../Fianance/Components/FinanceActionTab.vue";
import {Inertia} from "@inertiajs/inertia";
import {getCurrentInstance} from "vue";

export default {
    name: "ViewTenant",
    props: ['tenant', 'rent_details', 'house', 'page_data','subscriptions'],
    provide: {
        tab_name: 'Tenants'
    },
    data() {
        return {
            data: [],
            service_selector: Inertia.form({
                select_service: null,
                user_id: this.tenant.id,
                house_id: this.house ? this.house.id : null
            })
        }
    },
    computed:{
        balance(){
            let deposits = this.page_data.total_deposit.count.length > 0?this.page_data.total_deposit.count[0].sub_total:0
            let arrears = this.page_data.all_arrears ? this.page_data.all_arrears.count : 0

            return deposits - arrears;
        }
    },
    components: {
        ActionBar,
        AccountActionTab,
        FinanceActionTab
    },
    methods: {
        subscribe() {
            this.service_selector.post(route('subscribe_to_service'))
        },
        forceInstanceUpdate(){
            this.$forceUpdate();
        },
        update_invite(status,id){

            axios.post(route('updateEventStatus'),{
                status:status,
                invite_id:id
            }).then((resp) => {
                window.location.reload();
            })
        }
    },
}
</script>

<style src="../res/index.scss" lang="scss" scoped></style>
<style lang="scss" scoped>
.main-tab {
    width: 100%;
    display: flex;

    .tenant-display {
        width: 100%;
        height: 800px;

        & > section {
            width: 98%;
            height: 300px;
            margin: auto auto 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;

            & > div {
                border: 1px solid #e5e5e5;

                h3 {
                    font-size: 1.2em;
                    font-weight: bolder;
                    padding: 10px;
                    margin-bottom: 10px;
                    width: 100%;
                    display: flex;
                    justify-content: space-between;

                    span {
                        font-size: 0.9em;
                        color: #0762bb;
                        text-decoration: underline;

                        &:hover {
                            cursor: pointer;
                            color: lightskyblue;
                        }
                    }
                }
            }
        }

        section {
            padding-top: 10px;

            & > div {
                width: 49%;
                height: 100%;
                background-color: white;

            }
        }

        .split-3 {
            padding-top: 10px;

            & > div {
                width: 30%;
                height: 100%;
                background-color: white;

                .items-content {
                    width: 90%;
                    margin: auto;
                    height: auto;

                    .layer {

                        display: flex;

                        label {
                            width: 130px;

                            &::after {
                                content: "  :";
                            }
                        }

                        p {
                            margin: 0px;
                            padding: 0px;
                            color: grey;
                        }
                    }
                }
            }
        }

        & > section {
            .table-view {
                width: 98%;
                height: 230px;
                margin: auto;

                table {
                    border: 1px solid #d7d7d7;
                    font-size: 0.9em;
                    th{
                        border: none;
                    }
                    thead{
                        th{
                            border-bottom: 1px solid #d7d7d7;
                        }
                    }
                    tbody{
                        tr:nth-of-type(even){
                            background-color: #d3eaf8;
                        }
                        tr{
                            :hover{
                                .hide_remove{
                                    display: block;
                                }
                            }
                            .hide_remove{
                                display: none;
                            }
                        }
                    }
                }
            }
        }
    }

    .side-tab {
        border: 1px solid #dadada;
        width: 400px;
        background-color: white;

        h4 {
            justify-content: space-between;
            display: flex;
            width: 100%;
            height: 45px;
            padding: 10px;
            font-size: 1.2em;
            font-weight: bolder;
            border-bottom: 1px solid #dadada;

            span {
                font-size: 0.9em;
                font-weight: 500;
                color: red;
                text-decoration: underline;
                padding: 2px;
                overflow: hidden;
                border-radius: 4px;
                display: block;
                cursor: pointer;
            }
        }
    }
}

.subscription-tab {
    width: 100%;
    height: 400px;
    padding-top: 10px;

    .input-block {
        width: 90%;
        margin: auto;
        display: flex;
        flex-direction: column;
        margin-bottom: 30px;

        select {
            border: 1px solid #c9c9c9;
        }
    }

    button {
        display: block;
        background-color: #0762bb;
        color: white;
        margin: auto;
        width: 80%;
    }
}

.invites-holder{
    padding-top: 10px;
    overflow: auto;
    width: 100%;
    height: 230px;
    .ivent-card{
        width: 90%;
        height: 170px;
        background-color: white;
        margin: auto;
        display: flex;
        box-shadow: 0 0 6px lightgrey;
        margin-bottom: 10px;
        .left-section{
            width: 70%;
            height:100%;
            h4{
                font-weight: bolder;
                font-size: 1.4em;
                padding: 10px;
            }
            section{
                margin-left: 30px;
                display: flex;
                label{
                    width: 120px;
                    font-weight: bolder;
                }
                p{
                    color: grey;
                }
            }
        }
        .right-section{
            width: 29%;
            height: 100%;
            margin-left: 1%;
            display: flex;
            justify-content: center;

            button{
                padding: 0px 40px;
                margin-top: 20px;
                background-color: dodgerblue;
                color: white;
            }
        }
    }
}
</style>
