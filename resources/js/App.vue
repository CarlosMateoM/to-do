<template>
    <component :is="layout" >
        <RouterView />
    </component>
</template>
<script setup>
    import AuthenticatedLayout from './layouts/AuthenticatedLayout.vue';
    import GuessLayout from './layouts/GuessLayout.vue';
    import { RouterView, useRoute } from 'vue-router';
    import { computed } from 'vue';

    const route = useRoute();

    const layout = computed(() => {
        
        const layouts = {
            GuessLayout,
            AuthenticatedLayout
        }

        return route.meta.layout ? layouts[route.meta.layout] : 'div';
    });
</script>