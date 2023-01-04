<template>
    <div class="navigation-bar">
        <div onclick="history.go(-1)" class="back-button flex p-[15px]">
            <img src="/storage/Icons/back.png" alt="">
        </div>
        <div class="left-element">
            <slot></slot>
        </div>
    </div>
</template>
<script>
export default {
    name: 'navigation-bar'
}
</script>
<style lang="scss" scoped>
.navigation-bar {
    position: sticky;
    top: 0px;
    background-color: white;
    width: 100%;
    height: 55px;
    display: flex;
    justify-content: space-between;
    box-shadow: 0 0 6px lightgrey;
    margin-bottom: 20px;
    background-color: #0f89ff;
    z-index: 1000;

    .back-button {
        width: 55px;
        height: 55px;
    }

    .left-element{
        width: calc(100% - 55px);
    }
}
</style>
