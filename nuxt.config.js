export default {
    srcDir: 'resources/nuxt',
    buildModules: [
        '@nuxt/components',
        '@nuxt/postcss8',
        '@nuxtjs/tailwindcss',
    ],
    modules: [
        '@nuxtjs/axios',
        '@nuxt/http',
        [
            'nuxt-matomo',
            {
                matomoUrl: '//mtm.httpap.dev/',
                siteId: 12,
                doNotTrack: true,
                debug: false,
                verbose: false
            }
        ],
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
        titleTemplate: '%s - Exploring The Centre Pompidou',
        meta: [
            {charset: 'utf-8'},
            {name: 'viewport', content: 'width=device-width, initial-scale=1'},
            {
                hid: 'description',
                name: 'description',
                content: 'Visualizing the Centre Pompidou\'s (Centre national d\'art moderne, aka CNAM) collection data.'
            },
            {
                hid: 'twitter:creator',
                name: 'twitter:creator',
                content: '@papposilene'
            },
            {
                hid: 'twitter:card',
                name: 'twitter:card',
                content: 'summary_large_image'
            },
            {
                hid: 'og:title',
                property: 'og:title',
                content: 'Exploring The Pompidou'
            },
            {
                hid: 'og:description',
                property: 'og:description',
                content: 'Visualizing the Centre Pompidou\'s (Centre national d\'art moderne, aka CNAM) collection data.'
            },
            {
                hid: 'og:image',
                name: 'og:image',
                content: '/img/exploring-the-centre-pompidou_screenshot.png'
            }

        ],
        link: [{rel: 'icon', type: 'image/x-icon', href: '/favicon.ico'}],
        bodyAttrs: {
            class: 'bg-gray-900 m-4'
        }
    },
    ssr: false,
    target: 'static'
}
