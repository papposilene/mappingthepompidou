<template>
<div class="font-sans h-screen antialiased" id="app">
    <TheHeader />
    <main class="container w-full mx-auto pt-20 text-white">
        <div class="flex flex-row w-full px-0 mt-12">
            <div class="flex-col w-4/12 px-0 mt-4">
                <h2 class="flex flex-col bg-yellow-100 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="mb-2">{{ artistsTotal }} artists</span>
                </h2>
                <canvas id="chartArtistsGenders"></canvas>
            </div>
            <div class="flex-col w-8/12 px-0 mt-4">

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
            apiStreamData: null,
            apiLoading: true,
            apiErrored: false,
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
            axios.get('http://localhost:8000/api/statistics/artists/genders')
                .then(response => {
                    this.apiLoading = false;
                    this.apiStreamData = response.data.data;
                    this.artistsTotal = this.apiStreamData.total;
                    this.artistsWomen = this.apiStreamData.women;
                    this.artistsMen = this.apiStreamData.men;
                    this.artistsGroups = this.apiStreamData.groups;
                    this.artistsUnknown = this.apiStreamData.unknwon;
                })
                .catch(error => {
                    this.apiErrored = true;
                    //this.error = error.response.data.message || error.message;
                })
                .finally(() => this.apiLoading = false);
            console.info("Component mounted: Home.");
        },
        createChart() {
            this.chartErrored = false
            this.chartLoading = true
            axios.get('http://localhost:8000/api/statistics/artists/genders')
                .then(response => {
                    console.log(response.data.chart);
                    const ctx = document.getElementById('chartArtistsGenders').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'horizontalBar',
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
