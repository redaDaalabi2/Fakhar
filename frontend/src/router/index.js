import { createRouter, createWebHistory } from "vue-router";
import AccueilView from "../views/AccueilView.vue";
import ContactView from "../views/ContactView.vue";
import RegisterView from "../views/RegisterView.vue";
import LoginView from "../views/LoginView.vue";
import LoginAdminView from "../views/LoginAdminView.vue";

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
  {
    path: "/LoginView",
    name: "LoginView",
    component: LoginView
  },
  {
    path: "/LoginAdminView",
    name: "LoginAdminView",
    component: LoginAdminView
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
