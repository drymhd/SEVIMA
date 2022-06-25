import axios from 'axios';

axios.defaults.baseURL = process.env.MIX_APP_URL + '/api/v1/';

export default (app) => {
    app.axios = axios;
    app.$http = axios;

    app.config.globalProperties.axios = axios;
    app.config.globalProperties.$http = axios;
}