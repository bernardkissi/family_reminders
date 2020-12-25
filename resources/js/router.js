import Vue from "vue";
import VueRouter from "vue-router";
import routes from "~/routes";

Vue.use(VueRouter);

/* Our Vue Router Object */
const router = new VueRouter({
  routes,
  /* Use Pretty URL */
  mode: "history",
  /* Save The Scroll Position , Useful When Redirecting Back */
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition;
    } else {
      return { x: 0, y: 0 };
    }
  }
});