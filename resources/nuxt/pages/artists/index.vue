<template>
<div class="font-sans h-screen antialiased" id="app">
    <TheHeader />
    <main class="container w-full mx-auto pt-20 text-white">
        <div v-if="artistsErrored" class="flex w-full text-black bg-red-400 p-4 my-5 mt-12 rounded uppercase">
            Bim bam boum, c'est tout cassé !
        </div>

        <div class="flex flex-wrap w-full px-0 md:mt-12">
            <div class="w-full px-0">
                <h2 class="flex flex-col bg-green-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="mb-2">{{ artistsTotal }} artistes</span>
                </h2>
                <div class="flex flex-row">
                    <div class="flex w-6/12">
                        <canvas id="chartArtistsGenders"></canvas>
                    </div>
                    <div class="flex w-6/12">
                        <canvas id="chartCountries"></canvas>
                    </div>
                </div>
                <div class="flex flex-row mt-4">
                    <canvas id="chartArtistsBirthYears"></canvas>
                </div>
            </div>

            <div class="w-full px-0 mt-4">
                <div v-if="artistsLoading" class="flex w-full text-black bg-green-500 p-4 my-5 rounded uppercase">
                    Chargement en cours...
                </div>

                <div v-else>
                    <div class="flex flex-col w-full px-0 mt-12">
                        <div class="flex flex-col w-full">
                            <ThePaginator :pagination="artistsPaginator" @paginate="fetchData()" :offset="4" />
                            <div class="flex flex-wrap justify-center list-none text-white my-5 rounded">
                                <div v-for="data in artistsStreamData.data" :key="data.uiid" class="flex-1 border border-gray-900 bg-gray-800 hover:bg-green-400 hover:text-black m-2 p-2 rounded">
                                    <router-link :to="`/artists/show/${data.uuid}`" class="w-full">
                                        <h3 class="font-semibold uppercase whitespace-nowrap">{{ data.artist_name }}</h3>
                                        <h4 class="text-sm whitespace-nowrap">
                                            Naissance : {{ data.artist_birth != 0 ? data.artist_birth : 'sans date' }}.
                                            Décès : {{ data.artist_death != 0 ? data.artist_death : 'sans date' }}.
                                        </h4>
                                        <h4 class="text-sm whitespace-nowrap">
                                            Nombre d’oeuvres conservées : {{ data.has_artworks_count }}.
                                        </h4>
                                    </router-link>
                                </div>
                            </div>
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

export default {
    head() {
        return {
            title: 'Artistes'
        }
    },
    data() {
        return{
            artistsErrored: false,
            artistsLoading: true,
            artistsStreamData: null,
            artistsPaginator: {},
            artistsTotal: 0,
            artistsWomen: 0,
            artistsMen: 0,
            artistsGroups: 0,
            artistsUnknown: 0,
            chartLoading: true,
            chartErrored: false,
            chartData: null
        }
    },
    created() {
        this.renderChartGenders(),
        this.renderChartCountries(),
        this.renderChartBirthYears(),
        this.$watch(
            () => this.$route.params,
            () => {
                this.fetchData()
            },
            { immediate: true }
        )
    },
    methods: {
        async fetchData() {
            this.artistsErrored = false
            this.artistsLoading = true
            let currentPage = this.artistsPaginator.current_page
            let pageNumber = currentPage ? currentPage : 1;
            axios.get('http://localhost:8000/api/1.1/artists/?page=' + pageNumber)
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
        renderChartGenders() {
            this.chartErrored = false
            this.chartLoading = true
            axios.get('http://localhost:8000/api/1.1/statistics/artists/genders')
                .then(response => {
                    new Chart(document.getElementById('chartArtistsGenders').getContext('2d'), {
                        type: 'pie',
                        data: response.data.chart,
                        options: response.data.options,
                    });
                    this.chartLoading = false
                })
                .catch(error => {
                    this.chartErrored = true
                    this.chartError = error.response.data.message || error.message
                })
                .finally(() => this.chartLoading = false);
        },
        async renderChartCountries() {
            this.chartErrored = false;
            this.chartLoading = false;
            axios.get('http://localhost:8000/api/1.1/statistics/countries')
                .then(response => {
                    new Chart(document.getElementById('chartCountries').getContext('2d'), {
                        type: 'bar',
                        data: response.data.chart,
                        options: response.data.options,
                    });
                    this.chartLoading = false
                })
                .catch(error => {
                    this.chartErrored = true
                    this.chartError = error.response.data.message || error.message
                })
                .finally(() => this.chartLoading = false);
        },
        renderChartBirthYears() {
            this.chartErrored = false
            this.chartLoading = true
            axios.get('http://localhost:8000/api/1.1/statistics/artists/birthyears')
                .then(response => {
                    new Chart(document.getElementById('chartArtistsBirthYears').getContext('2d'), {
                        type: 'line',
                        data: response.data.chart,
                        options: response.data.options,
                    });
                    this.chartLoading = false
                })
                .catch(error => {
                    this.chartErrored = true
                    this.chartError = error.response.data.message || error.message
                })
                .finally(() => this.chartLoading = false);
        },
    }
};
</script>
