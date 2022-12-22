<template>
    <div class="form-action-tab">
        <div class="action-button-wrapper">
            <Link as="button" :href="'/Blocks'">List</Link>
            <Link as="button" :href="'/Blocks/Create'">Add Block</Link>
        </div>
    </div>
</template>
<script>
export default {
  name: 'BlockActionTab',
}
</script>
