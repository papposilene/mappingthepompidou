<template>
<div class="font-sans h-screen antialiased" id="app">
    <TheHeader />
    <main class="container w-full mx-auto pt-20 text-white">
        <div v-if="apiErrored" class="flex flex-row w-full px-0 mt-12 text-black bg-red-400 p-4 my-5 rounded uppercase">
            Bim bam boum, c'est tout cassé !
        </div>

        <div class="flex flex-wrap w-full px-0 md:mt-12">
            <div class="w-full px-0">
                <h2 class="flex flex-col bg-pink-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ movementsTotal }} mouvements artistiques</span>
                </h2>
                <canvas id="chartMovements"></canvas>
            </div>

            <div class="w-full px-0 mt-4">
                <div v-if="apiLoading" class="flex w-full text-black bg-green-500 p-4 my-5 rounded uppercase">
                    Chargement en cours...
                </div>

                <div v-else>
                    <div class="flex flex-row w-full px-0 mt-12">
                        <div class="flex flex-col w-full">
                            <ThePaginator :pagination="paginator" @paginate="fetchData()" :offset="4" />
                            <div class="flex flex-wrap justify-center list-none text-white my-5 rounded">
                                <div v-for="data in apiStreamData.data" :key="data.movement_slug" class="flex-1 border border-gray-900 bg-gray-800 hover:bg-pink-400 hover:text-black m-2 p-2 rounded">
                                    <router-link :to="`/movements/show/${data.movement_slug}`" class="w-full">
                                        <h3 class="font-semibold uppercase whitespace-nowrap">{{ data.movement_name }}</h3>
                                        <h4 class="text-sm whitespace-nowrap">
                                            Artistes : {{ data.has_artists_count }}.<br />
                                            Oeuvres : {{ data.has_artworks_count }}.
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
            title: 'Mouvements artistiques'
        }
    },
    data() {
        return{
            apiStreamData: {},
            apiLoading: true,
            apiErrored: false,
            chartLoading: true,
            chartErrored: false,
            paginator: {},
            movementsTotal: 0
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
            this.apiErrored = false;
            this.apiLoading = true;
            let currentPage = this.paginator.current_page;
            let pageNumber = currentPage ? currentPage : 1;
            axios.get('http://localhost:8000/api/1.1/movements?page=' + pageNumber)
                .then(response => {
                    this.apiStreamData = response.data;
                    this.paginator = response.data.meta;
                    this.movementsTotal = response.data.meta.total;
                    this.apiLoading = false;
                })
                .catch(error => {
                    this.apiErrored = true;
                    this.apiError = response.data.message || error.message;
                })
                .finally(() => this.apiLoading = false);
        },
        async renderChart() {
            this.chartErrored = false;
            this.chartLoading = false;
            axios.get('http://localhost:8000/api/1.1/statistics/movements')
                .then(response => {
                    new Chart(document.getElementById('chartMovements').getContext('2d'), {
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
        }
    }
};
</script>
