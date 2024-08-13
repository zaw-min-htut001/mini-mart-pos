<template>
    <div class="col-span-7">
        <div class="font-[sans-serif] space-x-4 space-y-4 text-center">
            <button @click="handleCategory('')" type="button"
                class="px-5 py-2.5 rounded-lg text-sm tracking-wider font-medium border border-current outline-none bg-blue-700 hover:bg-transparent text-white hover:text-blue-700 transition-all duration-300">All</button>
            <button @click="handleCategory(category.category_id)" v-for="(category ,index) in getCategories" :key="index" type="button"
                class="px-5 py-2.5 rounded-lg text-sm tracking-wider font-medium border border-current outline-none bg-blue-700 hover:bg-transparent text-white hover:text-blue-700 transition-all duration-300">{{ category.name }}</button>
        </div>
    </div>
    <!-- Products Display -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg col-span-4">
        <div class="grid md:grid-cols-2">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Products</h3>
            </div>
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <div
                    class="flex rounded-md border-2 border-blue-500 overflow-hidden max-w-md mx-auto font-[sans-serif]">
                    <input @keyup.enter="search(this.searchKey)"  v-model="searchKey" type="text" placeholder="Search Something..."
                        class="w-full outline-none bg-white text-gray-600 text-sm px-4 py-3" />
                    <button @click="search(this.searchKey)" type='button' class="flex items-center justify-center bg-[#007bff] px-5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px"
                            class="fill-white">
                            <path
                                d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    
            <div @click="addItem(product.id)" v-for="(product ,index) in getProducts" :key="index" class="bg-white p-4 rounded-lg shadow-md grid-rows-2 cursor-pointer">
                <div>
                    <img class="w-full h-36 object-cover" :src="product.image_path">
                </div>
                <div>
                    <p class="text-lg font-semibold">{{ product.name }}</p>
                    <p class="text-sm text-gray-500">Price: {{ product.unit_price }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions ,mapGetters} from 'vuex/dist/vuex.cjs.js';
export default {
    name: 'Products',
    data () {
        return {
            searchKey : '' ,
        } 
    },
    computed: {
        ...mapGetters(['getProducts' ,'getCategories'])
    },
    methods: {
        ...mapActions(['fetchSingleProduct','fetchProducts' , 'fetchCategories' ,'filterByCategory' ,'searchName']),
        handleCategory (id){
            this.filterByCategory(id);
        },
        search (key){
            this.searchName(key);
        },
        addItem(itemId) {
            this.fetchSingleProduct(itemId);
        }
    },
    mounted() {
        this.fetchProducts();
        this.fetchCategories();
    }

}
</script>
