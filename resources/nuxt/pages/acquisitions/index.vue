<template>
<div class="font-sans h-screen antialiased" id="app">
    <TheHeader />
    <main class="container w-full mx-auto pt-20 text-white">
        <div v-if="acquisitionsErrored" class="flex w-full text-black bg-red-400 p-4 my-5 mt-12 rounded uppercase">
            Bim bam boum, c'est tout cassé !
        </div>

        <div class="flex flex-wrap w-full px-0 md:mt-12">
            <div class="w-full px-0">
                <h2 class="flex flex-col bg-purple-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ acquisitionsTotal }} types d’acquisitions</span>
                </h2>
                <canvas id="chartAcquisitions"></canvas>
            </div>
            <div class="w-full px-0 mt-4">
                <div v-if="acquisitionsLoading" class="flex w-full text-black bg-green-500 p-4 my-5 rounded uppercase">
                    Chargement en cours...
                </div>

                <div v-else>
                    <div class="flex flex-col w-full px-0 mt-12">
                        <div class="flex flex-col w-full">
                            <ThePaginator :pagination="acquisitionsPaginator" @paginate="fetchData()" :offset="4" />
                            <div class="flex flex-wrap justify-center list-none text-white my-5 rounded">
                                <div v-for="data in acquisitionsStreamData.data" :key="data.acquisition_slug" class="flex-1 border border-gray-900 bg-gray-800 hover:bg-red-400 hover:text-black m-2 p-2 rounded">
                                    <router-link :to="`/acquisitions/show/${data.acquisition_slug}`" class="w-full">
                                        <h3 class="font-semibold uppercase whitespace-nowrap">{{ data.acquisition_name }}</h3>
                                        <h4 class="text-sm whitespace-nowrap">
                                            Oeuvres : {{ data.acquired_artworks_count }}.
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
            title: 'Acquisitions'
        }
    },
    data() {
        return{
            acquisitionsErrored: false,
            acquisitionsLoading: true,
            acquisitionsStreamData: null,
            acquisitionsPaginator: {},
            acquisitionsTotal: 0,
            chartErrored: false,
            chartLoading: true
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
        this.renderChart()
    },
    methods: {
        async fetchData() {
            this.acquisitionsErrored = false;
            this.acquisitionsLoading = true;
            let currentPage = this.acquisitionsPaginator.current_page;
            let pageNumber = currentPage ? currentPage : 1;
            axios.get('https://etp.psln.nl/api/1.1/acquisitions?page=' + pageNumber)
                .then(response => {
                    this.acquisitionsStreamData = response.data;
                    this.acquisitionsPaginator = this.acquisitionsStreamData.meta;
                    this.acquisitionsTotal = this.acquisitionsStreamData.meta.total;
                    this.acquisitionsLoading = false;
                })
                .catch(error => {
                    this.acquisitionsErrored = true;
                    this.acquisitionsError = response.data.message || error.message;
                })
                .finally(() => this.acquisitionsLoading = false);
        },
        async renderChart() {
            this.chartErrored = false
            this.chartLoading = false
            axios.get('https://etp.psln.nl/api/1.1/statistics/acquisitions')
                .then(response => {
                    new Chart(document.getElementById('chartAcquisitions').getContext('2d'), {
                        type: 'bar',
                        data: response.data.chart,
                        options: response.data.options,
                    });
                    this.chartLoading = true
                })
                .catch(error => {
                    this.chartErrored = true;
                    this.chartError = error.response.data.message || error.message;
                })
                .finally(() => this.chartLoading = false);
        }
    }
};
</script>
