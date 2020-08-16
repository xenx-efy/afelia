"use strict";

const fieldValueLength = 0,
    formField = document.querySelectorAll("form label");

formField.forEach((element) => {

    const field = element.querySelector("input"),
        label = element.querySelector(".placeholder");

    field.onfocus = function onfocus () {

        label.classList.add("active");

    };

    field.onblur = function onblur () {

        if (field.value.length === fieldValueLength) {

            label.classList.remove("active");

        }

    };

});

/**
 * Get data from site.
 * @param {string} url Is request url
 * @param {string} proxy I don't know what it
 * @returns {Promise} Describe this pls
 */
// eslint-disable-next-line no-unused-vars,require-jsdoc
window.requestDate = (url, proxy = "") => {

    const statusOk = 200;

    return new Promise((resolve, reject) => {

        const xhr = new XMLHttpRequest();

        xhr.open(
            "GET",
            proxy + url,
            true
        );
        xhr.onload = function onload () {

            if (this.status === statusOk) {

                resolve(this);

            } else {

                const error = new Error(this.statusText);

                error.code = this.status;
                reject(error);

            }

        };
        xhr.onerror = function onerror () {

            reject(new Error("Network Error"));

        };
        xhr.send();

    });

};

/*
 * Var sign_in = document.querySelector('#sign_in button');
 * sign_in.addEventListener('click', function (event) {
 *     event.preventDefault();
 *     authorisation();
 * });
 */

/*
 * Function authorisation() {
 *     let form = document.getElementById('sign_in');
 *     let params = 'username=' + encodeURIComponent(form.name.value) +
 *         '&password=' + encodeURIComponent(form.instrument.value);
 *     requestDate('/api/login?' + params)
 *         .then(result => {
 *                 let json = JSON.parse(result.response);
 *                 if (json.error) {
 *                     if(!form.querySelector('.error')){
 *                         let errorText = document.createElement('span');
 *                         errorText.classList.add('error');
 *                         errorText.innerHTML = json.error;
 *                         form.append(errorText);
 *                         setTimeout(()=>{
 *                             errorText.classList.add('show');
 *                         }, 100)
 *                     }
 *                 } else {
 *                     if(form.querySelector('.error')){
 *                         form.querySelector('.error').classList.remove('show');
 *                     }
 *                     document.querySelector('.header').classList.add('hide');
 *                     document.querySelector('.content').classList.add('show');
 */

/*
 *                     If (json.length) {
 *                         generateTable(json);
 *                     }
 *                 }
 *             },
 *             error => {
 *                 console.log("Rejected: " + error);
 *             }
 *         )
 *         .catch(error => {
 *             console.log("Catch: " + error);
 *         })
 * };
 */
