<template>
    <div>
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Novo Post</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Esse post aparecerá na administração de posts e não estará ativo até que seja ativado manualmente.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form @submit.prevent="storePost(post)">
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                            <!-- title -->
                            <div class="grid grid-cols-3 gap-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <label for="post-title" class="block text-sm font-medium text-gray-700">
                                    Título do post
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                    <span
                                        class="inline-flex items-center px-3 rounded-l-md border border-r-0
                                            border-gray-300 bg-gray-50 text-gray-500 text-sm"
                                    >
                                        Título
                                    </span>
                                    <input
                                        v-model="post.title"
                                        type="text"
                                        name="post-title"
                                        id="post-title"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full
                                            rounded-none rounded-r-md sm:text-sm border-gray-300"
                                        placeholder="Aqui vai o título do post"
                                    >
                                    </div>
                                    <div class="text-red-600 mt-1">
                                        <div v-for="message in validationErrors?.title" :key="message">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- text -->
                            <div>
                                <label for="post-content" class="block text-sm font-medium text-gray-700">
                                    Texto
                                </label>
                                <div class="mt-1">
                                    <textarea
                                        v-model="post.content"
                                        id="post-content"
                                        name="post-content"
                                        rows="3"
                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block
                                            w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="Aqui começa o seu post"></textarea>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">
                                    Desenvolva seu post
                                </p>
                                <div class="text-red-600 mt-1">
                                    <div v-for="message in validationErrors?.content" :key="message">
                                        {{ message }}
                                    </div>
                                </div>
                            </div>

                            <!-- Category -->
                            <div class="grid grid-cols-3 gap-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <label for="post-category" class="block text-sm font-medium text-gray-700">
                                        Categoria
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <select
                                            v-model="post.category_id"
                                            id="post-category"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full
                                                rounded-md sm:text-sm border-gray-300"
                                        >
                                            <option value="" selected>-- Escolha a categoria --</option>
                                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                                {{ category.name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="text-red-600 mt-1">
                                        <div v-for="message in validationErrors?.category_id" :key="message">
                                            {{ message }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Upload -->
                            <!-- <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Imagem de capa
                                </label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="True">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Upload a file</span>
                                            <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PNG, JPG, GIF up to 10MB
                                        </p>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Salvar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, reactive } from "vue"
import useCategories from '../../composables/categories'
import usePosts from '../../composables/posts'

export default {
    setup() {
        const post = reactive({
            title: '',
            content:  '',
            category_id: ''
        });

        const { categories, getCategories } = useCategories();
        const { storePost, validationErrors } = usePosts();

        onMounted(() => {
            getCategories()
        })

        return { categories, post, storePost, validationErrors }
    }
}
</script>
