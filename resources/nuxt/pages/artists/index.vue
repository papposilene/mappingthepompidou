<template>
<div class="font-sans h-screen antialiased" id="app">
    <TheHeader />
    <main class="container w-full mx-auto pt-20 text-white">
        <div v-if="artistsErrored" class="flex w-full text-black bg-red-400 p-4 my-5 mt-12 rounded uppercase">
            Bim bam boum, c'est tout cassé !
        </div>

        <div class="flex flex-row w-full px-0 mt-12">
            <div class="flex-col w-4/12 px-0 mt-4">
                <div v-if="artistsLoading" class="flex w-full text-black bg-green-500 p-4 my-5 rounded uppercase">
                    Chargement en cours...
                </div>

                <div v-else>
                    <div class="flex flex-col w-full px-0 mt-12">
                        <div class="flex flex-col w-full">
                            <ThePaginator :pagination="artistsPaginator" @paginate="fetchData()" :offset="4" />
                            <ul class="flex flex-col list-none text-white my-5 rounded">
                                <li v-for="data in artistsStreamData.data" :key="data.uiid" class="flex border-b border-gray-600 hover:bg-gray-600 p-2">
                                    <router-link :to="`/artists/show/${data.uuid}`" class="w-full">
                                        <span>{{ data.artist_name }}</span><br />
                                        <span class="text-gray-400 text-sm">
                                            Naissance : {{ data.artist_birth != 0 ? data.artist_birth : 'sans date' }}.
                                            Décès : {{ data.artist_death != 0 ? data.artist_death : 'sans date' }}.<br />
                                            Nombre d’oeuvres conservées : {{ data.has_artworks_count }}.<br />
                                        </span>
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-col w-8/12 px-0 mt-4">
                <h2 class="flex flex-col bg-yellow-100 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="mb-2">{{ artistsTotal }} artists</span>
                </h2>
                <canvas id="chartArtistsGenders"></canvas>
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
        this.renderChart(),
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
            axios.get('http://localhost:8000/api/artists/?page=' + pageNumber)
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
            console.info("Component mounted: Home.");
        },
        renderChart() {
            this.chartErrored = false
            this.chartLoading = true
            axios.get('http://localhost:8000/api/statistics/artists/genders')
                .then(response => {
                    const ctx = document.getElementById('chartArtistsGenders').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'horizontalBar',
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
            console.info("Component mounted: Chart.js.");
        }
    }
};
</script>
