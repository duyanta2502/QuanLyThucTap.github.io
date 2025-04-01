import {defineStore} from "pinia"
import api from "../src/axios";
export const usestudenStore = defineStore('studenStore',{
    state: () => ({
        user: JSON.parse(localStorage.getItem('user')) || null,
    }),
    actions: {
        async fetchUser() {
            await api.get('/api/sinhvien')
            .then(response => {
                console.log(response)
                this.user = response.data.user;
                localStorage.setItem('user', JSON.stringify(response.data.user))
            })
            .catch(error => {
                this.user = null;
                localStorage.removeItem('user');
                console.error("error:", error);
            })
        },
        login(){
            this.fetchUser()
        },
        logout(){
            this.user = null;
            localStorage.removeItem('user');    
        },
    }
})

