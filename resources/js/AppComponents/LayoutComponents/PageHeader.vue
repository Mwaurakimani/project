<template>
    <div class="top-navigation">
        <div class="top-section">
            <div class="search-section h-[60px] pl-[20px] ">
                <input type="search"
                       @focus="toggle_dropdown('show')"
                       @blur="toggle_dropdown('hide')"
                       placeholder="Search..."
                >
                <div class="search-dropdown">
                </div>
            </div>
            <div class="left-icons">
                <button style="border: none;position:relative;" class="p-[2px]"  ><img class="h-[30px]"
                                                                                    :src="'/storage/Icons/icons8-alarm-48.png'"
                                                                                    onmouseover="this.src='/storage/Icons/icons8-alarm-48-hover.png';this.parentNode.style.backgroundColor='dodgerblue'"
                                                                                    onmouseout="this.src='/storage/Icons/icons8-alarm-48.png';this.parentNode.style.backgroundColor='transparent'"
                                                                                    alt=""><span v-if="notification" style="position: absolute;top: 5px;right:2px;background-color: #f53f3f;width: 13px;height: 13px;border-radius: 50% "></span></button>
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
    data(){
        return{
            notification:false
        }
    },
    methods: {
        toggle_dropdown(action){
            if(action === 'show'){
                $('.search-dropdown').css('display',"block")
            }else {
                $('.search-dropdown').fadeOut('fast')
            }
        },
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

            input {
                width: 400px;
                border-radius: 8px;
                margin-top: 9px;
                margin-bottom: 10px;
                border: 1px solid lightgrey;
            }

            .search-dropdown {
                display: none;
                width: 400px;
                height: 400px;
                background-color: white;
                box-shadow: 0px 6px 4px #e1e1e1;
                z-index: 2000;
            }
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
