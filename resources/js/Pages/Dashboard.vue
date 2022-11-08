<template>
    <div class="dashboard-holder">
        <div class="side-bar"></div>
        <div class="main-body">
            <div class="top-navigation">
                <div class="top-section">

                </div>
                <div class="bottom-section">

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Dashboard"
}
</script>

<style scoped lang="scss" >


.dashboard-holder{
    width: 100vw;
    height: 100vh;
    display: flex;
    background-color: #f2f7f8;
    .side-bar{
        width: 250px;
        height: 100vh;
        background-color: #1f2937;
        box-shadow: 0 0 6px grey;
    }
    .main-body{
        width: calc(100vw - 260px);
        margin-left: 5px;

        .top-navigation{
            width: 100%;
            border: 1px solid #b4b4b4;
            background-color: white;
            border-bottom: none;

            .top-section{
                width: 100%;
                height: 56px;
                border-bottom: 1px solid #b4b4b4;
            }
            .bottom-section{
                display: none;
                width: 100%;
                height: 60px;
                border-bottom: 1px solid #b4b4b4;
            }

        }
    }
}

</style>
