export const TheFooter = () => import('../../resources/nuxt/components/TheFooter.vue' /* webpackChunkName: "components/the-footer" */).then(c => wrapFunctional(c.default || c))
export const TheHeader = () => import('../../resources/nuxt/components/TheHeader.vue' /* webpackChunkName: "components/the-header" */).then(c => wrapFunctional(c.default || c))
export const ThePaginator = () => import('../../resources/nuxt/components/ThePaginator.vue' /* webpackChunkName: "components/the-paginator" */).then(c => wrapFunctional(c.default || c))

// nuxt/nuxt.js#8607
function wrapFunctional(options) {
  if (!options || !options.functional) {
    return options
  }

  const propKeys = Array.isArray(options.props) ? options.props : Object.keys(options.props || {})

  return {
    render(h) {
      const attrs = {}
      const props = {}

      for (const key in this.$attrs) {
        if (propKeys.includes(key)) {
          props[key] = this.$attrs[key]
        } else {
          attrs[key] = this.$attrs[key]
        }
      }

      return h(options, {
        on: this.$listeners,
        attrs,
        props,
        scopedSlots: this.$scopedSlots,
      }, this.$slots.default)
    }
  }
}
