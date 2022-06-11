import {createApp} from 'vue'
import App from './App.vue'
import store from './store'
import {createStore} from 'vuex'
import routes from './routes'
import {createRouter, createWebHashHistory} from 'vue-router'
import './index.css'

createApp(App)
    .use(createStore(store))
    .use(createRouter({
        history: createWebHashHistory(),
        routes
    }))
    .mount('#app')
