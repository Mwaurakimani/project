<template>
    <div class="action-bar">
        <div class="search-bar">
            <label>What are you looking for</label>
            <input type="search">
        </div>
        <div class="criteria-search">
            <label>Title</label>
            <input type="text">
        </div>
        <div class="criteria-search">
            <label>Title</label>
            <input type="text">
        </div>
        <div class="criteria-search">
            <label>Title</label>
            <input type="text">
        </div>
        <div class="action-button">
            <button>Apply</button>
        </div>
    </div>
</template>
<script>
export default {
    name: 'action-bar'
}
</script>

<style lang="scss" scoped>
.action-bar {
    width: 98%;
    margin: auto;
    height: 80px;
    padding: 8px;
    background-color: white;
    box-shadow: 2px 2px 5px #ececec;
    border-radius: 8px;
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px !important;

    & > div {
        display: flex;
        flex-direction: column;
        margin: 0px 10px;

        & > label {
            font-size: 0.9em;
            padding: 3px;
            font-weight: bolder;
            margin-bottom: 5px;
        }

        & > input {
            height: 30px;
            margin: 0px;
            padding: 3px;
            border-radius: 5px;
            width: 160px;
            border: 1px solid #efefef;
        }
    }

    .search-bar {
        width: 100%;

        input {
            height: 30px;
            margin: 0px;
            padding: 3px;
            border-radius: 5px;
            width: 100%;

        }
    }

    .criteria-search {
        width: 200px;
    }
    .action-button{
        align-self: center;
        button{
            padding: 0px;
            margin-top:25px;
            width: 150px;
            height: 35px;
            color: white;
            background-color: dodgerblue;
            &:hover{
                background-color: #0762bb;
            }
        }
    }
}
</style>
