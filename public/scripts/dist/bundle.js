(()=>{"use strict";var t=function(t){return null==t},n="drawer--expanded";document.addEventListener("DOMContentLoaded",(function(){!function(e,o){void 0===o&&(o=document.body);var r,u=o.querySelector("#drawer--".concat(e)),c=o.querySelector("button#drawer_button--".concat(e));t(u)||t(c)||function(t){var e,o,r=t.drawer,u=function(t){t?r.root.classList.add(n):r.root.classList.remove(n)};t.button.addEventListener("click",(function(){return u(!0)})),null===(e=r.cancelButton)||void 0===e||e.addEventListener("click",(function(){return u(!1)})),null===(o=r.xButton)||void 0===o||o.addEventListener("click",(function(){return u(!1)}))}({button:c,drawer:(r=u,{root:r,xButton:r.querySelector('button[data-drawer-node="xButton"]'),cancelButton:r.querySelector('button[data-drawer-node="cancelButton"]')})})}("addItem")}))})();