<template>
    <Layout >
        <template v-slot:mobile >
            <navigation-bar>
                <div class="header-display w-[100%]" style="display: flex;align-items: center" >
                    <h4 style="font-weight: bolder;font-size: 1.4em;color:white;line-height: 55px" >Make Payment</h4>
                </div>
            </navigation-bar>


            <div class="card-display">
                <h2>Deposit details</h2>
                <div class="input-group">
                    <input type="text" @keyup="get_deposit_details" v-model="transition.deposit_id">
                    <div v-if="deposit !== null" class="suggestion">
                        <div class="input-group">
                            <label>ID</label>
                            <p>: {{ deposit.id }}</p>
                        </div>
                        <div class="input-group">
                            <label>Tenant</label>
                            <p>: {{deposit.tenant.username}}</p>
                        </div>
                        <div class="input-group">
                            <label>Amount</label>
                            <p>: {{deposit.amount}}</p>
                        </div>
                    </div>
                    <div v-else class="suggestion">
                        <p>No data Found</p>
                    </div>
                </div>
            </div>

            <div class="card-display">
                <h2>Arrears details</h2>
                <div class="input-group">
                    <input type="text" @keyup="get_arrears_details" v-model="transition.arrears_id">
                    <div v-if="arrears !== null" class="suggestion">
                        <div class="input-group">
                            <label>ID:</label>
                            <p>{{ arrears.id }}</p>
                        </div>
                        <div class="input-group">
                            <label>Description:</label>
                            <p>{{arrears.description}}</p>
                        </div>
                        <div class="input-group">
                            <label>Amount:</label>
                            <p>{{ arrears.amount }}</p>
                        </div>
                    </div>
                    <div v-else class="suggestion">
                        <p>No data Found</p>
                    </div>
                </div>
<!--                <p class="p-[15px]">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto cum doloribus </p>-->
            </div>

            <div class="transaction-data">
                <h2>Amount</h2>
                <input type="text" placeholder="Amount" v-model="transition.amount">
                <div class="display-group">
                    <label>Arrears Balance :</label>
                    <p>Arrears  Balance</p>
                </div>
                <div class="display-group" style="margin-bottom: 40px">
                    <label>Deposit Balance :</label>
                    <p>Arrears  Balance</p>
                </div>
                <button class="w-[100%] bg-blue-600 text-white" @click="make_payment">Confirm</button>
            </div>

        </template>
    </Layout>

</template>

<script>
import NavigationBar from "./NavigationBar.vue";

export default {
  name: "listBlocks",
    components: {NavigationBar},
    provide:{
        tab_name:'Dashboard'
    },
    data(){
      return {
          transition:this.$inertia.form({
              deposit_id:null,
              arrears_id:null,
              amount:null
          }),
          deposit:null,
          arrears:null
      }
    },
    methods:{
        get_deposit_details: _.debounce(function(event){
            {
                let value = $(event.target).val()

                axios.post(route('search_deposit_by_id'), {
                    deposit_id: value

                }).then((resp) => {
                    if (resp.data){
                        if(resp.data.deposit){
                            this.deposit = resp.data.deposit
                        }else {
                            this.deposit = null
                        }
                    }else {

                    }
                })
            }
        },500),
        get_arrears_details: _.debounce(function(event){
            {
                let value = $(event.target).val()

                axios.post(route('search_arrears_by_id'), {
                    arrears_id: value

                }).then((resp) => {
                    if (resp.data){
                        if(resp.data.arrears){
                            this.arrears = resp.data.arrears
                        }else {
                            this.arrears = null
                        }
                    }else {

                    }
                })
            }
        },500),
        make_payment(){
            let accepted = confirm("Are you sure you wish make this translation?")

            if(accepted){
                this.transition.post(route('postMobileTransaction'))
            }else {
                alert("Transaction canceled")
            }
        }
    }
}
</script>

<style scoped lang="scss">
.card-display{
    width: 90%;
    background-color: white;
    box-shadow: 0 0 6px #b4b4b4;
    margin: auto auto 20px;
    border-radius: 8px;
    padding-bottom: 20px;
    h2{
        padding: 15px;
        font-size: 1.1em;
    }
    input{
        display: block;
        width: 90%;
        height: 35px;
        border: 1px solid lightgrey;
        border-radius: 8px;
        margin: auto;
        margin-bottom: 10px;
    }
}

.suggestion{
    width: 90%;
    margin: auto !important;
    padding: 20px;
    background-color: #ececec;
    .input-group{
        display: flex;
        label{
            width: 100px;
            margin-bottom: 10px;
        }
    }
}

.transaction-data{
    width: 100%;
    height: 300px;
    padding: 5vw;

    h2{
        margin-bottom: 10px;
        font-weight: bolder;
    }

    input{
        display: block;
        width: 100%;
        height: 35px;
        border: 1px solid lightgrey;
        border-radius: 8px;
        margin: auto;
        margin-bottom: 20px;
    }
    .display-group{
        display: flex;
        margin-bottom: 10px;
        label{
            font-weight: bolder;
            width: 150px;
        }
    }
}

</style>
