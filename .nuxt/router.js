import Vue from 'vue'
import Router from 'vue-router'
import { normalizeURL, decode } from 'ufo'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _78a75037 = () => interopDefault(import('../resources/nuxt/pages/api.vue' /* webpackChunkName: "pages/api" */))
const _5f3866ae = () => interopDefault(import('../resources/nuxt/pages/artists.vue' /* webpackChunkName: "pages/artists" */))
const _d59841fe = () => interopDefault(import('../resources/nuxt/pages/movements.vue' /* webpackChunkName: "pages/movements" */))
const _13ccd5af = () => interopDefault(import('../resources/nuxt/pages/index.vue' /* webpackChunkName: "pages/index" */))

const emptyFn = () => {}

Vue.use(Router)

export const routerOptions = {
  mode: 'history',
  base: '/',
  linkActiveClass: 'nuxt-link-active',
  linkExactActiveClass: 'nuxt-link-exact-active',
  scrollBehavior,

  routes: [{
    path: "/api",
    component: _78a75037,
    name: "api"
  }, {
    path: "/artists",
    component: _5f3866ae,
    name: "artists"
  }, {
    path: "/movements",
    component: _d59841fe,
    name: "movements"
  }, {
    path: "/",
    component: _13ccd5af,
    name: "index"
  }],

  fallback: false
}

export function createRouter (ssrContext, config) {
  const base = (config.app && config.app.basePath) || routerOptions.base
  const router = new Router({ ...routerOptions, base  })

  // TODO: remove in Nuxt 3
  const originalPush = router.push
  router.push = function push (location, onComplete = emptyFn, onAbort) {
    return originalPush.call(this, location, onComplete, onAbort)
  }

  const resolve = router.resolve.bind(router)
  router.resolve = (to, current, append) => {
    if (typeof to === 'string') {
      to = normalizeURL(to)
    }
    return resolve(to, current, append)
  }

  return router
}
