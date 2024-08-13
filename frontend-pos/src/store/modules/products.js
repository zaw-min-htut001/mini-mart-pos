import axios from 'axios'

export default ({
    state : {
        categories : [],
        products: [] ,
        items : [] ,
    },
    getters : {
        getCategories(state){
            return state.categories
        },
        getProducts(state){
            return state.products
        },
        getItems(state){
            return state.items
        },
         // Calculate subtotal for a specific item
         getItemSubtotal: (state) => (itemId) => {
            const item = state.items.find(item => item.product_id === itemId);
            return item ? item.unit_price * item.quantity : 0;
        },
        // Calculate the total subtotal for all items in the cart
        getTotalSubtotal(state) {
            return state.items.reduce((total, item) => {
                return total + (item.unit_price * item.quantity);
            }, 0);
        }
    },
    mutations : {
        setCategories(state , data){
            state.categories = data
        },
        setProducts(state , data){
            state.products = data
        },
        setItem(state, data) {
            // Check if the product is already in the cart
            const existingItem = state.items.find(item => item.product_id === data.product_id);

            if (existingItem) {
                // If product exists, increase the quantity
                existingItem.quantity += 1;
            } else {
                // If product doesn't exist, add it to the cart with an initial quantity of 1
                state.items.push({ ...data, quantity: 1});
            }
        }
    },
    actions : {
        async fetchSingleProduct({ commit } , itemId) {
            let res = await axios.get(`/getSingleProduct/${itemId}`);
            commit('setItem', res.data.data);
        },
        async fetchCategories({ commit }) {
            let res = await axios.get('/categories');
            commit('setCategories', res.data.data);
        },
        async fetchProducts({ commit }) {
            let res = await axios.get('/products');
            commit('setProducts', res.data.data);
        },
        async filterByCategory ({commit} , category_id){
            let res = await axios.get(`products?category_id=${category_id}`);
            commit('setProducts' , res.data.data)
        },
        async searchName ({commit} , name ){
            let res = await axios.get(`products/?&name=${name}`);
            commit('setProducts' , res.data.data)
        }
    },
});