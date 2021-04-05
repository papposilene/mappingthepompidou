<template class="bg-gray-900">
<div class="font-sans h-screen antialiased" id="app">
    <TheHeader />
    <main class="container w-full mx-auto pt-20 text-white">
        <div class="flex flex-wrap w-full px-0 md:mt-12">
            <div class="flex flex-wrap w-full px-0 mt-4">
                <h2 class="flex-1 bg-indigo-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <router-link to="/departments">
                        <span class="mb-2">Départements</span><br />
                        <span class="mt-2">{{ statDepartments }}</span>
                    </router-link>
                </h2>
                <h2 class="flex-1 bg-green-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <router-link to="/artists">
                        <span class="mb-2">Artistes</span><br />
                        <span class="mt-2">{{ statArtists }}</span>
                    </router-link>
                </h2>
                <h2 class="flex-1 bg-yellow-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <router-link to="/artworks">
                        <span class="mb-2">Oeuvres</span><br />
                        <span class="mt-2">{{ statArtworks }}</span>
                    </router-link>
                </h2>

                <h2 class="flex-1 bg-pink-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <router-link to="/movements">
                        <span class="mb-2">Mouvements</span><br />
                        <span class="mt-2">{{ statMovements }}</span>
                    </router-link>
                </h2>
                <h2 class="flex-1 bg-purple-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <router-link to="/acquisitions">
                        <span class="mb-2">Acquisitions</span><br />
                        <span class="mt-2">{{ statAcquisitions }}</span>
                    </router-link>
                </h2>
            </div>
            <div class="w-full px-0 mt-4">
                <p class="mb-4">
                    <em>Exploring The Pompidou</em> vous permet de vous plonger visuellement dans les collections du Centre national d'art moderne,
                    plus connu sous le nom de Centre Pompidou.
                </p>
                <p class="mb-4">
                    Ce site repose sur une extraction des données disponibles dans Navigart. Réalisée sans qu'une API officielle et publique n'existe,
                    elle se contente strictement des informations utiles pour les visualisations envisagées. Les données récupérées sont celles
                    disponibles à la date du 16 mars 2021 sur le site des collections du Centre Pompidou (via
                    l'<a href="https://collection.centrepompidou.fr/" class="underline" target="_blank" rel="noopener">application Navigart</a> de
                    <a href="https://www.videomuseum.fr/" class="underline" target="_blank" rel="noopener">Videomuseum</a>),
                    et sont donc bien évidemment susceptibles d'évoluer selon l'état des connaissances et des mises à jour du musée.
                </p>
                <p class="mb-4">
                    Enfin, le script ayant permis l'extraction en question est librement <a href="https://github.com/papposilene/navigart-scrapy" class="underline" target="_blank" rel="noopener">disponible sur Github</a>.
                </p>
            </div>

        </div>
    </main>
    <TheFooter />
</div>
</template>

<script>
window.axios = require('axios');
export default {
    head() {
        return {
            title: 'Bienvenue'
        }
    },
    data() {
        return{
            statDataStream: null,
            statLoading: true,
            statErrored: false,
            statAcquisitions: 0,
            statArtists: 0,
            statArtworks: 0,
            statDepartments: 0,
            statMovements: 0
        }
    },
    created() {
        // watch the params of the route to fetch the data again
        this.$watch(
            () => this.$route.params,
            () => {
                this.fetchData()
            },
            // fetch the data when the view is created and
            // the data is already being observed
            { immediate: true }
        )
    },
    methods: {
        async fetchData() {
            this.statErrored = false
            this.statLoading = true
            axios.get('http://localhost:8000/api/1.1/statistics/')
                .then(response => {
                    this.statDataStream = response.data.data;
                    this.statAcquisitions = this.statDataStream.acquisitions.total;
                    this.statArtists = this.statDataStream.artists.total;
                    this.statArtworks = this.statDataStream.artworks.total;
                    this.statDepartments = this.statDataStream.departments.total;
                    this.statMovements = this.statDataStream.movements.total;
                    this.statLoading = false;
                })
                .catch(error => {
                    this.statErrored = true;
                    this.statError = error.response.data.message || error.message;
                })
                .finally(() => this.statLoading = false);
            console.info("Component mounted: Home.");
        }
    },
};
</script>
