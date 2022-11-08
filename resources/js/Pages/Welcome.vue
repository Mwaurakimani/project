<template>
    <p>{{ cot }}</p>
</template>

<script>
import { useStore } from "../Pinia/Store";

export default {
    name: "Welcome",
    setup(){
        const store = useStore();
        let cot = store.count;

        return { cot }
    }
}
</script>

<style scoped>

</style>
