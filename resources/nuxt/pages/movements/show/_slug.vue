<template>
<div class="font-sans h-screen antialiased" id="app">
    <TheHeader />
    <main class="container w-full mx-auto pt-20 text-white">
        <div class="flex flex-wrap w-full px-0 md:mt-12">
            <div class="md:flex-col md:w-4/12 w-full px-0">
                <h2 class="flex flex-col bg-pink-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ movementName }}</span>
                </h2>
                <ol class="px-4">
                    <li class="p-2 mb-2 bg-blue-300 text-black rounded">
                        <span class="flex float-right">
                            {{ globalGenderMen }}
                        </span>
                        <span>Hommes</span>
                    </li>
                    <li class="p-2 mb-2 bg-red-300 text-black rounded">
                        <span class="flex float-right">
                            {{ globalGenderWomen }}
                        </span>
                        <span>Femmes</span>
                    </li>
                    <li class="p-2 mb-2 bg-purple-300 text-black rounded">
                        <span class="flex float-right">
                            {{ globalGenderGroups }}
                        </span>
                        <span>Groupes</span>
                    </li>
                    <li class="p-2 mb-2 bg-gray-300 text-black rounded">
                        <span class="flex float-right">
                            {{ globalGenderUnknown }}
                        </span>
                        <span>Inconnu</span>
                    </li>
                </ol>
            </div>

            <div class="md:flex-col md:w-4/12 w-full px-0">
                <h3 class="flex flex-col bg-green-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ artistsTotal }} artistes</span>
                </h3>
                <div v-if="artistsLoading" class="flex w-full text-black bg-green-500 p-4 my-5 rounded uppercase">
                    Chargement en cours...
                </div>

                <div v-else class="px-4">
                    <div class="flex flex-col w-full px-0 mt-4">
                        <div class="flex flex-col w-full">
                            <ThePaginator :pagination="artistsPaginator" @paginate="fetchArtists()" :offset="4" />
                            <ul class="flex flex-col list-none text-white my-5 rounded">
                                <li v-for="data1 in artistsStreamData.data" :key="data1.uuid" class="flex border-b border-gray-600 hover:bg-gray-600 p-2">
                                    <router-link :to="`/artists/show/${data1.uuid}`" class="w-full">
                                        <span>{{ data1.artist_name }}</span><br />
                                        <span class="text-gray-400 text-sm">
                                            Catégorie : {{ data1.artist_type }}. Genre : {{ data1.artist_gender }}.<br />
                                            Naissance : {{ data1.artist_birth }}. Décès : {{ data1.artist_death }}.
                                        </span>
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:flex-col md:w-4/12 w-full px-0">
                <h3 class="flex flex-col bg-yellow-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ artworksTotal }} oeuvres</span>
                </h3>
                <div v-if="artworksLoading" class="flex w-full text-black bg-green-500 p-4 my-5 rounded uppercase">
                    Chargement en cours...
                </div>

                <div v-else class="px-4">
                    <div class="flex flex-col w-full px-0 mt-4">
                        <div class="flex flex-col w-full">
                            <ThePaginator :pagination="artworksPaginator" @paginate="fetchArtworks()" :offset="4" />
                            <ul class="flex flex-col list-none text-white my-5 rounded">
                                <li v-for="data2 in artworksStreamData.data" :key="data2.uuid" class="flex border-b border-gray-600 hover:bg-gray-600 p-2">
                                    <router-link :to="`/artworks/show/${data2.uuid}`" class="w-full">
                                        <span>{{ data2.object_title }}</span><br />
                                        <span class="text-gray-400 text-sm">
                                            Date de création : {{ data2.object_date }}.<br />
                                            Département : {{ data2.museum_department.department_name }}.
                                        </span>
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
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
            title: 'Mouvements artistiques'
        }
    },
    data() {
        return{
            movementName: 'Chargement en cours',
            globalErrored: false,
            globalLoading: true,
            globalStreamData: null,
            globalGenderMen : 0,
            globalGenderWomen: 0,
            globalGenderGroups: 0,
            globalGenderUnknown: 0,
            artistsErrored: false,
            artistsLoading: true,
            artistsStreamData: null,
            artistsPaginator: {},
            artistsTotal: 0,
            artworksErrored: false,
            artworksLoading: true,
            artworksStreamData: null,
            artworksPaginator: {},
            artworksTotal: 0
        }
    },
    created() {
        this.fetchData()
        this.$watch(
            () => this.$route.params,
            () => {
                this.fetchData()
                this.fetchArtists()
                this.fetchArtworks()
            },
            { immediate: true }
        )
    },
    methods: {
        async fetchData() {
            this.globalErrored = false;
            this.globalLoading = true;
            axios.get('https://etp.psln.nl/api/1.1/movements/show/' + this.$route.params.slug )
                .then(response => {
                    this.globalLoading = false;
                    this.globalStreamData = response.data.data[0];
                    this.movementName = this.globalStreamData.movement_name;
                    this.globalGenderMen = this.globalStreamData.artists.gender_men;
                    this.globalGenderWomen = this.globalStreamData.artists.gender_women;
                    this.globalGenderGroups = this.globalStreamData.artists.gender_groups;
                    this.globalGenderUnknown = this.globalStreamData.artists.gender_unknown;
                })
                .catch(error => {
                    this.globalErrored = true;
                    this.globalError = error.response.data.message || error.message;
                })
                .finally(() => this.globalLoading = false);
        },
        async fetchArtists() {
            this.artistsErrored = false;
            this.artistsLoading = true;
            let currentPage = this.artistsPaginator.current_page;
            let pageNumber = currentPage ? currentPage : 1;
            axios.get('https://etp.psln.nl/api/1.1/movements/show/' + this.$route.params.slug + '/artists?page=' + pageNumber)
                .then(response => {
                    this.artistsLoading = false;
                    this.artistsStreamData = response.data;
                    this.artistsPaginator = this.artistsStreamData.meta;
                    this.artistsTotal = this.artistsStreamData.meta.total;
                })
                .catch(error => {
                    this.artistsErrored = true;
                    this.artistsError = error.response.data.message || error.message;
                })
                .finally(() => this.artistsLoading = false);
        },
        async fetchArtworks() {
            this.artworksErrored = false;
            this.artworksLoading = true;
            let currentPage = this.artworksPaginator.current_page;
            let pageNumber = currentPage ? currentPage : 1;
            axios.get('https://etp.psln.nl/api/1.1/movements/show/' + this.$route.params.slug + '/artworks?page=' + pageNumber)
                .then(response => {
                    this.artworksLoading = false;
                    this.artworksStreamData = response.data;
                    this.artworksPaginator = this.artworksStreamData.meta;
                    this.artworksTotal = this.artworksStreamData.meta.total;
                })
                .catch(error => {
                    this.artworksErrored = true;
                    this.artworksError = error.response.data.message || error.message;
                })
                .finally(() => this.artworksLoading = false);
        }
    }
};
</script>
