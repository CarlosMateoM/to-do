<template>
    <button 
        class="
            flex
            justify-center
            rounded-xl 
            bg-[#127369]
            text-white 
            py-2 px-4
            hover:bg-[#0F5C4D]
        "     
        :type="type" 
    >
        {{ text }}

        <div v-if="isLoading" class="ml-2 size-6 rounded-full animate-spin border-2 border-t-[#127369]" >

        </div>
    </button>
</template>
<script setup>
import { RouterLink } from 'vue-router';

const props = defineProps({
    type: {
        type: String,
        default: 'button'
    },
    text: {
        type: String,
        required: true
    },
    isLoading: {
        type: Boolean,
        default: true
    }
});
</script>