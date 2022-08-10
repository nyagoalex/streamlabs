<template>
    <div class='px-4 py-5 sm:p-6'>
        <dt class='text-xl font-medium text-gray-500'>
            Median number of viewers
        </dt>
        <dd class='mt-1 flex items-baseline md:block lg:flex justify-end'>

            <div
                class='inline-flex items-baseline px-2.5 py-0.5 rounded-full text-2xl font-semibold text-indigo-600 md:mt-2 lg:mt-0'>
                {{ median }}
            </div>
        </dd>
    </div>
</template>

<script>
export default {
    name: 'MedianViewerNumber',
    props: {
        median: {
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
