(()=>{"use strict";var n=function(n){return null==n},t="drawer--expanded";document.addEventListener("DOMContentLoaded",(function(){var e,r,o,u=function(e){var r=e.name,o=e.containerNode,u=void 0===o?document.body:o,c=u.querySelector("#drawer--".concat(r)),a=u.querySelector("button#drawer_button--".concat(r));if(!n(c)&&!n(a)){var i,l=function(n){var e,r,o=n.drawer,u=function(n){n?o.root.classList.add(t):o.root.classList.remove(t)};return n.button.addEventListener("click",(function(){return u(!0)})),null===(e=o.cancelButton)||void 0===e||e.addEventListener("click",(function(){return u(!1)})),null===(r=o.xButton)||void 0===r||r.addEventListener("click",(function(){return u(!1)})),u}({button:a,drawer:(i=c,{root:i,xButton:i.querySelector('button[data-drawer-node="xButton"]'),cancelButton:i.querySelector('button[data-drawer-node="cancelButton"]')})});return{open:function(){return l(!0)},close:function(){return l(!1)}}}}({name:"editItem"}),c={open:function(n){}};null===(e=document.querySelector("button#button--delete"))||void 0===e||e.addEventListener("click",(r=u,o=c,function(){return n=void 0,t=void 0,u=function(){return function(n,t){var e,r,o,u,c={label:0,sent:function(){if(1&o[0])throw o[1];return o[1]},trys:[],ops:[]};return u={next:a(0),throw:a(1),return:a(2)},"function"==typeof Symbol&&(u[Symbol.iterator]=function(){return this}),u;function a(u){return function(a){return function(u){if(e)throw new TypeError("Generator is already executing.");for(;c;)try{if(e=1,r&&(o=2&u[0]?r.return:u[0]?r.throw||((o=r.return)&&o.call(r),0):r.next)&&!(o=o.call(r,u[1])).done)return o;switch(r=0,o&&(u=[2&u[0],o.value]),u[0]){case 0:case 1:o=u;break;case 4:return c.label++,{value:u[1],done:!1};case 5:c.label++,r=u[1],u=[0];continue;case 7:u=c.ops.pop(),c.trys.pop();continue;default:if(!((o=(o=c.trys).length>0&&o[o.length-1])||6!==u[0]&&2!==u[0])){c=0;continue}if(3===u[0]&&(!o||u[1]>o[0]&&u[1]<o[3])){c.label=u[1];break}if(6===u[0]&&c.label<o[1]){c.label=o[1],o=u;break}if(o&&c.label<o[2]){c.label=o[2],c.ops.push(u);break}o[2]&&c.ops.pop(),c.trys.pop();continue}u=t.call(n,c)}catch(n){u=[6,n],r=0}finally{e=o=0}if(5&u[0])throw u[1];return{value:u[0]?u[1]:void 0,done:!0}}([u,a])}}}(this,(function(n){switch(n.label){case 0:return n.trys.push([0,3,,4]),[4,fetch(location.pathname,{method:"DELETE"})];case 1:return[4,n.sent().json()];case 2:return n.sent().ok?(r.close(),location.replace("/pantry")):o.open("Something went wrong"),[3,4];case 3:return n.sent(),o.open("Something went wrong"),[3,4];case 4:return[2]}}))},new((e=void 0)||(e=Promise))((function(r,o){function c(n){try{i(u.next(n))}catch(n){o(n)}}function a(n){try{i(u.throw(n))}catch(n){o(n)}}function i(n){var t;n.done?r(n.value):(t=n.value,t instanceof e?t:new e((function(n){n(t)}))).then(c,a)}i((u=u.apply(n,t||[])).next())}));var n,t,e,u}))}))})();