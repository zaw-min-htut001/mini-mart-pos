import { createStore } from 'vuex/dist/vuex.cjs.js';
import product from './modules/products';
import auth from './modules/auth';
import invoices from './modules/invoices';

export default createStore({
    modules: { 
        product , auth , invoices
    }
});