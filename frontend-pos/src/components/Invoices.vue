<template>
    <!-- Invoice -->
    <div class="col-span-3">
        <div class="h-fit bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="flex justify-between px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Invoice</h3>
                <button @click="refresh">
                    <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-9 h-7 text-red-700">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>
                </button>
            </div>
            <div class="p-4">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Product</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Quantity</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="(item, index) in getItems" :key="index">
                            <td class="px-6 py-4 whitespace-nowrap">{{ item.name }}</td>
                            <td class="flex px-6 py-4 whitespace-nowrap">
                                {{ item.quantity }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ item.unit_price }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ getItemSubtotal(item.product_id) }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-4">
                    <div class="flex justify-between text-lg font-semibold">
                        <span>Total:</span>
                        <span>{{ getTotalSubtotal }}</span>
                    </div>
                </div>
                <button  @click="chechout()" class="mt-4 w-full bg-blue-500 text-white py-2 px-4 rounded-lg">Checkout</button>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex/dist/vuex.cjs.js';

export default {
    data() {
        return {
            
        }
    },
    computed: {
        ...mapGetters(['getItems', 'getTotalSubtotal', 'getItemSubtotal']),

    },
    methods: {
        ...mapActions(['checkout']),
        refresh () {
            window.location.reload();
        },
        chechout () {
            this.checkout(this.getItems).then((res) => {
                this.$router.replace('/invoices')
            });
        }
    }
}
</script>
