<template>
    <div class="h-screen" >
        <header class="flex items-center p-4 justify-between shadow">
            <h1 class="text-3xl text-gray-800">
                Notas
            </h1>

            <Button text="Cerrar sesión" :isLoading="false" />

        </header>
        <RouterView></RouterView>
    </div>
</template>
<script setup>
    import Button from '../components/Button.vue';
    import { computed, onMounted } from 'vue';
    import { RouterView } from 'vue-router';
    import { useStore } from 'vuex';

    const store = useStore();

    const user = computed(() => store.state.auth.user);

    onMounted(async () => {
        await store.dispatch('auth/getUser');
    })

</script>