<template>
    <div class="top-navigation">
        <div class="top-section">
            <div class="search-section h-[60px] pl-[20px] ">
                <p class="h-[100%]" style="line-height: 55px;font-weight: bold; font-size: large" >{{attrs.user.username}}</p>
            </div>
            <div class="left-icons">
                <button style="border: none" @click="logout" class="p-[2px]"  ><img class="h-[30px]"
                                                              :src="'/storage/Icons/icons8-log-out-50.png'"
                                                              onmouseover="this.src='/storage/Icons/icons8-log-out-50-hover.png';this.parentNode.style.backgroundColor='dodgerblue'"
                                                              onmouseout="this.src='/storage/Icons/icons8-log-out-50.png';this.parentNode.style.backgroundColor='transparent'"
                                                              alt=""></button>
            </div>
        </div>
    </div>
</template>
<script>
import {Inertia} from "@inertiajs/inertia";

export default {
    name: 'page-header',
    props:['attrs'],
    methods: {
        logout() {
            Inertia.post(route('logout'))
        }
    }
}
</script>
<style scoped lang="scss">
.top-navigation {
    width: 100%;
    height: 60px;
    background-color: white;
    box-shadow: 0 0 6px #c4c4c4;

    .top-section {
        display: flex;
        justify-content: space-between;

        .search-section {
            flex-wrap: wrap;
            flex-direction: row;
            z-index: 1000;

        }

        .left-icons {
            width: 300px;
            height: 60px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding-right: 30px;
            button{
                margin: 0 5px;
                &:hover{
                    background-color: dodgerblue;
                }
            }
        }
    }
}
</style>
