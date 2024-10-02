<template>
        <div
            class="
                p-8
                flex
                justify-between
            "
        >
                
            <h2
                class="
                    flex
                    text-3xl
                "
            >
                Nueva categoría
            </h2>
    
        </div>

        <form class="mx-8">
            <div class="flex flex-wrap" >

                <label for="name">Nombre</label>

                <input 
                    v-model="form.name"
                    id="name"
                    type="text" 
                    placeholder="" 
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

                <Button
                    class="
                        mt-4
                    "
                    text="Crear nota"
                    :isLoading="false"
                />
            </div>
        </form>

        <div
            class="
                p-8
                flex
                justify-between
            "
        >
                
            <h2
                class="
                    flex
                    text-3xl
                "
            >
                Listado de categorias
            </h2>


            
    
        </div>



</template>
<script setup>
import Button from '../../components/Button.vue';
import { ref } from 'vue';

const form = ref({
    name: ''
});


</script>