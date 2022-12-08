<template>
    <div class="dashboard-holder">
        <side-bar :active_bar="active_page"/>
        <slot></slot>
    </div>
</template>
<script>
export default {
    props: ['active_page'],
    name: 'Layout'
}
</script>
<style lang="scss" scoped>
.dashboard-holder {
    width: 100vw;
    height: 100vh;
    display: flex;
    background-color: #faf6f6;
}

</style>
