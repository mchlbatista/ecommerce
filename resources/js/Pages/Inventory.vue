<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
        Pagination,
    },
    props: {
        user: Object,
        inventory: Object,
     },
     data(){
         return{
            sku: "",
            product_id: "",
            threshold: ""
         }
     },
     methods: {
         isNumber(event){
            event = (event) ? event : window.event;
            var charCode = (event.which) ? event.which : event.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                event.preventDefault();
            } else {
                return true;
            }
         }
     }
}
</script>

<template>
    <Head title="Inventory" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <Link :href="route('inventory')" class="hover:text-slate-500 text-sky-800">
                    Inventory
                </Link>
            </h2>
        </template>
        <div class="pt-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-5 bg-white border-b border-gray-200">
                        <div class="flex">
                            <div class="flex-none w-30 ml-2">
                                <input type="text" class="px-5 h-10 w-max rounded-lg focus:shadow focus:outline-none" placeholder="SKU" v-model="sku">
                            </div>
                            <div class="flex-none w-30 ml-2">
                                <Link
                                    :href="route('inventory.sku', sku)"
                                    class="px-5 h-10 w-30 text-white rounded-lg hover:bg-slate-500 bg-sky-800"
                                    as="button">Search
                                </Link>
                            </div>
                            <div class="flex-none w-30 ml-2">
                                <input type="number" class="px-5 h-10 w-max rounded-lg focus:shadow focus:outline-none" placeholder="Product ID" v-model="product_id" @keypress="isNumber($event)">
                            </div>
                            <div class="flex-none w-30 ml-2">
                                <Link
                                    :href="route('inventory.product_id', product_id)"
                                    class="px-5 h-10 w-30 text-white rounded-lg hover:bg-slate-500 bg-sky-800"
                                    as="button">Search
                                </Link>
                            </div>
                            <div class="flex-none w-30 ml-2">
                                <input type="number" class="px-5 h-10 w-max rounded-lg focus:shadow focus:outline-none" placeholder="Quantity Threshold" v-model="threshold" @keypress="isNumber($event)">
                            </div>
                            <div class="flex-none w-30 ml-2">
                                <Link
                                    :href="route('inventory.quantity_below_that', threshold)"
                                    class="px-5 h-10 w-30 text-white rounded-lg hover:bg-slate-500 bg-sky-800"
                                    as="button">Search
                                </Link>
                            </div>
                            <div class="flex-auto w-max">
                                <p class="text-right font-bold">
                                    Total: {{ inventory.total }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden text-red-800">
                    {{ $page.props.flash.failure }}
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <table class="table-auto border-collapse w-full">
                            <thead>
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
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
