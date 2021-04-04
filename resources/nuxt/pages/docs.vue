<template class="bg-gray-900">
<div class="font-sans h-screen antialiased" id="app">
    <TheHeader />
    <main class="container w-full mx-auto pt-20 text-white">
        <div class="flex flex-wrap w-full px-0 mt-12">
            <div class="md:flex-col md:w-3/12 sm:w-full px-0 mt-4">
                <p class="font-mono font-bold mb-4 text-xl">Summary</p>
                <ol class="list-decimal font-mono text-xl">
                    <li>
                        <a href="#api_acquisitions">Acquisitions</a>
                        <ol class="list-decimal pl-9 font-mono">
                            <li><a href="#api_acquisitions_artworks">Artworks</a></li>
                            <li><a href="#api_acquisitions_details">Specific type</a></li>
                            <li><a href="#api_acquisitions_details_artworks">Specific type and details for artworks</a></li>
                        </ol>
                    </li>
                    <li>
                        <a href="#api_artists">Artists</a>
                        <ol class="list-decimal pl-9 font-mono">
                            <li><a href="#api_artists_details">Specific artist</a></li>
                            <li><a href="#api_artists_gender">Gender</a></li>
                            <li><a href="#api_artists_nationalities">Nationalities</a></li>
                            <li><a href="#api_artists_nationality">Nationality</a></li>
                        </ol>
                    </li>
                    <li>
                        <a href="#api_artworks">Artworks</a>
                        <ol class="list-decimal pl-9 font-mono">
                            <li><a href="#api_artworks_acquisitiondate">Acquisition Date</a></li>
                            <li><a href="#api_artworks_acquisitiontype">Acquisition Type</a></li>
                            <li><a href="#api_artworks_exposed">Exposed</a></li>
                            <li><a href="#api_artworks_year">Year of creation</a></li>
                        </ol>
                    </li>
                    <li>
                        <a href="#api_departments">Departments</a>
                        <ol class="list-decimal pl-9 font-mono">
                            <li><a href="#api_departments_details">Specific departement</a></li>
                            <li><a href="#api_departments_details_artists">Specific departement and details for artists</a></li>
                            <li><a href="#api_departments_details_artworks">Specific departement and details for artworks</a></li>
                        </ol>
                    </li>
                    <li><a href="#api_movements">Movements</a></li>
                    <li><a href="#api_statistics">Statistics</a></li>
                </ol>
            </div>
            <div class="md:flex-col md:w-9/12 sm:w-full px-0 mt-4">
                <h2 class="mb-4 font-mono font-bold text-xl" id="api_acquisitions">GET /api/acquisitions</h2>
                <p>
                    <span class="font-mono">/api/1.1/acquisitions</span> returns a listing of all valid types of accessions.
                </p>
                <table class="table-fixed my-4 w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="w-3/12 py-3">Parameters</th>
                            <th class="w-3/12 py-3">Format</th>
                            <th class="w-1/12 py-3">Default</th>
                            <th class="w-5/12 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700">
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">created_at</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">acquisition_name</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">acquisition_slug</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h2 class="mb-4 font-mono font-bold text-xl" id="api_acquisitions_details">GET /api/acquisitions/show/{slug}</h2>
                <p>
                    <span class="font-mono">/api/1.1/acquisitions/show/{slug}</span> returns informations for a specified type of accessions.
                </p>
                <table class="table-fixed my-4 w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="w-3/12 py-3">Parameters</th>
                            <th class="w-3/12 py-3">Format</th>
                            <th class="w-1/12 py-3">Default</th>
                            <th class="w-5/12 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700">
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">{slug}</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">string</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-red-400">Mandatory parameter.</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">acquired_artists_count</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">created_at</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">acquisition_name</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">acquisition_slug</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h2 class="mb-4 font-mono font-bold text-xl" id="api_acquisitions_details_artworks">GET /api/acquisitions/show/{slug}/artworks</h2>
                <p>
                    <span class="font-mono">/api/1.1/acquisitions/show/{slug}/artworks</span> returns informations about artworks for a specified type of accessions.
                </p>
                <table class="table-fixed my-4 w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="w-3/12 py-3">Parameters</th>
                            <th class="w-3/12 py-3">Format</th>
                            <th class="w-1/12 py-3">Default</th>
                            <th class="w-5/12 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700">
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">{slug}</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">string</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-red-400">Mandatory parameter.</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">acquired_artists_count</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">created_at</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">acquisition_name</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">acquisition_slug</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h2 class="mb-4 mt-6 font-mono font-bold text-xl" id="api_artists">GET /api/artists</h2>
                <p>
                    <span class="font-mono">/api/1.1/artists</span> returns a listing of all artists.
                </p>
                <table class="table-fixed my-4 w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="w-3/12 py-3">Parameters</th>
                            <th class="w-3/12 py-3">Format</th>
                            <th class="w-1/12 py-3">Default</th>
                            <th class="w-5/12 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700">
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">has_artworks_count</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">created_at</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">navigart_id</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_name</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_type</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_gender</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_birth</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_death</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_nationality</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h2 class="mb-4 mt-6 font-mono font-bold text-xl" id="api_artists_details">GET /api/artists/show/{uuid}</h2>
                <p>
                    <span class="font-mono">/api/1.1/artists/show/{uuid}</span> returns informations for a specified artist.
                </p>
                <table class="table-fixed my-4 w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="w-3/12 py-3">Parameters</th>
                            <th class="w-3/12 py-3">Format</th>
                            <th class="w-1/12 py-3">Default</th>
                            <th class="w-5/12 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700">
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">{uuid}</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">UUID</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-red-400">Mandatory parameter.</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">created_at</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">navigart_id</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_name</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_type</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_gender</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_birth</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_death</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_nationality</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h3 class="mb-4 mt-6 font-mono font-bold text-xl" id="api_artists_gender">GET /api/artists/gender</h3>
                <p>
                    <span class="font-mono">/api/1.1/artists/gender/{gender}</span> returns informations about genders for artists.
                </p>
                <table class="table-fixed my-4 w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="w-3/12 py-3">Parameters</th>
                            <th class="w-3/12 py-3">Format</th>
                            <th class="w-1/12 py-3">Default</th>
                            <th class="w-5/12 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700">
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">{gender}</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">woman</span>,
                                <span class="font-mono">man</span>,
                                <span class="font-mono">group</span>,
                                <span class="font-mono">unknown</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-red-400">Mandatory parameter.</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">created_at</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">navigart_id</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_name</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_type</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_gender</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_birth</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_death</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_nationality</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h3 class="mb-4 mt-6 font-mono font-bold text-xl" id="api_artists_nationalities">GET /api/artists/nationalities</h3>
                <p>
                    <span class="font-mono">/api/1.1/artists/nationalities</span> returns informations about all nationalities of artists.
                </p>
                <table class="table-fixed my-4 w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="w-3/12 py-3">Parameters</th>
                            <th class="w-3/12 py-3">Format</th>
                            <th class="w-1/12 py-3">Default</th>
                            <th class="w-5/12 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700">
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_nationality</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">created_at</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">navigart_id</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_name</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_type</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_gender</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_birth</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_death</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_nationality</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h3 class="mb-4 mt-6 font-mono font-bold text-xl" id="api_artists_nationality">GET /api/artists/nationality/{cca3}</h3>
                <p>
                    <span class="font-mono">/api/1.1/artists/nationality/{cca3}</span> returns informations about artists for a specified country.
                </p>
                <table class="table-fixed my-4 w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="w-3/12 py-3">Parameters</th>
                            <th class="w-3/12 py-3">Format</th>
                            <th class="w-1/12 py-3">Default</th>
                            <th class="w-5/12 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700">
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">{cca3}</span>
                            </td>
                            <td class="px-3 pb-2">
                                <a href="https://en.wikipedia.org/wiki/ISO_3166-1_alpha-3" class="underline" target="_blank" rel="noopener">Any valid ISO 3166-1 alpha-3 code of a country</a>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-red-400">Mandatory parameter.</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">created_at</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">navigart_id</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_name</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_type</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_gender</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_birth</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_death</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">artist_nationality</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h2 class="mb-4 mt-6 font-mono font-bold text-xl" id="api_artworks">GET /api/artworks</h2>
                <p>
                    <span class="font-mono">/api/1.1/artworks</span> returns a listing of all valid artworks.
                </p>
                <table class="table-fixed my-4 w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="w-3/12 py-3">Parameters</th>
                            <th class="w-3/12 py-3">Format</th>
                            <th class="w-1/12 py-3">Default</th>
                            <th class="w-5/12 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700">
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">created_at</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">navigart_id</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">museum_department</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_inventory</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_title</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_date</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_type</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_height</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_width</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_depth</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_weight</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_visibility</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">acquisition_date</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h3 class="mb-4 mt-6 font-mono font-bold text-xl" id="api_artworks_acquisitiondate">GET /api/artworks/acquisition_date/{year}</h3>
                <p>
                    <span class="font-mono">/api/1.1/artworks/acquisition_date/{year}</span> returns informations on artworks for a specified accession year.
                </p>
                <table class="table-fixed my-4 w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="w-3/12 py-3">Parameters</th>
                            <th class="w-3/12 py-3">Format</th>
                            <th class="w-1/12 py-3">Default</th>
                            <th class="w-5/12 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700">
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">{year}</span>
                            </td>
                            <td class="px-3 pb-2">
                                A 4-digit year (ie. 1986)
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-red-400">Mandatory parameter.</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">created_at</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">navigart_id</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">museum_department</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_inventory</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_title</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_date</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_type</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_height</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_width</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_depth</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_weight</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_visibility</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">acquisition_date</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h3 class="mb-4 mt-6 font-mono font-bold text-xl" id="api_artworks_exposed">GET /api/artworks/exposed/{bool}</h3>
                <p>
                    <span class="font-mono">/api/1.1/artworks/exposed/{bool}</span> returns informations on currently exposed (or not) artworks.
                </p>
                <table class="table-fixed my-4 w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="w-3/12 py-3">Parameters</th>
                            <th class="w-3/12 py-3">Format</th>
                            <th class="w-1/12 py-3">Default</th>
                            <th class="w-5/12 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700">
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">{bool}</span>
                            </td>
                            <td class="px-3 pb-2">
                                A boolean, <span class="font-mono">1</span> or <span class="font-mono">0</span>.
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-red-400">Mandatory parameter.</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">created_at</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">navigart_id</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">museum_department</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_inventory</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_title</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_date</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_type</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_height</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_width</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_depth</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_weight</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_visibility</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">acquisition_date</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h3 class="mb-4 mt-6 font-mono font-bold text-xl" id="api_artworks_year">GET /api/artworks/year/{year}</h3>
                <p>
                    <span class="font-mono">/api/1.1/artworks/year/{year}</span> returns artwork's informations for a specified year.
                </p>
                <table class="table-fixed my-4 w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="w-3/12 py-3">Parameters</th>
                            <th class="w-3/12 py-3">Format</th>
                            <th class="w-1/12 py-3">Default</th>
                            <th class="w-5/12 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700">
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">{year}</span>
                            </td>
                            <td class="px-3 pb-2">
                                A 4-digit year (ie. 1986)
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-red-400">Mandatory parameter.</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">created_at</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">navigart_id</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">museum_department</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_inventory</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_title</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_date</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_type</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_height</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_width</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_depth</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_weight</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_visibility</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">acquisition_date</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h3 class="mb-4 mt-6 font-mono font-bold text-xl" id="api_artworks_acquisitiontype">GET /api/artworks/acquisition_type/{slug}</h3>
                <p>
                    <span class="font-mono">/api/1.1/artworks/acquisition_type/{slug}</span> returns informations for a valid accession type.
                </p>
                <table class="table-fixed my-4 w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="w-3/12 py-3">Parameters</th>
                            <th class="w-3/12 py-3">Format</th>
                            <th class="w-1/12 py-3">Default</th>
                            <th class="w-5/12 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700">
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">{slug}</span>
                            </td>
                            <td class="px-3 pb-2">
                                Any valid acquisition_slug.
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-red-400">Mandatory parameter.</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">created_at</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">navigart_id</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">museum_department</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_inventory</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_title</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_date</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_type</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_height</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_width</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_depth</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_weight</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">object_visibility</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">acquisition_date</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h2 class="mb-4 mt-6 font-mono font-bold text-xl" id="api_departments">GET /api/departments</h2>
                <p>
                    <span class="font-mono">/api/1.1/departments</span> returns a listing of all valid museum departments available to use.
                </p>
                <table class="table-fixed my-4 w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="w-3/12 py-3">Parameters</th>
                            <th class="w-3/12 py-3">Format</th>
                            <th class="w-1/12 py-3">Default</th>
                            <th class="w-5/12 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700">
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">conserved_artworks_count</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">created_at</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">movement_name</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">movement_slug</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h2 class="mb-4 mt-6 font-mono font-bold text-xl" id="api_departments_details">GET /api/departments/{slug}</h2>
                <p>
                    <span class="font-mono">/api/1.1/departments/{slug}</span> returns informations for a valid museum departement.
                </p>
                <table class="table-fixed my-4 w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="w-3/12 py-3">Parameters</th>
                            <th class="w-3/12 py-3">Format</th>
                            <th class="w-1/12 py-3">Default</th>
                            <th class="w-5/12 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700">
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">{slug}</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">string</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-red-400">Mandatory parameter.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">conserved_artworks_count</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">created_at</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">movement_name</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">movement_slug</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h2 class="mb-4 mt-6 font-mono font-bold text-xl" id="api_departments_details_artworks">GET /api/departments/{slug}/artworks</h2>
                <p>
                    <span class="font-mono">/api/1.1/departments/{slug}/artworks</span> returns informations for a valid museum department and all associated artworks.
                </p>
                <table class="table-fixed my-4 w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="w-3/12 py-3">Parameters</th>
                            <th class="w-3/12 py-3">Format</th>
                            <th class="w-1/12 py-3">Default</th>
                            <th class="w-5/12 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700">
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">{slug}</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">string</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-red-400">Mandatory parameter.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">conserved_artworks_count</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">created_at</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">movement_name</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">movement_slug</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h2 class="mb-4 mt-6 font-mono font-bold text-xl" id="api_movements">GET /api/movements</h2>
                <p>
                    <span class="font-mono">/api/1.1/movements</span> returns a listing of all valid art movements available to use.
                </p>
                <table class="table-fixed my-4 w-full">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="w-3/12 py-3">Parameters</th>
                            <th class="w-3/12 py-3">Format</th>
                            <th class="w-1/12 py-3">Default</th>
                            <th class="w-5/12 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-700">
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">has_artworks_count</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">created_at</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">movement_name</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 pb-2">
                                <span class="font-mono">movement_slug</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">asc</span> or
                                <span class="font-mono">desc</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="font-mono">[]</span>
                            </td>
                            <td class="px-3 pb-2">
                                <span class="text-green-400">Optional.</span> Query string.
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h2 class="mb-4 mt-6 font-mono font-bold text-xl" id="api_statistics">GET /api/statistics</h2>
                <p>
                    <span class="font-mono">/api/1.1/statistics</span> returns a listing of all valid statistics available to use.
                </p>
            </div>
        </div>
    </main>
    <TheFooter />
</div>
</template>

<script>
export default {
    head() {
        return {
            title: 'API Documentation'
        }
    }
}
</script>
