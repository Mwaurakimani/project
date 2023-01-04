<template>
    <Layout>
        <div class="main-body">
            <page-header :attrs="$attrs" />
            <div class="page-heading">
                <h1>Service</h1>
            </div>
            <ServiceActionTab></ServiceActionTab>
            <div class="user-pan" >
                <div class="form-input">
                    <section>
                        <article class="sub-section">
                            <h2>Title</h2>
                            <div class="form-input-section">
                                <div class="input-group">
                                    <label>Name</label>
                                    <input v-model="serviceData.name" >
                                    <span>{{ $attrs.errors.name }}</span>
                                </div>
                                <div class="input-group">
                                    <label>Description</label>
                                    <textarea v-model="serviceData.description" ></textarea>
                                    <span>{{ $attrs.errors.description }}</span>
                                </div>
                                <div class="input-group">
                                    <label>Price</label>
                                    <input v-model="serviceData.price" >
                                    <span>{{ $attrs.errors.price }}</span>
                                </div>
                            </div>
                        </article>
                    </section>
                    <section>
                        <div class="button-section">
                            <button class="update" @click="update_service">Update</button>
                            <button class="delete">Delete </button>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import ServiceActionTab from "./Components/ServiceActionTab.vue";


export default {
    props:['service'],
    provide:{
        tab_name: 'Services'
    },
    name: "CreateBlock",
    components:{
        ServiceActionTab
    },
    data() {
        return {
            serviceData:this.$inertia.form({
                name:this.service?this.service.name:null,
                description:this.service?this.service.description:null,
                price:this.service?this.service.price:null
            })
        }
    },
    methods:{
        create_service(){
            this.serviceData.post(route('postService'));
        },
        update_service(){
            this.serviceData.put(route('putService',this.service.id));
        }
    }
}
</script>

<style scoped>

</style>
