import axios from 'axios';
import Cookies from 'js-cookie';

const getBaseUrl = () => {
    if (typeof window !== 'undefined') {
        const hostname = window.location.hostname;
        // If we are on a tenant subdomain, e.g. tenant1.sidbm.test
        // We should point to api.tenant1.sidbm.test or whatever our API structure is.
        // For simplicity, let's assume the API is at the same hostname under /api
        // But in stancl/tenancy, it's often a subdomain for API too.
        
        // Let's use a dynamic approach:
        return `${window.location.protocol}//${hostname}:8000/api`;
    }
    return process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api';
};

const api = axios.create({
    baseURL: getBaseUrl(),
    withCredentials: true,
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    },
});

api.interceptors.request.use((config) => {
    const token = Cookies.get('auth_token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});

export default api;
