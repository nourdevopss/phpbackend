import './assets/main.css'

import { createApp } from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

import App from './App.vue'
import router from './router'
import Cookies from 'js-cookie'; // Use a library like js-cookie to manage cookies

const domain = window.location.hostname
axios.defaults.baseURL = `http://${domain}:8000`; // Replace with your API base URL
axios.defaults.withCredentials = true; // Ensure credentials are sent with requests

axios.interceptors.request.use(config => {
    const token = Cookies.get('XSRF-TOKEN'); // Get the XSRF-TOKEN from cookies
    if (token) {
        config.headers['X-XSRF-TOKEN'] = token; // Add the token to request headers
    }
    return config;
}, error => {
    return Promise.reject(error);
});

const app = createApp(App)

app.use(router)
app.use(VueAxios, axios)

app.mount('#app')
