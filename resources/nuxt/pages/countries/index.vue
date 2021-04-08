<template>
<div class="font-sans h-screen antialiased" id="app">
    <TheHeader />
    <main class="container w-full mx-auto pt-20 text-white">
        <div v-if="apiErrored" class="flex flex-row w-full px-0 mt-12 text-black bg-red-400 p-4 my-5 rounded uppercase">
            Bim bam boum, c'est tout cassé !
        </div>

        <div class="flex flex-wrap w-full px-0 md:mt-12">
            <div class="md:flex-col md:w-4/12 sm:w-full px-0 order-last sm:order-first">
                <div v-if="apiLoading" class="flex w-full text-black bg-green-500 p-4 my-5 rounded uppercase">
                    Chargement en cours...
                </div>

                <div v-else>
                    <div class="flex flex-col w-full px-0 mt-12">
                        <div class="flex flex-col w-full">
                            <ThePaginator :pagination="paginator" @paginate="fetchData()" :offset="4" />
                            <ul class="flex flex-col list-none text-white my-5 rounded">
                                <li v-for="data in apiStreamData.data" :key="data.cca3" class="flex border-b border-gray-600 hover:bg-gray-600 p-2">
                                    <router-link :to="`/countries/show/${data.cca3.toLowerCase()}`" class="w-full">
                                        <span>{{ data.flag }} {{ data.name_common_fra }}</span><br />
                                        <span class="text-gray-400 text-sm">
                                            Artistes : {{ data.has_artists_count }}.
                                        </span>
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:flex-col md:w-8/12 w-full px-0 mt-4 md:min-h-screen order-first sm:order-last">
                <h2 class="flex flex-col bg-gray-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ countriesTotal }} pays</span>
                </h2>
                <canvas id="chartCountries"></canvas>
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
            title: 'Pays'
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
            countriesTotal: 0
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
            axios.get('http://localhost:8000/api/1.1/countries?page=' + pageNumber)
                .then(response => {
                    this.apiStreamData = response.data;
                    this.paginator = response.data.meta;
                    this.countriesTotal = response.data.meta.total;
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
        }
    }
};
</script>