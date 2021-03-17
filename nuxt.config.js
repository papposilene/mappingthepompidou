export default {
    buildModules: [
        '@nuxtjs/axios',
        '@nuxtjs/color-mode',
        '@nuxtjs/dotenv',
        '@nuxtjs/tailwindcss',
    ],
    modules: [
        '@nuxtjs/axios',
    ],
    components: true,
    axios: {
        baseURL: process.env.API_URL,
    },
    colorMode: {
        classSuffix: ''
    },
    head: {
        title: 'Mapping the Pompidou',
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
            class: 'bg-white dark:bg-gray-900'
        }
    },
    ssr: false,
    target: 'static'
}
