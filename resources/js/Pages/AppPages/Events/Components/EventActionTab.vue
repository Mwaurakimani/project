<template>
    <div class="form-action-tab">
        <div class="action-button-wrapper">
            <Link as="button" :href="'/Events'">List</Link>
            <Link as="button" :href="'/Events/Create'">Add Event</Link>
        </div>
    </div>
</template>
<script>
export default {
    name: 'EventsActionTab',
}
</script>

