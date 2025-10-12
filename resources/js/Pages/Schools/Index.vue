<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';


</script>

<template>
    <AppLayout title="Escolas">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Escolas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   <Link :href="route('schools.create')">
                    <button>
                        Registrar escolas
                    </button>
                </Link> 
                </div>
            </div>
        </div>
    </AppLayout>
</template>
