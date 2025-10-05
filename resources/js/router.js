// import { createRouter, createWebHistory } from 'vue-router';
// import Projects from './components/Projects.vue';
// import WorkExperience from './components/WorkExperience.vue';
// import Skills from './components/Skills.vue';
// import Education from './components/Education.vue';
// import Home from './components/Home.vue';
// import Login from './components/Login.vue';


// const routes = [
//     { path: '/home', component: Home },
//     { path: '/project', component: Projects },
//     { path: '/experience', component: WorkExperience },
//     { path: '/skills', component: Skills },
//     { path: '/education', component: Education },
//     { path: '/login', component: Login}
// ];

// const router = createRouter({
//   history: createWebHistory(),
//   routes,
// });

// export default router;
import { createRouter, createWebHistory } from 'vue-router';
import Projects from './components/Projects.vue';
import WorkExperience from './components/WorkExperience.vue';
import Skills from './components/Skills.vue';
import Education from './components/Education.vue';
import Home from './components/Home.vue';
import Login from './components/Login.vue';

// Auth check function
const isLoggedIn = () => {
  return !!localStorage.getItem('auth_token'); // or use your auth method
};

const routes = [
  { path: '/home', component: Home, meta: { requiresAuth: true } },
  { path: '/project', component: Projects, meta: { requiresAuth: true } },
  { path: '/experience', component: WorkExperience, meta: { requiresAuth: true } },
  { path: '/skills', component: Skills, meta: { requiresAuth: true } },
  { path: '/education', component: Education, meta: { requiresAuth: true } },
  { path: '/login', component: Login }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// GLOBAL GUARD
router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !isLoggedIn()) {
    next('/login'); // redirect to login if not authenticated
  } else if (to.path === '/login' && isLoggedIn()) {
    next('/home'); // prevent going back to login after logged in
  } else {
    next(); // allow navigation
  }
});

export default router;
