<template>
    <Layout>
        <div class="main-body">
            <page-header :attrs="$attrs" />
            <div class="page-heading">
                <h1>Services</h1>
            </div>
            <service-action-tab></service-action-tab>
            <div class="user-pan">
                <div class="table-bolder shadowed-table">
                    <div class="table-header">
                        <h4>Service List</h4>
                        <div class="table-pagination">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <li class="page-item "><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link active-page" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Total Active Subscribers</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <Link as="tr" :href="'#'"  v-for="service in services">
                            <th scope="row">{{ service.id }}</th>
                            <td>{{ service.name }}</td>
                            <td>{{ service.total_active }}</td>
                            <Link as="td" @click.stop :href="route('UpdateService',service.id)" class="table-action-cell">
                                <div class="holder">
                                    <div class="view-action">
                                        <img src="/storage/icons/icons8-external-link-96-blue.png"
                                             onmouseover="this.src='/storage/icons/icons8-external-link-96.png'"
                                             onmouseout="this.src='/storage/icons/icons8-external-link-96-blue.png'"
                                             title="edit">
                                    </div>
                                </div>
                            </Link>
                        </Link>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </Layout>

</template>

<script>
import ActionBar from "../../../AppComponents/PageComponents/ActionBar.vue";
import ServiceActionTab from "./Components/ServiceActionTab.vue";

export default {
    provide:{
        tab_name: 'Services'
    },
    name: "Dashboard",
    props:{
        services:{
            type: Array,
            default: []
        }
    },
    components: {
        ActionBar,
        ServiceActionTab
    },
}
</script>

<style lang="scss" scoped>
.main-body {
    width: calc(100vw - 260px);
    margin-left: 5px;

    div {
        margin-bottom: 15px;
    }
}

.page-heading {
    display: flex;
    padding: 10px;
    justify-content: space-between;
    margin-bottom: 5px !important;

    h1 {
        font-size: larger;
        font-weight: 700;
    }

    .bread-crumbs {
        margin-bottom: 0px;

        ol {
            margin: 0px;
        }
    }
}

.table-bolder {
    width: 98%;
    margin: auto;
    background-color: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 6px lightgrey;

    .table-header {
        width: 100%;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0px 10px;
        border-bottom: 1px solid #e8e8e8;
        margin: 0px;

        h4 {
            font-size: 1.1em;
            font-weight: 600;
        }

        .table-pagination {
            height: 100%;
            width: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0px;

            * {
                border: none;
                margin: 0 2px;
                border-radius: 8px;

                .pagination {
                    li {
                        padding: 0px;
                        width: 25px;

                        a {
                            padding: 5px;
                            width: 25px;
                            text-align: center;
                        }
                    }
                }
            }

            .active-page {
                background-color: dodgerblue;
                color: white;
            }
        }
    }
}

.form-action-tab{
    margin: auto;
    width: 98%;
    height: 50px;
    background-color: white;
    .action-button-wrapper{
        width: fit-content;
        height: 100%;
        display: flex;
        align-items: center;

        button{
            height: 35px;
            padding: 0px 5px !important;
            background-color: dodgerblue;
            color: white;
            margin: 0px 5px;
        }
    }
}

.table {
    font-size: 0.9em;
    margin-bottom: 0px;

    thead {
        tr {
            background-color: #e8e8e8;
            border-bottom: 1px solid #e8e8e8;

            th {
                font-weight: bolder;
                border: none;
                font-size: 0.95em;
            }
            th:last-of-type{
                width: 150px;
                text-align: center;
            }
        }
    }

    tbody {
        color: #494949;
        tr{
            cursor: pointer;
            border-bottom: 1px solid #e8e8e8;
            th{
                line-height: 30px;
                border-bottom: none;
            }
            td{
                line-height: 30px;
                height: 30px;
                border-bottom: none;
                vertical-align: center;
            }

            &:hover{
                color: white;
                background-color: #a0caf3;
            }

        }
    }
}
</style>

