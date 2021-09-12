export const defaultOptions = {
    url: '',
    method: 'GET',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    },
    data: {},
}

export default function createHttp(instanceOptions = {}, callback = () => {}) {
    // merge config
    const options = Object.assign({}, defaultOptions, instanceOptions)

    // prepare
    const data = JSON.stringify(options.data)

    // create http instance
    const http = new XMLHttpRequest();

    return new Promise((resolve, reject) => {
        // open request
        http.open(options.method, options.url, true);

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
