!function(t){var e={};function n(a){if(e[a])return e[a].exports;var r=e[a]={i:a,l:!1,exports:{}};return t[a].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=t,n.c=e,n.d=function(t,e,a){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:a})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var a=Object.create(null);if(n.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var r in t)n.d(a,r,function(e){return t[e]}.bind(null,r));return a},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/",n(n.s=2)}([,,function(t,e,n){t.exports=n(3)},function(t,e,n){"use strict";var a=document.searchForm,r=a.btnSubmit,o=a.btnReset,s=a.searchString,i=document.querySelector(".table-body"),c={},l=!1,u={get:i.clientHeight,update:function(){this.get=i.clientHeight}},d=window.outerHeight;window.addEventListener("load",(function(){u.update()})),window.addEventListener("resize",(function(){d=window.outerHeight,u.update()}));var f={title:"",getTitle:function(){return this.title.length?"&title=".concat(this.title):""},tags:[],getTags:function(){return this.tags.length?this.tags.map((function(t){return"&tags[]=".concat(t)})).join(""):""},sortBy:"",sortType:"",getSort:function(){return""===this.sortBy||""===this.sortType?"":"&sortBy=".concat(this.sortBy,"&sortType=").concat(this.sortType)},page:1,maxPage:2,nextPage:function(){this.page=this.page<this.maxPage?this.page+1:this.maxPage},getPage:function(){return"&page=".concat(this.page)}},g=function(t,e){var n=new DocumentFragment;t.forEach((function(t){for(var e=t.title,a=void 0===e?"":e,r=t.tags,o=void 0===r?[]:r,s=t.lastPlayed,i=void 0===s?"":s,c=t.composer,l=void 0===c?{}:c,u="<ul class='tags-list'>",d=0,f=o.length;d<f;d++)u+='<li class="tags-list_item">'.concat(o[d].title,"</li>");u+="</ul>";var g=document.createElement("div");g.classList.add("table-row"),g.innerHTML='<div class="table-row_cell table-row_cell-title">\n                        <div class="author">'.concat(l.composerName,"</div>\n                        ").concat(a,'\n                    </div>\n                    <div class="table-row_cell table-row_cell-tags">\n                            ').concat(u,'\n                    </div>\n                    <div class="table-row_cell table-row_cell-date">').concat(i,"</div>"),n.appendChild(g)})),e&&(i.innerHTML=""),i.appendChild(n),i.offsetTop,u.update()},p=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};t.replace=void 0===t.replace||t.replace;var e="/async/tracks?".concat(f.getTitle()).concat(f.getTags()).concat(f.getSort()).concat(f.getPage());l=!0,requestData(e).then((function(e){var n=e.response;if(console.log(n),"success"===n.status){if(!n.data.length){return void(i.innerHTML="<div class='table-row table-row_error'>Таких произведений не найдено</div>")}c=n.data,g(c,t.replace),f.page=n.meta.current_page,f.maxPage=n.meta.last_page,l=!1}else{for(var a in n.errors)for(var r=n.errors[a],o=r.length,s=0;s<o;s++){message({text:r[s]}).show()}l=!1}}),(function(t){console.log("Rejected: ".concat(t))}))};a.addEventListener("submit",(function(t){t.preventDefault(),f.title=s.value,f.page=1,p(),""!==s&&(o.classList.add("show"),r.classList.add("hide"))})),s.addEventListener("input",(function(){r.classList.remove("hide")})),o.addEventListener("click",(function(){f.title="",f.tags=[],f.sortBy="",p(),o.classList.remove("show"),r.classList.remove("hide")}));var v=a.querySelector(".tag-btn"),m=document.querySelector(".all-tags .tags-list");v.addEventListener("focus",(function(){v.blur()}));var y=modal({title:"Поиск по тегам",content:'<form name="tagsForm">'.concat(m.outerHTML,'\n<div class="btns text-center">\n<button type="submit" name="btnSubmit">Поиск</button>\n<button type="reset" name="btnReset" class="disagree">Сбросить</button>\n</div></form>\n'),class:"tags-popup",onBuild:function(t){var e=document.tagsForm;e.addEventListener("submit",(function(n){n.preventDefault();var a=e.querySelectorAll("input[type=checkbox]:checked"),r=Array.from(a);r=r.map((function(t){return t.value})),f.tags=r,f.page=1,p(),t.hide()}))}});v.addEventListener("click",(function(t){t.preventDefault(),y.show()}));for(var h=document.querySelectorAll(".sortBy"),b=function(t,e){var n=h[t];n.addEventListener("click",(function(){n.dataset.sortType="",f.sortBy=n.dataset.sortBy,f.sortType=n.dataset.sortTypeDefault,p()}))},w=0,T=h.length;w<T;w++)b(w);for(var L=document.querySelectorAll(".sortType"),x=function(t,e){var n=L[t];n.addEventListener("click",(function(){var t=document.querySelector(n.dataset.for);if(t){var e="desc"===(t.dataset.sortType?t.dataset.sortType:t.dataset.sortTypeDefault)?"asc":"desc";t.dataset.sortType=e,f.sortBy=t.dataset.sortBy,f.sortType=e,p()}else{message({text:"data-for не верный, попросите Лешу глянуть файл track.js в районе 262 строчки"}).show()}}))},S=0,_=L.length;S<_;S++)x(S);var P,E,B,j;E=0,B=!1,j={top:(P=i.getBoundingClientRect()).top+pageYOffset,left:P.left+pageXOffset},window.addEventListener("scroll",(function(){E=window.scrollY,B||(window.requestAnimationFrame((function(){var t,e;t=E,e=j.top+u.get,t+d>=.6*e&&!l&&f.page<f.maxPage&&(f.nextPage(),p({replace:!1})),B=!1})),B=!0)}))}]);
//# sourceMappingURL=track.js.map