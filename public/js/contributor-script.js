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
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/index.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./css/plugin-custom-styles.css":
/*!**************************************!*\
  !*** ./css/plugin-custom-styles.css ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("// extracted by mini-css-extract-plugin\n\n//# sourceURL=webpack:///./css/plugin-custom-styles.css?");

/***/ }),

/***/ "./src/ContributorsList.js":
/*!*********************************!*\
  !*** ./src/ContributorsList.js ***!
  \*********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var globals__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! globals */ \"globals\");\n/* harmony import */ var globals__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(globals__WEBPACK_IMPORTED_MODULE_0__);\n\n\nfunction ContributorsList (idOfListContainer){\n    if(!idOfListContainer) throw new Error('#Id of <ul> element containing info of contributors should be set.')\n    this.container=Object(globals__WEBPACK_IMPORTED_MODULE_0__[\"$\"])(idOfListContainer);\n    this.list=this.getListOfContributors();\n    this.init()\n    this.addContributor=this.addContributor.bind(this);\n    this.removeContributor=this.removeContributor.bind(this);\n\n};\nContributorsList.prototype.init=function(){\n    \n    if(this.container.length>0){\n        var _this=this;\n        this.container.children().each(function(){\n            Object(globals__WEBPACK_IMPORTED_MODULE_0__[\"$\"])(this).find('.fo-close').on('click',function(){\n                var id=Object(globals__WEBPACK_IMPORTED_MODULE_0__[\"$\"])(this).parent().data('id');\n                _this.removeContributor(id);\n            })\n        })\n    }\n\n}\nContributorsList.prototype.getListOfContributors=function(){\n    var arr=[];\n    if(this.container&&this.container.children().length>0){\n        this.container.children().each(function(){\n                arr.push(Object(globals__WEBPACK_IMPORTED_MODULE_0__[\"$\"])(this).data('id'));\n            })\n    }\n        return arr;\n   \n}\nContributorsList.prototype.removeContributor=function(id){\n   \n        if(this.container&&id){\n            this.container.children().each(function(){\n                Object(globals__WEBPACK_IMPORTED_MODULE_0__[\"$\"])(this).data('id')===id&&Object(globals__WEBPACK_IMPORTED_MODULE_0__[\"$\"])(this).remove();\n            })\n            this.updateList();\n        }\n        \n\n}\nContributorsList.prototype.addContributor=function({id,nickName}){\n        if(this.container&&id&&this.list.indexOf(parseInt(id))===-1){\n            var _this=this;\n            var newContributor=this.template(id,nickName);\n            this.container.append(Object(globals__WEBPACK_IMPORTED_MODULE_0__[\"$\"])(newContributor));\n            newContributor.find('.fo-close').on('click',function(){\n                var id=Object(globals__WEBPACK_IMPORTED_MODULE_0__[\"$\"])(this).parent().data('id');\n                _this.removeContributor(id);\n            })\n            this.updateList();\n        }\n}\nContributorsList.prototype.updateList=function(){\n    return this.list=this.getListOfContributors();\n  \n}\nContributorsList.prototype.template=function(id,nickName){\n        var liElement=Object(globals__WEBPACK_IMPORTED_MODULE_0__[\"$\"])(\"<li data-id=\"+id+\"></li>\");\n        Object(globals__WEBPACK_IMPORTED_MODULE_0__[\"$\"])(liElement).append(\"<span class='contributor-nickname'>\"+nickName+\"</span>\");\n        Object(globals__WEBPACK_IMPORTED_MODULE_0__[\"$\"])(liElement).append(\"<input type='hidden' name='wp_contributors_plugin_value[]' value=\"+id+\">\");\n        Object(globals__WEBPACK_IMPORTED_MODULE_0__[\"$\"])(liElement).append(\"<span class='fo fo-close' >\");\n        return Object(globals__WEBPACK_IMPORTED_MODULE_0__[\"$\"])(liElement);\n\n}\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (ContributorsList);\n\n//# sourceURL=webpack:///./src/ContributorsList.js?");

/***/ }),

/***/ "./src/SelectorGroup.js":
/*!******************************!*\
  !*** ./src/SelectorGroup.js ***!
  \******************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var globals__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! globals */ \"globals\");\n/* harmony import */ var globals__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(globals__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _ContributorsList__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ContributorsList */ \"./src/ContributorsList.js\");\n\n\n\nfunction SelectorGroup(selectorId,buttonId,instanceOfContributorsList){\n    if(!selectorId) throw new Error('#Id of <select> element containing info of contributors should be set.');\n    if(!buttonId) throw new Error('#Id of <button> for adding contributors to the list contributors should be set.');\n    const _this=this;\n    this.select=Object(globals__WEBPACK_IMPORTED_MODULE_0__[\"$\"])(selectorId);\n    this.selectedState={id:-1};\n    this.select.change(function(){\n        var selectItem=Object(globals__WEBPACK_IMPORTED_MODULE_0__[\"$\"])(this).children(\"option:selected\");\n        _this.selectedState={\n            id:selectItem.val(),\n            nickName:selectItem.text()\n        }\n    })\n    this.addButton=Object(globals__WEBPACK_IMPORTED_MODULE_0__[\"$\"])(buttonId);\n    this.CL=instanceOfContributorsList instanceof _ContributorsList__WEBPACK_IMPORTED_MODULE_1__[\"default\"]?instanceOfContributorsList:this.error('instanceOfContributorsList should be instance of ContributorsList');\n    this.init();\n}\nSelectorGroup.prototype.error=function(text){\n\n        throw new Error(text);\n    \n}\nSelectorGroup.prototype.init=function(){\n    const _this=this;\n    this.addButton.on('click',function(){\n        _this.selectedState.id!=-1&&_this.CL.addContributor(_this.selectedState)\n            \n    })\n}\n\n/* harmony default export */ __webpack_exports__[\"default\"] = (SelectorGroup);\n\n//# sourceURL=webpack:///./src/SelectorGroup.js?");

/***/ }),

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _SelectorGroup__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SelectorGroup */ \"./src/SelectorGroup.js\");\n/* harmony import */ var _ContributorsList__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ContributorsList */ \"./src/ContributorsList.js\");\n/* harmony import */ var _css_plugin_custom_styles_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../css/plugin-custom-styles.css */ \"./css/plugin-custom-styles.css\");\n/* harmony import */ var _css_plugin_custom_styles_css__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_css_plugin_custom_styles_css__WEBPACK_IMPORTED_MODULE_2__);\n\n\n\n\nwindow.addEventListener('load',function(){\n    \n    const CL=new _ContributorsList__WEBPACK_IMPORTED_MODULE_1__[\"default\"](\"#editable-contributors-list\");\n    const SG=new _SelectorGroup__WEBPACK_IMPORTED_MODULE_0__[\"default\"](\"#selector-contributors\",\"#add-contributor\",CL)\n});\n\n//# sourceURL=webpack:///./src/index.js?");

/***/ }),

/***/ "globals":
/*!*************************!*\
  !*** external "window" ***!
  \*************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("module.exports = window;\n\n//# sourceURL=webpack:///external_%22window%22?");

/***/ })

/******/ });