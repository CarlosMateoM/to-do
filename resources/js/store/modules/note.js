import axios from '../../lib/axios';

const state = {
    notes: [],
};

const getters = {

}

const actions = {
    async getNotes({ commit }, params) {
        const response = await axios.get(`/notes?${params}`);
        commit('setNotes', response.data.data);
        return response;
    },
    async getNote({commit}, id) {
        return await axios.get(`/notes/${id}`);
    },
    async createNote({ commit }, data) {
        const response = await axios.post('/notes', data);
        return response;
    },
    async updateNote({commit}, {id,  data}) {
        console.log(data);
        const response = await axios.put(`/notes/${id}`, data);
        return response;
    },
    async deleteNote({commit}, id) {
        const response = await axios.delete(`/notes/${id}`)
        return response;
    }
}

const mutations = {
    setNotes(state, notes) {
        state.notes = notes;
    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};