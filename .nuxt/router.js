import Vue from 'vue'
import Router from 'vue-router'
import { normalizeURL, decode } from 'ufo'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _7dc9defc = () => interopDefault(import('../resources/nuxt/pages/acquisitions/index.vue' /* webpackChunkName: "pages/acquisitions/index" */))
const _3124706c = () => interopDefault(import('../resources/nuxt/pages/artists/index.vue' /* webpackChunkName: "pages/artists/index" */))
const _479045b5 = () => interopDefault(import('../resources/nuxt/pages/artworks/index.vue' /* webpackChunkName: "pages/artworks/index" */))
const _41445c58 = () => interopDefault(import('../resources/nuxt/pages/countries/index.vue' /* webpackChunkName: "pages/countries/index" */))
const _237c05fe = () => interopDefault(import('../resources/nuxt/pages/departments/index.vue' /* webpackChunkName: "pages/departments/index" */))
const _cf22e124 = () => interopDefault(import('../resources/nuxt/pages/docs.vue' /* webpackChunkName: "pages/docs" */))
const _794360c4 = () => interopDefault(import('../resources/nuxt/pages/movements/index.vue' /* webpackChunkName: "pages/movements/index" */))
const _0780973e = () => interopDefault(import('../resources/nuxt/pages/acquisitions/show/_slug.vue' /* webpackChunkName: "pages/acquisitions/show/_slug" */))
const _216d6cde = () => interopDefault(import('../resources/nuxt/pages/artists/show/_uuid.vue' /* webpackChunkName: "pages/artists/show/_uuid" */))
const _4ab07d35 = () => interopDefault(import('../resources/nuxt/pages/artworks/show/_uuid.vue' /* webpackChunkName: "pages/artworks/show/_uuid" */))
const _dffbd4e6 = () => interopDefault(import('../resources/nuxt/pages/countries/show/_cca3.vue' /* webpackChunkName: "pages/countries/show/_cca3" */))
const _5bf37459 = () => interopDefault(import('../resources/nuxt/pages/departments/show/_slug.vue' /* webpackChunkName: "pages/departments/show/_slug" */))
const _3a284b48 = () => interopDefault(import('../resources/nuxt/pages/genders/show/_slug.vue' /* webpackChunkName: "pages/genders/show/_slug" */))
const _73ce1b14 = () => interopDefault(import('../resources/nuxt/pages/movements/show/_slug.vue' /* webpackChunkName: "pages/movements/show/_slug" */))
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
    path: "/artists",
    component: _3124706c,
    name: "artists"
  }, {
    path: "/artworks",
    component: _479045b5,
    name: "artworks"
  }, {
    path: "/countries",
    component: _41445c58,
    name: "countries"
  }, {
    path: "/departments",
    component: _237c05fe,
    name: "departments"
  }, {
    path: "/docs",
    component: _cf22e124,
    name: "docs"
  }, {
    path: "/movements",
    component: _794360c4,
    name: "movements"
  }, {
    path: "/acquisitions/show/:slug?",
    component: _0780973e,
    name: "acquisitions-show-slug"
  }, {
    path: "/artists/show/:uuid?",
    component: _216d6cde,
    name: "artists-show-uuid"
  }, {
    path: "/artworks/show/:uuid?",
    component: _4ab07d35,
    name: "artworks-show-uuid"
  }, {
    path: "/countries/show/:cca3?",
    component: _dffbd4e6,
    name: "countries-show-cca3"
  }, {
    path: "/departments/show/:slug?",
    component: _5bf37459,
    name: "departments-show-slug"
  }, {
    path: "/genders/show/:slug?",
    component: _3a284b48,
    name: "genders-show-slug"
  }, {
    path: "/movements/show/:slug?",
    component: _73ce1b14,
    name: "movements-show-slug"
  }, {
    path: "/",
    component: _13ccd5af,
    name: "index"
  }],

  fallback: false
}

export function createRouter (ssrContext, config) {
  const base = (config._app && config._app.basePath) || routerOptions.base
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
