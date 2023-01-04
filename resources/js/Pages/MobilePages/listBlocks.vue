<template>
    <Layout >
        <template v-slot:mobile >
            <navigation-bar>
                <div class="search-section">
                    <div class="input-group">
                        <input type="search" placeholder="Search...">
                    </div>
                </div>
            </navigation-bar>
            <h4 style="font-weight: bolder;font-size: 1.4em;text-decoration: underline" class="mb-[20px] pl-[10px]" >Blocks</h4>
            <table>
                <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                </thead>
                <tbody>
                <tr v-for="i in 10">
                    <th>1</th>
                    <td>Bishop Annex</td>
                    <td>Nairobi</td>
                </tr>
                </tbody>
            </table>
        </template>
    </Layout>

</template>

<script>
import NavigationBar from "./NavigationBar.vue";

export default {
  name: "listBlocks",
    components: {NavigationBar},
    provide:{
        tab_name:'Dashboard'
    },
}
</script>

<style scoped lang="scss">
.search-section{
    width: 100%;
    .input-group{
        width: 100%;
        height: 55px;
        position: relative;
        padding: 10px;

        input{
            width: 100%;
            background-color: #ececec;
            border: none;
            border-radius: 8px;
        }

    }
}
table{
    width: 97%;
    margin: auto;
    tbody{
        tr{
            height: 80px;
            border-bottom: 1px solid lightgrey;
        }
    }
}
</style>
