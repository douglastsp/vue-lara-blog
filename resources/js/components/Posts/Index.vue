<template>
    <div class="overflow-auto lg:overflow-visible">
        <div class="mb-4">
            <select v-model="selectedCategory" class="block text-center mt-1 w-full sm:w-1/4 rounded-md shadow-md border-0
            bg-gray-100 text-gray-600 space-y-6 text-sm">
                <option value="" selected>-- Filte por Categoria --</option>
                <option class="text-left" v-for="category in categories" :key="category.id"  :value="category.id">
                    {{ category.name }}
                </option>
            </select>
        </div>
        <table class="table text-gray-500 border-separate space-y-6 text-sm w-full">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-3">
                        <div class="flex items-center justify-center cursor-pointer" @click="updateOrdering('id')">
                            <div class="leading-4 tracking-wider" :class="{'font-bold text-blue-600': orderColumn === 'id'}">
                                ID
                            </div>
                            <span :class="{
                                'text-blue-600': orderDirection === 'asc' && orderColumn === 'id',
                                'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'id',
                            }">
                                &uarr;
                            </span>
                            <span :class="{
                                'text-blue-600': orderDirection === 'desc' && orderColumn === 'id',
                                'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'id'
                            }">
                                &darr;
                            </span>
                        </div>
                    </th>
                    <th class="p-3">
                        <div class="flex items-center justify-center cursor-pointer" @click="updateOrdering('title')">
                            <div class="leading-4 tracking-wider" :class="{'font-bold text-blue-600': orderColumn === 'title'}">
                                Título
                            </div>
                            <span :class="{
                                'text-blue-600': orderDirection === 'asc' && orderColumn === 'title',
                                'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'title',
                            }">
                                &uarr;
                            </span>
                            <span :class="{
                                'text-blue-600': orderDirection === 'desc' && orderColumn === 'title',
                                'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'title'
                            }">
                                &darr;
                            </span>
                        </div>
                    </th>
                    <th class="p-3">Categoria</th>
                    <th class="p-3 text-center">Conteúdo</th>
                    <th class="p-3 text-center">
                        <div class="flex items-center justify-center cursor-pointer" @click="updateOrdering('created_at')">
                            <div class="leading-4 tracking-wider" :class="{'font-bold text-blue-600': orderColumn === 'created_at'}">
                                Data
                            </div>
                            <span :class="{
                                'text-blue-600': orderDirection === 'asc' && orderColumn === 'created_at',
                                'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'created_at',
                            }">
                                &uarr;
                            </span>
                            <span :class="{
                                'text-blue-600': orderDirection === 'desc' && orderColumn === 'created_at',
                                'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'created_at'
                            }">
                                &darr;
                            </span>
                        </div>
                    </th>
                    <th class="p-3 text-center">Status</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="post in posts.data" :key="post.id"
                    class="bg-gray-100"
                >
                    <td class="p-3">
                        #{{ post.id }}
                    </td>
                    <td class="p-3">
                        <div class="flex items-center">
                            <img class="rounded-full h-12 w-12  object-cover" src="https://images.unsplash.com/photo-1613588718956-c2e80305bf61?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=634&q=80" alt="unsplash image">
                            <div class="ml-3">
                                <div class="">{{ post.title }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="p-3">
                        {{ post.category }}
                    </td>
                    <td class="p-3">
                        {{ post.content }}
                    </td>
                    <td class="p-3 font-bold">
                        {{ post.created_at }}
                    </td>
                    <td class="p-3">
                        <span class="bg-green-400 text-gray-50 rounded-md px-2">available</span>
                    </td>
                    <td class="p-3 ">
                        <a href="#" class="text-gray-400 hover:text-gray-100 mr-2">
                            <i class="material-icons-outlined text-base"><i class="fa-solid fa-eye-slash"></i></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-100  mx-2">
                            <i class="material-icons-outlined text-base"><i class="fa-solid fa-pen-to-square"></i></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-100  ml-2">
                            <i class="material-icons-round text-base"><i class="fa-solid fa-trash"></i></i>
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>

        <Pagination :data="posts" @pagination-change-page="getPosts(page, selectedCategory)"/>

    </div>
</template>

<style>
    /**.paginate */
    .pagination {
        display: flex;
        padding-left: 0;
        list-style: none;
        border-radius: 0.25rem;
    }

    .page-item {

    }

    .pagination-page-nav {

    }

    .active {

    }

    .page-link {
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #007bff;
        border: 1px solid #dee2e6;
    }

    .sr-only{

    }

    .page-next-nav {

    }

    /**table */
	.table {
		border-spacing: 0 15px;
	}

	i {
		font-size: 1rem !important;
	}

	.table tr {
		border-radius: 20px;
	}

	tr td:nth-child(n+7),
	tr th:nth-child(n+7) {
		border-radius: 0 .625rem .625rem 0;
	}

	tr td:nth-child(1),
	tr th:nth-child(1) {
		border-radius: .625rem 0 0 .625rem;
	}
</style>

<script>
import { onMounted, ref, watch } from "vue"
import usePosts from '../../composables/posts'
import useCategories from '../../composables/categories'

export default {
    setup() {
        const selectedCategory = ref('')
        const orderColumn = ref('created_at')
        const orderDirection = ref('desc')
        const { posts, getPosts } = usePosts()
        const { categories, getCategories } = useCategories()
        onMounted(() => {
            getPosts()
            getCategories()
        })

        const updateOrdering = (column) => {
            orderColumn.value = column;
            orderDirection.value = (orderDirection.value === 'asc') ? 'desc' : 'asc';
            getPosts(
                1,
                selectedCategory.value,
                orderColumn.value,
                orderDirection.value
            );
        }

        watch(selectedCategory, (current, previous) => {
            getPosts(1, current)
        })

        return { posts, getPosts, categories, selectedCategory, orderColumn, orderDirection, updateOrdering }
    }
}
</script>
