import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home";
import Navbar from "../views/Navbar.vue";

Vue.use(VueRouter);

export default new VueRouter({
  mode: "history",
  routes: [
    { path: "/", component: Navbar },
    //{ path: "*", redirect: "/" }
  ]
});