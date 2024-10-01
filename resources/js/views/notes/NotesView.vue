<template>
    <main>


        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4  gap-4 mx-8 my-4" >

            <div v-for="(i, index) in 10" class="
                rounded-lg
                border-2
            ">
                <img 
                    class="
                        rounded-t-lg
                    "
                    src="https://images.pexels.com/photos/1629212/pexels-photo-1629212.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="" srcset="">

                <div class="p-4" >

                    <div 
                        class="
                            text-sm
                            border-b
                            pb-2
                            mb-2
                        "
                    >

                        <h2 
                            class="
                                text-xl
                                mb-2
                            "
                            >
                            terminar el diseño de la tarjeta para mostrar las notas
                        </h2>

                        <p class="
                                text-xs
                            " 
                        >
                            por Carlos Mateo Martinez Guerra
                        </p>

                    </div>
                    
                    <p  
                        class="
                            text-gray-900
                            text-sm
                            border-b
                            pb-2
                        "
                    >
                        el diseño debe ser minimalista, organizado y contar con los parametros descriptos en el correo
                    </p>
                    
                    <p
                        class="
                            mt-2
                            text-xs
                            text-gray-950
                        "
                    >
                        creado el 20/09/2024
                    </p>
                    
                </div>

            </div>

        </div>

    </main>
</template>
<script setup>
</script>