import ActionBar from "../../../../AppComponents/PageComponents/ActionBar.vue";
import UserCreateModal from ".././Components/UserCreateModal.vue";
import testComponentModal from ".././Components/testComponentModal.vue";
import {mapState} from 'pinia';
import {mapActions} from "pinia";
import {ModalStore} from "../../../../Pinia/ModalController";

export default {
    name: "Users",
    components: {
        ActionBar,
        UserCreateModal,
        testComponentModal
    },
    props:{
        users:{
            type: Array,
            default: []
        },
    },
    computed:{
        ...mapState(ModalStore,{
            modalState: 'getState'
        }),
        componentData(){
            if (this.modalComponent === 'UserCreateModal' ){
                return this.userComponentData
            }else {
                return this.testComponent
            }
        }
    },
    data(){
        return {
            selectedData:this.$inertia.form({}),
            modalComponent:"UserCreateModal",
            userComponentData:{
                users:this.users
            },
            testComponent:{
                test:{
                    data:"test-data"
                }
            }
        }
    },
    methods:{
        ...mapActions(ModalStore,{
            openModal: 'setState'
        }),
        //UI functions
        open_user_panel(){
            var user_panel = $('.user-info')

            user_panel.css({
                "width":"450px",
                "opacity":"1",
            })
        },
        close_panel(){
            var user_panel = $('.user-info')

            user_panel.css({
                "width":"0px",
                "opacity" : "0",
            })
        },
        openTestComponent(){
            this.modalComponent = 'testComponentModal'
            this.openModal(true)
        },
        openCreateUserModal(){
            this.modalComponent = 'UserCreateModal'
            this.openModal(true)
        },


        // use case functions
        getUserDetails(id){
            fetch(route('apiGetUser',[id]))
                .then((response) => response.json())
                .then((data) => this.selectedData = data);
            this.open_user_panel()
        },
        quickUpdateUser(){
            const options = {
                url:route("apiUpdateUser",this.selectedData.id),
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json;charset=UTF-8'
                },
                data: this.selectedData
            };
            axios(options)
                .then(res => {
                    console.log(res)
                })
        },
    },

}
