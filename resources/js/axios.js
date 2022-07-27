// axios
import axios from 'axios'

const baseURL = `/api`;
axios.defaults.withCredentials = true;
export default axios.create({
    baseURL
    // You can add your headers here
})
