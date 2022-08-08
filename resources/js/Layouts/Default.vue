<template>
    <div>
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog
                as="div"
                class="fixed inset-0 flex z-40 md:hidden"
                @close="sidebarOpen = false"
            >
                <TransitionChild
                    as="template"
                    enter="transition-opacity ease-linear duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="transition-opacity ease-linear duration-300"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <DialogOverlay
                        class="fixed inset-0 bg-gray-600 bg-opacity-75"
                    />
                </TransitionChild>
                <TransitionChild
                    as="template"
                    enter="transition ease-in-out duration-300 transform"
                    enter-from="-translate-x-full"
                    enter-to="translate-x-0"
                    leave="transition ease-in-out duration-300 transform"
                    leave-from="translate-x-0"
                    leave-to="-translate-x-full"
                >
                    <div
                        class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-blue-700"
                    >
                        <TransitionChild
                            as="template"
                            enter="ease-in-out duration-300"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="ease-in-out duration-300"
                            leave-from="opacity-100"
                            leave-to="opacity-0"
                        >
                            <div class="absolute top-0 right-0 -mr-12 pt-2">
                                <button
                                    type="button"
                                    class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                    @click="sidebarOpen = false"
                                >
                                    <span class="sr-only">Close sidebar</span>
                                    <XIcon
                                        class="h-6 w-6 text-white"
                                        aria-hidden="true"
                                    />
                                </button>
                            </div>
                        </TransitionChild>
                        <div class="flex-shrink-0 flex items-center px-4">
                            <img
                                class="h-8 w-auto"
                                :src="asset('images/logo.png')"
                                alt="Workflow"
                            />
                        </div>
                        <div class="mt-5 flex-1 h-0 overflow-y-auto">
                            <nav class="px-2 space-y-1">
                                <a
                                    v-for="item in navigation"
                                    :key="item.name"
                                    :href="route(item.href)"
                                    :class="[
                                        isActive(item.component)
                                            ? 'bg-blue-800 text-white'
                                            : 'text-blue-100 hover:bg-blue-600',
                                        'group flex items-center px-2 py-2 text-base font-medium rounded-md',
                                    ]"
                                >
                                    <component
                                        :is="item.icon"
                                        class="mr-4 flex-shrink-0 h-6 w-6 text-blue-300"
                                        aria-hidden="true"
                                    />
                                    {{ item.name }}
                                </a>
                            </nav>
                        </div>
                    </div>
                </TransitionChild>
                <div class="flex-shrink-0 w-14" aria-hidden="true">
                    <!-- Dummy element to force sidebar to shrink to fit close icon -->
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- Static sidebar for desktop -->
        <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div
                class="flex flex-col flex-grow pt-5 bg-blue-900 overflow-y-auto"
            >
                <div class="flex items-center flex-shrink-0 px-4">
                    <img
                        class="h-16 w-auto rounded-full"
                        :src="asset('images/logo.png')"
                        alt="Workflow"
                    />
                    <div class="text-blue-300 ml-2 text-xs">
                        Private Security Information Management System
                    </div>
                </div>
                <div class="mt-5 flex-1 flex flex-col">
                    <nav class="flex-1 px-2 pb-4 space-y-1">
                        <a
                            v-for="item in navigation"
                            :key="item.name"
                            :href="route(item.href)"
                            :class="[
                                isActive(item.component)
                                    ? 'brightness-125 text-white'
                                    : 'text-blue-400 hover:bg-blue-800 hover:text-white',
                                'group flex items-center px-2 py-2 text-sm font-medium rounded-md',
                            ]"
                        >
                            <component
                                :is="item.icon"
                                class="mr-3 flex-shrink-0 h-6 w-6 text-blue-300"
                                :class="[
                                    isActive(item.component)
                                        ? 'brightness-125 text-white'
                                        : 'text-blue-300 group-hover:text-white',
                                    'mr-3 flex-shrink-0 h-6 w-6 ',
                                ]"
                                aria-hidden="true"
                            />
                            {{ item.name }}
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="md:pl-64 flex flex-col flex-1">
            <div
                class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow"
            >
                <button
                    type="button"
                    class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 md:hidden"
                    @click="sidebarOpen = true"
                >
                    <span class="sr-only">Open sidebar</span>
                    <MenuAlt2Icon class="h-6 w-6" aria-hidden="true" />
                </button>
                <div class="flex-1 px-4 flex justify-between">
                    <div class="flex-1 flex items-center">
                        <a href="#" class="text-gray-400 hover:text-blue-800">
                            <ChevronLeftIcon
                                class="h-8 w-8"
                                aria-hidden="true"
                            />
                        </a>
                    </div>
                    <div class="ml-4 flex items-center md:ml-6">
                        <button
                            type="button"
                            class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            <span class="sr-only">View notifications</span>
                            <BellIcon class="h-6 w-6" aria-hidden="true" />
                        </button>

                        <!-- Profile dropdown -->
                        <Menu as="div" class="ml-3 relative">
                            <div>
                                <MenuButton
                                    class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                >
                                    <span class="text-gray-400"
                                        >Alex Nyago</span
                                    >
                                </MenuButton>
                            </div>
                            <transition
                                enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95"
                            >
                                <MenuItems
                                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                >
                                    <MenuItem
                                        v-for="item in userNavigation"
                                        :key="item.name"
                                        v-slot="{ active }"
                                    >
                                        <a
                                            :href="item.href"
                                            :class="[
                                                active ? 'bg-gray-100' : '',
                                                'block px-4 py-2 text-sm text-gray-700',
                                            ]"
                                            >{{ item.name }}</a
                                        >
                                    </MenuItem>
                                </MenuItems>
                            </transition>
                        </Menu>
                        <span class="mx-3 text-gray-600">|</span>
                        <a
                            href="#"
                            class="text-blue-600 hover:text-blue-800 flex"
                        >
                            Logout
                            <LogoutIcon
                                class="h-6 w-6 ml-2"
                                aria-hidden="true"
                            />
                        </a>
                    </div>
                </div>
            </div>

            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'
import {
    Dialog,
    DialogOverlay,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import {
    BellIcon,
    MenuAlt2Icon,
    XIcon,
    LogoutIcon,
    ChevronLeftIcon,
} from '@heroicons/vue/outline'
import {
    SearchIcon,
    UsersIcon,
    UserCircleIcon,
    HomeIcon,
} from '@heroicons/vue/solid'

const navigation = [
    {
        name: 'Home',
        href: 'auth.login',
        icon: HomeIcon,
        current: true,
        component: ['home'],
    },
    {
        name: 'Users',
        href: 'auth.login',
        icon: UserCircleIcon,
        current: false,
        component: ['users'],
    },
]
const userNavigation = [
    { name: 'Your Profile', href: '#' },
    { name: 'Settings', href: '#' },
    { name: 'Sign out', href: '#' },
]

export default {
    name: 'DefaultLayout',
    components: {
        Dialog,
        DialogOverlay,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        TransitionChild,
        TransitionRoot,
        BellIcon,
        MenuAlt2Icon,
        SearchIcon,
        XIcon,
        LogoutIcon,
        ChevronLeftIcon,
    },
    setup() {
        const sidebarOpen = ref(false)

        const { component } = usePage()

        // const user = computed(() => usePage().props.value.auth.user)

        const isActive = (url) =>
            url.some((v) => component.value.toLowerCase().startsWith(v))

        return {
            navigation,
            userNavigation,
            sidebarOpen,
            isActive,
        }
    },
}
</script>
