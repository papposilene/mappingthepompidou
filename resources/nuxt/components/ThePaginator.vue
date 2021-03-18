<template>
    <ul class="flex justify-center list-reset font-sans">
        <li v-if="pagination.current_page > 1">
            <a class="block bg-gray-700 border-r border-gray-600 hover:text-white hover:bg-blue-500 text-black px-3 py-2 rounded-l-lg"
                href="#" @click.prevent="change(pagination.current_page - 1)" title="Previous page">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
            </a>
        </li>
        <li v-for="page in pages" :key="page" >
            <a :class="[page == pagination.current_page ? 'bg-blue-700 text-white':'bg-gray-700 hover:text-white hover:bg-blue-500 text-blue border-r border-gray-600', 'block px-3 py-2']"
               href="#" @click.prevent="change(page)">
                {{ page }}
            </a>
        </li>
        <li v-if="pagination.current_page < pagination.last_page">
            <a class="block bg-gray-700 hover:text-white hover:bg-blue-500 text-black px-3 py-2 rounded-r-lg"
               href="#" @click.prevent="change(pagination.current_page + 1)" title="Next page">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </a>
        </li>
    </ul>
</template>

<script>
    export default {
        props: {
            pagination: {
                type: Object,
                required: true
            },
            offset: {
                type: Number,
                default: 4
            }
        },
        computed: {
            pages() {
                if (!this.pagination.to) {
                    return null;
                }

                let from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }

                let to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }

                let pages = [];
                for (let page = from; page <= to; page++) {
                    pages.push(page);
                }

                return pages;
            },
        },
        methods: {
            change: function(page) {
                this.pagination.current_page = page;
                this.$emit('paginate');
            }
        }
    }
</script>
