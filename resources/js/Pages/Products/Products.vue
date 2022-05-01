<script>
import Layout from '@/Pages/Products/Layout.vue';
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
        products: Object
    }
}
</script>

<template>
    <Head title="Products" />
    <table class="table-auto border-collapse w-full">
        <thead>
            <tr>
                <th colspan="6" class="border-b dark:border-slate-400 p-4 pl-8 text-left">Total {{ products.total }}</th>
            </tr>
            <tr>
                <th class="border-b dark:border-slate-400 p-4 pl-8 text-left">ID</th>
                <th class="border-b dark:border-slate-400 p-4 pl-8 text-left">Product Name</th>
                <th class="border-b dark:border-slate-400 p-4 pl-8 text-left">Style</th>
                <th class="border-b dark:border-slate-400 p-4 pl-8 text-left">Brand</th>
                <th class="border-b dark:border-slate-400 p-4 pl-8 text-left">SKU Qty</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="p in products.data" :key="p.id">
                <td class="border-b border-slate-300 p-4 pl-8">
                    <Link
                        :href="route('products.product', p.id)"
                        class="hover:text-slate-500 text-sky-800">
                        {{ p.id }}
                    </Link>
                </td>
                <td class="border-b border-slate-300 p-4 pl-8">{{ p.product_name }}</td>
                <td class="border-b border-slate-300 p-4 pl-8">{{ p.style }}</td>
                <td class="border-b border-slate-300 p-4 pl-8">{{ p.brand }}</td>
                <td class="border-b border-slate-300 p-4 pl-8">
                    <Link v-if="p.inventories_count" :href="route('inventory.product_id', p.id)" class="hover:text-slate-500 text-sky-800">
                        {{ p.inventories_count }}
                    </Link>
                    <div v-else>0</div>
                </td>

            </tr>
        </tbody>
    </table>
    <pagination class="mt-6" :links="products.links" />
</template>
