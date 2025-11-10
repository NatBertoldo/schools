<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from 'laravel-precognition-vue-inertia';
import { Link, router } from '@inertiajs/vue3';
import InputText from 'primevue/inputtext';
import InputNumber from 'primevue/inputnumber';
import Button from 'primevue/button';
import Card from 'primevue/card';
import Message from 'primevue/message';

const form = useForm('post', route('schools.store'), {
    // Campos da escola
    name: '',
    cnpj: '',
    telephone: '',
    email: '',
    director: '',
    year_of_foundation: null,
    // Campos do endereço
    zip_code: '',
    street: '',
    neighborhood: '',
    city: '',
    number: '',
    complement: '',
});

const submit = () => {
    form.submit({
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            router.visit(route('schools.index'));
        },
    });
};
</script>

<template>
    <AppLayout title="Criar Escola">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Criar Escola
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Card>
                    <template #content>
                        <div class="space-y-6">
                            <!-- Botão Voltar -->
                            <div class="mb-4">
                                <Link :href="route('schools.index')">
                                    <Button label="Voltar" icon="pi pi-arrow-left" severity="secondary" text />
                                </Link>
                            </div>

                            <!-- Mensagens de erro -->
                            <Message v-if="form.hasErrors" severity="error" :closable="false">
                                <ul class="list-disc list-inside">
                                    <li v-for="(error, key) in form.errors" :key="key">
                                        {{ error }}
                                    </li>
                                </ul>
                            </Message>

                            <form @submit.prevent="submit" class="space-y-6">
                                <!-- Seção: Dados da Escola -->
                                <div class="border-b pb-4">
                                    <h3 class="text-lg font-semibold mb-4">Dados da Escola</h3>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Nome -->
                                        <div class="flex flex-col">
                                            <label for="name" class="mb-2 font-medium">Nome *</label>
                                            <InputText
                                                id="name"
                                                v-model="form.name"
                                                :class="{ 'p-invalid': form.errors.name }"
                                                placeholder="Nome da escola"
                                                @blur="form.validate('name')"
                                            />
                                            <small v-if="form.errors.name" class="p-error">{{ form.errors.name }}</small>
                                        </div>

                                        <!-- CNPJ -->
                                        <div class="flex flex-col">
                                            <label for="cnpj" class="mb-2 font-medium">CNPJ *</label>
                                            <InputText
                                                id="cnpj"
                                                v-model="form.cnpj"
                                                :class="{ 'p-invalid': form.errors.cnpj }"
                                                placeholder="00.000.000/0000-00"
                                                @blur="form.validate('cnpj')"
                                            />
                                            <small v-if="form.errors.cnpj" class="p-error">{{ form.errors.cnpj }}</small>
                                        </div>

                                        <!-- Telefone -->
                                        <div class="flex flex-col">
                                            <label for="telephone" class="mb-2 font-medium">Telefone *</label>
                                            <InputText
                                                id="telephone"
                                                v-model="form.telephone"
                                                :class="{ 'p-invalid': form.errors.telephone }"
                                                placeholder="(00) 0000-0000"
                                                @blur="form.validate('telephone')"
                                            />
                                            <small v-if="form.errors.telephone" class="p-error">{{ form.errors.telephone }}</small>
                                        </div>

                                        <!-- Email -->
                                        <div class="flex flex-col">
                                            <label for="email" class="mb-2 font-medium">Email *</label>
                                            <InputText
                                                id="email"
                                                v-model="form.email"
                                                type="email"
                                                :class="{ 'p-invalid': form.errors.email }"
                                                placeholder="email@escola.com"
                                                @blur="form.validate('email')"
                                            />
                                            <small v-if="form.errors.email" class="p-error">{{ form.errors.email }}</small>
                                        </div>

                                        <!-- Diretor -->
                                        <div class="flex flex-col">
                                            <label for="director" class="mb-2 font-medium">Diretor *</label>
                                            <InputText
                                                id="director"
                                                v-model="form.director"
                                                :class="{ 'p-invalid': form.errors.director }"
                                                placeholder="Nome do diretor"
                                                @blur="form.validate('director')"
                                            />
                                            <small v-if="form.errors.director" class="p-error">{{ form.errors.director }}</small>
                                        </div>

                                        <!-- Ano de Fundação -->
                                        <div class="flex flex-col">
                                            <label for="year_of_foundation" class="mb-2 font-medium">Ano de Fundação *</label>
                                            <InputNumber
                                                id="year_of_foundation"
                                                v-model="form.year_of_foundation"
                                                :class="{ 'p-invalid': form.errors.year_of_foundation }"
                                                placeholder="Ex: 1990"
                                                :min="1900"
                                                :max="new Date().getFullYear()"
                                                @blur="form.validate('year_of_foundation')"
                                            />
                                            <small v-if="form.errors.year_of_foundation" class="p-error">{{ form.errors.year_of_foundation }}</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Seção: Endereço -->
                                <div class="border-b pb-4">
                                    <h3 class="text-lg font-semibold mb-4">Endereço</h3>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- CEP -->
                                        <div class="flex flex-col">
                                            <label for="zip_code" class="mb-2 font-medium">CEP *</label>
                                            <InputText
                                                id="zip_code"
                                                v-model="form.zip_code"
                                                :class="{ 'p-invalid': form.errors.zip_code }"
                                                placeholder="00000-000"
                                                @blur="form.validate('zip_code')"
                                            />
                                            <small v-if="form.errors.zip_code" class="p-error">{{ form.errors.zip_code }}</small>
                                        </div>

                                        <!-- Rua -->
                                        <div class="flex flex-col">
                                            <label for="street" class="mb-2 font-medium">Rua *</label>
                                            <InputText
                                                id="street"
                                                v-model="form.street"
                                                :class="{ 'p-invalid': form.errors.street }"
                                                placeholder="Nome da rua"
                                                @blur="form.validate('street')"
                                            />
                                            <small v-if="form.errors.street" class="p-error">{{ form.errors.street }}</small>
                                        </div>

                                        <!-- Número -->
                                        <div class="flex flex-col">
                                            <label for="number" class="mb-2 font-medium">Número *</label>
                                            <InputText
                                                id="number"
                                                v-model="form.number"
                                                :class="{ 'p-invalid': form.errors.number }"
                                                placeholder="Número"
                                                @blur="form.validate('number')"
                                            />
                                            <small v-if="form.errors.number" class="p-error">{{ form.errors.number }}</small>
                                        </div>

                                        <!-- Bairro -->
                                        <div class="flex flex-col">
                                            <label for="neighborhood" class="mb-2 font-medium">Bairro *</label>
                                            <InputText
                                                id="neighborhood"
                                                v-model="form.neighborhood"
                                                :class="{ 'p-invalid': form.errors.neighborhood }"
                                                placeholder="Nome do bairro"
                                                @blur="form.validate('neighborhood')"
                                            />
                                            <small v-if="form.errors.neighborhood" class="p-error">{{ form.errors.neighborhood }}</small>
                                        </div>

                                        <!-- Cidade -->
                                        <div class="flex flex-col">
                                            <label for="city" class="mb-2 font-medium">Cidade *</label>
                                            <InputText
                                                id="city"
                                                v-model="form.city"
                                                :class="{ 'p-invalid': form.errors.city }"
                                                placeholder="Nome da cidade"
                                                @blur="form.validate('city')"
                                            />
                                            <small v-if="form.errors.city" class="p-error">{{ form.errors.city }}</small>
                                        </div>

                                        <!-- Complemento -->
                                        <div class="flex flex-col">
                                            <label for="complement" class="mb-2 font-medium">Complemento</label>
                                            <InputText
                                                id="complement"
                                                v-model="form.complement"
                                                :class="{ 'p-invalid': form.errors.complement }"
                                                placeholder="Apto, Bloco, etc. (opcional)"
                                                @blur="form.validate('complement')"
                                            />
                                            <small v-if="form.errors.complement" class="p-error">{{ form.errors.complement }}</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botões de ação -->
                                <div class="flex justify-end gap-2">
                                    <Link :href="route('schools.index')">
                                        <Button label="Cancelar" severity="secondary" outlined />
                                    </Link>
                                    <Button 
                                        type="submit" 
                                        label="Salvar" 
                                        icon="pi pi-check"
                                        :loading="form.processing"
                                        :disabled="form.processing"
                                    />
                                </div>
                            </form>
                        </div>
                    </template>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
