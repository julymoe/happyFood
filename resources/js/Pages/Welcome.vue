<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
})
</script>

<template>
    <div>
        <Head title="Happy Food" />

        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</Link>
            </template>
        </div>
        
        <h1 class="text-7xl text-center py-14">Happy Food</h1>
        <div class="flex gap-7 max-w-6xl mx-auto">
            <div class="w-2/3">
                <div class="bg-red-500 relative mb-72">
                    <img src="https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" class="w-full h-auto hover:scale-105 hover:transition-all duration-500 ease-in-out delay-300" alt="" /> 
                    <div class="bg-white p-10 mx-10 -mt-20 absolute overflow-hidden">
                        <h3 class="text-4xl pb-8">Grilled Salmon</h3>
                        <ul>
                            <li>A nice filet of salmon, king, chinook, coho, or sockeye *IMPORTANT* Choose a salmon fillet with the skin ON. More on this later in the post…</li>
                            <li>A quality oil (grape seed oil for its high smoke point, or an extra virgin olive oil are good options)</li>
                            <li>Kosher salt</li>
                            <li>Freshly ground black pepper.</li>
                        </ul>
                        <a href="" class="border border-orange-500 hover:border-rose-600 px-7 py-1 rounded my-4 inline-block hover:text-white hover:transition-all hover:bg-orange-400">Read More</a>
                    </div>                    
                </div>
                <div class="bg-red-500 relative mb-72">
                    <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTB8fGZvb2R8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60" class="w-full h-auto hover:scale-105 hover:transition-all duration-500 ease-in-out delay-300" alt="" />
                    <div class="bg-white p-10 mx-10 -mt-20 absolute overflow-hidden">
                        <h3 class="text-4xl pb-8">Avocado Salad</h3>
                        <ul>
                            <li>In a small bowl, whisk together oil, lemon juice, and cumin. Season dressing with salt and pepper. </li>
                            <li>In a large serving bowl, combine avocados, tomatoes, cucumber, corn, jalapeño, and cilantro. </li>
                            <li>Gently toss with dressing and serve immediately. </li>
                        </ul>
                        <a href="" class="border border-orange-500 hover:border-rose-600 px-7 py-1 rounded my-4 inline-block hover:text-white hover:transition-all hover:bg-orange-400">Read More</a>
                    </div>                    
                </div>
                           
            </div>
            <div class="w-1/3">In a small bowl, whisk together oil, lemon juice, and cumin. Season dressing with salt and pepper.</div>
        </div>
    </div>
</template>
