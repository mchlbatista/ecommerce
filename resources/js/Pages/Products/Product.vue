<script>
import Layout from '@/Pages/Products/Layout.vue';
import BreezeTextarea from '@/Components/Textarea.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination'

export default {
    layout: Layout,
    components: {
        Head,
        Link,
        BreezeLabel,
        BreezeTextarea,
        BreezeInput,
        BreezeButton,
        useForm,
        Pagination,
    },
    props: {
        product: Object,
        errors: Object,
    },
    data() {
        return {
            form: useForm({
                product_name: this.product.product_name,
                style: this.product.style,
                brand: this.product.brand,
                product_type: this.product.product_type,
                // Show price (originally in cents) in '$' format
                shipping_price: (
                    this.product.shipping_price > 0 ?
                    this.product.shipping_price / 100 : 0
                ).toLocaleString(undefined, { minimumFractionDigits: 2 }),
                description: this.product.description
            }),
            submit: () => {
                this.form.transform((data) => ({
                    ...data,
                    // Convert price
                    shipping_price: parseInt(data.shipping_price > 0 ? data.shipping_price * 100 : 0),
                })).put(route('products.update', this.product.id))
            }
        }
    },
    methods: {
        isNumber(event){
            event = (event) ? event : window.event;
            var charCode = (event.which) ? event.which : event.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46 || this.form.shipping_price.length > 12) {
                event.preventDefault();
            } else {
                return true;
            }
        }
    }
}
</script>

<template>
    <Head title="Product" />
    <form @submit.prevent="submit">
        <div class="grid grid-cols-1 gap-2">
            <div>
                <div class="pt-3">
                    <BreezeLabel for="product_name" value="Product Name" />
                    <BreezeInput id="product_name" type="text" class="mt-1 block w-full"
                    v-model="form.product_name"
                    required autofocus autocomplete="product_name" />
                </div>
                <div class="pt-3">
                    <BreezeLabel for="brand" value="Brand" />
                    <BreezeInput id="brand" type="text" class="mt-1 block w-full"
                    v-model="form.brand"
                    required autofocus autocomplete="brand" />
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <div class="pt-3">
                        <BreezeLabel for="style" value="Style" />
                        <BreezeInput id="style" type="text" class="mt-1 block w-full"
                        v-model="form.style"
                        required autofocus autocomplete="style" />
                    </div>
                    <div class="pt-3">
                        <BreezeLabel for="product_type" value="Type" />
                        <BreezeInput id="product_type" type="text" class="mt-1 block w-full"
                        v-model="form.product_type"
                        required autofocus autocomplete="product_type" />
                    </div>
                    <div class="pt-3">
                        <BreezeLabel for="shipping_price" value="Shipping Price" />
                        <BreezeInput
                            id="shipping_price"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.shipping_price"
                            required autofocus autocomplete="shipping_price"
                            @keypress="isNumber($event)"/>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-2 pt-3">
                    <BreezeLabel for="description" value="Description" />
                    <BreezeTextarea id="shipping_price" rows="5" class="mt-1 block w-full" v-model="form.description" required autofocus autocomplete="description" />
                </div>
                <div class="grid grid-cols-1-gap-2 pt-5">
                    <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Update
                    </BreezeButton>
                </div>
            </div>
        </div>
    </form>
    <div v-if="errors" class="mt-5 overflow-hidden text-red-800">
        <div v-for="(err, index) in errors" :key="index">
            {{ err }}
        </div>
    </div>
</template>
