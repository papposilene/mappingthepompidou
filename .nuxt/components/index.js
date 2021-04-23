import { wrapFunctional } from './utils'

export { default as TheFooter } from '../../resources/nuxt/components/TheFooter.vue'
export { default as TheHeader } from '../../resources/nuxt/components/TheHeader.vue'
export { default as ThePaginator } from '../../resources/nuxt/components/ThePaginator.vue'

export const LazyTheFooter = import('../../resources/nuxt/components/TheFooter.vue' /* webpackChunkName: "components/the-footer" */).then(c => wrapFunctional(c.default || c))
export const LazyTheHeader = import('../../resources/nuxt/components/TheHeader.vue' /* webpackChunkName: "components/the-header" */).then(c => wrapFunctional(c.default || c))
export const LazyThePaginator = import('../../resources/nuxt/components/ThePaginator.vue' /* webpackChunkName: "components/the-paginator" */).then(c => wrapFunctional(c.default || c))
