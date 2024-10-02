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
        name: 'notes.index',
        component: () => import('../views/notes/NotesView.vue'),
        meta: {
            layout: 'AuthenticatedLayout'
        }
    },
    {
        path: '/notes/new',
        name: 'notes.create',
        component: () => import('../views/notes/NoteView.vue'),
        meta: {
            layout: 'AuthenticatedLayout'
        }
    },
    {
        path: '/notes/:id/edit',
        name: 'notes.edit',
        component: () => import('../views/notes/NoteView.vue'),
        meta: {
            layout: 'AuthenticatedLayout'
        }
    },
    {
        path: '/categories',
        name: 'categories.index',
        component: () => import('../views/categories/CategoriesView.vue'),
        meta: {
            layout: 'AuthenticatedLayout'
        }
    },
    {
        path: '/categories/:id',
        name: 'categories.edit',
        component: () => import('../views/categories/CategoryView.vue'),
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