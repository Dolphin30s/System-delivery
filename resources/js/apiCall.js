import axios from "./axios";

export default {
    getCall : function(method, params, successCallback, failCallback = () => {}, errorCallback = null){
        //console.log(`API Call Get ${method} request :`, params);
        axios.get(method, {
                ...params
            })
            .then((response) => {
                if(response.status === 200){
                    console.log(`${method} response success :`, response.data.data);
                    successCallback(response.data.data);
                } else {
                    failCallback();
                    console.error(`API CALL Failed  => method: ${method}  response: `, response);
                }
            })
            .catch((error) => {
                if(!errorCallback)
                    failCallback();
                else
                    errorCallback();
                console.error(`API CALL Error  => method: ${method}  response: `, error.response);
            })
    },
    postCall : function(method, params, successCallback, failCallback = () => {}, errorCallback = null){
        //console.log(`API Call POST ${method} request :`, params);
        axios.post(method, {
                ...params
            })
            .then((response) => {
                if(response.status === 200){
                    console.log(`${method} response success :`, response.data.data);
                    successCallback(response.data.data);
                } else {
                    failCallback();
                   console.error(`API CALL Failed  => method: ${method}  response: `, response);
                }
            })
            .catch((error) => {
                if(!errorCallback)
                    failCallback();
                else
                    errorCallback();
                console.error(`API CALL Error  => method: ${method}  response: `, error.response);
            })
    },
    uploadCall: function(method, params, successCallback, failCallback = ()=> {}, errorCallback = () => {}){
        let form = new FormData();

        for(let key in params){
            form.append(key, params[key]);
        }

        axios.post(method, form, {headers:{ "Content-Type": "multipart/form-data" }})
            .then((response) => {
                if(response.status === 200){
                   console.log(`${method} response success :`, response.data.data);
                    successCallback(response.data.data);
                } else {
                    failCallback();
                   console.error(`API CALL Failed  => method: ${method}  response: `, response);
                }
            })
            .catch((error) => {
                errorCallback(error.data);
                console.error(`API CALL Error  => method: ${method}  response: `, error.response);
            })
    }
}
