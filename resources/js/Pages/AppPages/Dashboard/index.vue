<template>
    <Layout page_props="page_props">
        <div class="main-body">
            <page-header :attrs="$attrs" />
            <div class="page-heading">
                <h1>Dashboard</h1>
            </div>
            <div class="display-elements">
                <div class="display-box" style="background-color: #f3c166;">
                    <h3>Occupants</h3>
                    <p>100</p>
                </div>
                <div class="display-box" style="background-color: #aaf166;">
                    <h3>Deposits</h3>
                    <p>100</p>
                </div>
                <div class="display-box" style="background-color: #f57e7e;">
                    <h3>Arrears</h3>
                    <p>100</p>
                </div>
            </div>
            <div class="filter-bar">
                <h3>Statistics</h3>
                <div class="filter-section">
                    <input type="date">
                    <p>to</p>
                    <input type="date">
                    <button>Apply</button>
                </div>
            </div>
            <chart-section :chartData="chartData" />
        </div>
        <template v-slot:mobile >
            <div class="mobile-view">
                <div class="welcome-bar">
                    <div class="welcome-details">
                        <p>Welcome</p>
                        <h1>Username</h1>
                    </div>
                    <div class="account-display">
                        <div class="account-icon">

                        </div>
                    </div>
                </div>
                <Link href="/mobile/Blocks" as="div" class="block-section">
                    Blocks
                </Link>
                <Link href="/mobile/Houses" as="div" class="block-section mb-[40px]">
                    Houses
                </Link>
                <div class="split-pan w-[95%]  mx-[auto] mb-[20px] h-[100px] flex" style="justify-content: space-between">
                    <Link href="/mobile/Deposits" as="div" class="block-section" style="margin: 0px;margin-right: 10px">
                        Deposits
                    </Link>
                    <Link href="/mobile/Arrears" as="div" class="block-section" style="margin: 0px">
                        Arrears
                    </Link>
                </div>
                <Link href="/mobile/Payments" as="div" class="block-section">
                    Payments
                </Link>

            </div>
        </template>
    </Layout>

</template>

<script>
import ChartSection from "./ChartSection.vue";

export default {
    name: "Dashboard",
    provide:{
        tab_name:'Dashboard'
    },
    props:{
        users:{
            type: Array,
            default: []
        }
    },
    data(){
        return {
            chartData:[
                ['Jan', 10000, 500],
                ['Feb', 200, 5000],
                ['Mar', 3000, 10000],
                ['Apr', 40000, 2250],
                ['May', 500, 2250],
            ]
        }
    },
    components: {ChartSection},
}
</script>

<style lang="scss" scoped>
@import "./index";
</style>
