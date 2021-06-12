import Vue from "vue";
import VueRouter from "vue-router";
         
Vue.use(VueRouter);

import index from "./components/index.vue";
import main from "./components/main.vue";
import login from "./components/login.vue";
import create from "./components/create.vue";
import blog from "./components/blog.vue";

const router = new VueRouter({
    mode: "history",
    routes: [
    {
        path: '/list',
        name: 'index',
        component: index,
        meta: { guest: true },
        children:[{
          path: '',
          name: 'main',
          component: main,
          meta: { guest: true },
        },
        {
          path: '/list/:id',
          name: 'blog',
          component: blog,
          meta: { blog: true },
          props: true,
      },
      ]
    },
    {
        base:'/login_for_system_admin_only',
        path:'/login_for_system_admin_only',
        name:'login',
        component: login,
        meta: { guest: true },
    },
    {
        path:'/login_for_system_admin_only/create',
        name:'create',
        component: create,
        meta:{requiresAuth: true},
    }, 
]
});

function loggedIn(){
    return localStorage.getItem("auth")
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      if (!loggedIn()) {
        next({
          name:'index',
          query: { redirect: to.fullPath }
        })
      } else {
        next();
      }
    } else  if (to.matched.some(record => record.meta.guest))
        if (loggedIn()) {
            next({
              path: '/login_for_system_admin_only/create',
              query: { redirect: to.fullPath }
            })
    }
    else{
        next();
    }
}); 
export default router;