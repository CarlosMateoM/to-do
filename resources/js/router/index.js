import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: '/',
        redirect: {name : 'login'}
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('../views/auth/LoginView.vue'),
        meta: {
            layout: 'GuessLayout'
        }
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('../views/auth/RegisterView.vue'),
        meta: {
            layout: 'GuessLayout'
        }
    },
    {
        path: '/notes',
        name: 'register',
        component: () => import('../views/notes/NotesView.vue'),
        meta: {
            layout: 'AuthenticatedLayout'
        }
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;