<template>
        <div class="flex flex-col items-center justify-center flex-1 p-4 ">
            <h1 class="text-3xl mb-4 text-center text-gra-800" >Iniciar sesión</h1>

            <div v-if="errors" >
                <div 
                    class="
                        flex
                        items-center
                        bg-red-100
                        border-l-4
                        border-red-500
                        text-red-700
                        p-4
                        mb-4
                        rounded-lg
                    "
                >
                    <p>{{ errors }}</p>

                    <button class="
                        ml-2 
                        border 
                        px-2 
                        rounded 
                        border-red-700
                        hover:bg-red-500
                        "
                        @click="errors = null"
                    >
                        X
                    </button>
                </div>
            </div>

            <form @submit.prevent="login" class="flex flex-col space-y-4 mx-8" >

                <div class="flex flex-wrap" >

                    <label for="email">Correo electrónico</label>

                    <input 
                        v-model="loginForm.email"
                        id="email"
                        type="email" 
                        placeholder="Correo electrónico" 
                        class=" 
                            w-full
                            p-2 
                            mt-2
                            border 
                            border-gray-300 
                            rounded-lg
                            outline-none
                            " 
                        />
                </div>

                <div class="flex flex-wrap" >

                    <label for="password">Constraseña</label>

                    <input 
                        v-model="loginForm.password"
                        id="password"
                        type="password" 
                        placeholder="Correo electrónico" 
                        class=" 
                            w-full
                            p-2 
                            mt-2
                            border 
                            border-gray-300 
                            outline-none
                            rounded-lg" 
                        />
                </div>

                
                <div >
                    <Button 
                        class="mt-4 mx-auto"
                        type="submit"
                        text="Iniciar sesión"
                        :isLoading="false"
                    />
                </div>

                <div class="flex justify-center" >
                    <RouterLink 
                        class="
                            underline
                            text-center
                            text-[#127369]
                            hover:text-[#0F5C4D]
                        "
                        :to="{name: 'register'}" >    
                        Registrarse
                    </RouterLink>
                </div>
                
            </form>
        </div>
</template>
<script setup>
import Button from '../../components/Button.vue';
import { RouterLink } from 'vue-router';
import router from '../../router';
import { useStore } from 'vuex';
import { ref } from 'vue';

const store = useStore();

const errors = ref(null);

const loginForm = ref({
    email: 'carlos@correo.com',
    password: '12345678'
});


const login = async (event) => {
    
    try {
        const response = await store.dispatch('auth/login', loginForm.value);

        if (response.status === 200) {
            event.target.reset();
            router.push({name: 'notes.index'});
        }
    } catch (error) {
        errors.value = error.response.data.message;
    }
}

</script>