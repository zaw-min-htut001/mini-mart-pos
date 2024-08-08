<template>
    <!-- Main Content -->
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-3 lg:px-1 mb-6">
            <!-- Products and Invoice -->
            <div class="grid grid-cols-1 md:grid-cols-7 gap-3">
                <Products></Products>
                <Invoices />
            </div>
        </div>
    </div>
</template>

<script>
import Products from "./components/Products.vue";
import Invoices from './components/Invoices.vue';

    export default {
        name : 'Dashboard',
        components : {Products , Invoices }
        
    }
</script>
