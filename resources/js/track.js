"use strict";

// DEFINE VARIABLES
const {searchForm} = document,
    {btnSubmit, btnReset, searchString} = searchForm,
    tabelBody = document.querySelector(".table-body");
let compositionsArray = {},
    isLoadData = false;
const tabelBodyHeight = {
    "get": tabelBody.clientHeight,
    "update": function update () {

        this.get = tabelBody.clientHeight;

    }
};
let windowHeight = window.outerHeight;

window.addEventListener("load", () => {

    tabelBodyHeight.update();

});
window.addEventListener("resize", () => {

    windowHeight = window.outerHeight;
    tabelBodyHeight.update();

});

// DEFINE OBJECT TO GET PARAMETRS FOR SEARCH/SORT
const getParams = {
    "title": "",
    "getTitle": function getTitle () {

        return this.title.length ? `&title=${this.title}` : "";

    },
    "tags": [],
    "getTags": function getTags () {

        if (!this.tags.length) {

            return ""; 

        }

        const arr = this.tags.map((tagVal) => `&tags[]=${tagVal}`);

        return arr.join("");
    
    },
    "sortBy": "",
    "sortType": "",
    "getSort": function getSort () {

        if (this.sortBy === "" || this.sortType === "") {

            return ""; 

        }

        return `&sortBy=${this.sortBy}&sortType=${this.sortType}`;

    },
    "page": 1,
    "maxPage": 2,
    "nextPage": function nextPage () {

        this.page =  this.page < this.maxPage ? this.page + 1 : this.maxPage;

    },
    "getPage": function getPage () {

        return `&page=${this.page}`;

    }
};

// FUNCTION FOR RENDER TABLE ROW
const generateTable = (data, replace) => {

    const rows = new DocumentFragment();

    data.forEach((composition) => {

        const {title = "", tags = [], lastPlayed = "", composer = {}} = composition;
        let tagsHtml = "<ul class='tags-list'>",
            i = 0;
        const {length} = tags;

        for (i; i < length; i++) {

            tagsHtml += `<li class="tags-list_item">${tags[i].title}</li>`;

        }
        tagsHtml += "</ul>";
        const row = document.createElement("div");

        row.classList.add("table-row");
        row.innerHTML = `<div class="table-row_cell table-row_cell-title">
                        <div class="author">${composer.composerName}</div>
                        ${title}
                    </div>
                    <div class="table-row_cell table-row_cell-tags">
                            ${tagsHtml}
                    </div>
                    <div class="table-row_cell table-row_cell-date">${lastPlayed}</div>`;
        rows.appendChild(row);

    });

    if (replace) {

        tabelBody.innerHTML = "";

    }
    tabelBody.appendChild(rows);
// eslint-disable-next-line no-unused-expressions
    tabelBody.offsetTop;
    tabelBodyHeight.update();

};

// MAIN FUNCTION TO GET COMPOSITIONS
const getCompositions = (param = {}) => {

    param.replace = typeof param.replace === "undefined" ? true : param.replace;
    const url = `/async/tracks?${getParams.getTitle()}${getParams.getTags()}${getParams.getSort()}${getParams.getPage()}`;

    isLoadData = true;
    requestData(url).
    then(
        (result) => {

            const json = result.response;

            // eslint-disable-next-line no-console
            console.log(json);

            if (json.status === "success") {

                if (!json.data.length) {

                    const row = "<div class='table-row table-row_error'>Таких произведений не найдено</div>";

                    tabelBody.innerHTML = row;

                    return;

                }

                compositionsArray = json.data;
                generateTable(compositionsArray, param.replace);
                getParams.page = json.meta.current_page;
                getParams.maxPage = json.meta.last_page;
                isLoadData = false;

            } else {

                // eslint-disable-next-line guard-for-in
                for (const key in json.errors) {

                    const error = json.errors[key];
                    const {length} = error;
                    let i = 0;

                    for (i; i < length; i++) {

                        const mess = message({

                            "text": error[i]

                        });

                        mess.show();

                    }

                }

                isLoadData = false;

            }

        },
        (error) => {

            // eslint-disable-next-line no-console
            console.log(`Rejected: ${error}`);

        }
    );

};

searchForm.addEventListener("submit", (event) => {

    event.preventDefault();

    getParams.title = searchString.value;
    getParams.page = 1;

    getCompositions();

    if (searchString !== "") {

        btnReset.classList.add("show");
        btnSubmit.classList.add("hide");

    }

});
searchString.addEventListener("input", () => {

    btnSubmit.classList.remove("hide");

});

btnReset.addEventListener("click", () => {

    getParams.title = "";
    getParams.tags = [];
    getParams.sortBy = "";

    getCompositions();

    btnReset.classList.remove("show");
    btnSubmit.classList.remove("hide");

});

const tagsBtn = searchForm.querySelector(".tag-btn"),
    $allTags = document.querySelector(".all-tags .tags-list");

tagsBtn.addEventListener("focus", () => {

    tagsBtn.blur();

});

const modalTags = modal({
    "title": "Поиск по тегам",
    "content": `<form name="tagsForm">${$allTags.outerHTML}
<div class="btns text-center">
<button type="submit" name="btnSubmit">Поиск</button>
<button type="reset" name="btnReset" class="disagree">Сбросить</button>
</div></form>
`,
    "class": "tags-popup",
    "onBuild": (modal) => {

        const {tagsForm} = document;

        tagsForm.addEventListener("submit", (event) => {
        
            event.preventDefault();

            const tags = tagsForm.querySelectorAll("input[type=checkbox]:checked");
            let tagsArray = Array.from(tags);
        
            tagsArray = tagsArray.map((tag) => tag.value);
            getParams.tags = tagsArray;
            getParams.page = 1;

            getCompositions();

            modal.hide();


        });


    }
});

tagsBtn.addEventListener("click", (event) => {

    event.preventDefault();
    modalTags.show();

});

const sortByBtns = document.querySelectorAll(".sortBy");

for (let i = 0, {length} = sortByBtns; i < length; i++) {

    const btn = sortByBtns[i];

    btn.addEventListener("click", () => {

        btn.dataset.sortType = "";

        getParams.sortBy =  btn.dataset.sortBy;
        getParams.sortType =  btn.dataset.sortTypeDefault;

        getCompositions();

    });

}

const sortTypeBtns = document.querySelectorAll(".sortType");

for (let i = 0, {length} = sortTypeBtns; i < length; i++) {

    const btn = sortTypeBtns[i];

// eslint-disable-next-line no-loop-func
    btn.addEventListener("click", () => {

        const sortBy = document.querySelector(btn.dataset.for);

        if (!sortBy) {

            const error = message({

                "text": "data-for не верный, попросите Лешу глянуть файл track.js в районе 262 строчки"

            });
        
            error.show();

            return;

        }
        const prevType = sortBy.dataset.sortType ? sortBy.dataset.sortType : sortBy.dataset.sortTypeDefault;
        const newType = prevType === "desc" ? "asc" : "desc";

        sortBy.dataset.sortType = newType;
        getParams.sortBy =  sortBy.dataset.sortBy;
        getParams.sortType = newType;

        getCompositions();

    });

}

const paginate = () => {

    let lastKnownScrollPosition = 0;
    let ticking = false;
    const whenLoad = 0.6;
    const getCoords = (elem) => {

        const box = elem.getBoundingClientRect();
  
        return {
            "top": box.top + pageYOffset,
            "left": box.left + pageXOffset
        };
  
    };
    const tabelCoor = getCoords(tabelBody);

    const doSomething = (scrollPos) => {

        const endPoint = tabelCoor.top + tabelBodyHeight.get;
        const currentEndPoint = scrollPos + windowHeight;
        const makeLoad = currentEndPoint >= endPoint * whenLoad;

    // eslint-disable-next-line no-console
    // console.log(currentEndPoint, endPoint * whenLoad);

        if (makeLoad && !isLoadData && getParams.page < getParams.maxPage) {

            getParams.nextPage();
            getCompositions({
                "replace": false
            });

        }

    };

    window.addEventListener("scroll", () => {

        lastKnownScrollPosition = window.scrollY;

        if (!ticking) {
        
            window.requestAnimationFrame(() => {

                doSomething(lastKnownScrollPosition);
                ticking = false;

            });

            ticking = true;

        }

    });

};

paginate();
