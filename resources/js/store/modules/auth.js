import axios from "../../lib/axios";

const state = {
    user: null,
    token: null,
    isLoggedIn: false,
};

const getters = {
};

const actions = {

    async getUser({ commit }) {
        const response = await axios.get('/user');
        commit('setUser', response.data);
    },

    async register({ commit }, credentials) {
        const response = await axios.post('register', credentials);
        return response;
    },

    async login({ commit }, credentials) {
        const response = await axios.post('login', credentials);
        commit('setToken', response.data.token);
        localStorage.setItem('token', response.data.token);
        return response;
    },

    async logout({ commit }) {
        commit('setUser', null);
        commit('setToken', null);
    },
};

const mutations = {
    setUser(state, user) {
        state.user = user;
    },
    setToken(state, token) {
        state.token = token;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};