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
        product: Object
    }
}
</script>

<template>
    <Head title="Inventory" />
    <div class="grid grid-cols-2 gap-4">
        <div class="pb-10">
            <div class="text-sm text-grey-500 pb-3">Product</div>
            <div>{{ product.id }} - {{ product.product_name }}</div>
            <div class="grid grid-cols-2 gap-4">
                <div class="mt-10">
                    <div class="text-sm text-grey-500 pb-3">Style</div>
                    <div>{{ product.style }}</div>
                </div>
                <div class="mt-10">
                    <div class="text-sm text-grey-500 pb-3">Brand</div>
                    <div>{{ product.brand }}</div>
                </div>
                <div class="mt-10">
                    <div class="text-sm text-grey-500 pb-3">Type</div>
                    <div>{{ product.product_type }}</div>
                </div>
                <div class="mt-10">
                    <div class="text-sm text-grey-500 pb-3">Shipping Price</div>
                    <div>${{ product.shipping_price / 100 }}</div>
                </div>
            </div>
        </div>
        <div class="p-10 bg-slate-200 max-h-full overflow-hidden shadow-sm sm:rounded-lg">
            <div class="text-sm text-grey-500 pb-3">Description</div>
            <div>{{ product.description }}</div>
        </div>
    </div>
</template>
