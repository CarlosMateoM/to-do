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
                Listado de notas
            </h2>

            <ButtonLink
                text="Nueva nota"
                :to="{name: 'notes.create'}"
            />

        </div>

        <div
            class="
                flex
                px-8
                mb-8
                items-center
            "
        >
        <label for="order-by-date" >
            Order por
        </label>

        <select v-model="sort" id="order-by-date" 
            class="  
                ml-2 
                p-2
                rounded-lg
                outline-none
                bg-[#127369]
                text-white
                hover:bg-[#0F5C4D]
            "
            @change="sortHandler"
        >
            <option value=""></option>
            <option value="created_at">fecha creación, asc</option>
            <option value="-created_at">fecha creación, desc</option>
            <option value="expired_at">fecha vencimiento, asc</option>
            <option value="-expired_at">fecha vencimiento, desc</option>
        </select>

        </div>

        <div class="flex grow mb-24" >

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4  gap-4 mx-8" >
                
                <NoteCard 
                    v-for="note in notes"
                    :key="note.id"
                    :note="note"
                />
                
            </div>
            
        </div>

</template>
<script setup>
import NoteCard from './components/NoteCard.vue';
import ButtonLink from '../../components/ButtonLink.vue';
import { ref, computed, onMounted } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

const notes = computed(() => store.state.note.notes);

const sort = ref('');

const fetchNotes = async (params = '') => {
    await store.dispatch('note/getNotes', params);
}

const sortHandler = async (event) => {
    const sort = event.target.value;
    const params = new URLSearchParams();
    if(sort) {
        params.append('sort', sort)
    }
    await fetchNotes(params.toString());
}

onMounted(async () => {
    await fetchNotes();
})

</script>