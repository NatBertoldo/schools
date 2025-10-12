<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from 'laravel-precognition-vue-inertia';
import { Link } from '@inertiajs/vue3';

const form = useForm('post', '/users', {
    name: '',
    email: '',
});
 
const submit = () => form.submit({
    preserveScroll: true,
    onSuccess: () => form.reset(),
});
</script>

<template>
    <AppLayout title="criar escolas">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Criar Escolas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   <Link :href="route('schools.index')">
                    <button>
                        Voltar 
                    </button>
                </Link> 
                </div>
            </div>
        </div>
    </AppLayout>
</template>
