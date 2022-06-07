import { createRouter, createWebHistory } from "vue-router";
import AccueilView from "../views/AccueilView.vue";
import ContactView from "../views/ContactView.vue";
import RegisterView from "../views/RegisterView.vue";
import LoginView from "../views/LoginView.vue";
import LoginAdminView from "../views/LoginAdminView.vue";
import AnalyseAdminView from "../views/Dashboard/AnalyseAdminView.vue";
import CommandesAdminView from "../views/Dashboard/CommandesAdminView.vue";
import PoteriesAdminView from "../views/Dashboard/PoteriesAdminView.vue";
import CategoriesAdminView from "../views/Dashboard/CategoriesAdminView.vue";
import BoutiqueView from "../views/Magasin/BoutiqueView.vue";
import ProfileView from "../views/Magasin/ProfileView.vue";
import ContactAdminView from "../views/Dashboard/ContactAdminView.vue";

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
  {
    path: "/Dashboard/AnalyseAdminView",
    name: "AnalyseAdminView",
    component: AnalyseAdminView
  },
  {
    path: "/Dashboard/CommandesAdminView",
    name: "CommandesAdminView",
    component: CommandesAdminView
  },
  {
    path: "/Dashboard/PoteriesAdminView",
    name: "PoteriesAdminView",
    component: PoteriesAdminView
  },
  {
    path: "/Dashboard/CategoriesAdminView",
    name: "CategoriesAdminView",
    component: CategoriesAdminView
  },
  {
    path: "/Magasin/BoutiqueView",
    name: "BoutiqueView",
    component: BoutiqueView
  },
  {
    path: "/Magasin/ProfileView",
    name: "ProfileView",
    component: ProfileView
  },
  {
    path: "/Dashboard/ContactAdminView",
    name: "ContactAdminView",
    component: ContactAdminView
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
