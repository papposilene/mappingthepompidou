<template>
<div class="font-sans h-screen antialiased" id="app">
    <TheHeader />
    <main class="container w-full mx-auto pt-20 text-white">
        <div class="flex flex-wrap w-full px-0 md:mt-12">
            <div class="flex-col w-4/12 px-0">
                <h2 class="flex flex-col bg-red-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ artworkName }}</span>
                </h2>
                <ul class="flex flex-col list-none text-white px-4 my-5 rounded">
                    <li class="flex border-b border-gray-600 p-2">
                        Genre : {{ globalArtistGender }}.
                    </li>
                    <li class="flex border-b border-gray-600 p-2">
                        Nationalité : {{ globalArtistCountry }}.
                    </li>
                    <li class="flex border-b border-gray-600 p-2">
                        Date de naissance : {{ globalArtistBirth }}.
                    </li>
                    <li class="flex border-b border-gray-600 p-2">
                        Date de décès : {{ globalArtistDeath }}.
                    </li>
                </ul>

                <div v-if="globalLoading" class="flex w-full text-black bg-green-500 p-4 my-5 rounded uppercase">
                    Chargement en cours...
                </div>

                <div v-else class="px-4">
                    <div class="flex flex-col w-full px-0 mt-4">
                        <ul class="flex flex-col list-none text-white my-5 rounded">
                            <li v-for="data1 in globalStreamData.movements.list" :key="data1.uuid" class="flex border-b border-gray-600 hover:bg-gray-600 p-2">
                                <router-link :to="`/movements/show/${data1.uuid}`" class="w-full">
                                    <span>{{ data1.movement_name }}</span><br />
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="flex-col w-8/12 px-0">
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
                                <li v-for="data2 in artworkStreamData.data" :key="data2.uuid" class="flex border-b border-gray-600 hover:bg-gray-600 p-2">
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
            title: 'Oeuvre'
        }
    },
    data() {
        return{
            artworkName: 'Chargement en cours',
            globalErrored: false,
            globalLoading: true,
            globalStreamData: null,
            globalArtistGender: 'genre inconnu',
            globalArtistCountry: 'nationalité inconnue',
            globalArtistBirth: 'date de naissance inconnue',
            globalArtistDeath: 'date de décès inconnue',
            artworkErrored: false,
            artworkLoading: true,
            artworkStreamData: null,
            artworkPaginator: {},
            artworkTotal: 0,
            artworkNavigart: 0,
            artworkDate: 'sans date',
            artworkType: 'sans type',
            artworkExposed: 0
        }
    },
    created() {
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
            this.globalErrored = false;
            this.globalLoading = true;
            axios.get('http://localhost:8000/api/1.1/artworks/show/' + this.$route.params.uuid )
                .then(response => {
                    this.globalStreamData = response.data.data[0];
                    this.artworkName = this.globalStreamData.object_title;
                    this.globalArtistGender = this.globalStreamData.artists[0].artist_gender;
                    this.globalArtistCountry = this.globalStreamData.artists[0].nationality.country_flag + ' ' + this.globalStreamData.nationality.country_name;
                    this.globalArtistBirth = this.globalStreamData.artists[0].artist_birth;
                    this.globalArtistDeath = this.globalStreamData.artists[0].artist_death;

                    this.artworkNavigart = this.globalStreamData.navigart_id;
                    this.artworkDate = this.globalStreamData.object_date;
                    this.artworkType = this.globalStreamData.object_type;
                    this.artworkExposed = this.globalStreamData.object_visibility;

                    this.globalLoading = false;
                })
                .catch(error => {
                    this.globalErrored = true;
                    this.globalError = error.response.data.message || error.message;
                })
                .finally(() => this.globalLoading = false);
            console.info("Component mounted: Art Movement.");
        },
    }
};
</script>
