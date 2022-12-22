<template>
    <Layout>
        <div class="main-body">
            <page-header :attrs="$attrs" />
            <div class="page-heading">
                <h1>Event</h1>
            </div>
            <EventActionTab></EventActionTab>
            <div class="user-pan" >
                <div class="form-input">
                    <section>
                        <article class="sub-section">
                            <h2>Title</h2>
                            <div class="form-input-section">
                                <div class="input-group">
                                    <label>Title</label>
                                    <input v-model="eventData.title" >
                                    <span>{{ $attrs.errors.name }}</span>
                                </div>
                                <div class="input-group">
                                    <label>Event Day</label>
                                    <input v-model="eventData.start_date" >
                                    <span>{{ $attrs.errors.name }}</span>
                                </div>
                                <div class="input-group">
                                    <label>Description</label>
                                    <textarea v-model="eventData.description" ></textarea>
                                    <span>{{ $attrs.errors.name }}</span>
                                </div>
                            </div>
                        </article>
                    </section>
                    <section>
                        <div class="button-section">
                            <button class="create" @click=" create_event ">Create</button>
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
import EventActionTab from "./Components/EventActionTab.vue";

export default {
    provide:{
        tab_name: 'Events'
    },
    name: "CreateBlock",
    components:{
        EventActionTab
    },
    data() {
        return {
            eventData:this.$inertia.form({
                name:null,
                start_date:null,
                description:null,
            })
        }
    },
    methods:{
        create_event(){
            this.eventData.post(route('postBlock'));
        }
    }
}
</script>
