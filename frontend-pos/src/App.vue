<template>
    <Navbar />

    <router-view v-slot="{ Component }">
        <keep-alive>
            <component :is="Component" />
        </keep-alive>
    </router-view>
</template>

<script>
import axios from 'axios';
import Navbar from './components/Navbar.vue';
import store from './store'
import { computed, onMounted } from 'vue';

export default {
    name: 'App',
    components :{Navbar} ,
    setup() {
    onMounted(() => {
      const userString = localStorage.getItem('user')
      const token = localStorage.getItem('token')
      if (userString) {
        const userData = JSON.parse(userString)
        store.commit('SET_USER', userData)
        store.commit('SET_TOKEN' , token)
      }
    });
    // re login when refresh page
      axios.interceptors.request.use(
        (config) => {
            const token = localStorage.getItem('token');
    
            if (token) {
                config.headers['Authorization'] = `Bearer ${token}`;
            }
    
            return config;
        },
    
        (error) => {
            return Promise.reject(error);
        }
    );
  },

};
</script>