import { createRouter, createWebHistory } from "vue-router";
import AccueilView from "../views/AccueilView.vue";
import ContactView from "../views/ContactView.vue";
import RegisterView from "../views/RegisterView.vue";

const routes = [
  {
    path: "/",
    name: "AccueilView",
    component: AccueilView
  },
  {
    path: "/ContactView",
    name: "ContactView",
    component: ContactView
  },
  {
    path: "/RegisterView",
    name: "RegisterView",
    component: RegisterView
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
