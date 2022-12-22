<template>
    <div class="form-action-tab">
        <div class="action-button-wrapper">
            <Link as="button" :href="'/Deposits'">Deposits</Link>
            <Link as="button" :href="'/Payments'">Payments</Link>
            <Link as="button" :href="'/Arrears'">Arrears</Link>
        </div>
        <div class="user-pan">
            <div class="table-bolder shadowed-table">
                <div class="table-header">
                    <h4>Finances</h4>
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
                        <th scope="col">Tenant</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date Created</th>
                    </tr>
                    </thead>
                    <tbody>
                    <Link as="tr" :href="'#'"  v-for="block in blocks">
                        <th scope="row">{{ blcok.id }}</th>
                    </Link>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'FinanceActionTab',
}
</script>

