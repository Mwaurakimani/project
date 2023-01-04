<template>
    <Layout>
        <div class="main-body">
            <page-header :attrs="$attrs" />
            <div class="page-heading">
                <h1>Blocks</h1>
            </div>
            <BlockActionTab></BlockActionTab>
            <div class="user-pan">
                <div class="table-bolder shadowed-table">
                    <div class="table-header">
                        <h4>Block List</h4>
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
                            <th scope="col">Location</th>
                            <th scope="col">Total Houses</th>
                            <th scope="col">Occupied</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <Link as="tr" :href="'#'"  v-for="block in blocks">
                            <th scope="row">{{ block.id }}</th>
                            <td>{{ block.name }}</td>
                            <td>{{ block.location }}</td>
                            <td>{{ block.totalhouses }}</td>
                            <td>{{ block.totalhousesOccunpued }}</td>
                            <td class="table-action-cell">
                                <div class="holder">
                                    <div class="view-action">
                                        <img src="/storage/icons/icons8-external-link-96-blue.png"
                                             onmouseover="this.src='/storage/icons/icons8-external-link-96.png'"
                                             onmouseout="this.src='/storage/icons/icons8-external-link-96-blue.png'"
                                             title="edit">
                                    </div>
                                </div>
                            </td>
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
import BlockActionTab from "./Components/BlockActionTab.vue";

export default {
    provide:{
        tab_name: 'Block'
    },
    name: "Dashboard",
    props:{
        blocks:{
            type: Array,
            default: []
        }
    },
    components: {
        ActionBar,
        BlockActionTab
    },
}
</script>
<style lang="scss" scoped></style>

