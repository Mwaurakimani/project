<template>
    <div class="form-action-tab">
        <div class="action-button-wrapper">
            <Link as="button" :href="'/Accounts'">List</Link>
            <Link as="button" :href="'/Accounts/Create'">Add User</Link>
        </div>
    </div>
</template>
<script>
export default {
  name: 'AccountActionTab'
}
</script>
