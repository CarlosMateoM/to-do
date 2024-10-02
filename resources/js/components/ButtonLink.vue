<template>
    <RouterLink 
        class="
            rounded-xl 
            bg-[#127369] 
            text-white 
            py-2 px-4
            hover:bg-[#0F5C4D]
        "     
        :to="to" 
    >
        {{ text }}
    </RouterLink>
</template>
<script setup>
import { RouterLink } from 'vue-router';

const props = defineProps({
    to: {
        type: Object,
        required: true
    },
    text: {
        type: String,
        required: true
    }
});
</script>