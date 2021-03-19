<template>
<div class="font-sans h-screen antialiased" id="app">
    <TheHeader />
    <main class="container w-full mx-auto pt-20 text-white">
        <div v-if="acquisitionsErrored" class="flex w-full text-black bg-red-400 p-4 my-5 mt-12 rounded uppercase">
            Bim bam boum, c'est tout cassé !
        </div>

        <div class="flex flex-row w-full px-0 mt-12">
            <div class="flex-col w-4/12 px-0">
                <div v-if="acquisitionsLoading" class="flex w-full text-black bg-green-500 p-4 my-5 rounded uppercase">
                    Chargement en cours...
                </div>

                <div v-else>
                    <div class="flex flex-col w-full px-0 mt-12">
                        <div class="flex flex-col w-full">
                            <ThePaginator :pagination="acquisitionsPaginator" @paginate="fetchData()" :offset="4" />
                            <ul class="flex flex-col list-none text-white my-5 rounded">
                                <li v-for="data in acquisitionsStreamData.data" :key="data.acquisition_slug" class="flex border-b border-gray-600 hover:bg-gray-600 p-2">
                                    <router-link :to="`/acquisitions/show/${data.acquisition_slug}`" class="w-full">
                                        <span>{{ data.acquisition_name }}</span><br />
                                        <span class="text-gray-400 text-sm">
                                            Oeuvres entrées par ce type d‘acquisition : {{ data.artworks.total }}.
                                        </span>
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-col w-8/12 px-0 mt-4 min-h-screen">
                <h2 class="flex flex-col bg-purple-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ acquisitionsTotal }} types d’acquisitions</span>
                </h2>
                <canvas id="chartAcquisitions"></canvas>
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
            axios.get('http://localhost:8000/api/acquisitions?page=' + pageNumber)
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
            console.info("Component mounted: Acquisitions.");
        },
        async renderChart() {
            this.chartErrored = false
            this.chartLoading = false
            axios.get('http://localhost:8000/api/statistics/acquisitions')
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
            console.info("Component mounted: Chart.js.");
        }
    }
};
</script>
