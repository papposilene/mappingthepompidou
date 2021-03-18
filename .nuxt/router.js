import Vue from 'vue'
import Router from 'vue-router'
import { normalizeURL, decode } from 'ufo'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _7dc9defc = () => interopDefault(import('../resources/nuxt/pages/acquisitions/index.vue' /* webpackChunkName: "pages/acquisitions/index" */))
const _78a75037 = () => interopDefault(import('../resources/nuxt/pages/api.vue' /* webpackChunkName: "pages/api" */))
const _3124706c = () => interopDefault(import('../resources/nuxt/pages/artists/index.vue' /* webpackChunkName: "pages/artists/index" */))
const _794360c4 = () => interopDefault(import('../resources/nuxt/pages/movements/index.vue' /* webpackChunkName: "pages/movements/index" */))
const _0780973e = () => interopDefault(import('../resources/nuxt/pages/acquisitions/show/_slug.vue' /* webpackChunkName: "pages/acquisitions/show/_slug" */))
const _5d4ef386 = () => interopDefault(import('../resources/nuxt/pages/movements/show/_uuid.vue' /* webpackChunkName: "pages/movements/show/_uuid" */))
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
    path: "/acquisitions",
    component: _7dc9defc,
    name: "acquisitions"
  }, {
    path: "/api",
    component: _78a75037,
    name: "api"
  }, {
    path: "/artists",
    component: _3124706c,
    name: "artists"
  }, {
    path: "/movements",
    component: _794360c4,
    name: "movements"
  }, {
    path: "/acquisitions/show/:slug?",
    component: _0780973e,
    name: "acquisitions-show-slug"
  }, {
    path: "/movements/show/:uuid?",
    component: _5d4ef386,
    name: "movements-show-uuid"
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
