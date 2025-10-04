<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from '@/components/InputError.vue';
import SEO from '@/components/SEO.vue';

// Assuming services are needed for AppLayout, provide an empty array for now
const services = ref([]);

const form = useForm({
    name: '',
    email: '',
    phone: '',
    message: '',
});

const submit = () => {
    form.post(route('contact.send'), {
        onSuccess: () => {
            form.reset();
            alert('Mesajınız başarıyla gönderildi!');
        },
        onError: () => {
            alert('Mesaj gönderilirken bir hata oluştu.');
        },
    });
};

</script>

<template>
    <AppLayout :services="services">
        <SEO
            title="İletişim | Fast Teknik"
            description="Fast Teknik ile iletişime geçin. İzmir'de teknik servis hizmetleri için bizimle iletişime geçebilirsiniz."
        />

        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-8 text-center">İletişim</h1>

            <div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid gap-2">
                        <Label for="name">Adınız Soyadınız</Label>
                        <Input id="name" type="text" v-model="form.name" required />
                        <InputError :message="form.errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email">E-posta Adresiniz</Label>
                        <Input id="email" type="email" v-model="form.email" required />
                        <InputError :message="form.errors.email" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="phone">Telefon Numaranız (Opsiyonel)</Label>
                        <Input id="phone" type="tel" v-model="form.phone" />
                        <InputError :message="form.errors.phone" />
                    </div>

                     <div class="grid gap-2">
                        <Label for="message">Mesajınız</Label>
                        <textarea id="message" v-model="form.message" required class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 min-h-[80px]"></textarea>
                        <InputError :message="form.errors.message" />
                    </div>

                    <Button type="submit" :disabled="form.processing">
                        Gönder
                    </Button>
                </form>
            </div>
        </div>
    </AppLayout>
</template> 