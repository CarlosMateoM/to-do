<template>
    <div class="h-screen flex " >
        <header class="flex flex-col items-center p-2 justify-between shadow-lg w-[70px]">

            <div>
                <h1 class="text-3xl text-gray-800">
                    <NoteIcon 
                        class="
                            mb-2
                            size-14
                            text-[#127369]
                        " 
                    />
                </h1>
                <p
                    class="
                        text-gray-800
                        text-xs
                        text-center
                    "
                >
                    {{ user?.name }}
                </p>
            </div>

            <LogoutIcon 
                class="
                    p-2
                    size-14
                    rounded-full    
                    text-white
                    cursor-pointer
                    bg-[#127369]
                    hover:bg-[#0F5C4D]
                "
                @click="logoutHandler"  
            />

        </header>
        <main class=" flex w-full h-screen overflow-y-auto flex-col" >
            <RouterView></RouterView>
        </main>
    </div>
</template>
<script setup>
    import LogoutIcon from '../components/icons/LogoutIcon.vue';
    import NoteIcon from '../components/icons/NoteIcon.vue';
    import { computed, onMounted } from 'vue';
    import { RouterView } from 'vue-router';
    import router from '../router';
    import { useStore } from 'vuex';

    const store = useStore();

    const user = computed(() => store.state.auth.user);

    const logoutHandler = async () => {
        const response = await store.dispatch('auth/logout');

        if(response.status === 204) {
            router.push({name: 'login'});
        }
    }

    onMounted(async () => {
        await store.dispatch('auth/getUser');
    })

</script>