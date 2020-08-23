/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/track.js":
/*!*******************************!*\
  !*** ./resources/js/track.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


(function () {
  var _document = document,
      searchForm = _document.searchForm,
      btnSubmit = searchForm.btnSubmit,
      btnReset = searchForm.btnReset,
      searchString = searchForm.searchString,
      tabelBody = document.querySelector(".table-body");
  var compositionsArray = {};
  var getParams = {
    "title": "",
    "getTitle": function getTitle() {
      return this.title.length ? "&title=".concat(this.title) : "";
    },
    "tags": [],
    "getTags": function getTags() {
      var arr = this.tags.map(function (tagVal) {
        return "&tags[]=".concat(tagVal);
      });
      return arr.join("");
    },
    "sortBy": "",
    "sortType": "",
    "getSort": function getSort() {
      if (this.sortBy === "" || this.sortType === "") {
        return "";
      }

      return "&sortBy=".concat(this.sortBy, "&sortType=").concat(this.sortType);
    }
  };

  var generateTable = function generateTable(data) {
    var rows = "";
    data.forEach(function (composition) {
      var _composition$title = composition.title,
          title = _composition$title === void 0 ? "" : _composition$title,
          _composition$tags = composition.tags,
          tags = _composition$tags === void 0 ? [] : _composition$tags,
          _composition$lastPlay = composition.lastPlayed,
          lastPlayed = _composition$lastPlay === void 0 ? "" : _composition$lastPlay;
      var tagsHtml = "<ul class='tags-list'>",
          i = 0;
      var length = tags.length;

      for (i; i < length; i++) {
        tagsHtml += "<li class=\"tags-list_item\">".concat(tags[i].title, "</li>");
      }

      tagsHtml += "</ul>";
      rows += "<div class=\"table-row\">\n                        <div class=\"table-row_cell table-row_cell-title\">".concat(title, "</div>\n                            <div class=\"table-row_cell table-row_cell-tags\">\n                                ").concat(tagsHtml, "\n                            </div>\n                    <div class=\"table-row_cell table-row_cell-date\">").concat(lastPlayed, "</div>\n                </div>");
    });
    tabelBody.innerHTML = rows;
  };

  var getCompositions = function getCompositions() {
    var url = "/async/tracks?".concat(getParams.getTitle()).concat(getParams.getTags()).concat(getParams.getSort());
    requestDate(url).then(function (result) {
      var json = result.response; // eslint-disable-next-line no-console

      console.log(json);

      if (json.status === "success") {
        if (!json.data.length) {
          var row = "<div class='table-row table-row_error'>Таких произведений не найдено</div>";
          tabelBody.innerHTML = row;
          return;
        }

        compositionsArray = json.data;
        generateTable(compositionsArray);
      } else {
        var delay = 0; // eslint-disable-next-line guard-for-in

        for (var key in json.errors) {
          var error = json.errors[key];
          var length = error.length;
          var i = 0;

          var _loop = function _loop() {
            var mess = message({
              "text": error[i]
            });
            setTimeout(function () {
              mess.show();
            }, delay);
          };

          for (i; i < length; i++) {
            _loop();
          }

          delay += 200;
        }
      }
    }, function (error) {
      // eslint-disable-next-line no-console
      console.log("Rejected: ".concat(error));
    });
  };

  searchForm.addEventListener("submit", function (event) {
    event.preventDefault();
    getParams.title = searchString.value;
    getCompositions();

    if (searchString !== "") {
      btnReset.classList.add("show");
      btnSubmit.classList.add("hide");
    }
  });
  searchString.addEventListener("input", function () {
    // btnReset.classList.remove("show");
    btnSubmit.classList.remove("hide");
  });
  btnReset.addEventListener("click", function () {
    var url = "/async/search-by-title";
    getCompositions(url);
    btnReset.classList.remove("show");
    btnSubmit.classList.remove("hide");
  });
  var tagsBtn = searchForm.querySelector(".tag-btn"),
      $allTags = document.querySelector(".all-tags .tags-list");
  var modalTags = modal({
    "title": "Поиск по тегам",
    "content": "<form name=\"tagsForm\">".concat($allTags.outerHTML, "\n        <div class=\"btns text-center\">\n        <button type=\"submit\" name=\"btnSubmit\">\u041F\u043E\u0438\u0441\u043A</button>\n        <button type=\"reset\" name=\"btnReset\" class=\"disagree\">\u0421\u0431\u0440\u043E\u0441\u0438\u0442\u044C</button>\n        </div></form>\n        "),
    "class": "tags-popup",
    "onBuild": function onBuild(modal) {
      var _document2 = document,
          tagsForm = _document2.tagsForm;
      tagsForm.addEventListener("submit", function (event) {
        event.preventDefault();
        var tags = tagsForm.querySelectorAll("input[type=checkbox]:checked");
        var tagsArray = Array.from(tags);
        tagsArray = tagsArray.map(function (tag) {
          return tag.value;
        });
        getParams.tags = tagsArray;
        getCompositions();
        modal.hide();
      });
    }
  });
  tagsBtn.addEventListener("click", function (event) {
    event.preventDefault();
    modalTags.show();
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

/***/ }),

/***/ 1:
/*!*************************************!*\
  !*** multi ./resources/js/track.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/admin/Documents/orchestra/afelia/resources/js/track.js */"./resources/js/track.js");


/***/ })

/******/ });