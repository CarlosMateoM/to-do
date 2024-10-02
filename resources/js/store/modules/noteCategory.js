import axios from '../../lib/axios';

const actions = {
    async attachCategoryToNote({ commit }, {id, data}) {
        const response = await axios.post(`/notes/${id}/categories`, data);
        return response;
    },
    async deattachCategoryFromNote({commit}, {noteId, categoryId}) {
        const response = await axios.delete(`notes/${noteId}/categories/${categoryId}`)
        return response;
    }
}

export default {
    namespaced: true,
    actions,
};