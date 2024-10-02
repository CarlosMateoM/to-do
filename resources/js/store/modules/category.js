import axios from '../../lib/axios';

const state = {
    categories: [],
};

const actions = {
    async getCategories({ commit }, params = '') {
        const response = await axios.get(`/categories?${params}`);
        commit('setCategories', response.data.data);
        return response;
    },
    async createCategory({ commit }, data) {
        const response = await axios.post('/categories', data);
        return response;
    },
    async updateCategory({commit}, {id,  data}) {
        console.log(data);
        const response = await axios.put(`/categories/${id}`, data);
        return response;
    },
    async deleteCategory({commit}, id) {
        const response = await axios.delete(`/categories/${id}`)
        return response;
    }
}

const mutations = {
    setCategories(state, categories) {
        state.categories = categories;
    },
}

export default {
    namespaced: true,
    state,
    actions,
    mutations,
};