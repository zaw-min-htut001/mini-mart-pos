import { createApp } from 'vue'
import './index.css'
import App from './App.vue'
import { createWebHistory, createRouter } from 'vue-router'
import routes from './router'
import axios from 'axios'
import store from './store'

axios.defaults.baseURL = 'http://127.0.0.1:8000/api';

const router = createRouter({
    history: createWebHistory(),
    routes,
})

const app = createApp(App)
app.use(router)
app.use(store)
app.mount('#app')
