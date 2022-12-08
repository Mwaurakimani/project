import {defineStore} from "pinia/dist/pinia";

export const ModalStore = defineStore('ModalStore', {
    state: () => {
        return {
            display: false
        }
    },
    getters: {
        getState(state) {
            return state.display
        }
    },
    actions: {
        setState(val) {
            if (val) {
                $('#appModal').fadeIn("fast")

            } else {
                $('#appModal').fadeOut("fast")
            }
        }
    }
})
