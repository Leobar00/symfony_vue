import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home";
import Website from "../views/Website.vue";

Vue.use(VueRouter);

export default new VueRouter({
  mode: "history",
  routes: [
    { path: "/", component: Website },
    //{ path: "*", redirect: "/" }
  ]
});