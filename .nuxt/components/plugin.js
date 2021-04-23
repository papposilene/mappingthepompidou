import Vue from 'vue'
import { wrapFunctional } from './utils'

const components = {
  TheFooter: () => import('../../resources/nuxt/components/TheFooter.vue' /* webpackChunkName: "components/the-footer" */).then(c => wrapFunctional(c.default || c)),
  TheHeader: () => import('../../resources/nuxt/components/TheHeader.vue' /* webpackChunkName: "components/the-header" */).then(c => wrapFunctional(c.default || c)),
  ThePaginator: () => import('../../resources/nuxt/components/ThePaginator.vue' /* webpackChunkName: "components/the-paginator" */).then(c => wrapFunctional(c.default || c))
}

for (const name in components) {
  Vue.component(name, components[name])
  Vue.component('Lazy' + name, components[name])
}
