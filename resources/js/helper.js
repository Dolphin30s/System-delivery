import Vue from 'vue';

export const date_str_format = function(datetime, format){
    if(!datetime)
        return '';
    let date = new Date(Date.parse(datetime));
    let yy = date.getFullYear();
    let mm = date.getMonth() + 1;
    let dd = date.getDate();
    let hh = date.getHours();
    let MM = date.getMinutes();
    let SS = date.getSeconds();
    let format_str = format;
    if(/yy/.test(format)){
        format_str = format_str.replace('yy', `${yy}`);
    }
    if(/y/.test(format)){
        format_str = format_str.replace('y', `${yy}`);
    }
    if(/mm/.test(format)){
        format_str = format_str.replace('mm', mm < 10?`0${mm}`:`${mm}`);
    }
    if(/m/.test(format)){
        format_str = format_str.replace('m', `${mm}`);
    }
    if(/dd/.test(format)){
        format_str = format_str.replace('dd', dd<10?`0${dd}`:`${dd}`);
    }
    if(/d/.test(format)){
        format_str = format_str.replace('d', `${dd}`);
    }
    if(/hh/.test(format)){
        format_str = format_str.replace('hh', hh<10?`0${hh}`:`${hh}`);
    }
    if(/h/.test(format)){
        format_str = format_str.replace('h', `${hh}`);
    }
    if(/MM/.test(format)){
        format_str = format_str.replace('MM', MM<10?`0${MM}`:`${MM}`);
    }
    if(/M/.test(format)){
        format_str = format_str.replace('M', `${MM}`);
    }
    if(/SS/.test(format)){
        format_str = format_str.replace('SS', SS<10?`0${SS}`:`${SS}`);
    }
    if(/S/.test(format)){
        format_str = format_str.replace('S', `${SS}`);
    }
    return format_str;
};

export const number_format = function(amount){
    return amount.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
};

export const openWindowWithPostParams = function(route, params){
    const print_url = `${process.env.MIX_APP_URL}${route}`;

    window.io = {
        open: function(verb, url, data, target){
            var form = document.createElement("form");
            form.action = url;
            form.method = verb;
            form.target = target || "_self";
            if (data) {
                for (var key in data) {
                    var input = document.createElement("textarea");
                    input.name = key;
                    input.value = typeof data[key] === "object"
                        ? JSON.stringify(data[key])
                        : data[key];
                    form.appendChild(input);
                }
            }

            var tokenInput = document.createElement("input");
            tokenInput.name = "_token";
            tokenInput.value = Vue.auth.token('token');
            form.appendChild(tokenInput);

            form.style.display = 'none';
            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
        }
    };

    //console.log('Open window with post params route: ${route} ', params);

    io.open('POST',print_url, {
        ...params
    },'_blank');
};

export const showNotify = function (vs, title, text = '', success=true){
    vs.notify({
        time: 5000,
        title: title,
        text: text,
        color: success?'success':'danger',
        position: 'top-right',
        iconPack: 'feather',
        icon: success?'icon-check':'icon-alert-circle'
    });
}
