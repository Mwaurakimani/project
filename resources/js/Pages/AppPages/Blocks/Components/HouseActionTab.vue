<template>
    <div class="form-action-tab">
        <div class="action-button-wrapper">
            <Link as="button" :href="'/Houses'">List</Link>
            <Link as="button" :href="'/Houses/Create'">Add House</Link>
        </div>
    </div>
</template>
<script>
export default {
  name: 'BlockActionTab',
}
</script>
