export const defaultOptions = {
    url: '',
    method: 'GET',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    },
    data: {},
    params: {},
}

export default function createHttp(instanceOptions = {}, callback = () => {}) {
    // merge config
    const options = Object.assign({}, defaultOptions, instanceOptions)

    // prepare
    const data = JSON.stringify(options.data ?? {})
    const params = formatParams(options.params ?? {})
    const url = options.url + params

    // create http instance
    const http = new XMLHttpRequest();

    return new Promise((resolve, reject) => {
        // open request
        http.open(options.method, url, true)

        //
        options.headers['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

        // apply headers
        Object.keys(options.headers).forEach(key => {
            http.setRequestHeader(key, options.headers[key])
        })

        // events
        http.onreadystatechange = function() {
            if (http.readyState === 4 && http.status === 200) {
                let response
                try {
                    response = JSON.parse(http.responseText)
                } catch (e) {
                    response = http.responseText
                }
                resolve(response)
            }
        };

        //
        callback(http)

        // send request
        http.send(data);
    });
}

function formatParams( params ){
    return "?" + Object
          .keys(params)
          .map(function(key){
            return key+"="+encodeURIComponent(params[key])
          })
          .join("&")
  }
