<template>
    <Layout :active_page="'Dashboard'">
        <div class="main-body">
            <page-header/>
            <div class="page-heading">
                <h1>Dashboard</h1>
                <div class="bread-crumbs">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Library</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="form-action-tab">
                <div class="action-button-wrapper">
                    <button>Add New</button>
                    <button>Add New</button>
                    <button>Add New</button>
                </div>
            </div>

<!--            <action-bar/>-->

            <div class="table-bolder">
                <div class="table-header">
                    <h4>Table Heading</h4>
                    <div class="table-pagination">
                        <nav aria-label="Page navigation example">
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
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </Layout>

</template>

<script>
import ActionBar from "../AppComponents/PageComponents/ActionBar.vue";

export default {
    name: "Dashboard",
    components: {ActionBar},
    provide:{
        tab_name: 'Dashboard'
    }
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
        }
    }

    tbody {
        color: #494949;
        tr{
            border-bottom: 1px solid #e8e8e8;
            th{
                border-bottom: none;
            }
            td{
                border-bottom: none;
            }
        }
    }
}
</style>

