<template>
    <div class='px-4 py-5 sm:p-6'>
        <dt class='text-xl font-medium text-gray-500'>
            Views to top 1000
        </dt>
        <dd class='mt-1 flex items-baseline md:block lg:flex justify-end'>

            <div
                class='inline-flex items-baseline pr-2.5 py-0.5 pl-6 rounded-full text-2xl font-semibold text-indigo-600 md:mt-2 lg:mt-0 '>
                {{total}}
            </div>
        </dd>
    </div>
</template>

<script>
export default {
    name: 'MedianViewerNumber',
    props: {
        total: {
            type: Number,
            required: true,
        },
    },
    setup() {
        return {
        }
    },
}
</script>
