import axios from 'axios'
import Invoice from '../../pages/Invoice.vue';

export default ({
    state : {
        InvoiceData : [],
    },
    getters : {
        getInoviceData(state){
            return state.InvoiceData
        },
       
    },
    mutations : {
        setInoviceData(state , data){
            state.InvoiceData = data
        },
       
    },
    actions : {
        async checkout ({commit}, items){
            try {
                let res = await axios.post('/invoice' , items);
                commit('setInoviceData', res.data.data);
            } catch (e) {
                console.log(e);
            }
        },
        
    },
});