<template>

        <div class="p-8">
                
            <h2
                class="
                    flex
                    mb-8
                    text-3xl
                "
            >
                Listado de notas
            </h2>

            <ButtonLink
                class="mt-4"
                text="Regresar"
                :to="{name: 'notes.index'}"
            />

        </div>

        <form class="flex gap-4 px-8" @submit.prevent="submitHandler">

            <div class="flex-1 space-y-6 " >

                <div class="flex flex-wrap" >

                    <label for="title">Título</label>

                    <input 
                        v-model="form.title"
                        id="title"
                        type="text" 
                        placeholder="Título" 
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

                    <label for="description">Descripción</label>

                    <textarea 
                        v-model="form.description"
                        id="description"
                        placeholder="Descripción" 
                        class=" 
                            w-full
                            p-2 
                            mt-2
                            border 
                            border-gray-300 
                            rounded-lg
                            outline-none
                            " 
                        >
                    </textarea>
                </div>

                <div 
                    class="
                        flex
                        space-x-2
                    " 
                >                

                    <div class="flex flex-wrap" >

                        <label for="created_at">Fecha de creación</label>

                        <input 
                            v-model="form.created_at"
                            id="created_at"
                            type="date" 
                            placeholder="Fecha de creación" 
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

                        <label for="expired_at">Fecha de vencimiento</label>

                        <input 
                            v-model="form.expired_at"
                            id="expired_at"
                            type="date" 
                            placeholder="Fecha de expiración" 
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

                </div>

                <div class="flex justify-between" >

                    <Button 
                        type="submit"
                        :text=" route.name === 'notes.create' ? 'Crear nota' : 'Actualizar nota' "
                        :isLoading="false"
                    />

                    <Button 
                        v-if="route.name === 'notes.edit'"
                        class="
                            bg-red-500
                            hover:bg-red-700
                        "
                        text="eliminar"
                        :isLoading="false"
                        @click="deleteNote"
                    />

                </div>

            </div>

            <div class="flex-1" >
                <div class="flex flex-wrap" >

                    <label for="image">Imagen</label>

                    <input 

                        id="image"
                        type="file" 
                        placeholder="Imagen"
                        accept="image/*"
                        class=" 
                            w-full
                            p-1.5
                            mt-2
                            border 
                            border-gray-300 
                            rounded-lg
                            outline-none
                        "
                        @change="fileHandler"
                    />

                </div>

                <img :src="form.image" class="mt-2">
            </div>    

            <div 
                    class=""
                >

                <label> Categorias </label>


                <div class="flex mt-4 flex-col gap-2">

                        <div 
                            class="
                                bg-[#127369]
                                text-white
                                hover:bg-[#0F5C4D]
                                cursor-pointer
                                px-2
                                py-1    
                            "
                            v-for="category in store.state.category.categories"
                            :class="{'bg-red-500 hover:bg-red-700': notesCategories.includes(category.id)}"
                            @click="addCategoryToNote(category)"
                            >
                            {{ category.name }}
                        </div>
                        
                    </div>
                </div>

        </form>

</template>
<script setup>
    import ButtonLink from '../../components/ButtonLink.vue';
    import Button from '../../components/Button.vue';
    import { onMounted, ref} from 'vue'
    import router from '../../router';
    import { useRoute } from 'vue-router';
    import { useStore } from 'vuex';


    const store = useStore();

    const route = useRoute();

    const form = ref({
        user_id: -1,
        title: '',
        description: '',
        created_at: '',
        expired_at: '',
        image: null,
    })

    const notesCategories = ref([]);

    const addCategoryToNote = async (category) => {
        if(notesCategories.value.includes(category.id)){
            
            if(route.name === 'notes.edit') {
                await store.dispatch('noteCategory/deattachCategoryFromNote', { 
                    noteId: route.params.id,
                    categoryId: category.id
                })
            }

            notesCategories.value = notesCategories.value.filter(id => id !== category.id)
        } else {
            notesCategories.value.push(category.id)
        }
    }

    const fileHandler = async (event) => {
        
        const file = event.target.files[0]

        const response = await store.dispatch('image/saveImage', { image: file });

        form.value.image = response.data.url;
    }

    const getNote = async () => {
        const response = await store.dispatch('note/getNote', route.params.id);

        const note = response.data.data;

        form.value.user_id        = note.user.id;
        form.value.title          = note.title;
        form.value.description    = note.description;
        form.value.created_at     = note.created_at;
        form.value.expired_at     = note.expired_at;
        form.value.image          = note.image;

        notesCategories.value     = note.categories.map((category) => category.id);
    }

    const createNote = async (event) => {

        if(form.value.title === '' || form.value.description === '' || created_at === ''){
            alert('!Por favor, llene los tampos necesario! (titulo, descripción, fecha de creación)');
            return;
        }

        form.value.user_id = store.state.auth.user?.id;

        const response = await store.dispatch('note/createNote', form.value);

        if(response.status === 201) {
            event.target.reset();

            await store.dispatch('noteCategory/attachCategoryToNote',{ 
                id: response.data.data.id,
                data: {
                    'category_id': notesCategories.value
                }
            })

            router.push({name: 'notes.index'})
        }
    }

    const updateNote = async (event) => {

        form.value.user_id = store.state.auth.user?.id;

        const response = await store.dispatch('note/updateNote', {
            id: route.params.id, 
            data: form.value
        });
       

        if(response.status === 200) {
            
            if(notesCategories.value.length > 0) {
                await store.dispatch('noteCategory/attachCategoryToNote',{ 
                    id: response.data.data.id,
                    data: {
                        'category_id': notesCategories.value
                    }
                })
            }

            router.push({name: 'notes.index'});
        }
    }

    const deleteNote = async () => {
        const response = await store.dispatch('note/deleteNote', route.params.id);

        if(response.status = 204) {
            router.push({name: 'notes.index'});
        }
    }

    const submitHandler = async (event) => {

        if(route.name === 'notes.create') {
            await createNote(event);
        } else {
            await updateNote(event);
        }

    }

    onMounted(async () => {

        await store.dispatch('category/getCategories');

        if(route.name === 'notes.edit') {
            await getNote();
        }
    })
</script>