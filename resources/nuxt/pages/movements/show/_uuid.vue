<template>
<div class="font-sans h-screen antialiased" id="app">
    <TheHeader />
    <main class="container w-full mx-auto pt-20 text-white">
        <div v-if="globalErrored" class="flex flex-row w-full px-0 mt-12 text-black bg-red-400 p-4 my-5 rounded uppercase">
            Bim bam boum, c'est tout cassé !
        </div>

        <div class="flex flex-row w-full px-0 mt-12">
            <div class="flex-col w-4/12 px-0">
                <h2 class="flex flex-col bg-pink-100 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ movementName }}</span>
                </h2>
                <ol>
                    <li class="p-2">
                        <span class="flex float-right bg-blue-400 text-black h-8 w-8 py-3 px-6 items-center justify-center rounded-full">
                            {{ globalGenderMen }}
                        </span>
                        <span>Hommes</span>
                    </li>
                    <li class="p-2">
                        <span class="flex float-right bg-red-400 text-black h-8 w-8 py-3 px-6 items-center justify-center rounded-full">
                            {{ globalGenderWomen }}
                        </span>
                        <span>Femmes</span>
                    </li>
                    <li class="p-2">
                        <span class="flex float-right bg-purple-400 text-black h-8 w-8 py-3 px-6 items-center justify-center rounded-full">
                            {{ globalGenderGroups }}
                        </span>
                        <span>Groupes</span>
                    </li>
                    <li class="p-2">
                        <span class="flex float-right bg-gray-400 text-black h-8 w-8 py-3 px-6 items-center justify-center rounded-full">
                            {{ globalGenderUnknown }}
                        </span>
                        <span>Inconnu</span>
                    </li>
                </ol>
            </div>
            <div class="flex-col w-4/12 px-0">
                <h2 class="flex flex-col bg-green-100 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ artistsTotal }} artistes</span>
                </h2>
                <div v-if="artistsLoading" class="flex w-full text-black bg-green-500 p-4 my-5 rounded uppercase">
                    Chargement en cours...
                </div>

                <div v-else>
                    <div class="flex flex-col w-full px-0 mt-4">
                        <div class="flex flex-col w-full">
                            <ThePaginator :pagination="artistsPaginator" @paginate="fetchArtists()" :offset="4" />
                            <ul class="flex flex-col list-none text-white my-5 rounded">
                                <li v-for="data1 in artistsStreamData.data" :key="data1.uuid" class="flex border-b border-gray-600 hover:bg-gray-600 p-2">
                                    <router-link :to="`/artists/show/${data1.uuid}`" class="w-full">
                                        <span>{{ data1.artist_name }}</span><br />
                                        <span class="text-gray-400 text-sm">
                                            Genre : {{ data.artist_gender }}.
                                        </span>
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-col w-4/12 px-0">
                <h2 class="flex flex-col bg-yellow-100 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ artworksTotal }} oeuvres</span>
                </h2>
                <div v-if="artworksLoading" class="flex w-full text-black bg-green-500 p-4 my-5 rounded uppercase">
                    Chargement en cours...
                </div>

                <div v-else>
                    <div class="flex flex-col w-full px-0 mt-4">
                        <div class="flex flex-col w-full">
                            <ThePaginator :pagination="artworksPaginator" @paginate="fetchArtworks()" :offset="4" />
                            <ul class="flex flex-col list-none text-white my-5 rounded">
                                <li v-for="data2 in artworksStreamData.data" :key="data2.uuid" class="flex border-b border-gray-600 hover:bg-gray-600 p-2">
                                    <router-link :to="`/artworks/show/${data2.uuid}`" class="w-full">
                                        <span>{{ data2.object_title }}</span><br />
                                        <span class="text-gray-400 text-sm">
                                            Creation : {{ data2.object_date }}.
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
import Chart from 'chart.js';
//import Pagination from 'interface/PaginationComponent.vue'

export default {
    head() {
        return {
            title: 'Mouvements artistiques'
        }
    },
    data() {
        return{
            movementName: null,
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
            axios.get('http://localhost:8000/api/movements/show/' + this.$route.params.uuid )
                .then(response => {
                    this.globalLoading = false;
                    this.globalStreamData = response.data.data[0];
                    this.globalTotal = globalStreamData.meta.total;
                    this.globalGenderMen = globalStreamData.artists.gender_men;
                    this.globalGenderWomen = globalStreamData.artists.gender_women;
                    this.globalGenderGroups = globalStreamData.artists.gender_groups;
                    this.globalGenderUnknown = globalStreamData.artists.gender_unknown;
                })
                .catch(error => {
                    this.globalErrored = true;
                    this.globalError = error.response.data.message || error.message;
                })
                .finally(() => this.globalLoading = false);
            console.info("Component mounted: Art Movement.");
        },
        async fetchArtists() {
            this.artistsErrored = false;
            this.artistsLoading = true;
            let currentPage = this.paginator.current_page;
            let pageNumber = currentPage ? currentPage : 1;
            axios.get('http://localhost:8000/api/movements/show/' + this.$route.params.uuid + '/artists?page=' + pageNumber)
                .then(response => {
                    this.artistsLoading = false;
                    this.artistsStreamData = response.data;
                    this.artistsPaginator = artistsStreamData.meta;
                    this.artistsTotal = artistsStreamData.meta.total;
                })
                .catch(error => {
                    this.artistsErrored = true;
                    this.artistsError = error.response.data.message || error.message;
                })
                .finally(() => this.artistsLoading = false);
            console.info("Component mounted: Artists by Movements.");
        },
        async fetchArtworks() {
            this.artworksErrored = false;
            this.artworksLoading = true;
            let currentPage = this.artworksPaginator.current_page;
            let pageNumber = currentPage ? currentPage : 1;
            axios.get('http://localhost:8000/api/movements/show/' + this.$route.params.uuid + '/artworks?page=' + pageNumber)
                .then(response => {

                    this.artworksLoading = false;
                    this.artworksStreamData = response.data;
                    this.artworksPaginator = artworksStreamData.meta;
                    this.artworksTotal = artworksStreamData.meta.total;
console.log(this.artworksTotal);
                })
                .catch(error => {
                    this.artworksErrored = true;
                    this.artworksError = error.response.data.message || error.message;
                })
                .finally(() => this.artworksLoading = false);
            console.info("Component mounted: Artworks by Movements.");
        }
    }
};
</script>
