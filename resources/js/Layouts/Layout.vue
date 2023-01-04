<template>
    <div class="dashboard-holder">
        <side-bar :active_bar="active_page"/>
        <slot></slot>
    </div>
    <div class="mobile-display">
        <slot name="mobile"></slot>
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
    overflow: hidden;
}

@media only screen and (max-width: 425px){
    html{
        width: 100%;
        height: 100%;
    }
    .dashboard-holder{
        display: none;
    }
    .mobile-display{
        width: 100vw;
        height: 100vh;
    }
}

</style>
