<template>
    <div class="h-screen w-screen flex justify-center items-center login-page">
        <div
            class="flex flex-wrap backdrop-filter backdrop-blur-md bg-white/90 shadow-2xl rounded-lg w-2/3 h-auto max-w-3xl overflow-hidden"
        >
            <div
                class="w-full md:w-2/5 flex flex-col justify-between p-10 border-r border-gray-200"
            >
                <div>
                    <img
                        class="w-48"
                        :src="asset('images/logo.png')"
                        alt="logo"
                    />

                    <div
                        class="mt-12 text-center text-gray-500 font-medium text-3xl"
                    >
                        Top StreamStats App
                    </div>
                </div>

                <form class="" @submit.prevent="form.post('/login')">
                    <div class="text-gray-500 text-sm">
                        Sign in with your
                        <span class="text-indigo-600"> Twitch account</span>
                    </div>
                    <div class="input-group">
                        <PrimaryButton
                            type="submit"
                            primary
                            :loading="form.processing"
                            class="mt-4 w-full"
                        >
                            Login
                        </PrimaryButton>
                    </div>
                </form>
            </div>
            <figure class="hidden md:block w-3/5 aspect-w-4 aspect-h-2">
                <img
                    class="object-cover"
                    src="/images/user.jpg"
                    alt="doctors"
                />
            </figure>
        </div>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3'
import BaseButton from '@components/Buttons/BaseButton'

export default {
    name: 'Login',

    layout: null,

    components: {
        PrimaryButton: BaseButton,
    },

    setup() {
        const form = useForm({
            email: '',
            password: '',
            remember: null,
        })

        return { form }
    },
}
</script>
