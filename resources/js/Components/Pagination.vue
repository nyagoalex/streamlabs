<template>
    <nav
        v-if='
            paginator !== undefined &&
            paginator.data.length &&
            paginator.last_page > 1
        '
        class='flex items-center px-4'
        role='navigation'
    >
        <div
            class='w-full'
        >

            <div
                class=' flex-1 flex items-center justify-between w-full'>
                    <span
                        v-if='onFirstPage'
                        aria-disabled='true'
                        aria-hidden='true'
                        class='relative inline-flex items-center  text-sm font-medium text-gray-500  cursor-default  leading-5'
                    >
                        First
                    </span>
                <inertia-link
                    v-else
                    :href='previousPageUrl'
                    :only="[section]"
                    :preserve-scroll='true'
                    class='relative inline-flex items-center text-primary   text-sm font-medium  leading-5 hover:text-gray-400  active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150'
                    rel='prev'
                >
                    <svg
                        class='w-5 h-5'
                        fill='currentColor'
                        viewBox='0 0 20 20'
                    >
                        <path
                            clip-rule='evenodd'
                            d='M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z'
                            fill-rule='evenodd'
                        />
                    </svg>
                    Previous
                </inertia-link>
                <div>
                    <p class='text-xs text-gray-400 leading-5'>
                        Showing
                        <span class='font-medium' v-text='firstItem'></span>
                        to
                        <span class='font-medium' v-text='lastItem'></span>
                        of
                        <span class='font-medium' v-text='total'></span>
                        results
                    </p>
                </div>
                <inertia-link
                    v-if='hasMorePages'
                    :href='nextPageUrl'
                    :only="[section]"
                    :preserve-scroll='true'
                    class='relative inline-flex items-center -ml-px text-sm font-medium text-primary  leading-5 hover:text-gray-400  active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150'
                >Next
                    <svg
                        class='w-5 h-5'
                        fill='currentColor'
                        viewBox='0 0 20 20'
                    >
                        <path
                            clip-rule='evenodd'
                            d='M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z'
                            fill-rule='evenodd'
                        />
                    </svg>
                </inertia-link>
                <span
                    v-else
                    aria-disabled='true'
                    aria-hidden='true'
                    class='relative inline-flex items-center  -ml-px text-sm font-medium text-gray-500  cursor-default rounded-r-md leading-5'
                >
                        last
                    </span>
            </div>



        </div>
    </nav>
</template>

<script>
export default {
    name: 'PaginatorLink',
    props: {
        paginator: {
            current_page: Number,
            data: Array,
            first_page_url: String,
            from: Number,
            last_page: Number,
            last_page_url: String,
            links: Array,
            next_page_url: String,
            path: String,
            per_page: Number,
            prev_page_url: String,
            to: Number,
            total: Number,
        },
        section: String
    },
    methods: {
        isFirstOrLastOrDots(index, links_length, label) {
            return (
                index === 0 ||
                index === links_length - 1 ||
                label.includes('...')
            )
        },
    },
    computed: {
        onFirstPage() {
            return this.paginator.current_page === 1
        },
        hasMorePages() {
            return this.paginator.current_page < this.paginator.last_page
        },
        nextPageUrl() {
            return this.paginator.next_page_url
        },
        previousPageUrl() {
            return this.paginator.prev_page_url
        },
        firstItem() {
            return this.paginator.from
        },
        lastItem() {
            return this.paginator.to
        },
        total() {
            return this.paginator.total
        },
    },
}
</script>
