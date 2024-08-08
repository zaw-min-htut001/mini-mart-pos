import axios from 'axios'

export default ({
    state : {
        categories : [],
        products: []
    },
    getters : {
        getCategories(state){
            return state.categories
        },
        getProducts(state){
            return state.products
        }
    },
    mutations : {
        setCategories(state , data){
            state.categories = data
        },
        setProducts(state , data){
            state.products = data
        }
    },
    actions : {
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