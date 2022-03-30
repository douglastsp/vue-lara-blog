import { createRouter, createWebHistory } from 'vue-router';
import PostsIndex from '../components/Posts/Index';
import PostCreate from '../components/Posts/Create';

const routes = [
    {
        path: '/',
        name: 'posts.index',
        component: PostsIndex,
        meta: {
            pageTitle: 'Posts'
        }
    },
    {
        path: '/post/create',
        name: 'post.create',
        component: PostCreate,
        meta: {
            pageTitle: 'Novo Post'
        }
    },
];

export default createRouter({
    history: createWebHistory(),
    routes
});
