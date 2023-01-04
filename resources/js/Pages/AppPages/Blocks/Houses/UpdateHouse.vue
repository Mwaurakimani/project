<template>
    <Layout>
        <div class="main-body">
            <page-header :attrs="$attrs"/>
            <div class="page-heading">
                <h1>Houses</h1>
            </div>
            <HouseActionTab></HouseActionTab>
            <div class="user-pan">
                <div class="form-input">
                    <section>
                        <article class="sub-section">
                            <h2>Title</h2>
                            <div class="form-input-section">
                                <div class="input-group">
                                    <label>House Number</label>
                                    <input v-model="houseData.title">
                                    <span>{{ $attrs.errors.house_number }}</span>
                                </div>
                                <div class="input-group">
                                    <label>House Block</label>
                                    <input v-model="houseData.block_id">
                                    <span>{{ $attrs.errors.block_id }}</span>
                                </div>
                                <div class="input-group">
                                    <label>Description</label>
                                    <input v-model="houseData.description">
                                    <span>{{ $attrs.errors.description }}</span>
                                </div>
                                <div class="input-group">
                                    <label>Rent Amount</label>
                                    <input v-model="houseData.rent_amount">
                                    <span>{{ $attrs.errors.rent_amount }}</span>
                                </div>
                            </div>
                        </article>
                        <article class="sub-section">
                            <h2>Title</h2>
                            <div class="form-input-section">
                                <div class="input-group" style="margin-bottom: 0px !important;">
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
                            <button class="update" @click=" update_house ">Update</button>
                            <button class="delete">Delete</button>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import HouseActionTab from "../Components/HouseActionTab.vue";
import Select_tenant from "./Select_tenant.vue";

export default {
    props: ['house','tenant'],
    provide: {
        tab_name: 'Houses'
    },
    name: "UpdateHouse",
    components: {
        Select_tenant,
        HouseActionTab
    },
    data() {
        return {
            houseData: this.$inertia.form({
                title: this.house.title,
                block_id: this.house.block_id,
                description: this.house.description,
                rent_amount: this.house.rent_amount,
                tenant: {
                    id: this.tenant?this.tenant.id:null,
                    username:this.tenant?this.tenant.username:null
                }
            }),
            tenants:null
        }
    },
    methods: {
        update_house() {
            this.houseData.put(route('putHouse', [this.house.id]));
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

