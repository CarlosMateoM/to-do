import Axios from 'axios';
import router from '../router';


const axios = Axios.create({
    baseURL: 'http://localhost:8000/api/v1',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    },
});

axios.interceptors.request.use((config) => {

    const token = localStorage.getItem('token') || '';

    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }

    return config;
});

axios.interceptors.response.use(
    response => response,

    error => {

        if(error.status === 401) {
            router.push({name: 'login'});
        }

        return Promise.reject(error);
    }
)

export default axios;