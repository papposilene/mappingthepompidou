<template>
<div class="font-sans h-screen antialiased" id="app">
    <TheHeader />
    <main class="container w-full mx-auto pt-20 text-white">
        <div v-if="artworksErrored" class="flex w-full text-black bg-red-400 p-4 my-5 mt-12 rounded uppercase">
            Bim bam boum, c'est tout cassé !
        </div>

        <div class="flex flex-row w-full px-0 mt-12">
            <div class="flex-col w-4/12 px-0">
                <div v-if="artworksLoading" class="flex w-full text-black bg-green-500 p-4 my-5 rounded uppercase">
                    Chargement en cours...
                </div>

                <div v-else>
                    <div class="flex flex-col w-full px-0 mt-12">
                        <div class="flex flex-col w-full">
                            <ThePaginator :pagination="artworksPaginator" @paginate="fetchData()" :offset="4" />
                            <ul class="flex flex-col list-none text-white my-5 rounded">
                                <li v-for="data in artworksStreamData.data" :key="data.uiid" class="flex border-b border-gray-600 hover:bg-gray-600 p-2">
                                    <router-link :to="`/artworks/show/${data.uuid}`" class="w-full">
                                        <span>{{ data.object_title }}</span><br />
                                        <span class="text-gray-400 text-sm">
                                            Date de création : {{ data.object_date ? data.object_date : 'sans date' }}.<br />
                                            Département de convervation : {{ data.museum_department.department_name }}.
                                        </span>
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-col w-8/12 px-0 mt-4 min-h-screen">
                <h2 class="flex flex-col bg-yellow-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ artworksTotal }} oeuvres</span>
                </h2>
                <div class="flex flex-row">
                    <canvas id="chartExposed"></canvas>
                </div>
                <div class="flex flex-row mt-12">
                    <div class="flex w-1/2">
                        <canvas id="chartUnknown"></canvas>
                    </div>
                    <div class="flex w-1/2">

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
            title: 'Oeuvre d‘art'
        }
    },
    data() {
        return{
            artworksErrored: false,
            artworksLoading: true,
            artworksStreamData: null,
            artworksPaginator: {},
            artworksTotal: 0,
            chartErrored: false,
            chartLoading: true,
        }
    },
    created() {
        this.$watch(
            () => this.$route.params,
            () => {
                this.fetchData()
            },
            { immediate: true }
        ),
        this.renderExposedChart(),
        this.renderUnknownChart()
    },
    methods: {
        async fetchData() {
            this.artworksErrored = false;
            this.artworksLoading = true;
            let currentPage = this.artworksPaginator.current_page;
            let pageNumber = currentPage ? currentPage : 1;
            axios.get('https://etp.psln.nl/api/artworks?page=' + pageNumber)
                .then(response => {
                    this.artworksStreamData = response.data;
                    this.artworksPaginator = this.artworksStreamData.meta;
                    this.artworksTotal = this.artworksStreamData.meta.total;
                    this.artworksLoading = false;
                })
                .catch(error => {
                    this.artworksErrored = true;
                    this.artworksError = response.data.message || error.message;
                })
                .finally(() => this.artworksLoading = false);
            console.info("Component mounted: Artworks.");
        },
        async renderExposedChart() {
            this.chartErrored = false;
            this.chartLoading = false;
            axios.get('https://etp.psln.nl/api/statistics/artworks/exposed')
                .then(response => {
                    new Chart(document.getElementById('chartExposed').getContext('2d'), {
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
            console.info("Component mounted: Exposed Chart.js.");
        },
        async renderUnknownChart() {
            this.chartErrored = false;
            this.chartLoading = false;
            axios.get('https://etp.psln.nl/api/statistics/artworks/unknown')
                .then(response => {
                    new Chart(document.getElementById('chartUnknown').getContext('2d'), {
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
            console.info("Component mounted: Unknown Chart.js.");
        }
    }
};
</script>
