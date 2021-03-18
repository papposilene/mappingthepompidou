export default {
    srcDir: 'resources/nuxt',
    buildModules: [
        '@nuxt/components',
        '@nuxtjs/tailwindcss',
    ],
    modules: [
        '@nuxtjs/axios',
    ],
    //components: true,
    components: {
        dirs: [
          '~/components',
        ]
    },
    axios: {
        baseURL: process.env.API_URL,
    },
    head: {
        titleTemplate: '%s - Mapping the Pompidou',
        meta: [
          { charset: 'utf-8' },
          { name: 'viewport', content: 'width=device-width, initial-scale=1' },
          {
            hid: 'description',
            name: 'description',
            content: 'Visualizing the Centre Pompidou\'s (Centre national d\'art moderne, aka CNAM) collection data.'
          }
        ],
        link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }],
        bodyAttrs: {
            class: 'bg-gray-900'
        }
    },
    ssr: false,
    target: 'static'
}
