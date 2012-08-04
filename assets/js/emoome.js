/* Modernizr 2.0.6 | MIT & BSD Contains: All core tests, html5shiv, yepnope, respond.js. Get your own custom build at www.modernizr.com/download/ */
;window.Modernizr=function(a,b,c){function I(){e.input=function(a){for(var b=0,c=a.length;b<c;b++)t[a[b]]=a[b]in l;return t}("autocomplete autofocus list placeholder max min multiple pattern required step".split(" ")),e.inputtypes=function(a){for(var d=0,e,f,h,i=a.length;d<i;d++)l.setAttribute("type",f=a[d]),e=l.type!=="text",e&&(l.value=m,l.style.cssText="position:absolute;visibility:hidden;",/^range$/.test(f)&&l.style.WebkitAppearance!==c?(g.appendChild(l),h=b.defaultView,e=h.getComputedStyle&&h.getComputedStyle(l,null).WebkitAppearance!=="textfield"&&l.offsetHeight!==0,g.removeChild(l)):/^(search|tel)$/.test(f)||(/^(url|email)$/.test(f)?e=l.checkValidity&&l.checkValidity()===!1:/^color$/.test(f)?(g.appendChild(l),g.offsetWidth,e=l.value!=m,g.removeChild(l)):e=l.value!=m)),s[a[d]]=!!e;return s}("search tel url email datetime date month week time datetime-local number range color".split(" "))}function G(a,b){var c=a.charAt(0).toUpperCase()+a.substr(1),d=(a+" "+p.join(c+" ")+c).split(" ");return F(d,b)}function F(a,b){for(var d in a)if(k[a[d]]!==c)return b=="pfx"?a[d]:!0;return!1}function E(a,b){return!!~(""+a).indexOf(b)}function D(a,b){return typeof a===b}function C(a,b){return B(o.join(a+";")+(b||""))}function B(a){k.cssText=a}var d="2.0.6",e={},f=!0,g=b.documentElement,h=b.head||b.getElementsByTagName("head")[0],i="modernizr",j=b.createElement(i),k=j.style,l=b.createElement("input"),m=":)",n=Object.prototype.toString,o=" -webkit- -moz- -o- -ms- -khtml- ".split(" "),p="Webkit Moz O ms Khtml".split(" "),q={svg:"http://www.w3.org/2000/svg"},r={},s={},t={},u=[],v=function(a,c,d,e){var f,h,j,k=b.createElement("div");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:i+(d+1),k.appendChild(j);f=["&shy;","<style>",a,"</style>"].join(""),k.id=i,k.innerHTML+=f,g.appendChild(k),h=c(k,a),k.parentNode.removeChild(k);return!!h},w=function(b){if(a.matchMedia)return matchMedia(b).matches;var c;v("@media "+b+" { #"+i+" { position: absolute; } }",function(b){c=(a.getComputedStyle?getComputedStyle(b,null):b.currentStyle).position=="absolute"});return c},x=function(){function d(d,e){e=e||b.createElement(a[d]||"div"),d="on"+d;var f=d in e;f||(e.setAttribute||(e=b.createElement("div")),e.setAttribute&&e.removeAttribute&&(e.setAttribute(d,""),f=D(e[d],"function"),D(e[d],c)||(e[d]=c),e.removeAttribute(d))),e=null;return f}var a={select:"input",change:"input",submit:"form",reset:"form",error:"img",load:"img",abort:"img"};return d}(),y,z={}.hasOwnProperty,A;!D(z,c)&&!D(z.call,c)?A=function(a,b){return z.call(a,b)}:A=function(a,b){return b in a&&D(a.constructor.prototype[b],c)};var H=function(c,d){var f=c.join(""),g=d.length;v(f,function(c,d){var f=b.styleSheets[b.styleSheets.length-1],h=f.cssRules&&f.cssRules[0]?f.cssRules[0].cssText:f.cssText||"",i=c.childNodes,j={};while(g--)j[i[g].id]=i[g];e.touch="ontouchstart"in a||j.touch.offsetTop===9,e.csstransforms3d=j.csstransforms3d.offsetLeft===9,e.generatedcontent=j.generatedcontent.offsetHeight>=1,e.fontface=/src/i.test(h)&&h.indexOf(d.split(" ")[0])===0},g,d)}(['@font-face {font-family:"font";src:url("https://")}',["@media (",o.join("touch-enabled),("),i,")","{#touch{top:9px;position:absolute}}"].join(""),["@media (",o.join("transform-3d),("),i,")","{#csstransforms3d{left:9px;position:absolute}}"].join(""),['#generatedcontent:after{content:"',m,'";visibility:hidden}'].join("")],["fontface","touch","csstransforms3d","generatedcontent"]);r.flexbox=function(){function c(a,b,c,d){a.style.cssText=o.join(b+":"+c+";")+(d||"")}function a(a,b,c,d){b+=":",a.style.cssText=(b+o.join(c+";"+b)).slice(0,-b.length)+(d||"")}var d=b.createElement("div"),e=b.createElement("div");a(d,"display","box","width:42px;padding:0;"),c(e,"box-flex","1","width:10px;"),d.appendChild(e),g.appendChild(d);var f=e.offsetWidth===42;d.removeChild(e),g.removeChild(d);return f},r.canvas=function(){var a=b.createElement("canvas");return!!a.getContext&&!!a.getContext("2d")},r.canvastext=function(){return!!e.canvas&&!!D(b.createElement("canvas").getContext("2d").fillText,"function")},r.webgl=function(){return!!a.WebGLRenderingContext},r.touch=function(){return e.touch},r.geolocation=function(){return!!navigator.geolocation},r.postmessage=function(){return!!a.postMessage},r.websqldatabase=function(){var b=!!a.openDatabase;return b},r.indexedDB=function(){for(var b=-1,c=p.length;++b<c;)if(a[p[b].toLowerCase()+"IndexedDB"])return!0;return!!a.indexedDB},r.hashchange=function(){return x("hashchange",a)&&(b.documentMode===c||b.documentMode>7)},r.history=function(){return!!a.history&&!!history.pushState},r.draganddrop=function(){return x("dragstart")&&x("drop")},r.websockets=function(){for(var b=-1,c=p.length;++b<c;)if(a[p[b]+"WebSocket"])return!0;return"WebSocket"in a},r.rgba=function(){B("background-color:rgba(150,255,150,.5)");return E(k.backgroundColor,"rgba")},r.hsla=function(){B("background-color:hsla(120,40%,100%,.5)");return E(k.backgroundColor,"rgba")||E(k.backgroundColor,"hsla")},r.multiplebgs=function(){B("background:url(https://),url(https://),red url(https://)");return/(url\s*\(.*?){3}/.test(k.background)},r.backgroundsize=function(){return G("backgroundSize")},r.borderimage=function(){return G("borderImage")},r.borderradius=function(){return G("borderRadius")},r.boxshadow=function(){return G("boxShadow")},r.textshadow=function(){return b.createElement("div").style.textShadow===""},r.opacity=function(){C("opacity:.55");return/^0.55$/.test(k.opacity)},r.cssanimations=function(){return G("animationName")},r.csscolumns=function(){return G("columnCount")},r.cssgradients=function(){var a="background-image:",b="gradient(linear,left top,right bottom,from(#9f9),to(white));",c="linear-gradient(left top,#9f9, white);";B((a+o.join(b+a)+o.join(c+a)).slice(0,-a.length));return E(k.backgroundImage,"gradient")},r.cssreflections=function(){return G("boxReflect")},r.csstransforms=function(){return!!F(["transformProperty","WebkitTransform","MozTransform","OTransform","msTransform"])},r.csstransforms3d=function(){var a=!!F(["perspectiveProperty","WebkitPerspective","MozPerspective","OPerspective","msPerspective"]);a&&"webkitPerspective"in g.style&&(a=e.csstransforms3d);return a},r.csstransitions=function(){return G("transitionProperty")},r.fontface=function(){return e.fontface},r.generatedcontent=function(){return e.generatedcontent},r.video=function(){var a=b.createElement("video"),c=!1;try{if(c=!!a.canPlayType){c=new Boolean(c),c.ogg=a.canPlayType('video/ogg; codecs="theora"');var d='video/mp4; codecs="avc1.42E01E';c.h264=a.canPlayType(d+'"')||a.canPlayType(d+', mp4a.40.2"'),c.webm=a.canPlayType('video/webm; codecs="vp8, vorbis"')}}catch(e){}return c},r.audio=function(){var a=b.createElement("audio"),c=!1;try{if(c=!!a.canPlayType)c=new Boolean(c),c.ogg=a.canPlayType('audio/ogg; codecs="vorbis"'),c.mp3=a.canPlayType("audio/mpeg;"),c.wav=a.canPlayType('audio/wav; codecs="1"'),c.m4a=a.canPlayType("audio/x-m4a;")||a.canPlayType("audio/aac;")}catch(d){}return c},r.localstorage=function(){try{return!!localStorage.getItem}catch(a){return!1}},r.sessionstorage=function(){try{return!!sessionStorage.getItem}catch(a){return!1}},r.webworkers=function(){return!!a.Worker},r.applicationcache=function(){return!!a.applicationCache},r.svg=function(){return!!b.createElementNS&&!!b.createElementNS(q.svg,"svg").createSVGRect},r.inlinesvg=function(){var a=b.createElement("div");a.innerHTML="<svg/>";return(a.firstChild&&a.firstChild.namespaceURI)==q.svg},r.smil=function(){return!!b.createElementNS&&/SVG/.test(n.call(b.createElementNS(q.svg,"animate")))},r.svgclippaths=function(){return!!b.createElementNS&&/SVG/.test(n.call(b.createElementNS(q.svg,"clipPath")))};for(var J in r)A(r,J)&&(y=J.toLowerCase(),e[y]=r[J](),u.push((e[y]?"":"no-")+y));e.input||I(),e.addTest=function(a,b){if(typeof a=="object")for(var d in a)A(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return;b=typeof b=="boolean"?b:!!b(),g.className+=" "+(b?"":"no-")+a,e[a]=b}return e},B(""),j=l=null,a.attachEvent&&function(){var a=b.createElement("div");a.innerHTML="<elem></elem>";return a.childNodes.length!==1}()&&function(a,b){function s(a){var b=-1;while(++b<g)a.createElement(f[b])}a.iepp=a.iepp||{};var d=a.iepp,e=d.html5elements||"abbr|article|aside|audio|canvas|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",f=e.split("|"),g=f.length,h=new RegExp("(^|\\s)("+e+")","gi"),i=new RegExp("<(/*)("+e+")","gi"),j=/^\s*[\{\}]\s*$/,k=new RegExp("(^|[^\\n]*?\\s)("+e+")([^\\n]*)({[\\n\\w\\W]*?})","gi"),l=b.createDocumentFragment(),m=b.documentElement,n=m.firstChild,o=b.createElement("body"),p=b.createElement("style"),q=/print|all/,r;d.getCSS=function(a,b){if(a+""===c)return"";var e=-1,f=a.length,g,h=[];while(++e<f){g=a[e];if(g.disabled)continue;b=g.media||b,q.test(b)&&h.push(d.getCSS(g.imports,b),g.cssText),b="all"}return h.join("")},d.parseCSS=function(a){var b=[],c;while((c=k.exec(a))!=null)b.push(((j.exec(c[1])?"\n":c[1])+c[2]+c[3]).replace(h,"$1.iepp_$2")+c[4]);return b.join("\n")},d.writeHTML=function(){var a=-1;r=r||b.body;while(++a<g){var c=b.getElementsByTagName(f[a]),d=c.length,e=-1;while(++e<d)c[e].className.indexOf("iepp_")<0&&(c[e].className+=" iepp_"+f[a])}l.appendChild(r),m.appendChild(o),o.className=r.className,o.id=r.id,o.innerHTML=r.innerHTML.replace(i,"<$1font")},d._beforePrint=function(){p.styleSheet.cssText=d.parseCSS(d.getCSS(b.styleSheets,"all")),d.writeHTML()},d.restoreHTML=function(){o.innerHTML="",m.removeChild(o),m.appendChild(r)},d._afterPrint=function(){d.restoreHTML(),p.styleSheet.cssText=""},s(b),s(l);d.disablePP||(n.insertBefore(p,n.firstChild),p.media="print",p.className="iepp-printshim",a.attachEvent("onbeforeprint",d._beforePrint),a.attachEvent("onafterprint",d._afterPrint))}(a,b),e._version=d,e._prefixes=o,e._domPrefixes=p,e.mq=w,e.hasEvent=x,e.testProp=function(a){return F([a])},e.testAllProps=G,e.testStyles=v,e.prefixed=function(a){return G(a,"pfx")},g.className=g.className.replace(/\bno-js\b/,"")+(f?" js "+u.join(" "):"");return e}(this,this.document),function(a,b){function u(){r(!0)}a.respond={},respond.update=function(){},respond.mediaQueriesSupported=b;if(!b){var c=a.document,d=c.documentElement,e=[],f=[],g=[],h={},i=30,j=c.getElementsByTagName("head")[0]||d,k=j.getElementsByTagName("link"),l=[],m=function(){var b=k,c=b.length,d=0,e,f,g,i;for(;d<c;d++)e=b[d],f=e.href,g=e.media,i=e.rel&&e.rel.toLowerCase()==="stylesheet",!!f&&i&&!h[f]&&(!/^([a-zA-Z]+?:(\/\/)?(www\.)?)/.test(f)||f.replace(RegExp.$1,"").split("/")[0]===a.location.host?l.push({href:f,media:g}):h[f]=!0);n()},n=function(){if(l.length){var a=l.shift();s(a.href,function(b){o(b,a.href,a.media),h[a.href]=!0,n()})}},o=function(a,b,c){var d=a.match(/@media[^\{]+\{([^\{\}]+\{[^\}\{]+\})+/gi),g=d&&d.length||0,b=b.substring(0,b.lastIndexOf("/")),h=function(a){return a.replace(/(url\()['"]?([^\/\)'"][^:\)'"]+)['"]?(\))/g,"$1"+b+"$2$3")},i=!g&&c,j=0,k,l,m,n,o;b.length&&(b+="/"),i&&(g=1);for(;j<g;j++){k=0,i?(l=c,f.push(h(a))):(l=d[j].match(/@media ([^\{]+)\{([\S\s]+?)$/)&&RegExp.$1,f.push(RegExp.$2&&h(RegExp.$2))),n=l.split(","),o=n.length;for(;k<o;k++)m=n[k],e.push({media:m.match(/(only\s+)?([a-zA-Z]+)(\sand)?/)&&RegExp.$2,rules:f.length-1,minw:m.match(/\(min\-width:[\s]*([\s]*[0-9]+)px[\s]*\)/)&&parseFloat(RegExp.$1),maxw:m.match(/\(max\-width:[\s]*([\s]*[0-9]+)px[\s]*\)/)&&parseFloat(RegExp.$1)})}r()},p,q,r=function(a){var b="clientWidth",h=d[b],l=c.compatMode==="CSS1Compat"&&h||c.body[b]||h,m={},n=c.createDocumentFragment(),o=k[k.length-1],s=(new Date).getTime();if(a&&p&&s-p<i)clearTimeout(q),q=setTimeout(r,i);else{p=s;for(var t in e){var u=e[t];if(!u.minw&&!u.maxw||(!u.minw||u.minw&&l>=u.minw)&&(!u.maxw||u.maxw&&l<=u.maxw))m[u.media]||(m[u.media]=[]),m[u.media].push(f[u.rules])}for(var t in g)g[t]&&g[t].parentNode===j&&j.removeChild(g[t]);for(var t in m){var v=c.createElement("style"),w=m[t].join("\n");v.type="text/css",v.media=t,v.styleSheet?v.styleSheet.cssText=w:v.appendChild(c.createTextNode(w)),n.appendChild(v),g.push(v)}j.insertBefore(n,o.nextSibling)}},s=function(a,b){var c=t();if(!!c){c.open("GET",a,!0),c.onreadystatechange=function(){c.readyState==4&&(c.status==200||c.status==304)&&b(c.responseText)};if(c.readyState==4)return;c.send()}},t=function(){var a=!1,b=[function(){return new ActiveXObject("Microsoft.XMLHTTP")},function(){return new XMLHttpRequest}],c=b.length;while(c--){try{a=b[c]()}catch(d){continue}break}return function(){return a}}();m(),respond.update=m,a.addEventListener?a.addEventListener("resize",u,!1):a.attachEvent&&a.attachEvent("onresize",u)}}(this,Modernizr.mq("only all")),function(a,b,c){function k(a){return!a||a=="loaded"||a=="complete"}function j(){var a=1,b=-1;while(p.length- ++b)if(p[b].s&&!(a=p[b].r))break;a&&g()}function i(a){var c=b.createElement("script"),d;c.src=a.s,c.onreadystatechange=c.onload=function(){!d&&k(c.readyState)&&(d=1,j(),c.onload=c.onreadystatechange=null)},m(function(){d||(d=1,j())},H.errorTimeout),a.e?c.onload():n.parentNode.insertBefore(c,n)}function h(a){var c=b.createElement("link"),d;c.href=a.s,c.rel="stylesheet",c.type="text/css";if(!a.e&&(w||r)){var e=function(a){m(function(){if(!d)try{a.sheet.cssRules.length?(d=1,j()):e(a)}catch(b){b.code==1e3||b.message=="security"||b.message=="denied"?(d=1,m(function(){j()},0)):e(a)}},0)};e(c)}else c.onload=function(){d||(d=1,m(function(){j()},0))},a.e&&c.onload();m(function(){d||(d=1,j())},H.errorTimeout),!a.e&&n.parentNode.insertBefore(c,n)}function g(){var a=p.shift();q=1,a?a.t?m(function(){a.t=="c"?h(a):i(a)},0):(a(),j()):q=0}function f(a,c,d,e,f,h){function i(){!o&&k(l.readyState)&&(r.r=o=1,!q&&j(),l.onload=l.onreadystatechange=null,m(function(){u.removeChild(l)},0))}var l=b.createElement(a),o=0,r={t:d,s:c,e:h};l.src=l.data=c,!s&&(l.style.display="none"),l.width=l.height="0",a!="object"&&(l.type=d),l.onload=l.onreadystatechange=i,a=="img"?l.onerror=i:a=="script"&&(l.onerror=function(){r.e=r.r=1,g()}),p.splice(e,0,r),u.insertBefore(l,s?null:n),m(function(){o||(u.removeChild(l),r.r=r.e=o=1,j())},H.errorTimeout)}function e(a,b,c){var d=b=="c"?z:y;q=0,b=b||"j",C(a)?f(d,a,b,this.i++,l,c):(p.splice(this.i++,0,a),p.length==1&&g());return this}function d(){var a=H;a.loader={load:e,i:0};return a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=r&&!s,u=s?l:n.parentNode,v=a.opera&&o.call(a.opera)=="[object Opera]",w="webkitAppearance"in l.style,x=w&&"async"in b.createElement("script"),y=r?"object":v||x?"img":"script",z=w?"img":y,A=Array.isArray||function(a){return o.call(a)=="[object Array]"},B=function(a){return Object(a)===a},C=function(a){return typeof a=="string"},D=function(a){return o.call(a)=="[object Function]"},E=[],F={},G,H;H=function(a){function f(a){var b=a.split("!"),c=E.length,d=b.pop(),e=b.length,f={url:d,origUrl:d,prefixes:b},g,h;for(h=0;h<e;h++)g=F[b[h]],g&&(f=g(f));for(h=0;h<c;h++)f=E[h](f);return f}function e(a,b,e,g,h){var i=f(a),j=i.autoCallback;if(!i.bypass){b&&(b=D(b)?b:b[a]||b[g]||b[a.split("/").pop().split("?")[0]]);if(i.instead)return i.instead(a,b,e,g,h);e.load(i.url,i.forceCSS||!i.forceJS&&/css$/.test(i.url)?"c":c,i.noexec),(D(b)||D(j))&&e.load(function(){d(),b&&b(i.origUrl,h,g),j&&j(i.origUrl,h,g)})}}function b(a,b){function c(a){if(C(a))e(a,h,b,0,d);else if(B(a))for(i in a)a.hasOwnProperty(i)&&e(a[i],h,b,i,d)}var d=!!a.test,f=d?a.yep:a.nope,g=a.load||a.both,h=a.callback,i;c(f),c(g),a.complete&&b.load(a.complete)}var g,h,i=this.yepnope.loader;if(C(a))e(a,0,i,0);else if(A(a))for(g=0;g<a.length;g++)h=a[g],C(h)?e(h,0,i,0):A(h)?H(h):B(h)&&b(h,i);else B(a)&&b(a,i)},H.addPrefix=function(a,b){F[a]=b},H.addFilter=function(a){E.push(a)},H.errorTimeout=1e4,b.readyState==null&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",G=function(){b.removeEventListener("DOMContentLoaded",G,0),b.readyState="complete"},0)),a.yepnope=d()}(this,this.document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};
/* Copyright (c) 2011 Oscar Godson ( http://oscargodson.com ) and Sebastian Nitu ( http://sebnitu.com ) More infomation on http://oscargodson.com/labs/jkey or fork it at https://github.com/OscarGodson/jKey */
(function(a){a.fn.jkey=function(b,c,d){function l(a){var b,c={};for(b in a){if(a.hasOwnProperty(b)){c[a[b]]=b}}return c}var e=this;if(this[0] && !this[0].parentNode){e=document}var f={a:65,b:66,c:67,d:68,e:69,f:70,g:71,h:72,i:73,j:74,k:75,l:76,m:77,n:78,o:79,p:80,q:81,r:82,s:83,t:84,u:85,v:86,w:87,x:88,y:89,z:90,0:48,1:49,2:50,3:51,4:52,5:53,6:54,7:55,8:56,9:57,f1:112,f2:113,f3:114,f4:115,f5:116,f6:117,f7:118,f8:119,f9:120,f10:121,f11:122,f12:123,shift:16,ctrl:17,control:17,alt:18,option:18,opt:18,cmd:224,command:224,fn:255,"function":255,backspace:8,osxdelete:8,enter:13,"return":13,space:32,spacebar:32,esc:27,escape:27,tab:9,capslock:20,capslk:20,"super":91,windows:91,insert:45,"delete":46,home:36,end:35,pgup:33,pageup:33,pgdn:34,pagedown:34,left:37,up:38,right:39,down:40,"!":49,"@":50,"#":51,$:52,"%":53,"^":54,"&":55,"*":56,"(":57,")":48,"`":96,"~":96,"-":45,_:45,"=":187,"+":187,"[":219,"{":219,"]":221,"}":221,"\\":220,"|":220,";":59,":":59,"'":222,'"':222,",":188,"<":188,".":190,">":190,"/":191,"?":191};var g="";var h="";if(typeof c=="function"&&typeof d=="undefined"){d=c;c=false}if(b.toString().indexOf(",")>-1){var i=b.match(/[a-zA-Z0-9]+/gi)}else{var i=[b]}for(g in i){if(!i.hasOwnProperty(g)){continue}if(i[g].toString().indexOf("+")>-1){var j=[];var k=i[g].split("+");for(h in k){j[h]=f[k[h]]}i[g]=j}else{i[g]=f[i[g]]}}var m=l(f);return this.each(function(){e=a(this);var b=[];e.bind("keydown.jkey",function(e){b[e.keyCode]=e.keyCode;if(a.inArray(e.keyCode,i)>-1){if(typeof d=="function"){d.call(this,m[e.keyCode]);if(c===false){e.preventDefault()}}}else{for(g in i){if(a.inArray(e.keyCode,i[g])>-1){var f="unchecked";for(h in i[g]){if(f!=false){if(a.inArray(i[g][h],b)>-1){f=true}else{f=false}}}if(f===true){if(typeof d=="function"){var j="";for(var k in b){if(b[k]!=""){j+=m[b[k]]+"+"}}j=j.substring(0,j.length-1);d.call(this,j);if(c===false){e.preventDefault()}}}}}}}).bind("keyup.jkey",function(a){b[a.keyCode]=""})})}})(jQuery);
/* qTip2 - Pretty powerful tooltips http://craigsworks.com/projects/qtip2/ Copyright 2009-2010 Craig Michael Thompson - http://craigsworks.com jslint browser: true, onevar: true, undef: true, nomen: true, bitwise: true, regexp: true, newcap: true, immed: true, strict: true *//*global window: false, jQuery: false, console: false, define: false */
(function(a){typeof define==="function"&&define.amd?define(["jquery"],a):a(jQuery)})(function(a){function B(d){var e=this,f=d.options.show.modal,h=d.elements,i=h.tooltip,j="#qtip-overlay",k=".qtipmodal",l=k+d.id,n="is-modal-qtip",p=a(document.body),q;d.checks.modal={"^show.modal.(on|blur)$":function(){e.init(),h.overlay.toggle(i.is(":visible"))}},a.extend(e,{init:function(){if(!f.on)return e;q=e.create(),i.attr(n,b).css("z-index",g.modal.zindex+a(m+"["+n+"]").length).unbind(k).unbind(l).bind("tooltipshow"+k+" tooltiphide"+k,function(b,c,d){var f=b.originalEvent;if(b.target===i[0])if(f&&b.type==="tooltiphide"&&/mouse(leave|enter)/.test(f.type)&&a(f.relatedTarget).closest(q[0]).length)try{b.preventDefault()}catch(g){}else(!f||f&&!f.solo)&&e[b.type.replace("tooltip","")](b,d)}).bind("tooltipfocus"+k,function(b){if(!b.isDefaultPrevented()&&b.target===i[0]){var c=a(m).filter("["+n+"]"),d=g.modal.zindex+c.length,e=parseInt(i[0].style.zIndex,10);q[0].style.zIndex=d-1,c.each(function(){this.style.zIndex>e&&(this.style.zIndex-=1)}),c.end().filter("."+o).qtip("blur",b.originalEvent),i.addClass(o)[0].style.zIndex=d;try{b.preventDefault()}catch(f){}}}).bind("tooltiphide"+k,function(b){b.target===i[0]&&a("["+n+"]").filter(":visible").not(i).last().qtip("focus",b)}),f.escape&&a(window).unbind(l).bind("keydown"+l,function(a){a.keyCode===27&&i.hasClass(o)&&d.hide(a)}),f.blur&&h.overlay.unbind(l).bind("click"+l,function(a){i.hasClass(o)&&d.hide(a)});return e},create:function(){function d(){q.css({height:a(window).height(),width:a(window).width()})}var b=a(j);if(b.length)return h.overlay=b.insertAfter(a(m).last());q=h.overlay=a("<div />",{id:j.substr(1),html:"<div></div>",mousedown:function(){return c}}).insertAfter(a(m).last()),a(window).unbind(k).bind("resize"+k,d),d();return q},toggle:function(d,g,h){if(d&&d.isDefaultPrevented())return e;var j=f.effect,k=g?"show":"hide",o=q.is(":visible"),r=a("["+n+"]").filter(":visible").not(i),s;q||(q=e.create());if(q.is(":animated")&&o===g||!g&&r.length)return e;g?(q.css({left:0,top:0}),q.toggleClass("blurs",f.blur),p.bind("focusin"+l,function(b){var d=a(b.target),e=d.closest(".qtip"),f=e.length<1?c:parseInt(e[0].style.zIndex,10)>parseInt(i[0].style.zIndex,10);!f&&a(b.target).closest(m)[0]!==i[0]&&i.find("input:visible").filter(":first").focus()})):p.undelegate("*","focusin"+l),q.stop(b,c),a.isFunction(j)?j.call(q,g):j===c?q[k]():q.fadeTo(parseInt(h,10)||90,g?1:0,function(){g||a(this).hide()}),g||q.queue(function(a){q.css({left:"",top:""}),a()});return e},show:function(a,c){return e.toggle(a,b,c)},hide:function(a,b){return e.toggle(a,c,b)},destroy:function(){var b=q;b&&(b=a("["+n+"]").not(i).length<1,b?(h.overlay.remove(),a(window).unbind(k)):h.overlay.unbind(k+d.id),p.undelegate("*","focusin"+l));return i.removeAttr(n).unbind(k)}}),e.init()}function A(f,h){function w(a){var b=a.precedance==="y",c=n[b?"width":"height"],d=n[b?"height":"width"],e=a.string().indexOf("center")>-1,f=c*(e?.5:1),g=Math.pow,h=Math.round,i,j,k,l=Math.sqrt(g(f,2)+g(d,2)),m=[p/f*l,p/d*l];m[2]=Math.sqrt(g(m[0],2)-g(p,2)),m[3]=Math.sqrt(g(m[1],2)-g(p,2)),i=l+m[2]+m[3]+(e?0:m[0]),j=i/l,k=[h(j*d),h(j*c)];return{height:k[b?0:1],width:k[b?1:0]}}function v(b){var c=k.titlebar&&b.y==="top",d=c?k.titlebar:k.content,e=a.browser.mozilla,f=e?"-moz-":a.browser.webkit?"-webkit-":"",g=b.y+(e?"":"-")+b.x,h=f+(e?"border-radius-"+g:"border-"+g+"-radius");return parseInt(d.css(h),10)||parseInt(l.css(h),10)||0}function u(a,b,c){b=b?b:a[a.precedance];var d=l.hasClass(q),e=k.titlebar&&a.y==="top",f=e?k.titlebar:k.content,g="border-"+b+"-width",h;l.addClass(q),h=parseInt(f.css(g),10),h=(c?h||parseInt(l.css(g),10):h)||0,l.toggleClass(q,d);return h}function t(a,d,g,h){if(k.tip){var l=i.corner.clone(),n=g.adjusted,o=f.options.position.adjust.method.split(" "),p=o[0],q=o[1]||o[0],r={left:c,top:c,x:0,y:0},s,t={},u;i.corner.fixed!==b&&(p==="shift"&&l.precedance==="x"&&n.left&&l.y!=="center"?l.precedance=l.precedance==="x"?"y":"x":p==="flip"&&n.left&&(l.x=l.x==="center"?n.left>0?"left":"right":l.x==="left"?"right":"left"),q==="shift"&&l.precedance==="y"&&n.top&&l.x!=="center"?l.precedance=l.precedance==="y"?"x":"y":q==="flip"&&n.top&&(l.y=l.y==="center"?n.top>0?"top":"bottom":l.y==="top"?"bottom":"top"),l.string()!==m.corner.string()&&(m.top!==n.top||m.left!==n.left)&&i.update(l,c)),s=i.position(l,n),s.right!==e&&(s.left=-s.right),s.bottom!==e&&(s.top=-s.bottom),s.user=Math.max(0,j.offset);if(r.left=p==="shift"&&!!n.left)l.x==="center"?t["margin-left"]=r.x=s["margin-left"]-n.left:(u=s.right!==e?[n.left,-s.left]:[-n.left,s.left],(r.x=Math.max(u[0],u[1]))>u[0]&&(g.left-=n.left,r.left=c),t[s.right!==e?"right":"left"]=r.x);if(r.top=q==="shift"&&!!n.top)l.y==="center"?t["margin-top"]=r.y=s["margin-top"]-n.top:(u=s.bottom!==e?[n.top,-s.top]:[-n.top,s.top],(r.y=Math.max(u[0],u[1]))>u[0]&&(g.top-=n.top,r.top=c),t[s.bottom!==e?"bottom":"top"]=r.y);k.tip.css(t).toggle(!(r.x&&r.y||l.x==="center"&&r.y||l.y==="center"&&r.x)),g.left-=s.left.charAt?s.user:p!=="shift"||r.top||!r.left&&!r.top?s.left:0,g.top-=s.top.charAt?s.user:q!=="shift"||r.left||!r.left&&!r.top?s.top:0,m.left=n.left,m.top=n.top,m.corner=l.clone()}}var i=this,j=f.options.style.tip,k=f.elements,l=k.tooltip,m={top:0,left:0},n={width:j.width,height:j.height},o={},p=j.border||0,r=".qtip-tip",s=!!(a("<canvas />")[0]||{}).getContext;i.mimic=i.corner=d,i.border=p,i.offset=j.offset,i.size=n,f.checks.tip={"^position.my|style.tip.(corner|mimic|border)$":function(){i.init()||i.destroy(),f.reposition()},"^style.tip.(height|width)$":function(){n={width:j.width,height:j.height},i.create(),i.update(),f.reposition()},"^content.title.text|style.(classes|widget)$":function(){k.tip&&i.update()}},a.extend(i,{init:function(){var b=i.detectCorner()&&(s||a.browser.msie);b&&(i.create(),i.update(),l.unbind(r).bind("tooltipmove"+r,t));return b},detectCorner:function(){var a=j.corner,d=f.options.position,e=d.at,h=d.my.string?d.my.string():d.my;if(a===c||h===c&&e===c)return c;a===b?i.corner=new g.Corner(h):a.string||(i.corner=new g.Corner(a),i.corner.fixed=b),m.corner=new g.Corner(i.corner.string());return i.corner.string()!=="centercenter"},detectColours:function(b){var c,d,e,g=k.tip.css("cssText",""),h=b||i.corner,m=h[h.precedance],p="border-"+m+"-color",r="border"+m.charAt(0)+m.substr(1)+"Color",s=/rgba?\(0, 0, 0(, 0)?\)|transparent|#123456/i,t="background-color",u="transparent",v=" !important",w=a(document.body).css("color"),x=f.elements.content.css("color"),y=k.titlebar&&(h.y==="top"||h.y==="center"&&g.position().top+n.height/2+j.offset<k.titlebar.outerHeight(1)),z=y?k.titlebar:k.content;l.addClass(q),o.fill=d=g.css(t),o.border=e=g[0].style[r]||g.css(p)||l.css(p);if(!d||s.test(d))o.fill=z.css(t)||u,s.test(o.fill)&&(o.fill=l.css(t)||d);if(!e||s.test(e)||e===w)o.border=z.css(p)||u,s.test(o.border)&&(o.border=e);a("*",g).add(g).css("cssText",t+":"+u+v+";border:0"+v+";"),l.removeClass(q)},create:function(){var b=n.width,c=n.height,d;k.tip&&k.tip.remove(),k.tip=a("<div />",{"class":"ui-tooltip-tip"}).css({width:b,height:c}).prependTo(l),s?a("<canvas />").appendTo(k.tip)[0].getContext("2d").save():(d='<vml:shape coordorigin="0,0" style="display:inline-block; position:absolute; behavior:url(#default#VML);"></vml:shape>',k.tip.html(d+d),a("*",k.tip).bind("click mousedown",function(a){a.stopPropagation()}))},update:function(e,f){var h=k.tip,l=h.children(),q=n.width,r=n.height,t="px solid ",v="px dashed transparent",x=j.mimic,y=Math.round,A,B,C,D,E;e||(e=m.corner||i.corner),x===c?x=e:(x=new g.Corner(x),x.precedance=e.precedance,x.x==="inherit"?x.x=e.x:x.y==="inherit"?x.y=e.y:x.x===x.y&&(x[e.precedance]=e[e.precedance])),A=x.precedance,i.detectColours(e),o.border!=="transparent"&&o.border!=="#123456"?(p=u(e,d,b),j.border===0&&p>0&&(o.fill=o.border),i.border=p=j.border!==b?j.border:p):i.border=p=0,C=z(x,q,r),i.size=E=w(e),h.css(E),e.precedance==="y"?D=[y(x.x==="left"?p:x.x==="right"?E.width-q-p:(E.width-q)/2),y(x.y==="top"?E.height-r:0)]:D=[y(x.x==="left"?E.width-q:0),y(x.y==="top"?p:x.y==="bottom"?E.height-r-p:(E.height-r)/2)],s?(l.attr(E),B=l[0].getContext("2d"),B.restore(),B.save(),B.clearRect(0,0,3e3,3e3),B.translate(D[0],D[1]),B.beginPath(),B.moveTo(C[0][0],C[0][1]),B.lineTo(C[1][0],C[1][1]),B.lineTo(C[2][0],C[2][1]),B.closePath(),B.fillStyle=o.fill,B.strokeStyle=o.border,B.lineWidth=p*2,B.lineJoin="miter",B.miterLimit=100,p&&B.stroke(),B.fill()):(C="m"+C[0][0]+","+C[0][1]+" l"+C[1][0]+","+C[1][1]+" "+C[2][0]+","+C[2][1]+" xe",D[2]=p&&/^(r|b)/i.test(e.string())?parseFloat(a.browser.version,10)===8?2:1:0,l.css({antialias:""+(x.string().indexOf("center")>-1),left:D[0]-D[2]*Number(A==="x"),top:D[1]-D[2]*Number(A==="y"),width:q+p,height:r+p}).each(function(b){var c=a(this);c[c.prop?"prop":"attr"]({coordsize:q+p+" "+(r+p),path:C,fillcolor:o.fill,filled:!!b,stroked:!b}).css({display:p||b?"block":"none"}),!b&&c.html()===""&&c.html('<vml:stroke weight="'+p*2+'px" color="'+o.border+'" miterlimit="1000" joinstyle="miter"  style="behavior:url(#default#VML); display:inline-block;" />')})),f!==c&&i.position(e)},position:function(d){var e=k.tip,f={},g=Math.max(0,j.offset),h,l,m;if(j.corner===c||!e)return c;d=d||i.corner,h=d.precedance,l=w(d),m=[d.x,d.y],h==="x"&&m.reverse(),a.each(m,function(a,c){var e,i;c==="center"?(e=h==="y"?"left":"top",f[e]="50%",f["margin-"+e]=-Math.round(l[h==="y"?"width":"height"]/2)+g):(e=u(d,c,b),i=v(d),f[c]=a?p?u(d,c):0:g+(i>e?i:0))}),f[d[h]]-=l[h==="x"?"width":"height"],e.css({top:"",bottom:"",left:"",right:"",margin:""}).css(f);return f},destroy:function(){k.tip&&k.tip.remove(),l.unbind(r)}}),i.init()}function z(a,b,c){var d=Math.ceil(b/2),e=Math.ceil(c/2),f={bottomright:[[0,0],[b,c],[b,0]],bottomleft:[[0,0],[b,0],[0,c]],topright:[[0,c],[b,0],[b,c]],topleft:[[0,0],[0,c],[b,c]],topcenter:[[0,c],[d,0],[b,c]],bottomcenter:[[0,0],[b,0],[d,c]],rightcenter:[[0,0],[b,e],[0,c]],leftcenter:[[b,0],[b,c],[0,e]]};f.lefttop=f.bottomright,f.righttop=f.bottomleft,f.leftbottom=f.topright,f.rightbottom=f.topleft;return f[a.string()]}function y(e,h){var i,j,k,l,m,n=a(this),o=a(document.body),p=this===document?o:n,q=n.metadata?n.metadata(h.metadata):d,r=h.metadata.type==="html5"&&q?q[h.metadata.name]:d,s=n.data(h.metadata.name||"qtipopts");try{s=typeof s==="string"?(new Function("return "+s))():s}catch(u){v("Unable to parse HTML5 attribute data: "+s)}l=a.extend(b,{},f.defaults,h,typeof s==="object"?w(s):d,w(r||q)),j=l.position,l.id=e;if("boolean"===typeof l.content.text){k=n.attr(l.content.attr);if(l.content.attr!==c&&k)l.content.text=k;else{v("Unable to locate content for tooltip! Aborting render of tooltip on element: ",n);return c}}j.container.length||(j.container=o),j.target===c&&(j.target=p),l.show.target===c&&(l.show.target=p),l.show.solo===b&&(l.show.solo=j.container.closest("body")),l.hide.target===c&&(l.hide.target=p),l.position.viewport===b&&(l.position.viewport=j.container),j.container=j.container.eq(0),j.at=new g.Corner(j.at),j.my=new g.Corner(j.my);if(a.data(this,"qtip"))if(l.overwrite)n.qtip("destroy");else if(l.overwrite===c)return c;l.suppress&&(m=a.attr(this,"title"))&&a(this).removeAttr("title").attr(t,m),i=new x(n,l,e,!!k),a.data(this,"qtip",i),n.bind("remove.qtip-"+e+" removeqtip.qtip-"+e,function(){i.destroy()});return i}function x(r,s,v,x){function Q(){var b=[s.show.target[0],s.hide.target[0],y.rendered&&F.tooltip[0],s.position.container[0],s.position.viewport[0],window,document];y.rendered?a([]).pushStack(a.grep(b,function(a){return typeof a==="object"})).unbind(E):s.show.target.unbind(E+"-create")}function P(){function o(a){D.is(":visible")&&y.reposition(a)}function n(a){if(D.hasClass(l))return c;clearTimeout(y.timers.inactive),y.timers.inactive=setTimeout(function(){y.hide(a)},s.hide.inactive)}function k(b){if(D.hasClass(l)||B||C)return c;var f=a(b.relatedTarget||b.target),g=f.closest(m)[0]===D[0],h=f[0]===e.show[0];clearTimeout(y.timers.show),clearTimeout(y.timers.hide);if(d.target==="mouse"&&g||s.hide.fixed&&(/mouse(out|leave|move)/.test(b.type)&&(g||h)))try{b.preventDefault(),b.stopImmediatePropagation()}catch(i){}else s.hide.delay>0?y.timers.hide=setTimeout(function(){y.hide(b)},s.hide.delay):y.hide(b)}function j(a){if(D.hasClass(l))return c;clearTimeout(y.timers.show),clearTimeout(y.timers.hide);var d=function(){y.toggle(b,a)};s.show.delay>0?y.timers.show=setTimeout(d,s.show.delay):d()}var d=s.position,e={show:s.show.target,hide:s.hide.target,viewport:a(d.viewport),document:a(document),body:a(document.body),window:a(window)},g={show:a.trim(""+s.show.event).split(" "),hide:a.trim(""+s.hide.event).split(" ")},i=a.browser.msie&&parseInt(a.browser.version,10)===6;D.bind("mouseenter"+E+" mouseleave"+E,function(a){var b=a.type==="mouseenter";b&&y.focus(a),D.toggleClass(p,b)}),s.hide.fixed&&(e.hide=e.hide.add(D),D.bind("mouseover"+E,function(){D.hasClass(l)||clearTimeout(y.timers.hide)})),/mouse(out|leave)/i.test(s.hide.event)?s.hide.leave==="window"&&e.window.bind("mouseout"+E+" blur"+E,function(a){/select|option/.test(a.target)&&!a.relatedTarget&&y.hide(a)}):/mouse(over|enter)/i.test(s.show.event)&&e.hide.bind("mouseleave"+E,function(a){clearTimeout(y.timers.show)}),(""+s.hide.event).indexOf("unfocus")>-1&&d.container.closest("html").bind("mousedown"+E,function(b){var c=a(b.target),d=!D.hasClass(l)&&D.is(":visible"),e=c.parents(m).filter(D[0]).length>0;c[0]!==r[0]&&c[0]!==D[0]&&!e&&!r.has(c[0]).length&&!c.attr("disabled")&&y.hide(b)}),"number"===typeof s.hide.inactive&&(e.show.bind("qtip-"+v+"-inactive",n),a.each(f.inactiveEvents,function(a,b){e.hide.add(F.tooltip).bind(b+E+"-inactive",n)})),a.each(g.hide,function(b,c){var d=a.inArray(c,g.show),f=a(e.hide);d>-1&&f.add(e.show).length===f.length||c==="unfocus"?(e.show.bind(c+E,function(a){D.is(":visible")?k(a):j(a)}),delete g.show[d]):e.hide.bind(c+E,k)}),a.each(g.show,function(a,b){e.show.bind(b+E,j)}),"number"===typeof s.hide.distance&&e.show.add(D).bind("mousemove"+E,function(a){var b=G.origin||{},c=s.hide.distance,d=Math.abs;(d(a.pageX-b.pageX)>=c||d(a.pageY-b.pageY)>=c)&&y.hide(a)}),d.target==="mouse"&&(e.show.bind("mousemove"+E,function(a){h={pageX:a.pageX,pageY:a.pageY,type:"mousemove"}}),d.adjust.mouse&&(s.hide.event&&(D.bind("mouseleave"+E,function(a){(a.relatedTarget||a.target)!==e.show[0]&&y.hide(a)}),F.target.bind("mouseenter"+E+" mouseleave"+E,function(a){G.onTarget=a.type==="mouseenter"})),e.document.bind("mousemove"+E,function(a){G.onTarget&&!D.hasClass(l)&&D.is(":visible")&&y.reposition(a||h)}))),(d.adjust.resize||e.viewport.length)&&(a.event.special.resize?e.viewport:e.window).bind("resize"+E,o),(e.viewport.length||i&&D.css("position")==="fixed")&&e.viewport.bind("scroll"+E,o)}function O(b,d){function g(b){function i(e){e&&(delete h[e.src],clearTimeout(y.timers.img[e.src]),a(e).unbind(E)),a.isEmptyObject(h)&&(y.redraw(),d!==c&&y.reposition(G.event),b())}var g,h={};if((g=f.find("img[src]:not([height]):not([width])")).length===0)return i();g.each(function(b,c){if(h[c.src]===e){var d=0,f=3;(function g(){if(c.height||c.width||d>f)return i(c);d+=1,y.timers.img[c.src]=setTimeout(g,700)})(),a(c).bind("error"+E+" load"+E,function(){i(this)}),h[c.src]=c}})}var f=F.content;if(!y.rendered||!b)return c;a.isFunction(b)&&(b=b.call(r,G.event,y)||""),b.jquery&&b.length>0?f.empty().append(b.css({display:"block"})):f.html(b),y.rendered<0?D.queue("fx",g):(C=0,g(a.noop));return y}function N(b,d){var e=F.title;if(!y.rendered||!b)return c;a.isFunction(b)&&(b=b.call(r,G.event,y));if(b===c||!b&&b!=="")return J(c);b.jquery&&b.length>0?e.empty().append(b.css({display:"block"})):e.html(b),y.redraw(),d!==c&&y.rendered&&D.is(":visible")&&y.reposition(G.event)}function M(a){var b=F.button,d=F.title;if(!y.rendered)return c;a?(d||L(),K()):b.remove()}function L(){var c=A+"-title";F.titlebar&&J(),F.titlebar=a("<div />",{"class":j+"-titlebar "+(s.style.widget?"ui-widget-header":"")}).append(F.title=a("<div />",{id:c,"class":j+"-title","aria-atomic":b})).insertBefore(F.content).delegate(".ui-tooltip-close","mousedown keydown mouseup keyup mouseout",function(b){a(this).toggleClass("ui-state-active ui-state-focus",b.type.substr(-4)==="down")}).delegate(".ui-tooltip-close","mouseover mouseout",function(b){a(this).toggleClass("ui-state-hover",b.type==="mouseover")}),s.content.title.button?K():y.rendered&&y.redraw()}function K(){var b=s.content.title.button,d=typeof b==="string",e=d?b:"Close tooltip";F.button&&F.button.remove(),b.jquery?F.button=b:F.button=a("<a />",{"class":"ui-state-default ui-tooltip-close "+(s.style.widget?"":j+"-icon"),title:e,"aria-label":e}).prepend(a("<span />",{"class":"ui-icon ui-icon-close",html:"&times;"})),F.button.appendTo(F.titlebar).attr("role","button").click(function(a){D.hasClass(l)||y.hide(a);return c}),y.redraw()}function J(a){F.title&&(F.titlebar.remove(),F.titlebar=F.title=F.button=d,a!==c&&y.reposition())}function I(){var a=s.style.widget;D.toggleClass(k,a).toggleClass(n,s.style.def&&!a),F.content.toggleClass(k+"-content",a),F.titlebar&&F.titlebar.toggleClass(k+"-header",a),F.button&&F.button.toggleClass(j+"-icon",!a)}function H(a){var b=0,c,d=s,e=a.split(".");while(d=d[e[b++]])b<e.length&&(c=d);return[c||s,e.pop()]}var y=this,z=document.body,A=j+"-"+v,B=0,C=0,D=a(),E=".qtip-"+v,F,G;y.id=v,y.rendered=c,y.elements=F={target:r},y.timers={img:{}},y.options=s,y.checks={},y.plugins={},y.cache=G={event:{},target:a(),disabled:c,attr:x,onTarget:c},y.checks.builtin={"^id$":function(d,e,g){var h=g===b?f.nextid:g,i=j+"-"+h;h!==c&&h.length>0&&!a("#"+i).length&&(D[0].id=i,F.content[0].id=i+"-content",F.title[0].id=i+"-title")},"^content.text$":function(a,b,c){O(c)},"^content.title.text$":function(a,b,c){if(!c)return J();!F.title&&c&&L(),N(c)},"^content.title.button$":function(a,b,c){M(c)},"^position.(my|at)$":function(a,b,c){"string"===typeof c&&(a[b]=new g.Corner(c))},"^position.container$":function(a,b,c){y.rendered&&D.appendTo(c)},"^show.ready$":function(){y.rendered?y.toggle(b):y.render(1)},"^style.classes$":function(a,b,c){D.attr("class",j+" qtip ui-helper-reset "+c)},"^style.widget|content.title":I,"^events.(render|show|move|hide|focus|blur)$":function(b,c,d){D[(a.isFunction(d)?"":"un")+"bind"]("tooltip"+c,d)},"^(show|hide|position).(event|target|fixed|inactive|leave|distance|viewport|adjust)":function(){var a=s.position;D.attr("tracking",a.target==="mouse"&&a.adjust.mouse),Q(),P()}},a.extend(y,{render:function(d){if(y.rendered)return y;var e=s.content.text,f=s.content.title.text,h=s.position,i=a.Event("tooltiprender");a.attr(r[0],"aria-describedby",A),D=F.tooltip=a("<div/>",{id:A,"class":j+" qtip ui-helper-reset "+n+" "+s.style.classes+" "+j+"-pos-"+s.position.my.abbrev(),width:s.style.width||"",height:s.style.height||"",tracking:h.target==="mouse"&&h.adjust.mouse,role:"alert","aria-live":"polite","aria-atomic":c,"aria-describedby":A+"-content","aria-hidden":b}).toggleClass(l,G.disabled).data("qtip",y).appendTo(s.position.container).append(F.content=a("<div />",{"class":j+"-content",id:A+"-content","aria-atomic":b})),y.rendered=-1,B=C=1,f&&(L(),a.isFunction(f)||N(f,c)),a.isFunction(e)||O(e,c),y.rendered=b,I(),a.each(s.events,function(b,c){a.isFunction(c)&&D.bind(b==="toggle"?"tooltipshow tooltiphide":"tooltip"+b,c)}),a.each(g,function(){this.initialize==="render"&&this(y)}),P(),D.queue("fx",function(a){i.originalEvent=G.event,D.trigger(i,[y]),B=C=0,y.redraw(),(s.show.ready||d)&&y.toggle(b,G.event,c),a()});return y},get:function(a){var b,c;switch(a.toLowerCase()){case"dimensions":b={height:D.outerHeight(),width:D.outerWidth()};break;case"offset":b=g.offset(D,s.position.container);break;default:c=H(a.toLowerCase()),b=c[0][c[1]],b=b.precedance?b.string():b}return b},set:function(e,f){function m(a,b){var c,d,e;for(c in k)for(d in k[c])if(e=(new RegExp(d,"i")).exec(a))b.push(e),k[c][d].apply(y,b)}var g=/^position\.(my|at|adjust|target|container)|style|content|show\.ready/i,h=/^content\.(title|attr)|style/i,i=c,j=c,k=y.checks,l;"string"===typeof e?(l=e,e={},e[l]=f):e=a.extend(b,{},e),a.each(e,function(b,c){var d=H(b.toLowerCase()),f;f=d[0][d[1]],d[0][d[1]]="object"===typeof c&&c.nodeType?a(c):c,e[b]=[d[0],d[1],c,f],i=g.test(b)||i,j=h.test(b)||j}),w(s),B=C=1,a.each(e,m),B=C=0,D.is(":visible")&&y.rendered&&(i&&y.reposition(s.position.target==="mouse"?d:G.event),j&&y.redraw());return y},toggle:function(e,f){function r(){e?(a.browser.msie&&D[0].style.removeAttribute("filter"),D.css("overflow",""),"string"===typeof i.autofocus&&a(i.autofocus,D).focus(),i.target.trigger("qtip-"+v+"-inactive")):D.css({display:"",visibility:"",opacity:"",left:"",top:""}),q=a.Event("tooltip"+(e?"visible":"hidden")),q.originalEvent=f?G.event:d,D.trigger(q,[y])}if(!y.rendered)return e?y.render(1):y;var g=e?"show":"hide",i=s[g],j=D.is(":visible"),k=!f||i.target.length<2||G.target[0]===f.target,l=f&&i.target.add(f.target).length!==i.target.length,n=s.position,o=s.content,p,q;(typeof e).search("boolean|number")&&(e=!j);if(!D.is(":animated")&&j===e&&k)return y;if(f){if(/over|enter/.test(f.type)&&/out|leave/.test(G.event.type)&&s.show.target.add(f.target).length===s.show.target.length&&D.has(f.relatedTarget).length)return y;G.event=a.extend({},f)}q=a.Event("tooltip"+g),q.originalEvent=f?G.event:d,D.trigger(q,[y,90]);if(q.isDefaultPrevented())return y;a.attr(D[0],"aria-hidden",!e),e?(G.origin=a.extend({},h),y.focus(f),a.isFunction(o.text)&&O(o.text,c),a.isFunction(o.title.text)&&N(o.title.text,c),!u&&n.target==="mouse"&&n.adjust.mouse&&(a(document).bind("mousemove.qtip",function(a){h={pageX:a.pageX,pageY:a.pageY,type:"mousemove"}}),u=b),y.reposition(f,arguments[2]),(q.solo=!!i.solo)&&a(m,i.solo).not(D).qtip("hide",q)):(clearTimeout(y.timers.show),delete G.origin,u&&!a(m+'[tracking="true"]:visible',i.solo).not(D).length&&(a(document).unbind("mousemove.qtip"),u=c),y.blur(f)),D.stop(l,!l),i.effect===c?(D[g](),r.call(D)):a.isFunction(i.effect)?(i.effect.call(D,y),D.queue("fx",function(a){r(),a()})):D.fadeTo(90,e?1:0,r),e&&i.target.trigger("qtip-"+v+"-inactive");return y},show:function(a){return y.toggle(b,a)},hide:function(a){return y.toggle(c,a)},focus:function(b){if(!y.rendered)return y;var c=a(m),d=parseInt(D[0].style.zIndex,10),e=f.zindex+c.length,g=a.extend({},b),h,i;D.hasClass(o)||(i=a.Event("tooltipfocus"),i.originalEvent=g,D.trigger(i,[y,e]),i.isDefaultPrevented()||(d!==e&&(c.each(function(){this.style.zIndex>d&&(this.style.zIndex=this.style.zIndex-1)}),c.filter("."+o).qtip("blur",g)),D.addClass(o)[0].style.zIndex=e));return y},blur:function(b){var c=a.extend({},b),d;D.removeClass(o),d=a.Event("tooltipblur"),d.originalEvent=c,D.trigger(d,[y]);return y},reposition:function(b,d){if(!y.rendered||B)return y;B=1;var e=s.position.target,f=s.position,i=f.my,k=f.at,l=f.adjust,m=l.method.split(" "),n=D.outerWidth(),o=D.outerHeight(),p=0,q=0,r=a.Event("tooltipmove"),t=D.css("position")==="fixed",u=f.viewport,v={left:0,top:0},w=f.container,x=c,A=y.plugins.tip,C={horizontal:m[0],vertical:m[1]=m[1]||m[0],enabled:u.jquery&&e[0]!==window&&e[0]!==z&&l.method!=="none",left:function(a){var b=C.horizontal==="shift",c=-w.offset.left+u.offset.left+u.scrollLeft,d=i.x==="left"?n:i.x==="right"?-n:-n/2,e=k.x==="left"?p:k.x==="right"?-p:-p/2,f=A&&A.size?A.size.width||0:0,g=A&&A.corner&&A.corner.precedance==="x"&&!b?f:0,h=c-a+g,j=a+n-u.width-c+g,m=d-(i.precedance==="x"||i.x===i.y?e:0)-(k.x==="center"?p/2:0),o=i.x==="center";b?(g=A&&A.corner&&A.corner.precedance==="y"?f:0,m=(i.x==="left"?1:-1)*d-g,v.left+=h>0?h:j>0?-j:0,v.left=Math.max(-w.offset.left+u.offset.left+(g&&A.corner.x==="center"?A.offset:0),a-m,Math.min(Math.max(-w.offset.left+u.offset.left+u.width,a+m),v.left))):(h>0&&(i.x!=="left"||j>0)?v.left-=m:j>0&&(i.x!=="right"||h>0)&&(v.left-=o?-m:m),v.left!==a&&o&&(v.left-=l.x),v.left<c&&-v.left>j&&(v.left=a));return v.left-a},top:function(a){var b=C.vertical==="shift",c=-w.offset.top+u.offset.top+u.scrollTop,d=i.y==="top"?o:i.y==="bottom"?-o:-o/2,e=k.y==="top"?q:k.y==="bottom"?-q:-q/2,f=A&&A.size?A.size.height||0:0,g=A&&A.corner&&A.corner.precedance==="y"&&!b?f:0,h=c-a+g,j=a+o-u.height-c+g,m=d-(i.precedance==="y"||i.x===i.y?e:0)-(k.y==="center"?q/2:0),n=i.y==="center";b?(g=A&&A.corner&&A.corner.precedance==="x"?f:0,m=(i.y==="top"?1:-1)*d-g,v.top+=h>0?h:j>0?-j:0,v.top=Math.max(-w.offset.top+u.offset.top+(g&&A.corner.x==="center"?A.offset:0),a-m,Math.min(Math.max(-w.offset.top+u.offset.top+u.height,a+m),v.top))):(h>0&&(i.y!=="top"||j>0)?v.top-=m:j>0&&(i.y!=="bottom"||h>0)&&(v.top-=n?-m:m),v.top!==a&&n&&(v.top-=l.y),v.top<0&&-v.top>j&&(v.top=a));return v.top-a}},E;if(a.isArray(e)&&e.length===2)k={x:"left",y:"top"},v={left:e[0],top:e[1]};else if(e==="mouse"&&(b&&b.pageX||G.event.pageX))k={x:"left",y:"top"},b=(b&&(b.type==="resize"||b.type==="scroll")?G.event:b&&b.pageX&&b.type==="mousemove"?b:h&&h.pageX&&(l.mouse||!b||!b.pageX)?{pageX:h.pageX,pageY:h.pageY}:!l.mouse&&G.origin&&G.origin.pageX&&s.show.distance?G.origin:b)||b||G.event||h||{},v={top:b.pageY,left:b.pageX};else{e==="event"?b&&b.target&&b.type!=="scroll"&&b.type!=="resize"?e=G.target=a(b.target):e=G.target:e=G.target=a(e.jquery?e:F.target),e=a(e).eq(0);if(e.length===0)return y;e[0]===document||e[0]===window?(p=g.iOS?window.innerWidth:e.width(),q=g.iOS?window.innerHeight:e.height(),e[0]===window&&(v={top:(u||e).scrollTop(),left:(u||e).scrollLeft()})):e.is("area")&&g.imagemap?v=g.imagemap(e,k,C.enabled?m:c):e[0].namespaceURI==="http://www.w3.org/2000/svg"&&g.svg?v=g.svg(e,k):(p=e.outerWidth(),q=e.outerHeight(),v=g.offset(e,w)),v.offset&&(p=v.width,q=v.height,x=v.flipoffset,v=v.offset);if(g.iOS<4.1&&g.iOS>3.1||g.iOS==4.3||!g.iOS&&t)E=a(window),v.left-=E.scrollLeft(),v.top-=E.scrollTop();v.left+=k.x==="right"?p:k.x==="center"?p/2:0,v.top+=k.y==="bottom"?q:k.y==="center"?q/2:0}v.left+=l.x+(i.x==="right"?-n:i.x==="center"?-n/2:0),v.top+=l.y+(i.y==="bottom"?-o:i.y==="center"?-o/2:0),C.enabled?(u={elem:u,height:u[(u[0]===window?"h":"outerH")+"eight"](),width:u[(u[0]===window?"w":"outerW")+"idth"](),scrollLeft:t?0:u.scrollLeft(),scrollTop:t?0:u.scrollTop(),offset:u.offset()||{left:0,top:0}},w={elem:w,scrollLeft:w.scrollLeft(),scrollTop:w.scrollTop(),offset:w.offset()||{left:0,top:0}},v.adjusted={left:C.horizontal!=="none"?C.left(v.left):0,top:C.vertical!=="none"?C.top(v.top):0},v.adjusted.left+v.adjusted.top&&D.attr("class",D[0].className.replace(/ui-tooltip-pos-\w+/i,j+"-pos-"+i.abbrev())),x&&v.adjusted.left&&(v.left+=x.left),x&&v.adjusted.top&&(v.top+=x.top)):v.adjusted={left:0,top:0},r.originalEvent=a.extend({},b),D.trigger(r,[y,v,u.elem||u]);if(r.isDefaultPrevented())return y;delete v.adjusted,d===c||isNaN(v.left)||isNaN(v.top)||e==="mouse"||!a.isFunction(f.effect)?D.css(v):a.isFunction(f.effect)&&(f.effect.call(D,y,a.extend({},v)),D.queue(function(b){a(this).css({opacity:"",height:""}),a.browser.msie&&this.style.removeAttribute("filter"),b()})),B=0;return y},redraw:function(){if(y.rendered<1||C)return y;var a=s.position.container,b,c,d,e;C=1,s.style.height&&D.css("height",s.style.height),s.style.width?D.css("width",s.style.width):(D.css("width","").addClass(q),c=D.width()+1,d=D.css("max-width")||"",e=D.css("min-width")||"",b=(d+e).indexOf("%")>-1?a.width()/100:0,d=(d.indexOf("%")>-1?b:1)*parseInt(d,10)||c,e=(e.indexOf("%")>-1?b:1)*parseInt(e,10)||0,c=d+e?Math.min(Math.max(c,e),d):c,D.css("width",Math.round(c)).removeClass(q)),C=0;return y},disable:function(b){"boolean"!==typeof b&&(b=!D.hasClass(l)&&!G.disabled),y.rendered?(D.toggleClass(l,b),a.attr(D[0],"aria-disabled",b)):G.disabled=!!b;return y},enable:function(){return y.disable(c)},destroy:function(){var b=r[0],c=a.attr(b,t),d=r.data("qtip");y.rendered&&(D.stop(1,0).remove(),a.each(y.plugins,function(){this.destroy&&this.destroy()})),clearTimeout(y.timers.show),clearTimeout(y.timers.hide),Q();if(!d||y===d)a.removeData(b,"qtip"),s.suppress&&c&&(a.attr(b,"title",c),r.removeAttr(t)),r.removeAttr("aria-describedby");r.unbind(".qtip-"+v),delete i[y.id];return r}})}function w(b){var e;if(!b||"object"!==typeof b)return c;if(b.metadata===d||"object"!==typeof b.metadata)b.metadata={type:b.metadata};if("content"in b){if(b.content===d||"object"!==typeof b.content||b.content.jquery)b.content={text:b.content};e=b.content.text||c,!a.isFunction(e)&&(!e&&!e.attr||e.length<1||"object"===typeof e&&!e.jquery)&&(b.content.text=c);if("title"in b.content){if(b.content.title===d||"object"!==typeof b.content.title)b.content.title={text:b.content.title};e=b.content.title.text||c,!a.isFunction(e)&&(!e&&!e.attr||e.length<1||"object"===typeof e&&!e.jquery)&&(b.content.title.text=c)}}if("position"in b)if(b.position===d||"object"!==typeof b.position)b.position={my:b.position,at:b.position};if("show"in b)if(b.show===d||"object"!==typeof b.show)b.show.jquery?b.show={target:b.show}:b.show={event:b.show};if("hide"in b)if(b.hide===d||"object"!==typeof b.hide)b.hide.jquery?b.hide={target:b.hide}:b.hide={event:b.hide};if("style"in b)if(b.style===d||"object"!==typeof b.style)b.style={classes:b.style};a.each(g,function(){this.sanitize&&this.sanitize(b)});return b}function v(){v.history=v.history||[],v.history.push(arguments);if("object"===typeof console){var a=console[console.warn?"warn":"log"],b=Array.prototype.slice.call(arguments),c;typeof arguments[0]==="string"&&(b[0]="qTip2: "+b[0]),c=a.apply?a.apply(console,b):a(b)}}"use strict";var b=!0,c=!1,d=null,e,f,g,h,i={},j="ui-tooltip",k="ui-widget",l="ui-state-disabled",m="div.qtip."+j,n=j+"-default",o=j+"-focus",p=j+"-hover",q=j+"-fluid",r="-31000px",s="_replacedByqTip",t="oldtitle",u;f=a.fn.qtip=function(g,h,i){var j=(""+g).toLowerCase(),k=d,l=a.makeArray(arguments).slice(1),m=l[l.length-1],n=this[0]?a.data(this[0],"qtip"):d;if(!arguments.length&&n||j==="api")return n;if("string"===typeof g){this.each(function(){var d=a.data(this,"qtip");if(!d)return b;m&&m.timeStamp&&(d.cache.event=m);if(j!=="option"&&j!=="options"||!h)d[j]&&d[j].apply(d[j],l);else if(a.isPlainObject(h)||i!==e)d.set(h,i);else{k=d.get(h);return c}});return k!==d?k:this}if("object"===typeof g||!arguments.length){n=w(a.extend(b,{},g));return f.bind.call(this,n,m)}},f.bind=function(d,j){return this.each(function(k){function r(b){function d(){p.render(typeof b==="object"||l.show.ready),m.show.add(m.hide).unbind(o)}if(p.cache.disabled)return c;p.cache.event=a.extend({},b),p.cache.target=b?a(b.target):[e],l.show.delay>0?(clearTimeout(p.timers.show),p.timers.show=setTimeout(d,l.show.delay),n.show!==n.hide&&m.hide.bind(n.hide,function(){clearTimeout(p.timers.show)})):d()}var l,m,n,o,p,q;q=a.isArray(d.id)?d.id[k]:d.id,q=!q||q===c||q.length<1||i[q]?f.nextid++:i[q]=q,o=".qtip-"+q+"-create",p=y.call(this,q,d);if(p===c)return b;l=p.options,a.each(g,function(){this.initialize==="initialize"&&this(p)}),m={show:l.show.target,hide:l.hide.target},n={show:a.trim(""+l.show.event).replace(/ /g,o+" ")+o,hide:a.trim(""+l.hide.event).replace(/ /g,o+" ")+o},/mouse(over|enter)/i.test(n.show)&&!/mouse(out|leave)/i.test(n.hide)&&(n.hide+=" mouseleave"+o),m.show.bind("mousemove"+o,function(a){h={pageX:a.pageX,pageY:a.pageY,type:"mousemove"},p.cache.onTarget=b}),m.show.bind(n.show,r),(l.show.ready||l.prerender)&&r(j)})},g=f.plugins={Corner:function(a){a=(""+a).replace(/([A-Z])/," $1").replace(/middle/gi,"center").toLowerCase(),this.x=(a.match(/left|right/i)||a.match(/center/)||["inherit"])[0].toLowerCase(),this.y=(a.match(/top|bottom|center/i)||["inherit"])[0].toLowerCase();var b=a.charAt(0);this.precedance=b==="t"||b==="b"?"y":"x",this.string=function(){return this.precedance==="y"?this.y+this.x:this.x+this.y},this.abbrev=function(){var a=this.x.substr(0,1),b=this.y.substr(0,1);return a===b?a:a==="c"||a!=="c"&&b!=="c"?b+a:a+b},this.clone=function(){return{x:this.x,y:this.y,precedance:this.precedance,string:this.string,abbrev:this.abbrev,clone:this.clone}}},offset:function(b,c){function j(a,b){d.left+=b*a.scrollLeft(),d.top+=b*a.scrollTop()}var d=b.offset(),e=b.closest("body")[0],f=c,g,h,i;if(f){do f.css("position")!=="static"&&(h=f.position(),d.left-=h.left+(parseInt(f.css("borderLeftWidth"),10)||0)+(parseInt(f.css("marginLeft"),10)||0),d.top-=h.top+(parseInt(f.css("borderTopWidth"),10)||0)+(parseInt(f.css("marginTop"),10)||0),!g&&(i=f.css("overflow"))!=="hidden"&&i!=="visible"&&(g=f));while((f=a(f[0].offsetParent)).length);g&&g[0]!==e&&j(g,1)}return d},iOS:parseFloat((""+(/CPU.*OS ([0-9_]{1,3})|(CPU like).*AppleWebKit.*Mobile/i.exec(navigator.userAgent)||[0,""])[1]).replace("undefined","3_2").replace("_","."))||c,fn:{attr:function(b,c){if(this.length){var d=this[0],e="title",f=a.data(d,"qtip");if(b===e&&f&&"object"===typeof f&&f.options.suppress){if(arguments.length<2)return a.attr(d,t);f&&f.options.content.attr===e&&f.cache.attr&&f.set("content.text",c);return this.attr(t,c)}}return a.fn["attr"+s].apply(this,arguments)},clone:function(b){var c=a([]),d="title",e=a.fn["clone"+s].apply(this,arguments);b||e.filter("["+t+"]").attr("title",function(){return a.attr(this,t)}).removeAttr(t);return e}}},a.each(g.fn,function(c,d){if(!d||a.fn[c+s])return b;var e=a.fn[c+s]=a.fn[c];a.fn[c]=function(){return d.apply(this,arguments)||e.apply(this,arguments)}}),a.ui||(a["cleanData"+s]=a.cleanData,a.cleanData=function(b){for(var c=0,d;(d=b[c])!==e;c++)try{a(d).triggerHandler("removeqtip")}catch(f){}a["cleanData"+s](b)}),f.version="nightly",f.nextid=0,f.inactiveEvents="click dblclick mousedown mouseup mousemove mouseleave mouseenter".split(" "),f.zindex=15e3,f.defaults={prerender:c,id:c,overwrite:b,suppress:b,content:{text:b,attr:"title",title:{text:c,button:c}},position:{my:"top left",at:"bottom right",target:c,container:c,viewport:c,adjust:{x:0,y:0,mouse:b,resize:b,method:"flip flip"},effect:function(b,d,e){a(this).animate(d,{duration:200,queue:c})}},show:{target:c,event:"mouseenter",effect:b,delay:90,solo:c,ready:c,autofocus:c},hide:{target:c,event:"mouseleave",effect:b,delay:0,fixed:c,inactive:c,leave:"window",distance:c},style:{classes:"",widget:c,width:c,height:c,def:b},events:{render:d,move:d,show:d,hide:d,toggle:d,visible:d,hidden:d,focus:d,blur:d}},g.tip=function(a){var b=a.plugins.tip;return"object"===typeof b?b:a.plugins.tip=new A(a)},g.tip.initialize="render",g.tip.sanitize=function(a){var c=a.style,d;c&&"tip"in c&&(d=a.style.tip,typeof d!=="object"&&(a.style.tip={corner:d}),/string|boolean/i.test(typeof d.corner)||(d.corner=b),typeof d.width!=="number"&&delete d.width,typeof d.height!=="number"&&delete d.height,typeof d.border!=="number"&&d.border!==b&&delete d.border,typeof d.offset!=="number"&&delete d.offset)},a.extend(b,f.defaults,{style:{tip:{corner:b,mimic:c,width:6,height:6,border:b,offset:0}}}),g.svg=function(b,c){var d=a(document),e=b[0],f={width:0,height:0,offset:{top:1e10,left:1e10}},g,h,i,j,k;if(e.getBBox&&e.parentNode){g=e.getBBox(),h=e.getScreenCTM(),i=e.farthestViewportElement||e;if(!i.createSVGPoint)return f;j=i.createSVGPoint(),j.x=g.x,j.y=g.y,k=j.matrixTransform(h),f.offset.left=k.x,f.offset.top=k.y,j.x+=g.width,j.y+=g.height,k=j.matrixTransform(h),f.width=k.x-f.offset.left,f.height=k.y-f.offset.top,f.offset.left+=d.scrollLeft(),f.offset.top+=d.scrollTop()}return f},g.modal=function(a){var b=a.plugins.modal;return"object"===typeof b?b:a.plugins.modal=new B(a)},g.modal.initialize="render",g.modal.sanitize=function(a){a.show&&(typeof a.show.modal!=="object"?a.show.modal={on:!!a.show.modal}:typeof a.show.modal.on==="undefined"&&(a.show.modal.on=b))},g.modal.zindex=f.zindex+1e3,a.extend(b,f.defaults,{show:{modal:{on:c,effect:b,blur:b,escape:b}}})});
// Underscore.js 1.3.3
// (c) 2009-2012 Jeremy Ashkenas, DocumentCloud Inc.
// Underscore is freely distributable under the MIT license.
// Portions of Underscore are inspired or borrowed from Prototype,
// Oliver Steele's Functional, and John Resig's Micro-Templating.
// For all details and documentation:
// http://documentcloud.github.com/underscore
(function(){function r(a,c,d){if(a===c)return 0!==a||1/a==1/c;if(null==a||null==c)return a===c;a._chain&&(a=a._wrapped);c._chain&&(c=c._wrapped);if(a.isEqual&&b.isFunction(a.isEqual))return a.isEqual(c);if(c.isEqual&&b.isFunction(c.isEqual))return c.isEqual(a);var e=l.call(a);if(e!=l.call(c))return!1;switch(e){case "[object String]":return a==""+c;case "[object Number]":return a!=+a?c!=+c:0==a?1/a==1/c:a==+c;case "[object Date]":case "[object Boolean]":return+a==+c;case "[object RegExp]":return a.source==
c.source&&a.global==c.global&&a.multiline==c.multiline&&a.ignoreCase==c.ignoreCase}if("object"!=typeof a||"object"!=typeof c)return!1;for(var f=d.length;f--;)if(d[f]==a)return!0;d.push(a);var f=0,g=!0;if("[object Array]"==e){if(f=a.length,g=f==c.length)for(;f--&&(g=f in a==f in c&&r(a[f],c[f],d)););}else{if("constructor"in a!="constructor"in c||a.constructor!=c.constructor)return!1;for(var h in a)if(b.has(a,h)&&(f++,!(g=b.has(c,h)&&r(a[h],c[h],d))))break;if(g){for(h in c)if(b.has(c,h)&&!f--)break;
g=!f}}d.pop();return g}var s=this,I=s._,o={},k=Array.prototype,p=Object.prototype,i=k.slice,J=k.unshift,l=p.toString,K=p.hasOwnProperty,y=k.forEach,z=k.map,A=k.reduce,B=k.reduceRight,C=k.filter,D=k.every,E=k.some,q=k.indexOf,F=k.lastIndexOf,p=Array.isArray,L=Object.keys,t=Function.prototype.bind,b=function(a){return new m(a)};"undefined"!==typeof exports?("undefined"!==typeof module&&module.exports&&(exports=module.exports=b),exports._=b):s._=b;b.VERSION="1.3.3";var j=b.each=b.forEach=function(a,
c,d){if(a!=null)if(y&&a.forEach===y)a.forEach(c,d);else if(a.length===+a.length)for(var e=0,f=a.length;e<f;e++){if(e in a&&c.call(d,a[e],e,a)===o)break}else for(e in a)if(b.has(a,e)&&c.call(d,a[e],e,a)===o)break};b.map=b.collect=function(a,c,b){var e=[];if(a==null)return e;if(z&&a.map===z)return a.map(c,b);j(a,function(a,g,h){e[e.length]=c.call(b,a,g,h)});if(a.length===+a.length)e.length=a.length;return e};b.reduce=b.foldl=b.inject=function(a,c,d,e){var f=arguments.length>2;a==null&&(a=[]);if(A&&
a.reduce===A){e&&(c=b.bind(c,e));return f?a.reduce(c,d):a.reduce(c)}j(a,function(a,b,i){if(f)d=c.call(e,d,a,b,i);else{d=a;f=true}});if(!f)throw new TypeError("Reduce of empty array with no initial value");return d};b.reduceRight=b.foldr=function(a,c,d,e){var f=arguments.length>2;a==null&&(a=[]);if(B&&a.reduceRight===B){e&&(c=b.bind(c,e));return f?a.reduceRight(c,d):a.reduceRight(c)}var g=b.toArray(a).reverse();e&&!f&&(c=b.bind(c,e));return f?b.reduce(g,c,d,e):b.reduce(g,c)};b.find=b.detect=function(a,
c,b){var e;G(a,function(a,g,h){if(c.call(b,a,g,h)){e=a;return true}});return e};b.filter=b.select=function(a,c,b){var e=[];if(a==null)return e;if(C&&a.filter===C)return a.filter(c,b);j(a,function(a,g,h){c.call(b,a,g,h)&&(e[e.length]=a)});return e};b.reject=function(a,c,b){var e=[];if(a==null)return e;j(a,function(a,g,h){c.call(b,a,g,h)||(e[e.length]=a)});return e};b.every=b.all=function(a,c,b){var e=true;if(a==null)return e;if(D&&a.every===D)return a.every(c,b);j(a,function(a,g,h){if(!(e=e&&c.call(b,
a,g,h)))return o});return!!e};var G=b.some=b.any=function(a,c,d){c||(c=b.identity);var e=false;if(a==null)return e;if(E&&a.some===E)return a.some(c,d);j(a,function(a,b,h){if(e||(e=c.call(d,a,b,h)))return o});return!!e};b.include=b.contains=function(a,c){var b=false;if(a==null)return b;if(q&&a.indexOf===q)return a.indexOf(c)!=-1;return b=G(a,function(a){return a===c})};b.invoke=function(a,c){var d=i.call(arguments,2);return b.map(a,function(a){return(b.isFunction(c)?c||a:a[c]).apply(a,d)})};b.pluck=
function(a,c){return b.map(a,function(a){return a[c]})};b.max=function(a,c,d){if(!c&&b.isArray(a)&&a[0]===+a[0])return Math.max.apply(Math,a);if(!c&&b.isEmpty(a))return-Infinity;var e={computed:-Infinity};j(a,function(a,b,h){b=c?c.call(d,a,b,h):a;b>=e.computed&&(e={value:a,computed:b})});return e.value};b.min=function(a,c,d){if(!c&&b.isArray(a)&&a[0]===+a[0])return Math.min.apply(Math,a);if(!c&&b.isEmpty(a))return Infinity;var e={computed:Infinity};j(a,function(a,b,h){b=c?c.call(d,a,b,h):a;b<e.computed&&
(e={value:a,computed:b})});return e.value};b.shuffle=function(a){var b=[],d;j(a,function(a,f){d=Math.floor(Math.random()*(f+1));b[f]=b[d];b[d]=a});return b};b.sortBy=function(a,c,d){var e=b.isFunction(c)?c:function(a){return a[c]};return b.pluck(b.map(a,function(a,b,c){return{value:a,criteria:e.call(d,a,b,c)}}).sort(function(a,b){var c=a.criteria,d=b.criteria;return c===void 0?1:d===void 0?-1:c<d?-1:c>d?1:0}),"value")};b.groupBy=function(a,c){var d={},e=b.isFunction(c)?c:function(a){return a[c]};
j(a,function(a,b){var c=e(a,b);(d[c]||(d[c]=[])).push(a)});return d};b.sortedIndex=function(a,c,d){d||(d=b.identity);for(var e=0,f=a.length;e<f;){var g=e+f>>1;d(a[g])<d(c)?e=g+1:f=g}return e};b.toArray=function(a){return!a?[]:b.isArray(a)||b.isArguments(a)?i.call(a):a.toArray&&b.isFunction(a.toArray)?a.toArray():b.values(a)};b.size=function(a){return b.isArray(a)?a.length:b.keys(a).length};b.first=b.head=b.take=function(a,b,d){return b!=null&&!d?i.call(a,0,b):a[0]};b.initial=function(a,b,d){return i.call(a,
0,a.length-(b==null||d?1:b))};b.last=function(a,b,d){return b!=null&&!d?i.call(a,Math.max(a.length-b,0)):a[a.length-1]};b.rest=b.tail=function(a,b,d){return i.call(a,b==null||d?1:b)};b.compact=function(a){return b.filter(a,function(a){return!!a})};b.flatten=function(a,c){return b.reduce(a,function(a,e){if(b.isArray(e))return a.concat(c?e:b.flatten(e));a[a.length]=e;return a},[])};b.without=function(a){return b.difference(a,i.call(arguments,1))};b.uniq=b.unique=function(a,c,d){var d=d?b.map(a,d):a,
e=[];a.length<3&&(c=true);b.reduce(d,function(d,g,h){if(c?b.last(d)!==g||!d.length:!b.include(d,g)){d.push(g);e.push(a[h])}return d},[]);return e};b.union=function(){return b.uniq(b.flatten(arguments,true))};b.intersection=b.intersect=function(a){var c=i.call(arguments,1);return b.filter(b.uniq(a),function(a){return b.every(c,function(c){return b.indexOf(c,a)>=0})})};b.difference=function(a){var c=b.flatten(i.call(arguments,1),true);return b.filter(a,function(a){return!b.include(c,a)})};b.zip=function(){for(var a=
i.call(arguments),c=b.max(b.pluck(a,"length")),d=Array(c),e=0;e<c;e++)d[e]=b.pluck(a,""+e);return d};b.indexOf=function(a,c,d){if(a==null)return-1;var e;if(d){d=b.sortedIndex(a,c);return a[d]===c?d:-1}if(q&&a.indexOf===q)return a.indexOf(c);d=0;for(e=a.length;d<e;d++)if(d in a&&a[d]===c)return d;return-1};b.lastIndexOf=function(a,b){if(a==null)return-1;if(F&&a.lastIndexOf===F)return a.lastIndexOf(b);for(var d=a.length;d--;)if(d in a&&a[d]===b)return d;return-1};b.range=function(a,b,d){if(arguments.length<=
1){b=a||0;a=0}for(var d=arguments[2]||1,e=Math.max(Math.ceil((b-a)/d),0),f=0,g=Array(e);f<e;){g[f++]=a;a=a+d}return g};var H=function(){};b.bind=function(a,c){var d,e;if(a.bind===t&&t)return t.apply(a,i.call(arguments,1));if(!b.isFunction(a))throw new TypeError;e=i.call(arguments,2);return d=function(){if(!(this instanceof d))return a.apply(c,e.concat(i.call(arguments)));H.prototype=a.prototype;var b=new H,g=a.apply(b,e.concat(i.call(arguments)));return Object(g)===g?g:b}};b.bindAll=function(a){var c=
i.call(arguments,1);c.length==0&&(c=b.functions(a));j(c,function(c){a[c]=b.bind(a[c],a)});return a};b.memoize=function(a,c){var d={};c||(c=b.identity);return function(){var e=c.apply(this,arguments);return b.has(d,e)?d[e]:d[e]=a.apply(this,arguments)}};b.delay=function(a,b){var d=i.call(arguments,2);return setTimeout(function(){return a.apply(null,d)},b)};b.defer=function(a){return b.delay.apply(b,[a,1].concat(i.call(arguments,1)))};b.throttle=function(a,c){var d,e,f,g,h,i,j=b.debounce(function(){h=
g=false},c);return function(){d=this;e=arguments;f||(f=setTimeout(function(){f=null;h&&a.apply(d,e);j()},c));g?h=true:i=a.apply(d,e);j();g=true;return i}};b.debounce=function(a,b,d){var e;return function(){var f=this,g=arguments;d&&!e&&a.apply(f,g);clearTimeout(e);e=setTimeout(function(){e=null;d||a.apply(f,g)},b)}};b.once=function(a){var b=false,d;return function(){if(b)return d;b=true;return d=a.apply(this,arguments)}};b.wrap=function(a,b){return function(){var d=[a].concat(i.call(arguments,0));
return b.apply(this,d)}};b.compose=function(){var a=arguments;return function(){for(var b=arguments,d=a.length-1;d>=0;d--)b=[a[d].apply(this,b)];return b[0]}};b.after=function(a,b){return a<=0?b():function(){if(--a<1)return b.apply(this,arguments)}};b.keys=L||function(a){if(a!==Object(a))throw new TypeError("Invalid object");var c=[],d;for(d in a)b.has(a,d)&&(c[c.length]=d);return c};b.values=function(a){return b.map(a,b.identity)};b.functions=b.methods=function(a){var c=[],d;for(d in a)b.isFunction(a[d])&&
c.push(d);return c.sort()};b.extend=function(a){j(i.call(arguments,1),function(b){for(var d in b)a[d]=b[d]});return a};b.pick=function(a){var c={};j(b.flatten(i.call(arguments,1)),function(b){b in a&&(c[b]=a[b])});return c};b.defaults=function(a){j(i.call(arguments,1),function(b){for(var d in b)a[d]==null&&(a[d]=b[d])});return a};b.clone=function(a){return!b.isObject(a)?a:b.isArray(a)?a.slice():b.extend({},a)};b.tap=function(a,b){b(a);return a};b.isEqual=function(a,b){return r(a,b,[])};b.isEmpty=
function(a){if(a==null)return true;if(b.isArray(a)||b.isString(a))return a.length===0;for(var c in a)if(b.has(a,c))return false;return true};b.isElement=function(a){return!!(a&&a.nodeType==1)};b.isArray=p||function(a){return l.call(a)=="[object Array]"};b.isObject=function(a){return a===Object(a)};b.isArguments=function(a){return l.call(a)=="[object Arguments]"};b.isArguments(arguments)||(b.isArguments=function(a){return!(!a||!b.has(a,"callee"))});b.isFunction=function(a){return l.call(a)=="[object Function]"};
b.isString=function(a){return l.call(a)=="[object String]"};b.isNumber=function(a){return l.call(a)=="[object Number]"};b.isFinite=function(a){return b.isNumber(a)&&isFinite(a)};b.isNaN=function(a){return a!==a};b.isBoolean=function(a){return a===true||a===false||l.call(a)=="[object Boolean]"};b.isDate=function(a){return l.call(a)=="[object Date]"};b.isRegExp=function(a){return l.call(a)=="[object RegExp]"};b.isNull=function(a){return a===null};b.isUndefined=function(a){return a===void 0};b.has=function(a,
b){return K.call(a,b)};b.noConflict=function(){s._=I;return this};b.identity=function(a){return a};b.times=function(a,b,d){for(var e=0;e<a;e++)b.call(d,e)};b.escape=function(a){return(""+a).replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;").replace(/'/g,"&#x27;").replace(/\//g,"&#x2F;")};b.result=function(a,c){if(a==null)return null;var d=a[c];return b.isFunction(d)?d.call(a):d};b.mixin=function(a){j(b.functions(a),function(c){M(c,b[c]=a[c])})};var N=0;b.uniqueId=
function(a){var b=N++;return a?a+b:b};b.templateSettings={evaluate:/<%([\s\S]+?)%>/g,interpolate:/<%=([\s\S]+?)%>/g,escape:/<%-([\s\S]+?)%>/g};var u=/.^/,n={"\\":"\\","'":"'",r:"\r",n:"\n",t:"\t",u2028:"\u2028",u2029:"\u2029"},v;for(v in n)n[n[v]]=v;var O=/\\|'|\r|\n|\t|\u2028|\u2029/g,P=/\\(\\|'|r|n|t|u2028|u2029)/g,w=function(a){return a.replace(P,function(a,b){return n[b]})};b.template=function(a,c,d){d=b.defaults(d||{},b.templateSettings);a="__p+='"+a.replace(O,function(a){return"\\"+n[a]}).replace(d.escape||
u,function(a,b){return"'+\n_.escape("+w(b)+")+\n'"}).replace(d.interpolate||u,function(a,b){return"'+\n("+w(b)+")+\n'"}).replace(d.evaluate||u,function(a,b){return"';\n"+w(b)+"\n;__p+='"})+"';\n";d.variable||(a="with(obj||{}){\n"+a+"}\n");var a="var __p='';var print=function(){__p+=Array.prototype.join.call(arguments, '')};\n"+a+"return __p;\n",e=new Function(d.variable||"obj","_",a);if(c)return e(c,b);c=function(a){return e.call(this,a,b)};c.source="function("+(d.variable||"obj")+"){\n"+a+"}";return c};
b.chain=function(a){return b(a).chain()};var m=function(a){this._wrapped=a};b.prototype=m.prototype;var x=function(a,c){return c?b(a).chain():a},M=function(a,c){m.prototype[a]=function(){var a=i.call(arguments);J.call(a,this._wrapped);return x(c.apply(b,a),this._chain)}};b.mixin(b);j("pop,push,reverse,shift,sort,splice,unshift".split(","),function(a){var b=k[a];m.prototype[a]=function(){var d=this._wrapped;b.apply(d,arguments);var e=d.length;(a=="shift"||a=="splice")&&e===0&&delete d[0];return x(d,
this._chain)}});j(["concat","join","slice"],function(a){var b=k[a];m.prototype[a]=function(){return x(b.apply(this._wrapped,arguments),this._chain)}});m.prototype.chain=function(){this._chain=true;return this};m.prototype.value=function(){return this._wrapped}}).call(this);

/*	Emoome.js
	Author: Brennan Novak
	Copyright: Emoome, 2012
	Contact: info@emoo.me
*/

/* Global Values */
var type_colors		= {"E":"#ff0000","I":"#142bd7","D":"#dcca07","S":"#0aa80e","A":"#ee9700","P":"#cf00ee","U":"#c3c3c3"}
var word_types		= {"E":"Emotional","I":"Intellectual","D":"Descriptive","S":"Sensory","A":"Action","P":"Physical","U":"Undecided"};
var word_types_sub	= {"M":"Moral","S":"Slang","P":"Perception","Y":"Psychological","L":"Feeling","F":"Food","C":"Common","U":"Undecided"}
var speech_types	= {"V":"Verb","N":"Noun","P":"Pro Noun","A":"Adjective","D":"Adverb","R":"Prepositon","C":"Conjunction","I":"Interjection"};



/* User Messages */
var messages = {
	"log_feeling_complete" : [
		"Every entry helps us build your emotional map",
		"We suggest logging 1-3 entries per day",
		"Try logging entries at different times of the day",
		"The best entries are when you feel something strongly",
		"If something is hard to describe it is a good entry",
		"The best entries are moments that seem important",
		"Had an intense experience? Log an entry for later analysis"
	],
	"memory_quote" : [
		"Memory is the scribe of the soul. ~Aristotle",
		"It is a poor sort of memory that only works backwards. ~Lewis Carroll"
	]
}

/* Data Objects */
var log_feeling_time = {
	time_feeling : '',
	time_action : '',
	time_describe : ''
}

/* Pages */
var pages_views	= new Array('content_index', 'content_login', 'content_signup');

/* Device Size */
var visualization_sizes = {
	"mobile" : {
		"circle_word_types" : 50,
		"circle_strong_experiences" : 5
	},
	"tablet" : {
		"circle_word_types" : 75,
		"circle_strong_experiences" : 10
	},
	"web" : {
		"circle_word_types"	: 100,
		"circle_strong_experiences" : 10
	}
} 

/* General Functions */
function requestMade(message)
{	
	$('#lightbox_message').removeClass('lightbox_message_success lightbox_message_error').addClass('lightbox_message_normal').html(message);
	$('#request_lightbox').delay(250).fadeIn();

	// Adjust Height For Device
	if (user_data.source == 'mobile')
	{
		var new_lightbox_height = $('body').height() + 150;	
		var new_lightbox_scroll	= $(window).scrollTop() + 50;
	}
	else
	{
		var new_lightbox_height = $('body').height() + 100;
		var new_lightbox_scroll = $(window).scrollTop() + 100;
	}

	$('#lightbox_message').css('top', new_lightbox_scroll);
	$('#request_lightbox').height(new_lightbox_height);

	return false;
}

function requestComplete(message, status)
{
	$('#lightbox_message').html(message);
	
	if (status == 'success')
	{
		$('#lightbox_message').addClass('lightbox_message_success');
		$("#request_lightbox").delay(1500).fadeOut();
	}
	else
	{
		$('#lightbox_message').addClass('lightbox_message_error');
		$("#request_lightbox").delay(2500).fadeOut();		
	}
	
	return false;
}

function printUserMessage(message)
{
	$('#lightbox_message').removeClass('lightbox_message_success lightbox_message_error').addClass('lightbox_message_normal').html(message);
	$('#request_lightbox').delay(250).fadeIn();
	$("#request_lightbox").delay(1500).fadeOut();

	//$('#content_message').notify({status:'success',message:message});
}


/* Log - Feeling */
function logFeelingStart()
{
	/// Get Geo
	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(showPosition, geoErrorHandler);	
	}

	// Get Start Time
	log_feeling_time.time_feeling = new Date().getTime();

	$('#log_feeling').delay(250).fadeIn('slow');
}


function logFeeling()
{
	$.validator(
	{
		elements :
			[{
				'selector' 	: '#log_val_feeling',
				'rule'		: 'require', 
				'field'		: 'Feeling'
			}],
		message : 'Enter a ',
		success	: function()
		{
			logFeelingComplete();
		},
		failed : function()
		{
			printUserMessage('Please enter how you feel right now');
		}
	});
}

function logFeelingComplete()
{
	// Stamp Times
	log_feeling_time.time_feeling	= getTimeSpent(log_feeling_time.time_feeling);
	log_feeling_time.time_action	= new Date().getTime();

	//jQT.goTo('#log_action', 'slideleft');
	$('#log_feeling').fadeOut();
	$('#log_action').delay(500).fadeIn();
}

function logAction()
{
	// Set Action
	$('#log_describe_this').html('"' + $('#log_val_action').val() + '"');

	$.validator(
	{
		elements :
			[{
				'selector' 	: '#log_val_action',
				'rule'		: 'require', 
				'field'		: 'Action'
			}],
		message : 'Enter a ',
		success	: function()
		{
			logActionComplete();
		},
		failed : function()
		{
			printUserMessage('Please enter one thing you did today');
		}
	});
}

function logActionComplete()
{
	// Get Start Time
	log_feeling_time.time_action	= getTimeSpent(log_feeling_time.time_action);
	log_feeling_time.time_describe	= new Date().getTime();

	//jQT.goTo('#log_action', 'slideleft');
	$('#log_action').fadeOut();
	$('#log_describe').delay(500).fadeIn();

}

function logDescribe()
{
	$.validator(
	{
		elements :
			[{
				'selector' 	: '#log_val_describe_1',
				'rule'		: 'require', 
				'field'		: 'Describe 1'
			},{
				'selector' 	: '#log_val_describe_2',
				'rule'		: 'require',
				'field'		: 'Describe 2'
			},{
				'selector' 	: '#log_val_describe_3',
				'rule'		: 'require',
				'field'		: 'Describe 3'
			}],
		message : 'Enter a ',
		success	: function()
		{
			log_feeling_time.time_describe = getTimeSpent(log_feeling_time.time_describe);
		
			var log_data = $('#log_data').serializeArray();
			var log_time = 0;

			log_data.push({'name' : 'source', 'value' : user_data.source });
			log_data.push({'name' : 'feeling', 'value' : $('#log_val_feeling').val() });
			log_data.push({'name' : 'action', 'value' : $('#log_val_action').val() });
			log_data.push({'name' : 'describe_1', 'value' : $('#log_val_describe_1').val() });
			log_data.push({'name' : 'describe_2', 'value' : $('#log_val_describe_2').val() });
			log_data.push({'name' : 'describe_3', 'value' : $('#log_val_describe_3').val() });
			log_data.push({'name' : 'geo_lat', 'value' : user_data.geo_lat });
			log_data.push({'name' : 'geo_lon', 'value' : user_data.geo_lon });

			
			// Time Data
			for (time in log_feeling_time)
			{
				log_time += log_feeling_time[time];
				log_data.push({'name' : time, 'value' : log_feeling_time[time]});
			}
			
			log_data.push({'name' : 'time_total', 'value' : log_time});

			// Save Data To API
			$.oauthAjax(
			{
				oauth 		: user_data,		
				url			: base_url + 'api/emoome/log_feeling',
				type		: 'POST',
				dataType	: 'json',
				data		: log_data,
				beforeSend	: requestMade('Saving your entry'),
			  	success		: function(result)
			  	{
					// Close Loading
		  			requestComplete(result.message, result.status);
					
					if (result.status == 'success')
					{
						// Clean Data & Completion
				  		$('#log_val_feeling').val('');
				  		$('#log_val_action').val('');
				  		$('#log_val_describe_1').val('');
				  		$('#log_val_describe_2').val('');
				  		$('#log_val_describe_3').val('');
				  		$('#log_describe_this').html('');

						$('#log_describe').fadeOut();
						
						// Show Completion View
						var new_array = _.shuffle(messages.log_feeling_complete);
						$('#log_completion_message').html(new_array[0]);
						$('#log_thanks').delay(500).fadeIn();
					}
			  	}			  			
			});
		},
		failed : function()
		{
			printUserMessage('Please enter three words to describe what you did today');
		}
	});
}

function logThanks()
{
	//jQT.goTo('#log_action', 'slideleft');
	$('#log_thanks').fadeOut();
	logFeelingStart();
}



/* Utility Functions */
function countElementsArray(item, array)
{
    var count = 0;
	if (array !== undefined)
	{
    	$.each(array, function(i,v) { if (v === item) count++; });
   	}

    return count;
}

function getTimeSpent(start_time)
{
	now_time = new Date().getTime();	
	return now_time - start_time;
}

	
/* Geo Location */
function showPosition(position)
{	
	user_data.geo_lat = position.coords.latitude;
	user_data.geo_lon = position.coords.longitude;
}

// report errors to user
function geoErrorHandler(error)
{
	switch (error.code)
	{ 
		case error.PERMISSION_DENIED:
			alert("Maybe next time try enabling location as the more details you provide, the more meaning we can give you :)");
		break;
		case error.POSITION_UNAVAILABLE:
			//alert("Dang, we could not get your position as this is not available right now");
		break;
		case error.TIMEOUT:
			//alert("Attempt to get position timed out");
		break;
	default:
			//alert("Sorry, an error occurred. Code: " + error.code + " Message: " + error.message);
		break;	
	}
}


function determineView()
{
	var current_url	= document.location.hash.replace('#!/','');

	if (current_url.length != '') 
	{		
		var this_view = 'content_' + current_url;	

		$.each(pages_views, function(key, view)
		{	
			if (view == this_view)
			{
				$('#' + view).delay(250).fadeIn();			
			}
			else
			{
				$('#' + view).hide();
			}
		});
	}
	else
	{					
		$.each(pages_views, function(key, view)
		{	
			$('#' + view).hide();
		});
		
		$('#content_index').fadeIn('');
	}
}


function showWebLogged(name, image)
{
	// Set User Data
	$('#header_logged_avatar').html('<a href="' + base_url + 'record/feeling/"><img src="' + image + '" border="0"></a>');
	$('#header_logged_name').html('<a href="' + base_url + 'record/feeling">' + name + '</a>');
	
	var entry_count = 175;
	
	$('#header_logged_count').html("Welcome to emoome");

	// Show Header
	$('#header_not_logged').hide();
	$('#header_logged').fadeIn('normal');
}

function showMobileLogged(name)
{
	// Set User Data
	$('#header_logged_name').html('<a href="' + base_url + 'record/feeling">' + name + '</a>');		

	// Show Header
	$('#toolbar_public').hide();
	$('#toolbar_logged').fadeIn('normal');
}



/* Thought Demo Stuff for Hackday */
function logThoughtStart()
{
	/// Get Geo
	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(showPosition, geoErrorHandler);	
	}

	$('#log_thought').delay(250).fadeIn('slow');
}


function logThought()
{
	$.validator(
	{
		elements :
			[{
				'selector' 	: '#log_val_thought',
				'rule'		: 'require', 
				'field'		: 'Thought'
			}],
		message : 'Enter a ',
		success	: function()
		{			
			var log_data = $('#log_data').serializeArray();
			log_data.push({'name' : 'category_id', 'value' : 9 });
			log_data.push({'name' : 'source', 'value' : user_data.source });
			log_data.push({'name' : 'log_thought', 'value' : $('#log_val_thought').val() });

			console.log(log_data);

			// Save Data To API
			$.oauthAjax(
			{
				oauth 		: user_data,		
				url			: base_url + 'api/emoome/log_thought',
				type		: 'POST',
				dataType	: 'json',
				data		: log_data,
				beforeSend	: requestMade('Saving your entry'),
			  	success		: function(result)
			  	{
					// Close Loading
		  			requestComplete(result.message, result.status);
					
					if (result.status == 'success')
					{
						// Clean Data & Completion
				  		$('#log_val_thought').val('');

						$('#log_thought').fadeOut();
						
						// Show Completion View
						$('#log_completion_message').html('Great, thanks for logging your thought');
						$('#log_thanks').delay(500).fadeIn();
					}
			  	}			  			
			});
		},
		failed : function()
		{
			printUserMessage('Please enter your thought');
		}
	});
}

function logThoughtThanks()
{
	//jQT.goTo('#log_action', 'slideleft');
	$('#log_thanks').fadeOut();
	logThoughtStart();
}


function renderSentimentHuman(sentiment, count)
{
	var absolute_good	= 5 * count;
	var absolute_bad 	= -5 * count;
	var	range_good		= absolute_good / 4;
	var	range_bad		= absolute_bad / 4;
	var feeling			= '';
	
	if (sentiment > range_good)
	{
		feeling = 'Really Good';
	}
	else if (sentiment > 0)
	{
		feeling = 'Decent';
	}
	else if (sentiment < 0)
	{
		feeling = 'Could Be Better';
	}
	else if (sentiment < range_bad)
	{
		feeling = 'Really Bad';
	}
	else
	{
		feeling = 'Ok';
	}
	
	return feeling;
}


// Live Actions
$(document).ready(function()
{
	// Main Nav Buttons
	$('.navigation_button').bind('click', function(e)
	{	
		var view = $(this).attr('href').split('#!/');
		
		// Is Index
		if (view.length == 1)
		{
			e.preventDefault();
		
			history.pushState("", document.title, window.location.pathname + window.location.search);
			$.each(pages_views, function(key, view)
			{	
				$('#' + view).hide();
			});	
	
			$('#content_index').delay(250).fadeIn();			
		}
		else
		{		
			$.each(pages_views, function(key, view)
			{	
				$('#' + view).hide();
			});
	
			$('#content_' + view[1]).delay(250).fadeIn();	
		}
	});

	// Login
	$('#user_login').bind('submit', function(e)
	{	
		e.preventDefault();
		$.validator(
		{
			elements :
				[{
					'selector' 	: '#login_email', 
					'rule'		: 'email', 
					'field'		: 'Please enter a valid Email',
					'action'	: 'label'	
				},{
					'selector' 	: '#login_password', 
					'rule'		: 'require', 
					'field'		: 'Please enter your Password',
					'action'	: 'label'
				}],
			message : '',
			success	: function()
			{
				var login_data = $('#user_login').serializeArray();
				login_data.push({'name':'session','value':'1'});
			
				$.ajax(
				{
					url			: base_url + 'api/users/login',
					type		: 'POST',
					dataType	: 'json',
					data		: login_data,
					beforeSend	: requestMade('Logging You In'),					
			  		success		: function(result)
			  		{
			  			console.log(result);
			  		
						// Close Loading
			  			requestComplete(result.message, result.status);
	  			  		
						if (result.status == 'success')
						{							
							processLogin(result.user, result.meta);
						}
				 	}
				});
			}
		});
	});

	// Signup
	$("#user_signup").bind('submit', function(e)
	{	
		e.preventDefault();	
		$.validator(
		{
			elements :		
				[{
					'selector' 	: '#signup_name', 
					'rule'		: 'require', 
					'field'		: 'Enter your name',
					'action'	: 'label'					
				},{
					'selector' 	: '#signup_email', 
					'rule'		: 'email', 
					'field'		: 'Please enter a valid email',
					'action'	: 'label'							
				},{
					'selector' 	: '#signup_password',
					'rule'		: 'require', 
					'field'		: 'Please enter a password',
					'action'	: 'label'					
				}],
			message : '',
			success	: function()
			{					
				var signup_data = $('#user_signup').serializeArray();
				signup_data.push({'name':'session','value':'1'},{'name':'password_confirm','value':$('#signup_password').val()});
				$.ajax(
				{
					url			: base_url + 'api/users/signup',
					type		: 'POST',
					dataType	: 'json',
					data		: signup_data,
					beforeSend	: requestMade('Creating Account'),
			  		success		: function(result)
			  		{			  		
						// Close Loading
			  			requestComplete(result.message, result.status);	
	
						if (result.status == 'success')
						{							
							processSignup(result.user, result.meta);
						}
				 	}
				});
			}
		});
	});	
	
	// Signup
	$("#user_signup_short").bind('submit', function(e)
	{	
		e.preventDefault();	
		$.validator(
		{
			elements :		
				[{
					'selector' 	: '#signup_name_short', 
					'rule'		: 'require', 
					'field'		: 'Enter your name',
					'action'	: 'label'					
				},{
					'selector' 	: '#signup_email_short', 
					'rule'		: 'email', 
					'field'		: 'Please enter a valid email',
					'action'	: 'label'							
				},{
					'selector' 	: '#signup_password_short',
					'rule'		: 'require', 
					'field'		: 'Please enter a password',
					'action'	: 'label'					
				}],
			message : '',
			success	: function()
			{					
				var signup_data = $('#user_signup_short').serializeArray();
				signup_data.push({'name':'session','value':'1'},{'name':'password_confirm','value':$('#signup_password_short').val()});
				$.ajax(
				{
					url			: base_url + 'api/users/signup',
					type		: 'POST',
					dataType	: 'json',
					data		: signup_data,
					beforeSend	: requestMade('Creating Account'),
			  		success		: function(result)
			  		{
						// Close Loading
			  			requestComplete(result.message, result.status);	
	
						if (result.status == 'success')
						{							
							$('[name=name]').val('');
							$('[name=email]').val('');
							$('[name=password]').val('');

							// Update URL & View
							window.location = 'record/feeling';
						}
				 	}
				});
			}
		});
	});	
	
	// Hijack Spacebar in a few places...
	$('#log_val_feeling').jkey('space, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0', function(key)
	{		
		printUserMessage('Enter only a single word (no spaces or numbers)');
	});

	$('#log_val_describe_1, #log_val_describe_2, #log_val_describe_3').jkey('space, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0', function()
	{
		printUserMessage('Enter only a single word (no spaces or numbers)');
	});	

});
