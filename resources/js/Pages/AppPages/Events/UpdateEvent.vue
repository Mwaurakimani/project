<template>
    <Layout>
        <div class="main-body">
            <page-header :attrs="$attrs"/>
            <div class="page-heading">
                <h1>Event</h1>
            </div>
            <EventActionTab></EventActionTab>
            <div class="user-pan">
                <div class="form-input">
                    <section>
                        <article class="sub-section">
                            <h2>Title</h2>
                            <div class="form-input-section">
                                <div class="input-group">
                                    <label>Title</label>
                                    <input v-model="eventData.name">
                                    <span>{{ $attrs.errors.name }}</span>
                                </div>
                                <div class="input-group">
                                    <label>Event Day</label>
                                    <input type="date" v-model="eventData.start_date">
                                    <span>{{ $attrs.errors.name }}</span>
                                </div>
                                <div class="input-group">
                                    <label>Description</label>
                                    <textarea v-model="eventData.description"></textarea>
                                    <span>{{ $attrs.errors.name }}</span>
                                </div>
                            </div>
                        </article>
                    </section>
                    <section>
                        <div class="button-section">
                            <button class="update" @click.stop="update_event">Update</button>
                            <button class="delete">Delete</button>
                        </div>
                    </section>
                    <section>
                        <article class="sub-section">
                            <h2>Title</h2>
                            <div class="invite-bar">
                                <input placeholder="Search User" @keyup="get_tenants">
                                <button @click="clear_search">Clear</button>
                            </div>
                            <div style="margin: 30px"  class="dropdown-tab">
                                <ul v-if="block_members.length > 0">
                                    <li v-for="user in block_members" >Username: {{ user.username }} | Email: {{ user.email }} <button @click="invite(user.id)">Invite</button></li>
                                </ul>
                            </div>
                            <div v-if="invites && invite.length>0" class="table-view">
                                <table class="table table-sm">
                                    <thead>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Date Created</th>
                                    <th>Block</th>
                                    <th>House</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    <tr v-for="invite in invites">
                                        <th>{{ invite.id }}</th>
                                        <td>{{ invite.username }}</td>
                                        <td>{{ invite.email }}</td>
                                        <td>{{ invite.created_at }}</td>
                                        <td>{{ invite.block ? invite.block.name :null}}</td>
                                        <td>{{ invite.house ? invite.house.title :null }}</td>
                                        <td style="color: red;cursor: pointer" @click="un_invite(invite.id)" >Remove</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </article>
                    </section>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import EventActionTab from "./Components/EventActionTab.vue";

export default {
    provide: {
        tab_name: 'Events'
    },
    props: ['event','invites'],
    name: "CreateBlock",
    components: {
        EventActionTab
    },
    data() {
        return {
            eventData: this.$inertia.form({
                name: this.event.title,
                start_date: this.event.event_start_date,
                description: this.event.description,
            }),
            block_members:[]
        }
    },
    methods: {
        create_event() {
            this.eventData.post(route('postEvent'));
        },
        update_event() {
            this.eventData.put(route('putEvent', [this.event.id]))
        },
        get_tenants: _.debounce(function(event){
            {
                this.tenants = null
                let value = $(event.target).val()

                if (value.trim() !== '' & value !== undefined) {
                    axios.post(route('search_tenant'), {
                        tenant: value
                    }).then((resp) => {
                        let data = resp.data;

                        if(data.length > 0){
                            this.block_members = data
                        }else {
                            console.log("no data found")
                        }
                    })
                }
            }
        },500),
        invite(id){
            axios.post(route('addToEvent'),{
                event_id : this.event.id,
                user_id : id
            }).then((resp) => {
                let data = resp.data;

                console.log(data)
            })
        },
        clear_search(event){
            $(event.target).parent().find('input').val('')
            this.block_members = []
        },
        un_invite(id){
            console.log(id)
        }
    }
}
</script>

<style lang="scss" scoped>
h2 {
    margin: 0px !important;
}

.invite-bar {
    width: 95%;
    margin: auto;

    input {
        width: calc(100% - 85px);
        height: 40px;
        margin-right: 23px;
        border: 1px solid #dedede;
        padding-left: 10px;
    }
}

.dropdown-tab{
    position: relative;
    width: 95%;
    height: 0px;
    z-index: 1000;
    margin: auto;
    ul{
        max-height: 200px;
        padding: 10px;
        background-color: white;
        width: 100%;
        box-shadow: 0 0 6px lightgrey;
        overflow: auto;
        li{
            padding: 10px;
            display: flex;
            justify-content: space-between;
            button {
                background-color: #74c024;
                color: white;
            }
            &:hover{
                cursor: pointer;
                background-color: #92c3f5;
                color: white;
            }
        }
    }
}

.table-view{
    width: 95%;
    margin: auto;
    table{
        border: 1px solid lightgrey;
        thead{
            th{
                padding: 5px;
                border-bottom: 1px solid lightgrey;
            }
        }
        tbody{
            tr:nth-of-type(even){
                background-color: lightskyblue;
            }
        }
    }
}
</style>
