<template>
    <div class="">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-medium text-gray-500">Streams you follow</h1>
            </div>
        </div>
        <div class="mt-2 flex flex-col h-80 overflow-y-scroll  overflow-x-hidden border-t-4 border-indigo-600">
            <div class="-my-2 -mx-4 sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle">
                    <div class="shadow-sm ring-1 ring-black ring-opacity-5">
                        <table class="min-w-full border-separate  " style="border-spacing: 0">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-12">#</th>
                                <th scope="col" class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">Streams</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white border-b border-gray-200">
                            <tr v-for="({title}, index) in streams" :key="title" >

                                <td class=" py-2 pl-4 text-sm font-medium text-gray-600 sm:pl-6 lg:pl-12 border-b border-gray-200">
                                    {{index + 1}}</td>
                                <td class="py-2 pl-2 pr-2 text-sm font-medium text-gray-600 sm:pl-6 lg:pl-8 border-b border-gray-200"> <div class=' '>{{ title }}</div></td>


                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import Pagination from '@components/Pagination'


export default {
    props: {
        streams: {
            type: Array,
            required: true,
        },
    },
    components:{
        Pagination
    },
    setup() {
        return {
        }
    },
}
</script>
