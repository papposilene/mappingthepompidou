<template>
<div class="font-sans h-screen antialiased" id="app">
    <TheHeader />
    <main class="container w-full mx-auto pt-20 text-white">
        <div class="flex flex-wrap w-full px-0 md:mt-12">
            <div class="md:flex-col md:w-4/12 sm:w-full px-0 order-last sm:order-first">
                <h2 class="flex flex-col bg-purple-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ acquisitionName }}</span>
                </h2>
                <ol class="px-4 mb-12">
                    <li class="p-2 mb-2 bg-blue-300 text-black rounded">
                        <span class="flex float-right">
                            {{ globalGenderMen }}
                        </span>
                        <span>Hommes</span>
                    </li>
                    <li class="p-2 mb-2 bg-red-300 text-black rounded">
                        <span class="flex float-right">
                            {{ globalGenderWomen }}
                        </span>
                        <span>Femmes</span>
                    </li>
                    <li class="p-2 mb-2 bg-purple-300 text-black rounded">
                        <span class="flex float-right">
                            {{ globalGenderGroups }}
                        </span>
                        <span>Groupes</span>
                    </li>
                    <li class="p-2 mb-2 bg-gray-300 text-black rounded">
                        <span class="flex float-right">
                            {{ globalGenderUnknown }}
                        </span>
                        <span>Inconnu</span>
                    </li>
                </ol>
                <div class="h-96">
                    <canvas id="chartAcquisitions"></canvas>
                </div>
            </div>

            <div class="md:flex-col md:w-8/12 sm:w-full px-0 mt-4 order-first sm:order-last">
                <h3 class="flex flex-col bg-yellow-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ artworksTotal }} oeuvres</span>
                </h3>
                <div v-if="artworksLoading" class="flex w-full text-black bg-green-500 p-4 my-5 rounded uppercase">
                    Chargement en cours...
                </div>

                <div v-else class="px-4">
                    <div class="flex flex-col w-full px-0 mt-4">
                        <div class="flex flex-col w-full">
                            <ThePaginator :pagination="artworksPaginator" @paginate="fetchArtworks()" :offset="4" />
                            <ul class="flex flex-col list-none text-white my-5 rounded">
                                <li v-for="data2 in artworksStreamData.data" :key="data2.uuid" class="flex border-b border-gray-600 hover:bg-gray-600 p-2">
                                    <router-link :to="`/artworks/show/${data2.uuid}`" class="w-full">
                                        <span>{{ data2.object_title }}</span><br />
                                        <span class="text-gray-400 text-sm">
                                            Date de création : {{ data2.object_date ? data2.object_date : 'sans date' }}.<br />
                                            Département : {{ data2.museum_department.department_name }}.
                                        </span>
                                    </router-link>
                                </li>
                            </ul>
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
            title: 'Acquisition'
        }
    },
    data() {
        return{
            acquisitionName: 'Chargement en cours',
            globalErrored: false,
            globalLoading: true,
            globalStreamData: null,
            globalGenderMen : 0,
            globalGenderWomen: 0,
            globalGenderGroups: 0,
            globalGenderUnknown: 0,
            artworksErrored: false,
            artworksLoading: true,
            artworksStreamData: null,
            artworksPaginator: {},
            artworksTotal: 0,
            chartErrored: false,
            chartLoading: true
        }
    },
    created() {
        this.fetchData()
        this.$watch(
            () => this.$route.params,
            () => {
                this.fetchData()
                this.fetchArtworks()
            },
            { immediate: true }
        ),
        this.renderChart()
    },
    methods: {
        async fetchData() {
            this.globalErrored = false;
            this.globalLoading = true;
            axios.get('http://localhost:8000/api/1.1/acquisitions/show/' + this.$route.params.slug )
                .then(response => {
                    this.globalLoading = false;
                    this.globalStreamData = response.data.data[0];
                    this.acquisitionName = this.globalStreamData.acquisition_name;
                    this.globalGenderMen = this.globalStreamData.artists.gender_men;
                    this.globalGenderWomen = this.globalStreamData.artists.gender_women;
                    this.globalGenderGroups = this.globalStreamData.artists.gender_groups;
                    this.globalGenderUnknown = this.globalStreamData.artists.gender_unknown;
                })
                .catch(error => {
                    this.globalErrored = true;
                    this.globalError = error.response.data.message || error.message;
                })
                .finally(() => this.globalLoading = false);
            console.info("Component mounted: Art Movement.");
        },
        async fetchArtworks() {
            this.artworksErrored = false;
            this.artworksLoading = true;
            let currentPage = this.artworksPaginator.current_page;
            let pageNumber = currentPage ? currentPage : 1;
            axios.get('http://localhost:8000/api/1.1/acquisitions/show/' + this.$route.params.slug + '/artworks?page=' + pageNumber)
                .then(response => {
                    this.artworksLoading = false;
                    this.artworksStreamData = response.data;
                    this.artworksPaginator = this.artworksStreamData.meta;
                    this.artworksTotal = this.artworksStreamData.meta.total;
                })
                .catch(error => {
                    this.artworksErrored = true;
                    this.artworksError = error.response.data.message || error.message;
                })
                .finally(() => this.artworksLoading = false);
            console.info("Component mounted: Artworks by Acquisitions.");
        },
        async renderChart() {
            this.chartErrored = false
            this.chartLoading = false
            axios.get('http://localhost:8000/api/1.1/statistics/acquisitions/for-' + this.$route.params.slug + '/departments')
                .then(response => {
                    new Chart(document.getElementById('chartAcquisitions').getContext('2d'), {
                        type: 'pie',
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
