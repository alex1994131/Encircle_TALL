/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/assets/js/profile.js":
/*!****************************************!*\
  !*** ./resources/assets/js/profile.js ***!
  \****************************************/
/***/ (() => {

eval("$(document).ready(function () {\n  var readURL = function readURL(input) {\n    if (input.files && input.files[0]) {\n      var reader = new FileReader();\n\n      reader.onload = function (e) {\n        var file_data = $('#photo').prop('files')[0];\n        var form_data = new FormData();\n        form_data.append('photo', file_data);\n        form_data.append('_token', $(\"[name='_token']\").val());\n        $.ajax({\n          url: base_url + '/user/avatarUpload',\n          data: form_data,\n          cache: false,\n          contentType: false,\n          processData: false,\n          type: 'post',\n          success: function success(response) {\n            $('#user_avatar').attr('src', e.target.result);\n          }\n        });\n      };\n\n      reader.readAsDataURL(input.files[0]);\n    }\n  };\n\n  $(\"#user_avatar\").on('click', function () {\n    $(\"#photo\").click();\n    console.log('aa');\n  });\n  $(\"#photo\").on('change', function () {\n    readURL(this);\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYXNzZXRzL2pzL3Byb2ZpbGUuanM/ZGIwYiJdLCJuYW1lcyI6WyIkIiwiZG9jdW1lbnQiLCJyZWFkeSIsInJlYWRVUkwiLCJpbnB1dCIsImZpbGVzIiwicmVhZGVyIiwiRmlsZVJlYWRlciIsIm9ubG9hZCIsImUiLCJmaWxlX2RhdGEiLCJwcm9wIiwiZm9ybV9kYXRhIiwiRm9ybURhdGEiLCJhcHBlbmQiLCJ2YWwiLCJhamF4IiwidXJsIiwiYmFzZV91cmwiLCJkYXRhIiwiY2FjaGUiLCJjb250ZW50VHlwZSIsInByb2Nlc3NEYXRhIiwidHlwZSIsInN1Y2Nlc3MiLCJyZXNwb25zZSIsImF0dHIiLCJ0YXJnZXQiLCJyZXN1bHQiLCJyZWFkQXNEYXRhVVJMIiwib24iLCJjbGljayIsImNvbnNvbGUiLCJsb2ciXSwibWFwcGluZ3MiOiJBQUFBQSxDQUFDLENBQUNDLFFBQUQsQ0FBRCxDQUFZQyxLQUFaLENBQWtCLFlBQVk7QUFDMUIsTUFBSUMsT0FBTyxHQUFHLFNBQVZBLE9BQVUsQ0FBVUMsS0FBVixFQUFpQjtBQUMzQixRQUFJQSxLQUFLLENBQUNDLEtBQU4sSUFBZUQsS0FBSyxDQUFDQyxLQUFOLENBQVksQ0FBWixDQUFuQixFQUFtQztBQUMvQixVQUFJQyxNQUFNLEdBQUcsSUFBSUMsVUFBSixFQUFiOztBQUVBRCxNQUFBQSxNQUFNLENBQUNFLE1BQVAsR0FBZ0IsVUFBVUMsQ0FBVixFQUFhO0FBQ3pCLFlBQUlDLFNBQVMsR0FBR1YsQ0FBQyxDQUFDLFFBQUQsQ0FBRCxDQUFZVyxJQUFaLENBQWlCLE9BQWpCLEVBQTBCLENBQTFCLENBQWhCO0FBQ0EsWUFBSUMsU0FBUyxHQUFHLElBQUlDLFFBQUosRUFBaEI7QUFDQUQsUUFBQUEsU0FBUyxDQUFDRSxNQUFWLENBQWlCLE9BQWpCLEVBQTBCSixTQUExQjtBQUNBRSxRQUFBQSxTQUFTLENBQUNFLE1BQVYsQ0FBaUIsUUFBakIsRUFBMkJkLENBQUMsQ0FBQyxpQkFBRCxDQUFELENBQXFCZSxHQUFyQixFQUEzQjtBQUNBZixRQUFBQSxDQUFDLENBQUNnQixJQUFGLENBQU87QUFDSEMsVUFBQUEsR0FBRyxFQUFFQyxRQUFRLEdBQUcsb0JBRGI7QUFFSEMsVUFBQUEsSUFBSSxFQUFFUCxTQUZIO0FBR0hRLFVBQUFBLEtBQUssRUFBRSxLQUhKO0FBSUhDLFVBQUFBLFdBQVcsRUFBRSxLQUpWO0FBS0hDLFVBQUFBLFdBQVcsRUFBRSxLQUxWO0FBTUhDLFVBQUFBLElBQUksRUFBRSxNQU5IO0FBT0hDLFVBQUFBLE9BQU8sRUFBRSxpQkFBVUMsUUFBVixFQUFvQjtBQUN6QnpCLFlBQUFBLENBQUMsQ0FBQyxjQUFELENBQUQsQ0FBa0IwQixJQUFsQixDQUF1QixLQUF2QixFQUE4QmpCLENBQUMsQ0FBQ2tCLE1BQUYsQ0FBU0MsTUFBdkM7QUFDSDtBQVRFLFNBQVA7QUFXSCxPQWhCRDs7QUFrQkF0QixNQUFBQSxNQUFNLENBQUN1QixhQUFQLENBQXFCekIsS0FBSyxDQUFDQyxLQUFOLENBQVksQ0FBWixDQUFyQjtBQUNIO0FBQ0osR0F4QkQ7O0FBMEJBTCxFQUFBQSxDQUFDLENBQUMsY0FBRCxDQUFELENBQWtCOEIsRUFBbEIsQ0FBcUIsT0FBckIsRUFBOEIsWUFBWTtBQUN0QzlCLElBQUFBLENBQUMsQ0FBQyxRQUFELENBQUQsQ0FBWStCLEtBQVo7QUFDQUMsSUFBQUEsT0FBTyxDQUFDQyxHQUFSLENBQVksSUFBWjtBQUNILEdBSEQ7QUFLQWpDLEVBQUFBLENBQUMsQ0FBQyxRQUFELENBQUQsQ0FBWThCLEVBQVosQ0FBZSxRQUFmLEVBQXlCLFlBQVk7QUFDakMzQixJQUFBQSxPQUFPLENBQUMsSUFBRCxDQUFQO0FBQ0gsR0FGRDtBQUlILENBcENEIiwic291cmNlc0NvbnRlbnQiOlsiJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24gKCkge1xyXG4gICAgdmFyIHJlYWRVUkwgPSBmdW5jdGlvbiAoaW5wdXQpIHtcclxuICAgICAgICBpZiAoaW5wdXQuZmlsZXMgJiYgaW5wdXQuZmlsZXNbMF0pIHtcclxuICAgICAgICAgICAgdmFyIHJlYWRlciA9IG5ldyBGaWxlUmVhZGVyKCk7XHJcblxyXG4gICAgICAgICAgICByZWFkZXIub25sb2FkID0gZnVuY3Rpb24gKGUpIHtcclxuICAgICAgICAgICAgICAgIHZhciBmaWxlX2RhdGEgPSAkKCcjcGhvdG8nKS5wcm9wKCdmaWxlcycpWzBdO1xyXG4gICAgICAgICAgICAgICAgdmFyIGZvcm1fZGF0YSA9IG5ldyBGb3JtRGF0YSgpO1xyXG4gICAgICAgICAgICAgICAgZm9ybV9kYXRhLmFwcGVuZCgncGhvdG8nLCBmaWxlX2RhdGEpO1xyXG4gICAgICAgICAgICAgICAgZm9ybV9kYXRhLmFwcGVuZCgnX3Rva2VuJywgJChcIltuYW1lPSdfdG9rZW4nXVwiKS52YWwoKSk7XHJcbiAgICAgICAgICAgICAgICAkLmFqYXgoe1xyXG4gICAgICAgICAgICAgICAgICAgIHVybDogYmFzZV91cmwgKyAnL3VzZXIvYXZhdGFyVXBsb2FkJyxcclxuICAgICAgICAgICAgICAgICAgICBkYXRhOiBmb3JtX2RhdGEsXHJcbiAgICAgICAgICAgICAgICAgICAgY2FjaGU6IGZhbHNlLFxyXG4gICAgICAgICAgICAgICAgICAgIGNvbnRlbnRUeXBlOiBmYWxzZSxcclxuICAgICAgICAgICAgICAgICAgICBwcm9jZXNzRGF0YTogZmFsc2UsXHJcbiAgICAgICAgICAgICAgICAgICAgdHlwZTogJ3Bvc3QnLFxyXG4gICAgICAgICAgICAgICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uIChyZXNwb25zZSkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAkKCcjdXNlcl9hdmF0YXInKS5hdHRyKCdzcmMnLCBlLnRhcmdldC5yZXN1bHQpO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH0pO1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICByZWFkZXIucmVhZEFzRGF0YVVSTChpbnB1dC5maWxlc1swXSk7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgICQoXCIjdXNlcl9hdmF0YXJcIikub24oJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xyXG4gICAgICAgICQoXCIjcGhvdG9cIikuY2xpY2soKTtcclxuICAgICAgICBjb25zb2xlLmxvZygnYWEnKTtcclxuICAgIH0pO1xyXG5cclxuICAgICQoXCIjcGhvdG9cIikub24oJ2NoYW5nZScsIGZ1bmN0aW9uICgpIHtcclxuICAgICAgICByZWFkVVJMKHRoaXMpO1xyXG4gICAgfSk7XHJcblxyXG59KTsiXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2Fzc2V0cy9qcy9wcm9maWxlLmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/assets/js/profile.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/assets/js/profile.js"]();
/******/ 	
/******/ })()
;