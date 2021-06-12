
import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        elements:[],
        timeLimit: 60*60*2,
    },
    mutations: {
        setElements(state, item){
            this.state.elements = item
        },
    },
    actions:{
          ImportElements({ commit }) {
             axios.get('/api/elements')
             .then(response => {
                commit('setElements',response.data.data)
            })
            
        },
        

    },
});
export default store;
