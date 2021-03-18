<template>
<div class="font-sans h-screen antialiased" id="app">
    <TheHeader />
    <main class="container w-full mx-auto pt-20 text-white">
        <div class="flex flex-row w-full px-0 mt-12">
            <div class="flex-col w-full px-0 mt-4">
                <canvas id="chartMovements"></canvas>
            </div>
        </div>
        <div class="flex flex-row w-full px-0 mt-12">

            <div class="flex-col w-4/12 px-0 mt-4">
                <h2 class="flex flex-col bg-pink-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="mb-2">Mouvements</span>
                    <span class="mt-2">{{ movementsTotal }}</span>
                </h2>

            </div>
            <div class="flex-col w-8/12 px-0 mt-4">
                <div v-if="apiErrored" class="text-black bg-red-500 p-4 my-5 rounded uppercase">
                    Bim bam boum, c'est tout cassé !
                </div>

                <section v-else class="py-4 w-full">
                    <div v-if="apiLoading" class="text-black bg-green-500 p-4 my-5 rounded uppercase">
                        Chargement en cours...
                    </div>

                    <div v-else>
                        <ThePaginator :pagination="paginator" @paginate="fetchData()" :offset="4" />
                        <ul class="list-none text-white my-5 rounded">
                            <li v-for="data in apiStreamData.data" :key="data.uuid" class="bg-gray-800 p-2">
                                <router-link :to="{ name: 'movements_show', params: { uuid: data.uuid }}">
                                    <span>{{ data.movement_name }}</span><br />
                                    <span class="text-gray-400 text-sm">
                                        Artistes : {{ data.artists.total }}.
                                        Oeuvres : {{ data.artworks.total }}
                                    </span>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </section>
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
            apiStreamData: null,
            apiLoading: true,
            apiErrored: false,
            paginator: {},
            movementsTotal: 0
        }
    },
    created() {
        this.createChart(),
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
            this.apiErrored = false
            this.apiLoading = true
            let currentPage = this.paginator.current_page;
            let pageNumber = currentPage ? currentPage : 1;
            axios.get('http://localhost:8000/api/movements?page=' + pageNumber)
                .then(response => {
                    this.apiLoading = false;
                    this.apiStreamData = response.data;
                    this.paginator = response.data.meta;
                    this.movementsTotal = response.data.meta.total;
                })
                .catch(error => {
                    this.apiErrored = true;
                    this.apiError = error.response.data.message || error.message;
                })
                .finally(() => this.apiLoading = false);
            console.info("Component mounted: Movements.");
        },
        createChart() {
            this.chartErrored = false
            this.chartLoading = true
            axios.get('http://localhost:8000/api/statistics/movements')
                .then(response => {
                    const ctx = document.getElementById('chartMovements').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: response.data.chart,
                        options: response.data.options,
                    });
                    this.chartLoading = false;
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
