import { defineStore } from 'pinia'
import { ModalStore } from "./ModalController";


export const useStore = defineStore('main', {
    state: () => {
        return {
            count: 1,
        }
    }
})
