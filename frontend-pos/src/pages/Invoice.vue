<template>
    <div class="mx-auto max-w-2xl mt-4 flex justify-between">
        <button @click="goBack"
        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
            class="w-4 h-4 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        Back
    </button>
    <!-- Print Button -->
    <button v-print="'#invoiceContent'"
        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">Print</button>
    </div>

    <div id="invoiceContent" class="max-w-2xl mx-auto bg-white p-8 my-10 rounded-lg shadow-lg">
        <div class="text-center">
            <h1 class="text-3xl font-bold mb-4">Bamboo Shop</h1>
        </div>

        <div class="mt-8">
            <div class="flex justify-between">
                <div>
                    <p class="text-gray-600">{{ getInoviceData.invoice_id }}</p>
                    <p class="text-gray-600">{{ getInoviceData.cashier }}</p>
                    <p class="text-gray-600">{{ getInoviceData.date }}</p>
                </div>
            </div>

            <div class="mt-8">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left">Item</th>
                            <th class="px-4 py-2 text-right">Quantity</th>
                            <th class="px-4 py-2 text-right">Price</th>
                            <th class="px-4 py-2 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in getInoviceData.sale_items" :key="index">
                            <td class="border px-4 py-2">{{ item.product.name }}</td>
                            <td class="border px-4 py-2 text-right">{{ item.quantity }}</td>
                            <td class="border px-4 py-2 text-right">{{ item.product.unit_price }}</td>
                            <td class="border px-4 py-2 text-right">{{ item.unit_price * item.quantity }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end mt-8">
                <div class="w-1/2">
                    <div class="flex justify-between py-2 border-t">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="text-gray-900">{{ getInoviceData.total }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-t">
                        <span class="text-gray-600">Total</span>
                        <span class="text-gray-900 font-bold">{{ getInoviceData.total }}</span>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center text-gray-600">
                <p>Thank you for your purchase!</p>
            </div>
        </div>
    </div>

</template>

<script>
import print from 'vue3-print-nb'
import { mapActions, mapGetters } from 'vuex/dist/vuex.cjs.js';

export default {
    directives: {
        print
    },
    computed: {
        ...mapGetters(['getInoviceData']),

    },
    methods: {
    goBack() {
        this.$router.push('/')
    }
    },
};
</script>

<style>
@media print {
    button {
        display: none;
    }
}
</style>
