<template>
<div class="font-sans h-screen antialiased" id="app">
    <TheHeader />
    <main class="container w-full mx-auto pt-20 text-white">
        <div v-if="departmentsErrored" class="flex w-full text-black bg-red-400 p-4 my-5 mt-12 rounded uppercase">
            Bim bam boum, c'est tout cassé !
        </div>

        <div class="flex flex-row w-full px-0 mt-12">
            <div class="flex-col w-4/12 px-0">
                <div v-if="departmentsLoading" class="flex w-full text-black bg-green-500 p-4 my-5 rounded uppercase">
                    Chargement en cours...
                </div>

                <div v-else>
                    <div class="flex flex-col w-full px-0 mt-12">
                        <div class="flex flex-col w-full">
                            <ThePaginator :pagination="departmentsPaginator" @paginate="fetchData()" :offset="4" />
                            <ul class="flex flex-col list-none text-white my-5 rounded">
                                <li v-for="data in departmentsStreamData.data" :key="data.department_slug" class="flex border-b border-gray-600 hover:bg-gray-600 p-2">
                                    <router-link :to="`/departments/show/${data.department_slug}`" class="w-full">
                                        <span>{{ data.department_name }}</span><br />
                                        <span class="text-gray-400 text-sm">
                                            Oeuvres entrées par ce type d‘acquisition : {{ data.conserved_artworks_count }}.
                                        </span>
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-col w-8/12 px-0 mt-4 min-h-screen">
                <h2 class="flex flex-col bg-pink-100 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ departmentsTotal }} départements</span>
                </h2>
                <canvas id="chartDepartments"></canvas>
            </div>
        </div>
    </main>
    <TheFooter />
</div>
</template>

<script>
window.axios = require('axios');

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
        this.renderChart()
    },
    methods: {
        async fetchData() {
            this.departmentsErrored = false;
            this.departmentsLoading = true;
            let currentPage = this.departmentsPaginator.current_page;
            let pageNumber = currentPage ? currentPage : 1;
            axios.get('http://localhost:8000/api/departments?page=' + pageNumber)
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
            console.info("Component mounted: Museum Departments.");
        },
        async renderChart() {
            this.chartErrored = false;
            this.chartLoading = false;
            axios.get('http://localhost:8000/api/statistics/departments')
                .then(response => {
                    const ctx = document.getElementById('chartDepartments').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'horizontalBar',
                        data: response.data.chart,
                        options: response.data.options,
                    });
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
