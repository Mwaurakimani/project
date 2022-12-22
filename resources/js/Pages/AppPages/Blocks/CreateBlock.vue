<template>
    <Layout>
        <div class="main-body">
            <page-header :attrs="$attrs" />
            <div class="page-heading">
                <h1>Blocks</h1>
            </div>
            <BlockActionTab></BlockActionTab>
            <div class="user-pan" >
                <div class="form-input">
                    <section>
                        <article class="sub-section">
                            <h2>Title</h2>
                            <div class="form-input-section">
                                <div class="input-group">
                                    <label>Name</label>
                                    <input v-model="blockData.name" >
                                    <span>{{ $attrs.errors.name }}</span>
                                </div>
                                <div class="input-group">
                                    <label>Location</label>
                                    <input v-model="blockData.location" >
                                    <span>{{ $attrs.errors.location }}</span>
                                </div>
                                <div class="input-group">
                                    <label>Description</label>
                                    <input v-model="blockData.description" >
                                    <span>{{ $attrs.errors.description }}</span>
                                </div>

                            </div>
                        </article>

                    </section>
                    <section>
                        <div class="button-section">
                            <button class="create" @click=" create_block ">Create</button>
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
import BlockActionTab from "./Components/BlockActionTab.vue";

export default {
    provide:{
        tab_name: 'Block'
    },
    name: "CreateBlock",
    components:{
        BlockActionTab
    },
    data() {
        return {
            blockData:this.$inertia.form({
                name:null,
                location:null,
                description:null,
            })
        }
    },
    methods:{
        create_block(){
            this.blockData.post(route('postBlock'));
        }
    }
}
</script>

<style scoped>

</style>
