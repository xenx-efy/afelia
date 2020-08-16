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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/base.js":
/*!******************************!*\
  !*** ./resources/js/base.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var fieldValueLength = 0,
    formField = document.querySelectorAll("form label");
formField.forEach(function (element) {
  var field = element.querySelector("input"),
      label = element.querySelector(".placeholder");

  field.onfocus = function onfocus() {
    label.classList.add("active");
  };

  field.onblur = function onblur() {
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

window.requestDate = function (url) {
  var proxy = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "";
  var statusOk = 200;
  return new Promise(function (resolve, reject) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", proxy + url, true);

    xhr.onload = function onload() {
      if (this.status === statusOk) {
        resolve(this);
      } else {
        var error = new Error(this.statusText);
        error.code = this.status;
        reject(error);
      }
    };

    xhr.onerror = function onerror() {
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

/***/ }),

/***/ "./resources/sass/base.scss":
/*!**********************************!*\
  !*** ./resources/sass/base.scss ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/login.scss":
/*!***********************************!*\
  !*** ./resources/sass/login.scss ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/tracks.scss":
/*!************************************!*\
  !*** ./resources/sass/tracks.scss ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!************************************************************************************************************************!*\
  !*** multi ./resources/js/base.js ./resources/sass/base.scss ./resources/sass/login.scss ./resources/sass/tracks.scss ***!
  \************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/admin/Documents/orchestra/afelia/resources/js/base.js */"./resources/js/base.js");
__webpack_require__(/*! /Users/admin/Documents/orchestra/afelia/resources/sass/base.scss */"./resources/sass/base.scss");
__webpack_require__(/*! /Users/admin/Documents/orchestra/afelia/resources/sass/login.scss */"./resources/sass/login.scss");
module.exports = __webpack_require__(/*! /Users/admin/Documents/orchestra/afelia/resources/sass/tracks.scss */"./resources/sass/tracks.scss");


/***/ })

/******/ });