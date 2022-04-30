<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: { BreezeAuthenticatedLayout, Head},
    props: {
        user: Object
    }
}
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                eCommerce Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <table class="table-auto border-collapse w-full">
                            <tbody>
                                <tr>
                                    <td class="border-b border-slate-300 p-4 pl-8 font-bold">User Name</td>
                                    <td class="border-b border-slate-300 p-4 pl-8">{{ user.name }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b border-slate-300 p-4 pl-8 font-bold">User Email</td>
                                    <td class="border-b border-slate-300 p-4 pl-8">{{ user.email }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b border-slate-300 p-4 pl-8 font-bold">Shop Name</td>
                                    <td class="border-b border-slate-300 p-4 pl-8">{{ user.shop_name }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b border-slate-300 p-4 pl-8 font-bold">Domain</td>
                                    <td class="border-b border-slate-300 p-4 pl-8">{{ user.shop_domain }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b border-slate-300 p-4 pl-8 font-bold">Billing Plan</td>
                                    <td class="border-b border-slate-300 p-4 pl-8">{{ user.billing_plan }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
