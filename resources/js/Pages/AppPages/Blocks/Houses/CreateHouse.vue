<template>
    <Layout>
        <div class="main-body">
            <page-header :attrs="$attrs" />
            <div class="page-heading">
                <h1>Houses</h1>
            </div>
            <HouseActionTab></HouseActionTab>
            <div class="user-pan" >
                <div class="form-input">
                    <section>
                        <article class="sub-section">
                            <h2>Title</h2>
                            <div class="form-input-section">
                                <div class="input-group">
                                    <label>House Number</label>
                                    <input v-model="houseData.title" >
                                    <span>{{ $attrs.errors.house_number }}</span>
                                </div>
                                <div class="input-group">
                                    <label>House Block</label>
                                    <input v-model="houseData.block_id" >
                                    <span>{{ $attrs.errors.block_id }}</span>
                                </div>
                                <div class="input-group">
                                    <label>Description</label>
                                    <input v-model="houseData.description" >
                                    <span>{{ $attrs.errors.description }}</span>
                                </div>
                                <div class="input-group">
                                    <label>Rent Amount</label>
                                    <input v-model="houseData.rent_amount" >
                                    <span>{{ $attrs.errors.rent_amount }}</span>
                                </div>
                            </div>
                        </article>
                        <article class="sub-section">
                            <h2>Title</h2>
                            <div class="form-input-section">
                                <div class="input-group">
                                    <label>Tenant Name</label>
                                    <input v-model="houseData.tenant.username" @keyup="get_tenants">
                                    <span>{{ $attrs.errors.tenant }}</span>
                                </div>
                                <select_tenant :select_tenant="select_tenant" :tenants="tenants"/>
                            </div>
                        </article>
                    </section>
                    <section>
                        <div class="button-section">
                            <button class="create" @click=" create_house ">Create</button>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import HouseActionTab from "../Components/HouseActionTab.vue";
import select_tenant from "./Select_tenant.vue";

export default {
    provide:{
        tab_name: 'Houses'
    },
    name: "CreateBlock",
    components:{
        select_tenant,
        HouseActionTab
    },
    data() {
        return {
            houseData:this.$inertia.form({
                title:null,
                block_id:null,
                description:null,
                rent_amount:null,
                tenant:{
                    id:null,
                    username:null
                }
            }),
            tenants:null
        }
    },
    methods:{
        create_house(){
            this.houseData.post(route('postHouse'));
        },
        get_tenants: _.debounce(function(event){
            {
                this.tenants = null
                let value = event.target.value

                if (value.trim() !== '' & value !== undefined) {
                    axios.post(route('search_tenant'), {
                        tenant: value
                    }).then((resp) => {
                        let data = resp.data;

                        if(data.length > 0){
                            this.tenants = data
                        }else {
                            console.log("no data found")
                        }
                    })
                }
            }
        },500),
        select_tenant(event){
            let elem = $(event.currentTarget)

            this.houseData.tenant.id  = elem.find('td:nth-child(1)').text()
            this.houseData.tenant.username  = elem.find('td:nth-child(2)').text()

            this.tenants = null
        },
    }
}
</script>

<style scoped>

</style>
