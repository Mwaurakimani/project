<template>
    <div class="side-bar">
        <div class="logo-wrapper">
            <img src="/storage/logo.png">
        </div>
        <ul class="button-section">
            <Link as="li" :href="route('dashboard')"  class="active-page">Dashboard</Link>
            <Link as="li" :href="route('listIncidents')" >Incidents</Link>
            <Link as="li" :href="route('departments')" >Departments</Link>
            <Link as="li" :href="route('ListUsers')" >Users</Link>
        </ul>
    </div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    props:['active_bar'],
    name: 'side-bar',
    components: {
        Link
    },
    mounted() {
        let activePage = this.active_bar;

        let sideButtons = $('.side-bar .button-section').find("li")

        for (let button of sideButtons){

            if(activePage == button.innerHTML){
                button.classList.add('active-page')
            }else {
                button.classList.remove('active-page')
            }
        }
    }
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

</style>
