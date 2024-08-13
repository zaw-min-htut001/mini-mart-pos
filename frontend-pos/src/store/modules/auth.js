import axios from 'axios'

export default ({
    state : {
        token : null,
        errors :{},
        user : {}
    },
    getters : {
        user (state){
            return state.user
        },
        token (state){
            return state.token
        },
        errors (state){
            return state.errors
        },
    },
    mutations : {
        SET_USER (state , user){
            state.user = user
        },
        SET_TOKEN (state , token){
            state.token = token
        },
        SET_ERROR (state , errors){
            state.errors = errors
        },
        CLEAR_TOKEN(state){
            localStorage.clear()
        },
       
    },
    actions : {
        async login ({commit}, credentials){
            try {
                let res = await axios.post('/login' , credentials);
                localStorage.setItem('token', res.data.data.token);
                localStorage.setItem('user', JSON.stringify(res.data.data.user));
                commit('SET_TOKEN' ,res.data.data.token);
                commit('SET_USER' ,res.data.data.user);
            } catch (e) {
                console.log(e);
                commit('SET_ERROR' ,e.response.data.errors);
                localStorage.removeItem('token');
                localStorage.removeItem('user');
            }
        },
        async logout ({commit}){
            let res = await axios.post('/logout');
            console.log(res);
            
            commit('CLEAR_TOKEN')
    },
        
    },
});