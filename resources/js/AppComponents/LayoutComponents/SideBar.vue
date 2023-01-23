<template>
    <div class="side-bar">
        <div class="logo-wrapper">
            <img src="/storage/logo.png">
        </div>
        <ul class="button-section">
            <Link v-for="button in buttons" as="li" :href="route(button.link)" :class="[button.sub ? 'sub-button' : '',button.title === tab_name ? 'active-page':'']">{{button.title}}</Link>
        </ul>
    </div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    props:['active_bar'],
    inject:['tab_name'],
    name: 'side-bar',
    components: {
        Link
    },
    data(){
        return {
            buttons: [
                {
                    title:'Dashboard',
                    link:'dashboard',
                    sub:false,
                },
                {
                    title:'Accounts',
                    link:'Accounts',
                    sub:false
                },
                {
                    title:'Admin',
                    link:'Admins',
                    sub:true
                },
                {
                    title:'Agents',
                    link:'Agents',
                    sub:true
                },
                {
                    title:'Tenants',
                    link:'Tenants',
                    sub:true
                },
                {
                    title:'Block',
                    link:'Blocks',
                    sub:false
                },
                {
                    title:'Houses',
                    link:'Houses',
                    sub:true
                },
                {
                    title:'Services',
                    link:'Services',
                    sub:false
                },
                {
                    title:'Events',
                    link:'Events',
                    sub:false
                },
                {
                    title:'Finance',
                    link:'Finances',
                    sub:false
                },
                {
                    title:'Arrears',
                    link:'Arrears',
                    sub:true
                },
                {
                    title:'Deposits',
                    link:'Deposits',
                    sub:true
                },

            ]
        }
    },
}
</script>
<style scoped lang="scss">

.side-bar {
    width: 250px;
    height: 100vh;
    background-color: #1f2937;
    box-shadow: 0 0 6px grey;

    .logo-wrapper {
        width: 100%;
        height: 150px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .button-section {
        width: 100%;

        li {
            width: 100%;
            height: 40px;
            margin-bottom: 2px;
            padding-left: 20px;
            line-height: 40px;
            color: white;
            cursor: pointer;

            &:hover {
                background-color: #0f89ff;
            }

            &:active {
                background-color: #0762bb;
            }
        }

        .active-page {
            background-color: dodgerblue;
        }
    }
}

.sub-button{
    padding-left: 50px !important;
    &::before{
        content: '| ';
    }
}

</style>
