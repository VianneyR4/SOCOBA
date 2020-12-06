'use strict';

// http://jsonplaceholder.typicode.com/posts
const API_URL = "http://127.0.0.1:3000/api/v1";
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

    const url = API_URL + "/admin/login";

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

};


/**
 * a function that allow the admin to be connected
 * @param {*} token
 */

const getProfile = (token) => {

    const url = API_URL + "/admin/profile";

    return fetch(url, {
            headers: {
                'Content-type': "application/json",
                'Access-Control-Allow-Origin': "*",
                authorization: token,
            }
        })
        .then(res => res.json())
        .then(data => {
            let response = {
                "status": data.error == undefined ? 201 : 400,
                "profile": data,
                "message": data.error != undefined ? data.error : data.msg,
            }

            return response;
        })
        .catch(err => {
            console.log('ERROR: ', err);
        })

};