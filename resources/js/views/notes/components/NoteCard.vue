<template>
    <div class="rounded-lg border shadow-lg ">
            <div class="relative" >
                <img
                    v-if="note.image"
                    class="
                        rounded-t-lg
                    "
                    :src="note.image"
                />

                
                <EditIcon 
                    class="
                        size-6 
                        ml-2 
                        top-1 
                        right-1 
                        p-1 
                        rounded 
                        absolute
                        bg-[#127369]
                        text-white
                        hover:bg-[#0F5C4D]
                    " 
                    @click="router.push({name: 'notes.edit', params: { id: note.id}})"
                />
            </div>

                <div class="p-4" >

                    <div 
                        class="
                            pb-2
                            mb-2
                            text-sm
                            border-b
                        "
                    >

                        <h2 
                            class="
                                text-xl
                                mb-2
                            "
                            >
                            {{note.title}}
                        </h2>

                        <p class="
                                text-xs
                            " 
                        >
                            por {{ note.user.name }}
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
                        {{ note.description }}
                    </p>
                    
                    <div 
                        class="
                            flex
                            justify-between
                        "
                    >
                        <p
                            class="
                                mt-2
                                text-xs
                                text-gray-950
                            "
                        >
                            creado {{ note.created_at }}
                        </p>

                        <p
                            v-if="note.expired_at"
                            class="
                                mt-2
                                text-xs
                                text-gray-950
                            "
                        >
                            vence {{ note.expired_at }}
                        </p>


                    </div>

                    <div 
                        v-if="note.categories"  
                        class="flex mt-2 border-t pt-4"
                    >
                        <div
                            v-for="category in note.categories" 
                            class="
                                text-xs
                                border
                                px-2
                                py-1
                                border-[#127369]
                                
                            "
                        >
                            {{ category.name }}
                        </div>
                    </div>
                    
                </div>
    </div>
</template>
<script setup>
import EditIcon from '../../../components/icons/EditIcon.vue';
import router from '../../../router';


const props = defineProps({
    note: {
        type: Object,
        required: true
    }
});

</script>