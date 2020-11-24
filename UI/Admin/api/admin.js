'use strict';

// http://jsonplaceholder.typicode.com/posts
const API_URL = "http://127.0.0.1:3000";
const SOURCE_URL = "file:///D:/Sonia/";


const configPostEndPoint = {
    headers: {
        'Content-type': "application/json",
        'Access-Control-Allow-Origin': "*"
    },
    mode: "no-cors"
};

/**
 * a function that allow the admin to be connected
 * @param {*} email
 * @param {*} password
 */

const login = (email, password) => {

    const bodyRequests = {
        email: email,
        password: password,
    };

    const url = API_URL + "/api/v1/admin/login";

    return fetch(url, {
            method: "Post",
            body: JSON.stringify(bodyRequests),
            headers: configPostEndPoint.headers
        })
        .then(res => res.json())
        .then(result => {
            let response = {
                "status": result.error == undefined ? 200 : 400,
                "message": result.error == undefined ? result.msg : result.error,
                "adminId": result.error == undefined ? result.AdminId : null,
                "token": result.error == undefined ? result.token : "",
            }

            return response;
        })
        .catch(err => {
            console.log('ERROR: ', err);
        })

}