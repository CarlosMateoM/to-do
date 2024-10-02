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
        const response = await axios.get('user');
        commit('setUser', response.data);
        return response;
    },

    async register({ commit }, credentials) {
        const response = await axios.post('register', credentials);
        return response;
    },

    async login({ commit }, credentials) {
        const response = await axios.post('login', credentials);
        commit('setToken', response.data.token);
        commit('setLoggedIn', true);
        localStorage.setItem('token', response.data.token);
        return response;
    },

    async logout({ commit }) {
        const response = await axios.delete('logout');
        commit('setToken', null);
        commit('setLoggedIn', false);
        return response;
    },
};

const mutations = {
    setIsLoggedIn(state, isLoggedIn) {
        state.isLoggedIn = isLoggedIn;
    },
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