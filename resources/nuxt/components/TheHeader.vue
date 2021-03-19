<template>
    <nav id="header" class="bg-gray-900 fixed w-full top-0">
	    <div class="container w-full mx-auto flex flex-wrap items-center mt-0 py-4">
            <h1>
                <router-link to="/" class="text-gray-100 text-3xl no-underline hover:no-underline font-bold">
                    Mapping The Pompidou
                </router-link>
            </h1>
        </div>
        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 z-20" id="nav-content">
            <ul class="list-reset lg:flex flex-1 items-center mx-4 px-4">
                <li class="mr-6 my-2 md:my-0">
                    <router-link to="/" class="inline-flex py-1 md:py-3 pl-1 align-middle no-underline text-white hover:text-blue-100 border-b-2 hover:border-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="pb-1 md:pb-0 text-sm">Accueil</span>
                    </router-link>
                </li>
                <li class="mr-6 my-2 md:my-0">
                    <router-link to="/departments" class="inline-flex py-1 md:py-3 pl-1 align-middle no-underline text-white hover:text-indigo-100 border-b-2 hover:border-indigo-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                        </svg>
                        <span class="pb-1 md:pb-0 text-sm">Départements</span>
                    </router-link>
                </li>
                <li class="mr-6 my-2 md:my-0">
                    <router-link to="/artists" class="inline-flex py-1 md:py-3 pl-1 align-middle no-underline text-white hover:text-green-100 border-b-2 hover:border-green-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>
                        <span class="pb-1 md:pb-0 text-sm">Artistes</span>
                    </router-link>
                </li>
                <li class="mr-6 my-2 md:my-0">
                    <router-link to="/artworks" class="inline-flex py-1 md:py-3 pl-1 align-middle no-underline text-white hover:text-yellow-100 border-b-2 hover:border-yellow-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="pb-1 md:pb-0 text-sm">Oeuvres</span>
                    </router-link>
                </li>
                <li class="mr-6 my-2 md:my-0">
                    <router-link to="/movements" class="inline-flex py-1 md:py-3 pl-1 align-middle no-underline text-white hover:text-pink-100 border-b-2 hover:border-pink-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="pb-1 md:pb-0 text-sm">Mouvements</span>
                    </router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>
