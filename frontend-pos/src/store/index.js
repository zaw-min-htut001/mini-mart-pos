import { createStore } from 'vuex/dist/vuex.cjs.js';
import product from './modules/products';

export default createStore({
    modules: { 
        product
    }
});