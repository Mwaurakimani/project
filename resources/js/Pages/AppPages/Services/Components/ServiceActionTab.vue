<template>
    <div class="form-action-tab">
        <div class="action-button-wrapper">
            <Link as="button" :href="'/Services'">List</Link>
            <Link as="button" :href="'/Services/Create'">Add Services</Link>
        </div>
    </div>
</template>
<script>
export default {
  name: 'ServiceActionTab',
}
</script>
