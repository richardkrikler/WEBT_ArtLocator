import Main from './components/Main.vue'
import About from './components/About.vue'
import Admin from './components/Admin.vue'
import Museums from './components/Museums.vue'

export default [
    {
        name: 'Museums',
        path: '/museums',
        component: Museums,
        props: true
    },
    {
        name: 'About',
        path: '/about',
        component: About,
        props: true
    },
    {
        name: 'Admin',
        path: '/admin',
        component: Admin,
        props: true
    },
    {
        name: 'default',
        path: '/',
        component: Main,
        props: true
    }
]