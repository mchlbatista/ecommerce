<script>
import Layout from '@/Pages/Inventory/Layout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination'

export default {
    layout: Layout,
    components: {
        Head,
        Link,
        Pagination,
    },
    props: {
        user: Object,
        inventory: Object,
    }
}
</script>

<template>
    <Head title="Inventory" />
    <table class="table-auto border-collapse w-full">
        <thead>
            <tr>
                <th colspan="6" class="border-b dark:border-slate-400 p-4 pl-8 text-left">Total {{ inventory.total }}</th>
            </tr>
            <tr>
                <th class="border-b dark:border-slate-400 p-4 pl-8 text-left">Product Name</th>
                <th class="border-b dark:border-slate-400 p-4 pl-8 text-left">SKU</th>
                <th class="border-b dark:border-slate-400 p-4 pl-8 text-left">Qty</th>
                <th class="border-b dark:border-slate-400 p-4 pl-8 text-left">Color</th>
                <th class="border-b dark:border-slate-400 p-4 pl-8 text-left">Price</th>
                <th class="border-b dark:border-slate-400 p-4 pl-8 text-left">Cost</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="i in inventory.data" :key="i.id">
                <td class="border-b border-slate-300 p-4 pl-8">
                    <Link :href="route('inventory.product_id', i.product.id)" class="hover:text-slate-500 text-sky-800">
                        {{ i.product.product_name }}
                    </Link>
                </td>
                <td class="border-b border-slate-300 p-4 pl-8">
                    <Link :href="route('inventory.sku', i.sku)" class="hover:text-slate-500 text-sky-800">
                        {{ i.sku }}
                    </Link>
                </td>
                <td class="border-b border-slate-300 p-4 pl-8">{{ i.quantity }}</td>
                <td class="border-b border-slate-300 p-4 pl-8">{{ i.color }}</td>
                <td class="border-b border-slate-300 p-4 pl-8">${{ i.price_cents / 100 }}</td>
                <td class="border-b border-slate-300 p-4 pl-8">${{ i.cost_cents / 100 }}</td>
            </tr>
        </tbody>
    </table>
    <pagination class="mt-6" :links="inventory.links" />
</template>
