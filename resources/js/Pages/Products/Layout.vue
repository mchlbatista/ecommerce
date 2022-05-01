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
    data(){
        return{
            product_id: ""
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
    <Head title="Products" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
        </template>
        <div class="pt-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-5 bg-white border-b border-gray-200">
                        <div class="flex">
                            <div class="flex-none w10 ml-2 pt-2">
                                <Link :href="route('products')">
                                    <i class="fa-solid fa-box-open pr-5"></i>
                                </Link>
                            </div>
                            <div class="flex-auto w-30 ml-2">
                                <input type="text"
                                    class="px-5 h-10 w-full rounded-lg focus:shadow focus:outline-none"
                                    placeholder="Product ID"
                                    v-model="product_id"
                                    @keypress="isNumber($event)">
                            </div>
                            <div class="flex-none w-30 ml-2">
                                <Link
                                    :href="route('products.product', product_id)"
                                    class="px-5 h-10 w-30 text-white rounded-lg bg-sky-800"
                                    :class="[!product_id.length ? 'bg-zinc-300' : 'hover:bg-slate-500']"
                                    as="button" type="button" :disabled="!product_id.length" @click="(product_id='')">Search
                                </Link>
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
                        <slot />
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
