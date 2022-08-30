<template>
  <div>
    <Head title="Dashboard" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Post
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div className="flex items-center justify-between mb-6">
                            <Link
                                className="px-6 py-2 text-white bg-blue-500 rounded-md focus:outline-none"
                                :href="route('posts.index')"
                            >
                                Back
                            </Link>
                        </div>
                        <form name="createForm" @submit.prevent="submit">
                                <div className="flex flex-col">
                                    <div className="mb-4">
                                        <BreezeLabel for="title" value="Title" />
                                        
                                        <BreezeInput 
                                            id="title" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            v-model="form.title" 
                                            autofocus />
                                        <span className="text-red-600" v-if="form.errors.title">
                                            {{ form.errors.title }}
                                        </span>
                                    </div>
                                    <div className="mb-4">
                                        <BreezeLabel for="image" value="Image" />
                                        
                                        <input type="file" id="image" name="image" class="mt-1 block w-full" @input="form.image = $event.target.files[0]" />
                                        <!-- <BreezeInput 
                                            id="image"
                                            name="image" 
                                            type="file" 
                                            class="mt-1 block w-full" 
                                            v-model="form.image" 
                                            autofocus /> -->
                                        <span className="text-red-600" v-if="form.errors.image">
                                            {{ form.errors.image }}
                                        </span>
                                    </div>
                                    <div className="mb-4">
                                        <BreezeLabel for="category" value="Category" />
                                        
                                        <BreezeInput 
                                            id="category" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            v-model="form.category" 
                                            autofocus />
                                        <span className="text-red-600" v-if="form.errors.category">
                                            {{ form.errors.category }}
                                        </span>
                                    </div>
                                    <div className="mb-4">
                                        <BreezeLabel for="description" value="Description" />
                                        
                                        <BreezeTextArea 
                                            id="description" 
                                            class="mt-1 block w-full" 
                                            v-model="form.description" 
                                            autofocus />
                                        <span className="text-red-600" v-if="form.errors.description">
                                            {{ form.errors.description }}
                                        </span>
                                    </div>
                                </div>
  
                                <div className="mt-4">
                                    <button
                                        type="submit"
                                        className="px-6 py-2 font-bold text-white bg-green-500 rounded"
                                    >
                                        Save
                                    </button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
  </div>
</template>

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeTextArea from '@/Components/Textarea.vue';
import {Head,Link, useForm} from '@inertiajs/inertia-vue3';
const form = useForm({
    title:'',
    image:'',
    category:'',
    description:''
});
const submit = () => {
    form.post(route('posts.store'));
};
</script>