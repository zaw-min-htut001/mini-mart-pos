<template>
   <!-- Invoice -->
   <div class="col-span-3">
                    <div class="h-fit bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class=" px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Invoice</h3>
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
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">Product A</td>
                                    <td class="px-6 py-4 whitespace-nowrap">2</td>
                                    <td class="px-6 py-4 whitespace-nowrap">$123</td>
                                    <td class="px-6 py-4 whitespace-nowrap">$246</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">Product B</td>
                                    <td class="px-6 py-4 whitespace-nowrap">1</td>
                                    <td class="px-6 py-4 whitespace-nowrap">$456</td>
                                    <td class="px-6 py-4 whitespace-nowrap">$456</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-4">
                            <div class="flex justify-between text-lg font-semibold">
                                <span>Total:</span>
                                <span>$702</span>
                            </div>
                        </div>
                        <button class="mt-4 w-full bg-blue-500 text-white py-2 px-4 rounded-lg">Checkout</button>
                    </div>
                    </div>
                </div>
</template>

<script>
    export default {
        
    }
</script>
