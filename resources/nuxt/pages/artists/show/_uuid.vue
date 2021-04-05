<template>
<div class="font-sans h-screen antialiased" id="app">
    <TheHeader />
    <main class="container w-full mx-auto pt-20 text-white">
        <div class="flex flex-wrap w-full px-0 md:mt-12">
            <div class="md:flex-col md:w-4/12 w-full px-0">
                <h2 class="flex flex-col bg-green-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ artistName }}</span>
                </h2>
                <ul class="flex flex-col list-none text-white px-4 my-5 rounded">
                    <li class="flex border-b border-green-400 p-2">
                        Genre : {{ globalArtistGender }}.
                    </li>
                    <li class="flex border-b border-green-400 p-2">
                        Nationalité : {{ globalArtistCountry }}.
                    </li>
                    <li class="flex border-b border-green-400 p-2">
                        Date de naissance : {{ globalArtistBirth ? globalArtistBirth : 'inconnue' }}.
                    </li>
                    <li class="flex border-b border-green-400 p-2">
                        Date de décès : {{ globalArtistDeath ? globalArtistDeath : 'inconnue' }}.
                    </li>
                </ul>

                <div v-if="globalLoading" class="flex w-full text-black bg-green-500 p-4 my-5 rounded uppercase">
                    Chargement en cours...
                </div>

                <div v-else class="px-4">
                    <div class="flex flex-col w-full px-0 mt-4">
                        <ul class="flex flex-col list-none text-white my-5 rounded">
                            <li v-for="data1 in globalStreamData.movements.list" :key="data1.uuid" class="flex border-b border-pink-400 hover:bg-pink-400 hover:text-black p-2">
                                <router-link :to="`/movements/show/${data1.uuid}`" class="w-full">
                                    <span>{{ data1.movement_name }}</span><br />
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="md:flex-col md:w-8/12 w-full px-0">
                <h2 class="flex flex-col bg-yellow-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ artworksTotal }} oeuvres</span>
                </h2>
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
                                            Date de création : {{ data2.object_date }}.<br />
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

export default {
    head() {
        return {
            title: 'Artistes'
        }
    },
    data() {
        return{
            artistName: 'Chargement en cours',
            globalErrored: false,
            globalLoading: true,
            globalStreamData: null,
            globalArtistGender: 'genre inconnu',
            globalArtistCountry: 'nationalité inconnue',
            globalArtistBirth: 'date de naissance inconnue',
            globalArtistDeath: 'date de décès inconnue',
            artworksErrored: false,
            artworksLoading: true,
            artworksStreamData: null,
            artworksPaginator: {},
            artworksTotal: 0,
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
        )
    },
    methods: {
        async fetchData() {
            this.globalErrored = false;
            this.globalLoading = true;
            axios.get('http://localhost:8000/api/1.1/artists/show/' + this.$route.params.uuid )
                .then(response => {
                    this.globalStreamData = response.data.data[0];
                    this.artistName = this.globalStreamData.artist_name;
                    this.globalArtistGender = this.globalStreamData.artist_gender;
                    this.globalArtistCountry = this.globalStreamData.nationality.country_flag + ' ' + this.globalStreamData.nationality.country_name;
                    this.globalArtistBirth = this.globalStreamData.artist_birth;
                    this.globalArtistDeath = this.globalStreamData.artist_death;
                    this.globalLoading = false;
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
            axios.get('http://localhost:8000/api/1.1/artists/show/' + this.$route.params.uuid + '/artworks?page=' + pageNumber)
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
            console.info("Component mounted: Artworks by Movements.");
        }
    }
};
</script>
