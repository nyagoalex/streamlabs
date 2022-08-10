<template>
    <div class='px-14'>
        <div class='py-4 px-4 sm:px-6 lg:px-8 '>
            <div class='mb-6'>
                <dl class='mt-5 grid grid-cols-1 rounded-lg bg-white overflow-hidden shadow divide-y divide-gray-200 md:grid-cols-2 md:divide-y-0 md:divide-x'>

                    <MedianViewerNumber :median='medianViewerCount' />
                    <ViewersToTop1000 :total='viewersNeededForLeastFollowed' />
                </dl>
            </div>

            <div class='grid grid-cols-2 gap-x-6 gap-y-12'>
                <StreamsPerGame :games='streamPerGame' />
                <ViewerCountPerGame :games='topGamesByViewerCount' />
                <TopStreamsByViewerCount :games='topStreamsByViewerCount' />
                <NumberOfStreamsByStartTime :games='numberOfStreamsByStartTime' />
                <StreamsFollowed :streams='streamsFollowedByUser' />
                <SharedTags :tags='sharedTags' />
            </div>
        </div>
    </div>
</template>

<script>
import StreamsPerGame from '@components/Stats/StreamsPerGame'
import ViewerCountPerGame from '@components/Stats/ViewerCountPerGame'
import MedianViewerNumber from '@components/Stats/MedianViewerNumber'
import ViewersToTop1000 from '@components/Stats/ViewersToTop1000'
import TopStreamsByViewerCount from '@components/Stats/TopStreamsByViewerCount'
import NumberOfStreamsByStartTime from '@components/Stats/NumberOfStreamsByStartTime'
import StreamsFollowed from '@components/Stats/StreamsFollowed'
import SharedTags from '@components/Stats/SharedTags'

export default {
    name: 'Home',
    components: {
        StreamsPerGame,
        ViewerCountPerGame,
        MedianViewerNumber,
        ViewersToTop1000,
        TopStreamsByViewerCount,
        NumberOfStreamsByStartTime,
        StreamsFollowed,
        SharedTags,
    },
    props: {
        streamPerGame: {
            type: Array,
            required: true,
        },
        topGamesByViewerCount: {
            type: Array,
            required: true,
        },
        topStreamsByViewerCount: {
            type: Array,
            required: true,
        },
        numberOfStreamsByStartTime: {
            type: Array,
            required: true,
        },
        streamsFollowedByUser: {
            type: Array,
            required: true,
        },
        sharedTags: {
            type: Array,
            required: true,
        },
        medianViewerCount: {
            type: Number,
            required: true,
        },
        viewersNeededForLeastFollowed: {
            type: Number,
            required: true,
        },
    },
}
</script>

<style scoped>

</style>
