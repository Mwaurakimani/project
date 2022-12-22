<template>
    <Teleport to="body">
        <div id="appModal">
            <slot></slot>
        </div>
    </Teleport>
</template>

<script>
import {mapState} from "pinia";
import {mapActions} from "pinia";
import {ModalStore} from "../Pinia/ModalController";

export default {
    name: "Modal",
    watch:{
        mapState(newVal,oldVal){
            console.log(newVal)
        }
    },
    computed:{
        ...mapState(ModalStore,{
            modalState:'getState'
        })
    },
    methods:{
        ...mapActions(ModalStore,{
            setModalState: 'setState'
        }),
    }
}
</script>

<style scoped lang="scss">
#appModal {
    display: none;
    position: absolute;
    top: 0px;
    left: 0px;
    z-index: 10000;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.8);
    overflow: auto;
}
</style>
