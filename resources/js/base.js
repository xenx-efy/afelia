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
function requestDate (url, proxy = "") {

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

}

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


/*
 * Document.querySelector('#search input').onchange = function(){
 *     this.parentNode.querySelector('.search-reset').remove('show');
 * }
 */

/*
 * Document.querySelector('#search button').addEventListener('click', function (event) {
 *     event.preventDefault();
 *     let url = '/api/compositions?' + getParams.search_s() + '&' + getParams.title() + '&' + getParams.date()
 *  + '&' + getParams.tags();
 *     getCompositions(url);
 *     if(this.parentNode.search_s.value !== ''){
 *         this.parentNode.querySelector('.search-reset').classList.add('show');
 *         this.parentNode.querySelector('button').classList.add('hide');
 *     }
 * });
 * document.querySelector('.search-reset').addEventListener('click', function(){
 *     this.parentNode.reset();
 *     let url = '/api/compositions';
 *     getCompositions(url);
 *     this.classList.remove('show');
 *     this.parentNode.querySelector('button').classList.remove('hide');
 * })
 * function getCompositions(url) {
 *     requestDate(url)
 *         .then(result => {
 *                 let json = JSON.parse(result.response);
 *                 if (json.length) {
 *                     generateTable(json);
 *                 } else{
 *                     clearTable();
 *                     let error = document.createElement('div');
 *                     error.classList.add('content-table_row', 'content-table_row-error');
 *                     error.innerHTML = 'Таких произведений не найдено';
 *                     document.querySelector('.content-table').append(error);
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

/*
 * Function clearTable(){
 *     let table = document.querySelector('.content-table');
 *     while (table.querySelector('.content-table_row')) {
 *         table.removeChild(table.querySelector('.content-table_row'));
 *     }
 * };
 */

/*
 * Var orderby_btn = document.querySelectorAll('.filter-order');
 * orderby_btn.forEach(element => {
 *     element.addEventListener('click', function(event){
 *         console.log(event.target);
 *         let attr = this.getAttribute('data-value');
 *         if(attr == 'asc'){
 *             this.setAttribute('data-value', 'desc');
 *             this.classList.add('reverse');
 *         }else{
 *             this.setAttribute('data-value', 'asc');
 *             this.classList.remove('reverse');
 *         }
 */

/*
 *     })
 * });
 */

/*
 * Var getParams = {
 *     'search_s': function(){
 *         let form = document.getElementById('search');
 *         return 'search_s=' + encodeURIComponent(form.search_s.value);
 *     },
 *     'title': function(){
 *         let filter = document.querySelector('.content-table_head-cell-title');
 *         return 'title=' + encodeURIComponent(filter.querySelector('.filter-order').getAttribute('data-value'));
 *     },
 *     'date': function(){
 *         let filter = document.querySelector('.content-table_head-cell-updated_at');
 *         return 'date=' + encodeURIComponent(filter.querySelector('.filter-order').getAttribute('data-value'));
 *     },
 *     'tags': function(){
 *         let tags = document.querySelectorAll('#tags-modal .tags-list_item.active'),
 *             tags_length = tags.length,
 *             tags_string = '';
 */

/*
 *         Tags.forEach(function(elem, i){
 *             tags_string += 'tag[]=' + elem.innerHTML + (i !== (tags_length - 1) ? '&' : '');
 *         });
 */

/*
 *         Return tags_string;
 *     }
 * };
 */

/*
 * Var filter_btn = document.querySelectorAll('.filter-btn');
 * filter_btn.forEach(element => {
 *     element.addEventListener('click', function () {
 *         let filter = this.getAttribute('data-filter');
 *         let url = '/api/compositions?' + getParams.search_s() + '&' + getParams[filter]() + '&' + getParams.tags();
 *         getCompositions(url);
 *     });
 * });
 */

/*
 * Function generateTable(date) {
 *     let rows = new DocumentFragment()
 *         row_example = document.createElement('div');
 *     row_example.classList.add('content-table_row');
 */

/*
 *     Let cell_example = document.createElement('div');
 *     cell_example.classList.add('content-table_row-cell');
 */

/*
 *     Let tags = [],
 *         tags_modal = new DocumentFragment(),
 *         tags_modal_wrap = document.createElement('div'),
 *         tags_modal_content = document.createElement('div'),
 *         tags_ul_example = document.createElement('ul'),
 *         tags_li_example = document.createElement('li');
 */

/*
 *         Tags_modal_wrap.id = 'tags-modal';
 *         tags_modal_wrap.classList.add('modal-wrap');
 *         tags_modal_content.classList.add('modal-content');
 *         tags_ul_example.classList.add('tags-list');
 *         tags_li_example.classList.add('tags-list_item');
 */

/*
 *     Date.forEach(element => {
 *         let row = row_example.cloneNode(false);
 *         let needdate = ['title', 'tags', 'updated_at'];
 *         for(let i = 0; i < 3; i++){
 *             let cell = cell_example.cloneNode(false);
 *             cell.classList.add('content-table_row-cell-' + needdate[i]);
 *             if(needdate[i] == "tags"){
 *                 let ul = tags_ul_example.cloneNode(false);
 *                 element[needdate[i]].forEach(element=>{
 *                     let li = tags_li_example.cloneNode(false);
 *                     li.innerHTML = element.tag;
 *                     tags.push(element.tag);
 *                     ul.append(li);
 *                 })
 *                 cell.append(ul);
 *             }else{
 *                 cell.innerHTML = element[needdate[i]];
 *             }
 *             row.append(cell);
 *         }
 *         rows.append(row);
 *     });
 *     console.log(tags);
 *     tags = uniq(tags);
 *     let modal_tags_ul = tags_ul_example.cloneNode(false);
 *     tags.forEach(function(element){
 *         let li = tags_li_example.cloneNode(false);
 *         li.innerHTML = element;
 *         li.addEventListener('click', toggleTags);
 *         modal_tags_ul.append(li);
 *     })
 *     tags_modal_content.append(modal_tags_ul);
 *     tags_modal_wrap.append(tags_modal_content);
 *     tags_modal.append(tags_modal_wrap);
 *     document.querySelector('.app').append(tags_modal);
 *     let tags_modal_target = document.querySelector('.content-table_head-cell-tags');
 *     tags_modal_target.addEventListener('click', toggleModal.bind(null, 'tags-modal', 'on'));
 */

/*
 *     Tags_modal = document.getElementById('tags-modal');
 *     tags_modal.addEventListener('click', function(event){
 *         if(event.target.classList.contains('modal-wrap')){
 *             toggleModal('tags-modal', 'off');
 *         }
 *     });
 */

/*
 *     Console.log(tags);
 *     clearTable();
 *     document.querySelector('.content-table').append(rows);
 * };
 */

/*
 * Function uniq(a) {
 *     let r = {};
 *     return a.filter(i=>r.hasOwnProperty(i)?!1:r[i]=!0)
 * }
 */


/*
 * Function toggleTags(event){
 *     event.stopPropagation();
 *     this.classList.toggle('active');
 * }
 * function toggleModal(modalId, value){
 *     let modal = document.getElementById(modalId);
 *     if(value === 'on'){
 *         modal.classList.add('active');
 *     } else {
 *         modal.classList.remove('active');
 *     }
 * }
 */
