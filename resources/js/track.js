"use strict";

(() => {

    const {searchForm} = document,
        {btnSubmit, btnReset, searchString} = searchForm,
        tabelBody = document.querySelector(".table-body");
    let compositionsArray = {};

    const generateTable = (data) => {

        let rows = "";

        data.forEach((composition) => {

            const {title = "", tags = "", last_played = ""} = composition;

            rows += `<div class="table-row">
                        <div class="table-row_cell table-row_cell-title">${title}</div>
                            <div class="table-row_cell table-row_cell-tags">
                                ${tags}
                            </div>
                    <div class="table-row_cell table-row_cell-date">${last_played}</div>
                </div>`;

        });

        tabelBody.innerHTML = rows;

    };

    const getCompositions = (url) => {

        requestDate(url).
            then(
                (result) => {

                    const json = JSON.parse(result.response);

                    // eslint-disable-next-line no-console
                    console.log(json);

                    if (json.status === "success") {

                        compositionsArray = json.data;
                        generateTable(compositionsArray);

                    } else {

                        const row = "<div class='table-row table-row_error'>Таких произведений не найдено</div>";

                        tabelBody.innerHTML = row;

                    }

                },
                (error) => {

                    // eslint-disable-next-line no-console
                    console.log(`Rejected: ${error}`);

                }
            ).
            catch((error) => {

                // eslint-disable-next-line no-console
                console.log(`Catch: ${error}`);

            });

    };

    searchForm.addEventListener("submit", (event) => {

        event.preventDefault();

        const url = `/async/search-by-title?
            title=${searchString.value}`;

        getCompositions(url);

        if (searchString !== "") {

            btnReset.classList.add("show");
            btnSubmit.classList.add("hide");

        }

    });

    searchString.addEventListener("input", () => {

        // btnReset.classList.remove("show");
        btnSubmit.classList.remove("hide");

    });

    btnReset.addEventListener("click", () => {

        const url = "/async/search-by-title";

        getCompositions(url);

        btnReset.classList.remove("show");
        btnSubmit.classList.remove("hide");

    });

    const tagsBtn = searchForm.querySelector(".tag-btn"),
        $allTags = document.querySelector(".all-tags .tags-list");

    const modalCookie = modal({
        "title": "Поиск по тегам",
        "content": `<form name="tagsForm">${$allTags.outerHTML}
        <div class="btns text-center">
        <button type="submit" name="btnSubmit">Поиск</button>
        <button type="reset" name="btnReset" class="disagree">Сбросить</button>
        </div></form>
        `,
        "class": "tags-popup",
        "onBuild": () => {

            const {tagsForm} = document,
                tags = tagsForm["tags[]"];

            // eslint-disable-next-line no-console
            console.log(tags);

        }
    });

    tagsBtn.addEventListener("click", (event) => {

        event.preventDefault();
        modalCookie.show();

    });

})();

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

