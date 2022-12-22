<template>
    <Layout>
        <div class="main-body">
            <page-header :attrs="$attrs" />
            <div class="page-heading">
                <h1>Admin</h1>
            </div>

            <AccountActionTab></AccountActionTab>
            <div class="user-pan">
                <div class="table-bolder shadowed-table">
                    <div class="table-header">
                        <h4>Admins List</h4>
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
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Account Type</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <Link as="tr" :href="'#'"  v-for="user in users">
                            <th scope="row">{{ user.id }}</th>
                            <td>{{ user.username }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.account_type }}</td>
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
import ActionBar from "../../../../AppComponents/PageComponents/ActionBar.vue";
import AccountActionTab from "../Components/AccountActionTab.vue";

export default {
    provide:{
        tab_name: 'Admin'
    },
    props:['users'],
    components: {
        ActionBar,
        AccountActionTab
    },
}
</script>

<style src="../res/index.scss" lang="scss" scoped></style>
