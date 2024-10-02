import axios from '../../lib/axios';

const actions = {
    async saveImage ({commit}, data) {
        const response = await axios.post('images', data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        return response;
    }
}

export default {
    namespaced: true,
    actions
};