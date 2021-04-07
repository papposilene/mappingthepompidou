<template>
<div class="font-sans h-screen antialiased" id="app">
    <TheHeader />
    <main class="container w-full mx-auto pt-20 text-white">
        <div class="flex flex-wrap w-full px-0 md:mt-12">
            <div class="md:flex-col md:w-8/12 sm:w-full px-0">
                <h2 class="flex flex-col bg-yellow-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ artworkName }}</span>
                </h2>
                <ul class="flex flex-col list-none text-white px-4 my-5 rounded">
                    <li class="flex border-b border-yellow-400 p-2">
                        Date : {{ artworkDate }}.
                    </li>
                    <li class="flex border-b border-yellow-400 p-2">
                        Inventaire : {{ artworkInventory }}.
                    </li>
                    <li class="flex border-b border-yellow-400 p-2">
                        Type : {{ artworkType }}.
                    </li>
                    <li class="flex border-b border-yellow-400 p-2">
                        Technique : {{ artworkTechnique }}.
                    </li>
                    <li class="flex border-b border-yellow-400 p-2">
                         {{ artworkExposed ? 'Actuellement exposé' : 'Non présent dans le parcours' }}.
                    </li>
                    <li class="flex border-b border-yellow-400 p-2">
                        Droits : {{ artworkCopyright }}.
                    </li>
                    <li class="flex border-b border-yellow-400 hover:bg-yellow-400 hover:text-black p-2">
                        <a :href="artworkLink" class="w-full" target="_blank" rel="noopener">Fiche sur le site des collections du Centre Pompidou.</a>
                    </li>
                </ul>
            </div>

            <div class="md:flex-col md:w-4/12 w-full px-0">
                <h3 class="flex flex-col bg-green-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">{{ artistName }}</span>
                </h3>
                <ul class="flex flex-col list-none text-white px-4 my-5 rounded">
                    <li class="flex border-b border-green-400 p-2">
                        Genre : {{ artistGender }}.
                    </li>
                    <li class="flex border-b border-green-400 p-2">
                        Nationalité : {{ artistCountry }}.
                    </li>
                    <li class="flex border-b border-green-400 p-2">
                        Date de naissance : {{ artistBirth ? artistBirth : 'inconnue' }}.
                    </li>
                    <li class="flex border-b border-green-400 p-2">
                        Date de décès : {{ artistDeath ? artistDeath : 'inconnue' }}.
                    </li>
                </ul>

                <h4 class="flex flex-col bg-gray-400 font-bold m-4 py-4 text-3xl text-center text-black rounded">
                    <span class="text-black">Informations</span>
                </h4>
                <ul class="flex flex-col list-none text-white px-4 my-5 rounded">
                    <li class="flex border-b border-indigo-400 hover:bg-indigo-400 hover:text-black p-2">
                        <router-link :to="`/departments/show/${departmentSlug}`" class="w-full">
                            {{ departmentName ? departmentName : 'Département inconnu' }}.
                        </router-link>
                    </li>
                    <li v-for="data1 in movements" :key="data1.movement_uuid" class="flex border-b border-pink-400 hover:bg-pink-400 hover:text-black p-2">
                        <router-link :to="`/movements/show/${data1.movement_slug}`" class="w-full">
                            {{ data1.movement_name }}.
                        </router-link>
                    </li>
                    <li class="flex border-b border-purple-400 hover:bg-purple-400 hover:text-black p-2">
                        <router-link :to="`/acquisitions/show/${acquisitionSlug}`" class="w-full">
                            Entré par {{ acquisitionType ? acquisitionType : 'mode inconnu' }}, en {{ acquisitionDate ? acquisitionDate : 'une année inconnue' }}.
                        </router-link>
                    </li>
                </ul>
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
            artworkErrored: false,
            artworkLoading: true,
            artworkStreamData: null,
            artistName: 'Auteur inconnu',
            artistGender: 'inconnu',
            artistCountry: 'inconnue',
            artistBirth: null,
            artistDeath: null,
            artworkLink: '#',
            artworkTitle: 'sans titre',
            artworkDate: 'sans date',
            artworkInventory: 'inconnu',
            artworkType: 'inconnu',
            artworkTechnique: 'inconnue',
            artworkCopyright: 'domaine public',
            artworkExposed: 0,
            acquisitionType: null,
            acquisitionSlug: null,
            acquisitionDate: null,
            departmentName: null,
            departmentSlug: null,
            movements: null,
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
            this.artworkErrored = false;
            this.artworkLoading = true;
            axios.get('https://etp.psln.nl/api/1.1/artworks/show/' + this.$route.params.uuid )
                .then(response => {
                    this.artworkStreamData = response.data.data[0];
                    this.artworkName = this.artworkStreamData.object_title;
                    this.artworkLink = 'https://collection.centrepompidou.fr/artwork/' + this.artworkStreamData.navigart_id;
                    this.artworkDate = this.artworkStreamData.object_date;
                    this.artworkInventory = this.artworkStreamData.object_inventory;
                    this.artworkType = this.artworkStreamData.object_type;
                    this.artworkTechnique = this.artworkStreamData.object_technique;
                    this.artworkCopyright = this.artworkStreamData.object_copyright;
                    this.artworkExposed = this.artworkStreamData.object_visibility;
                    this.artistName = this.artworkStreamData.artists[0].artist_name;
                    this.artistGender = this.artworkStreamData.artists[0].artist_gender;
                    this.artistCountry = this.artworkStreamData.artists[0].nationality.country_flag + ' ' + this.artworkStreamData.artists[0].nationality.country_name;
                    this.artistBirth = this.artworkStreamData.artists[0].artist_birth;
                    this.artistDeath = this.artworkStreamData.artists[0].artist_death;
                    this.acquisitionType = this.artworkStreamData.acquisition.acquisition_type;
                    this.acquisitionSlug = this.artworkStreamData.acquisition.acquisition_slug;
                    this.acquisitionDate = this.artworkStreamData.acquisition.acquisition_date;
                    console.log(this.artworkStreamData.acquisition);
                    console.log(this.artworkStreamData.museum_department);
                    this.departmentName = this.artworkStreamData.museum_department.department_name;
                    this.departmentSlug = this.artworkStreamData.museum_department.department_slug;
                    this.movements = this.artworkStreamData.movements;
                    this.artworkLoading = false;
                })
                .catch(error => {
                    this.artworkErrored = true;
                    this.artworkError = error.response.data.message || error.message;
                })
                .finally(() => this.artworkLoading = false);
        },
    }
};
</script>
