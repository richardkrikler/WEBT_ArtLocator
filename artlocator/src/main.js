import {createApp} from 'vue'
import App from './App.vue'
import routes from './routes'
import {createRouter, createWebHashHistory} from 'vue-router'
import './index.css'

createApp(App)
    .use(createRouter({
        history: createWebHashHistory(),
        routes
    }))
    .mount('#app')
