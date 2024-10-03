<template>

    <div class="
            p-4
            flex 
            flex-1 
            flex-col 
            items-center 
            justify-center 
        "
    >
            <h1 class="text-3xl mb-4 text-center text-gra-800">
                Registrarse
            </h1>

            <div v-if="errors" >
                <div 
                    class="
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
                </div>
            </div>

            <form @submit.prevent="register" class="flex flex-col space-y-4 mx-8" >

                <div class="flex flex-wrap" >

                    <label for="name">Nombre</label>

                    <input 
                        v-model="registerForm.name"
                        id="name"
                        type="text" 
                        placeholder="Nombre" 
                        class=" 
                            w-full
                            p-2 
                            mt-2
                            border 
                            rounded-lg
                            outline-none
                            border-gray-300 
                        " 
                        />
                </div>

                <div class="flex flex-wrap" >

                    <label for="email">Correo electrónico</label>

                    <input 
                        v-model="registerForm.email"
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
                        v-model="registerForm.password"
                        id="password"
                        type="password" 
                        placeholder="**************" 
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

                <div class="flex flex-wrap" >

                    <label for="password-confirmation">Confirmar contraseña</label>

                    <input 
                        v-model="registerForm.password_confirmation"
                        id="password-confirmation"
                        type="password" 
                        placeholder="**************" 
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
                        text="Registrarse"
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
                        :to="{name: 'login'}" >    
                        Iniciar sesión
                    </RouterLink>
                </div>
                
            </form>
    </div>
</template>
<script setup>
    import { ref } from 'vue';
    import { useStore } from 'vuex';
    import router from '../../router';
    import Button from '../../components/Button.vue';

    const store = useStore();

    const registerForm = ref({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const errors = ref(null);

    const clearErrors = () => {
        errors.value = null;
    }   

    const register = async (event) => {
        
        try {

            const response = await store.dispatch('auth/register', registerForm.value);

            if (response.status === 201) { 
                
                event.target.reset(); 

                setTimeout(() => {
                    router.push({name: 'login'});
                }, 1000);
            }

        } catch (error) {
            
            if (error.response.status === 400) {
                errors.value = error.response.data.message;
            } else if(error.response.status === 422) {
                errors.value = error.response.data.errors;
            } else if (error.response.status === 500) {
                errors.value = ['Error en el servidor'];
            }

        }
        
    }
</script>