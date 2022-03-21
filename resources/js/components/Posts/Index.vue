<template>
    <div class="overflow-auto lg:overflow-visible">
        <table class="table text-gray-500 border-separate space-y-6 text-sm w-full">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-3">Título</th>
                    <th class="p-3 text-left">Conteúdo</th>
                    <th class="p-3 text-left">Data</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr 
                    v-for="post in posts.data" :key="post.id"
                    class="bg-gray-100"
                >
                    <td class="p-3">
                        <div class="flex items-center">
                            <img class="rounded-full h-12 w-12  object-cover" src="https://images.unsplash.com/photo-1613588718956-c2e80305bf61?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=634&q=80" alt="unsplash image">
                            <div class="ml-3">
                                <div class="">{{ post.title }}</div>
                            </div>
                        </div>
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
                            <i class="material-icons-outlined text-base">visibility</i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-100  mx-2">
                            <i class="material-icons-outlined text-base">edit</i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-100  ml-2">
                            <i class="material-icons-round text-base">delete_outline</i>
                        </a>
                    </td>
                </tr>
                
            </tbody>
        </table>

        <Pagination :data="posts" @pagination-change-page="getPosts"/>

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

	tr td:nth-child(n+5),
	tr th:nth-child(n+5) {
		border-radius: 0 .625rem .625rem 0;
	}

	tr td:nth-child(1),
	tr th:nth-child(1) {
		border-radius: .625rem 0 0 .625rem;
	}
</style>

<script>
import { onMounted } from "vue"
import usePosts from '../../composables/posts'

export default {
    setup() {
        const { posts, getPosts } = usePosts()
        onMounted(getPosts)

        return { posts, getPosts }
    }
}
</script>
