import Vue from 'vue'
import Router from 'vue-router'
import { normalizeURL, decode } from 'ufo'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _868a9794 = () => interopDefault(import('../resources/nuxt/pages/acquisitions/index.vue' /* webpackChunkName: "pages/acquisitions/index" */))
const _bf04821c = () => interopDefault(import('../resources/nuxt/pages/artists/index.vue' /* webpackChunkName: "pages/artists/index" */))
const _793e7022 = () => interopDefault(import('../resources/nuxt/pages/artworks/index.vue' /* webpackChunkName: "pages/artworks/index" */))
const _44c4d24c = () => interopDefault(import('../resources/nuxt/pages/countries/index.vue' /* webpackChunkName: "pages/countries/index" */))
const _5ba49887 = () => interopDefault(import('../resources/nuxt/pages/departments/index.vue' /* webpackChunkName: "pages/departments/index" */))
const _2597b228 = () => interopDefault(import('../resources/nuxt/pages/docs.vue' /* webpackChunkName: "pages/docs" */))
const _778325ca = () => interopDefault(import('../resources/nuxt/pages/movements/index.vue' /* webpackChunkName: "pages/movements/index" */))
const _79c5f644 = () => interopDefault(import('../resources/nuxt/pages/acquisitions/show/_slug.vue' /* webpackChunkName: "pages/acquisitions/show/_slug" */))
const _605e4218 = () => interopDefault(import('../resources/nuxt/pages/artists/show/_uuid.vue' /* webpackChunkName: "pages/artists/show/_uuid" */))
const _2c4b618a = () => interopDefault(import('../resources/nuxt/pages/artworks/show/_uuid.vue' /* webpackChunkName: "pages/artworks/show/_uuid" */))
const _53daf772 = () => interopDefault(import('../resources/nuxt/pages/countries/show/_cca3.vue' /* webpackChunkName: "pages/countries/show/_cca3" */))
const _5fa31c93 = () => interopDefault(import('../resources/nuxt/pages/departments/show/_slug.vue' /* webpackChunkName: "pages/departments/show/_slug" */))
const _79192082 = () => interopDefault(import('../resources/nuxt/pages/genders/show/_slug.vue' /* webpackChunkName: "pages/genders/show/_slug" */))
const _0c296130 = () => interopDefault(import('../resources/nuxt/pages/movements/show/_slug.vue' /* webpackChunkName: "pages/movements/show/_slug" */))
const _2bc80a35 = () => interopDefault(import('../resources/nuxt/pages/index.vue' /* webpackChunkName: "pages/index" */))

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
    component: _868a9794,
    name: "acquisitions"
  }, {
    path: "/artists",
    component: _bf04821c,
    name: "artists"
  }, {
    path: "/artworks",
    component: _793e7022,
    name: "artworks"
  }, {
    path: "/countries",
    component: _44c4d24c,
    name: "countries"
  }, {
    path: "/departments",
    component: _5ba49887,
    name: "departments"
  }, {
    path: "/docs",
    component: _2597b228,
    name: "docs"
  }, {
    path: "/movements",
    component: _778325ca,
    name: "movements"
  }, {
    path: "/acquisitions/show/:slug?",
    component: _79c5f644,
    name: "acquisitions-show-slug"
  }, {
    path: "/artists/show/:uuid?",
    component: _605e4218,
    name: "artists-show-uuid"
  }, {
    path: "/artworks/show/:uuid?",
    component: _2c4b618a,
    name: "artworks-show-uuid"
  }, {
    path: "/countries/show/:cca3?",
    component: _53daf772,
    name: "countries-show-cca3"
  }, {
    path: "/departments/show/:slug?",
    component: _5fa31c93,
    name: "departments-show-slug"
  }, {
    path: "/genders/show/:slug?",
    component: _79192082,
    name: "genders-show-slug"
  }, {
    path: "/movements/show/:slug?",
    component: _0c296130,
    name: "movements-show-slug"
  }, {
    path: "/",
    component: _2bc80a35,
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
