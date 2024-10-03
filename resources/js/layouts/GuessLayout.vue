<template>
    <div class="h-screen flex flex-col" >
        <header class="flex items-center p-4 justify-between shadow " >
            <h1 class="text-3xl" >Notas</h1>
        </header>
        
        <main class="flex flex-col sm:flex-row flex-wrap grow" >
            <div class="flex-1" >
                <img class="
                        object-cover
                        w-full
                        h-full
                    " 
                    src="https://www.murdoch.edu.au/sf-images/newsportallibrary/feature-images/note-taking-feature.jpg?sfvrsn=ff31cf5f_0" 
                >
            </div>
            <slot />
        </main>
        
    </div>
</template>