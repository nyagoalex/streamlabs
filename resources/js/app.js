import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3'
import DefaultLayout from '@layouts/Default'
import { InertiaProgress } from '@inertiajs/progress'

InertiaProgress.init({
    color: 'rgb(22 163 74)',
    showSpinner: true,
})

const mixins = {
    methods: {
        // eslint-disable-next-line no-undef
        route,
        asset(path) {
            return (window._asset || '') + path
        },
    },
}
createInertiaApp({
    resolve: (name) => {
        const page = require(`./Pages/${name}`).default

        if (page.layout === undefined && !name.startsWith('Auth')) {
            page.layout = DefaultLayout
        }
        return page
    },
    setup({ el, app, props, plugin }) {
        const appjs = createApp({ render: () => h(app, props) })
        appjs.mixin(mixins)
        appjs.use(plugin)
        appjs.component('inertia-link', Link)
        appjs.mount(el)
    },
})
