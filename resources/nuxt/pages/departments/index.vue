<template>
<div class="font-sans h-screen antialiased" id="app">
    <TheHeader />
    <main class="container w-full mx-auto pt-20 text-white">
        <div v-if="departmentsErrored" class="flex w-full text-black bg-indigo-400 p-4 my-5 mt-12 rounded uppercase">
            Bim bam boum, c'est tout cassé !
        </div>

        <div class="flex flex-wrap w-full px-0 md:mt-12">
            <div class="w-full px-0">
                <h2 class="flex flex-col bg-indigo-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ departmentsTotal }} départements</span>
                </h2>
                <canvas id="chartDepartments"></canvas>
            </div>

            <div class="w-full px-0 mt-4">
                <div v-if="departmentsLoading" class="flex w-full text-black bg-green-500 p-4 my-5 rounded uppercase">
                    Chargement en cours...
                </div>

                <div v-else>
                    <div class="flex flex-col w-full px-0 mt-12">
                        <div class="flex flex-col w-full">
                            <ThePaginator :pagination="departmentsPaginator" @paginate="fetchData()" :offset="4" />
                            <div class="flex flex-wrap justify-center list-none text-white my-5 rounded">
                                <div v-for="data in departmentsStreamData.data" :key="data.department_slug" class="flex-1 border border-gray-900 bg-gray-800 hover:bg-indigo-400 hover:text-black m-2 p-2 rounded">
                                    <router-link :to="`/departments/show/${data.department_slug}`" class="w-full">
                                        <h3 class="font-semibold uppercase whitespace-nowrap">{{ data.department_name }}</h3>
                                        <h4 class="text-sm whitespace-nowrap">
                                            Oeuvres : {{ data.conserved_artworks_count }}.
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
            title: 'Départments'
        }
    },
    data() {
        return{
            departmentsErrored: false,
            departmentsLoading: true,
            departmentsStreamData: null,
            departmentsPaginator: {},
            departmentsTotal: 0,
            chartLoading: true,
            chartErrored: false,
            chartData: null
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
            this.departmentsErrored = false;
            this.departmentsLoading = true;
            let currentPage = this.departmentsPaginator.current_page;
            let pageNumber = currentPage ? currentPage : 1;
            axios.get('https://etp.psln.nl/api/1.1/departments?page=' + pageNumber)
                .then(response => {
                    this.departmentsStreamData = response.data;
                    this.departmentsPaginator = this.departmentsStreamData.meta;
                    this.departmentsTotal = this.departmentsStreamData.meta.total;
                    this.departmentsLoading = false;
                })
                .catch(error => {
                    this.departmentsErrored = true;
                    this.departmentsError = response.data.message || error.message;
                })
                .finally(() => this.departmentsLoading = false);
        },
        async renderChart() {
            this.chartErrored = false;
            this.chartLoading = true;
            axios.get('https://etp.psln.nl/api/1.1/statistics/departments')
                .then(response => {
                    new Chart(document.getElementById('chartDepartments'), {
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
