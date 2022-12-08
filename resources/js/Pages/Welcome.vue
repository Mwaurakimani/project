<template>
    <div class="bg-holder">
        <div class="log-in-wrapper">
            <div class="background-effect">

            </div>
            <form class="login-section" onsubmit="event.preventDefault()">
                <h1>Log In</h1>
                <div >
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input v-model="form.email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text text-red-400">{{ $attrs.errors ? $attrs.errors.email : '' }}</div>
                </div>
                <div class="mb-[30px]">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input v-model="form.password" type="password" class="form-control" id="exampleInputPassword1">
                    <div id="emailHelp" class="form-text text-red-400">{{ $attrs.errors ? $attrs.errors.password : '' }}</div>
                </div>
                <button @click="login" class="btn bg-primary text-white">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
import {useStore} from "../Pinia/Store";
import {reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";

export default {
    name: "Welcome",
    setup() {
        const store = useStore();
        const form = reactive(({
            email:null,
            password:null,
            remember: 'on',
        }))
        let cot = store.count;

        return {cot,form}
    },
    methods:{
        login(){
            Inertia.post(route('login'),this.form)
        }
    }
}
</script>

<style scoped lang="scss">
.bg-holder {
    width: 100%;
    height: 100%;
    background-image: url("./storage/background-image.jpg");
    align-items: center;
    justify-content: center;
    mix-blend-mode: multiply;
    background-position: center;
    background-size: cover;
    overflow: hidden;


    .log-in-wrapper {
        width: 100vw;
        height: 100vh;
        background-color: rgba(black,0.6);


        .background-effect {
            width: 100vw;
            height: 100vh;
            filter: blur(1px);
        }

        .login-section {
            width: 500px;
            filter: none;
            height: 430px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 6px #424242;
            position: absolute;
            top: calc((100vh - 430px) / 2);
            left: calc((100vw - 500px) / 2);
            h1{
                font-size:2.5em;
                padding: 20px;
                //border-bottom: 2px solid rgb(121, 120, 120);
                text-align: center;
            }

            &>div{
                padding:10px 20px;
                input{
                    border-radius: 2px !important;
                }
            }

            button{
                display: block;
                width: 200px;
                margin: auto;
            }
        }
    }

}
</style>
