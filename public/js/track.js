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
 // DEFINE VARIABLES

var _document = document,
    searchForm = _document.searchForm,
    btnSubmit = searchForm.btnSubmit,
    btnReset = searchForm.btnReset,
    searchString = searchForm.searchString,
    tabelBody = document.querySelector(".table-body");
var compositionsArray = {},
    isLoadData = false;
var tabelBodyHeight = {
  "get": tabelBody.clientHeight,
  "update": function update() {
    this.get = tabelBody.clientHeight;
  }
};
var windowHeight = window.outerHeight;
window.addEventListener("load", function () {
  tabelBodyHeight.update();
});
window.addEventListener("resize", function () {
  windowHeight = window.outerHeight;
  tabelBodyHeight.update();
}); // DEFINE OBJECT TO GET PARAMETRS FOR SEARCH/SORT

var getParams = {
  "title": "",
  "getTitle": function getTitle() {
    return this.title.length ? "&title=".concat(this.title) : "";
  },
  "tags": [],
  "getTags": function getTags() {
    if (!this.tags.length) {
      return "";
    }

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
  },
  "page": 1,
  "maxPage": 2,
  "nextPage": function nextPage() {
    this.page = this.page < this.maxPage ? this.page + 1 : this.maxPage;
  },
  "getPage": function getPage() {
    return "&page=".concat(this.page);
  }
}; // FUNCTION FOR RENDER TABLE ROW

var generateTable = function generateTable(data, replace) {
  var rows = new DocumentFragment();
  data.forEach(function (composition) {
    var _composition$title = composition.title,
        title = _composition$title === void 0 ? "" : _composition$title,
        _composition$tags = composition.tags,
        tags = _composition$tags === void 0 ? [] : _composition$tags,
        _composition$lastPlay = composition.lastPlayed,
        lastPlayed = _composition$lastPlay === void 0 ? "" : _composition$lastPlay,
        _composition$composer = composition.composer,
        composer = _composition$composer === void 0 ? {} : _composition$composer;
    var tagsHtml = "<ul class='tags-list'>",
        i = 0;
    var length = tags.length;

    for (i; i < length; i++) {
      tagsHtml += "<li class=\"tags-list_item\">".concat(tags[i].title, "</li>");
    }

    tagsHtml += "</ul>";
    var row = document.createElement("div");
    row.classList.add("table-row");
    row.innerHTML = "<div class=\"table-row_cell table-row_cell-title\">\n                        <div class=\"author\">".concat(composer.composerName, "</div>\n                        ").concat(title, "\n                    </div>\n                    <div class=\"table-row_cell table-row_cell-tags\">\n                            ").concat(tagsHtml, "\n                    </div>\n                    <div class=\"table-row_cell table-row_cell-date\">").concat(lastPlayed, "</div>");
    rows.appendChild(row);
  });

  if (replace) {
    tabelBody.innerHTML = "";
  }

  tabelBody.appendChild(rows); // eslint-disable-next-line no-unused-expressions

  tabelBody.offsetTop;
  tabelBodyHeight.update();
}; // MAIN FUNCTION TO GET COMPOSITIONS


var getCompositions = function getCompositions() {
  var param = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
  param.replace = typeof param.replace === "undefined" ? true : param.replace;
  var url = "/async/tracks?".concat(getParams.getTitle()).concat(getParams.getTags()).concat(getParams.getSort()).concat(getParams.getPage());
  isLoadData = true;
  requestData(url).then(function (result) {
    var json = result.response; // eslint-disable-next-line no-console

    console.log(json);

    if (json.status === "success") {
      if (!json.data.length) {
        var row = "<div class='table-row table-row_error'>Таких произведений не найдено</div>";
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
      for (var key in json.errors) {
        var error = json.errors[key];
        var length = error.length;
        var i = 0;

        for (i; i < length; i++) {
          var mess = message({
            "text": error[i]
          });
          mess.show();
        }
      }

      isLoadData = false;
    }
  }, function (error) {
    // eslint-disable-next-line no-console
    console.log("Rejected: ".concat(error));
  });
};

searchForm.addEventListener("submit", function (event) {
  event.preventDefault();
  getParams.title = searchString.value;
  getParams.page = 1;
  getCompositions();

  if (searchString !== "") {
    btnReset.classList.add("show");
    btnSubmit.classList.add("hide");
  }
});
searchString.addEventListener("input", function () {
  btnSubmit.classList.remove("hide");
});
btnReset.addEventListener("click", function () {
  getParams.title = "";
  getParams.tags = [];
  getParams.sortBy = "";
  getCompositions();
  btnReset.classList.remove("show");
  btnSubmit.classList.remove("hide");
});
var tagsBtn = searchForm.querySelector(".tag-btn"),
    $allTags = document.querySelector(".all-tags .tags-list");
tagsBtn.addEventListener("focus", function () {
  tagsBtn.blur();
});
var modalTags = modal({
  "title": "Поиск по тегам",
  "content": "<form name=\"tagsForm\">".concat($allTags.outerHTML, "\n<div class=\"btns text-center\">\n<button type=\"submit\" name=\"btnSubmit\">\u041F\u043E\u0438\u0441\u043A</button>\n<button type=\"reset\" name=\"btnReset\" class=\"disagree\">\u0421\u0431\u0440\u043E\u0441\u0438\u0442\u044C</button>\n</div></form>\n"),
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
      getParams.page = 1;
      getCompositions();
      modal.hide();
    });
  }
});
tagsBtn.addEventListener("click", function (event) {
  event.preventDefault();
  modalTags.show();
});
var sortByBtns = document.querySelectorAll(".sortBy");

var _loop = function _loop(i, length) {
  var btn = sortByBtns[i];
  btn.addEventListener("click", function () {
    btn.dataset.sortType = "";
    getParams.sortBy = btn.dataset.sortBy;
    getParams.sortType = btn.dataset.sortTypeDefault;
    getCompositions();
  });
};

for (var i = 0, length = sortByBtns.length; i < length; i++) {
  _loop(i, length);
}

var sortTypeBtns = document.querySelectorAll(".sortType");

var _loop2 = function _loop2(_i, _length) {
  var btn = sortTypeBtns[_i]; // eslint-disable-next-line no-loop-func

  btn.addEventListener("click", function () {
    var sortBy = document.querySelector(btn.dataset["for"]);

    if (!sortBy) {
      var error = message({
        "text": "data-for не верный, попросите Лешу глянуть файл track.js в районе 262 строчки"
      });
      error.show();
      return;
    }

    var prevType = sortBy.dataset.sortType ? sortBy.dataset.sortType : sortBy.dataset.sortTypeDefault;
    var newType = prevType === "desc" ? "asc" : "desc";
    sortBy.dataset.sortType = newType;
    getParams.sortBy = sortBy.dataset.sortBy;
    getParams.sortType = newType;
    getCompositions();
  });
};

for (var _i = 0, _length = sortTypeBtns.length; _i < _length; _i++) {
  _loop2(_i, _length);
}

var paginate = function paginate() {
  var lastKnownScrollPosition = 0;
  var ticking = false;
  var whenLoad = 0.6;

  var getCoords = function getCoords(elem) {
    var box = elem.getBoundingClientRect();
    return {
      "top": box.top + pageYOffset,
      "left": box.left + pageXOffset
    };
  };

  var tabelCoor = getCoords(tabelBody);

  var doSomething = function doSomething(scrollPos) {
    var endPoint = tabelCoor.top + tabelBodyHeight.get;
    var currentEndPoint = scrollPos + windowHeight;
    var makeLoad = currentEndPoint >= endPoint * whenLoad; // eslint-disable-next-line no-console
    // console.log(currentEndPoint, endPoint * whenLoad);

    if (makeLoad && !isLoadData && getParams.page < getParams.maxPage) {
      getParams.nextPage();
      getCompositions({
        "replace": false
      });
    }
  };

  window.addEventListener("scroll", function () {
    lastKnownScrollPosition = window.scrollY;

    if (!ticking) {
      window.requestAnimationFrame(function () {
        doSomething(lastKnownScrollPosition);
        ticking = false;
      });
      ticking = true;
    }
  });
};

paginate();

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