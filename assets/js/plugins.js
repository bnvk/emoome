/* Copyright (c) 2011 Oscar Godson ( http://oscargodson.com ) and Sebastian Nitu ( http://sebnitu.com ) More infomation on http://oscargodson.com/labs/jkey or fork it at https://github.com/OscarGodson/jKey */
(function(a){a.fn.jkey=function(b,c,d){function l(a){var b,c={};for(b in a){if(a.hasOwnProperty(b)){c[a[b]]=b}}return c}var e=this;if(this[0] && !this[0].parentNode){e=document}var f={a:65,b:66,c:67,d:68,e:69,f:70,g:71,h:72,i:73,j:74,k:75,l:76,m:77,n:78,o:79,p:80,q:81,r:82,s:83,t:84,u:85,v:86,w:87,x:88,y:89,z:90,0:48,1:49,2:50,3:51,4:52,5:53,6:54,7:55,8:56,9:57,f1:112,f2:113,f3:114,f4:115,f5:116,f6:117,f7:118,f8:119,f9:120,f10:121,f11:122,f12:123,shift:16,ctrl:17,control:17,alt:18,option:18,opt:18,cmd:224,command:224,fn:255,"function":255,backspace:8,osxdelete:8,enter:13,"return":13,space:32,spacebar:32,esc:27,escape:27,tab:9,capslock:20,capslk:20,"super":91,windows:91,insert:45,"delete":46,home:36,end:35,pgup:33,pageup:33,pgdn:34,pagedown:34,left:37,up:38,right:39,down:40,"!":49,"@":50,"#":51,$:52,"%":53,"^":54,"&":55,"*":56,"(":57,")":48,"`":96,"~":96,"-":45,_:45,"=":187,"+":187,"[":219,"{":219,"]":221,"}":221,"\\":220,"|":220,";":59,":":59,"'":222,'"':222,",":188,"<":188,".":190,">":190,"/":191,"?":191};var g="";var h="";if(typeof c=="function"&&typeof d=="undefined"){d=c;c=false}if(b.toString().indexOf(",")>-1){var i=b.match(/[a-zA-Z0-9]+/gi)}else{var i=[b]}for(g in i){if(!i.hasOwnProperty(g)){continue}if(i[g].toString().indexOf("+")>-1){var j=[];var k=i[g].split("+");for(h in k){j[h]=f[k[h]]}i[g]=j}else{i[g]=f[i[g]]}}var m=l(f);return this.each(function(){e=a(this);var b=[];e.bind("keydown.jkey",function(e){b[e.keyCode]=e.keyCode;if(a.inArray(e.keyCode,i)>-1){if(typeof d=="function"){d.call(this,m[e.keyCode]);if(c===false){e.preventDefault()}}}else{for(g in i){if(a.inArray(e.keyCode,i[g])>-1){var f="unchecked";for(h in i[g]){if(f!=false){if(a.inArray(i[g][h],b)>-1){f=true}else{f=false}}}if(f===true){if(typeof d=="function"){var j="";for(var k in b){if(b[k]!=""){j+=m[b[k]]+"+"}}j=j.substring(0,j.length-1);d.call(this,j);if(c===false){e.preventDefault()}}}}}}}).bind("keyup.jkey",function(a){b[a.keyCode]=""})})}})($);

/* qTip2 - Pretty powerful tooltips http://craigsworks.com/projects/qtip2/ Copyright 2009-2010 Craig Michael Thompson - http://craigsworks.com jslint browser: true, onevar: true, undef: true, nomen: true, bitwise: true, regexp: true, newcap: true, immed: true, strict: true *//*global window: false, jQuery: false, console: false, define: false */
(function(a){typeof define==="function"&&define.amd?define(["jquery"],a):a(jQuery)})(function(a){function B(d){var e=this,f=d.options.show.modal,h=d.elements,i=h.tooltip,j="#qtip-overlay",k=".qtipmodal",l=k+d.id,n="is-modal-qtip",p=a(document.body),q;d.checks.modal={"^show.modal.(on|blur)$":function(){e.init(),h.overlay.toggle(i.is(":visible"))}},a.extend(e,{init:function(){if(!f.on)return e;q=e.create(),i.attr(n,b).css("z-index",g.modal.zindex+a(m+"["+n+"]").length).unbind(k).unbind(l).bind("tooltipshow"+k+" tooltiphide"+k,function(b,c,d){var f=b.originalEvent;if(b.target===i[0])if(f&&b.type==="tooltiphide"&&/mouse(leave|enter)/.test(f.type)&&a(f.relatedTarget).closest(q[0]).length)try{b.preventDefault()}catch(g){}else(!f||f&&!f.solo)&&e[b.type.replace("tooltip","")](b,d)}).bind("tooltipfocus"+k,function(b){if(!b.isDefaultPrevented()&&b.target===i[0]){var c=a(m).filter("["+n+"]"),d=g.modal.zindex+c.length,e=parseInt(i[0].style.zIndex,10);q[0].style.zIndex=d-1,c.each(function(){this.style.zIndex>e&&(this.style.zIndex-=1)}),c.end().filter("."+o).qtip("blur",b.originalEvent),i.addClass(o)[0].style.zIndex=d;try{b.preventDefault()}catch(f){}}}).bind("tooltiphide"+k,function(b){b.target===i[0]&&a("["+n+"]").filter(":visible").not(i).last().qtip("focus",b)}),f.escape&&a(window).unbind(l).bind("keydown"+l,function(a){a.keyCode===27&&i.hasClass(o)&&d.hide(a)}),f.blur&&h.overlay.unbind(l).bind("click"+l,function(a){i.hasClass(o)&&d.hide(a)});return e},create:function(){function d(){q.css({height:a(window).height(),width:a(window).width()})}var b=a(j);if(b.length)return h.overlay=b.insertAfter(a(m).last());q=h.overlay=a("<div />",{id:j.substr(1),html:"<div></div>",mousedown:function(){return c}}).insertAfter(a(m).last()),a(window).unbind(k).bind("resize"+k,d),d();return q},toggle:function(d,g,h){if(d&&d.isDefaultPrevented())return e;var j=f.effect,k=g?"show":"hide",o=q.is(":visible"),r=a("["+n+"]").filter(":visible").not(i),s;q||(q=e.create());if(q.is(":animated")&&o===g||!g&&r.length)return e;g?(q.css({left:0,top:0}),q.toggleClass("blurs",f.blur),p.bind("focusin"+l,function(b){var d=a(b.target),e=d.closest(".qtip"),f=e.length<1?c:parseInt(e[0].style.zIndex,10)>parseInt(i[0].style.zIndex,10);!f&&a(b.target).closest(m)[0]!==i[0]&&i.find("input:visible").filter(":first").focus()})):p.undelegate("*","focusin"+l),q.stop(b,c),a.isFunction(j)?j.call(q,g):j===c?q[k]():q.fadeTo(parseInt(h,10)||90,g?1:0,function(){g||a(this).hide()}),g||q.queue(function(a){q.css({left:"",top:""}),a()});return e},show:function(a,c){return e.toggle(a,b,c)},hide:function(a,b){return e.toggle(a,c,b)},destroy:function(){var b=q;b&&(b=a("["+n+"]").not(i).length<1,b?(h.overlay.remove(),a(window).unbind(k)):h.overlay.unbind(k+d.id),p.undelegate("*","focusin"+l));return i.removeAttr(n).unbind(k)}}),e.init()}function A(f,h){function w(a){var b=a.precedance==="y",c=n[b?"width":"height"],d=n[b?"height":"width"],e=a.string().indexOf("center")>-1,f=c*(e?.5:1),g=Math.pow,h=Math.round,i,j,k,l=Math.sqrt(g(f,2)+g(d,2)),m=[p/f*l,p/d*l];m[2]=Math.sqrt(g(m[0],2)-g(p,2)),m[3]=Math.sqrt(g(m[1],2)-g(p,2)),i=l+m[2]+m[3]+(e?0:m[0]),j=i/l,k=[h(j*d),h(j*c)];return{height:k[b?0:1],width:k[b?1:0]}}function v(b){var c=k.titlebar&&b.y==="top",d=c?k.titlebar:k.content,e=a.browser.mozilla,f=e?"-moz-":a.browser.webkit?"-webkit-":"",g=b.y+(e?"":"-")+b.x,h=f+(e?"border-radius-"+g:"border-"+g+"-radius");return parseInt(d.css(h),10)||parseInt(l.css(h),10)||0}function u(a,b,c){b=b?b:a[a.precedance];var d=l.hasClass(q),e=k.titlebar&&a.y==="top",f=e?k.titlebar:k.content,g="border-"+b+"-width",h;l.addClass(q),h=parseInt(f.css(g),10),h=(c?h||parseInt(l.css(g),10):h)||0,l.toggleClass(q,d);return h}function t(a,d,g,h){if(k.tip){var l=i.corner.clone(),n=g.adjusted,o=f.options.position.adjust.method.split(" "),p=o[0],q=o[1]||o[0],r={left:c,top:c,x:0,y:0},s,t={},u;i.corner.fixed!==b&&(p==="shift"&&l.precedance==="x"&&n.left&&l.y!=="center"?l.precedance=l.precedance==="x"?"y":"x":p==="flip"&&n.left&&(l.x=l.x==="center"?n.left>0?"left":"right":l.x==="left"?"right":"left"),q==="shift"&&l.precedance==="y"&&n.top&&l.x!=="center"?l.precedance=l.precedance==="y"?"x":"y":q==="flip"&&n.top&&(l.y=l.y==="center"?n.top>0?"top":"bottom":l.y==="top"?"bottom":"top"),l.string()!==m.corner.string()&&(m.top!==n.top||m.left!==n.left)&&i.update(l,c)),s=i.position(l,n),s.right!==e&&(s.left=-s.right),s.bottom!==e&&(s.top=-s.bottom),s.user=Math.max(0,j.offset);if(r.left=p==="shift"&&!!n.left)l.x==="center"?t["margin-left"]=r.x=s["margin-left"]-n.left:(u=s.right!==e?[n.left,-s.left]:[-n.left,s.left],(r.x=Math.max(u[0],u[1]))>u[0]&&(g.left-=n.left,r.left=c),t[s.right!==e?"right":"left"]=r.x);if(r.top=q==="shift"&&!!n.top)l.y==="center"?t["margin-top"]=r.y=s["margin-top"]-n.top:(u=s.bottom!==e?[n.top,-s.top]:[-n.top,s.top],(r.y=Math.max(u[0],u[1]))>u[0]&&(g.top-=n.top,r.top=c),t[s.bottom!==e?"bottom":"top"]=r.y);k.tip.css(t).toggle(!(r.x&&r.y||l.x==="center"&&r.y||l.y==="center"&&r.x)),g.left-=s.left.charAt?s.user:p!=="shift"||r.top||!r.left&&!r.top?s.left:0,g.top-=s.top.charAt?s.user:q!=="shift"||r.left||!r.left&&!r.top?s.top:0,m.left=n.left,m.top=n.top,m.corner=l.clone()}}var i=this,j=f.options.style.tip,k=f.elements,l=k.tooltip,m={top:0,left:0},n={width:j.width,height:j.height},o={},p=j.border||0,r=".qtip-tip",s=!!(a("<canvas />")[0]||{}).getContext;i.mimic=i.corner=d,i.border=p,i.offset=j.offset,i.size=n,f.checks.tip={"^position.my|style.tip.(corner|mimic|border)$":function(){i.init()||i.destroy(),f.reposition()},"^style.tip.(height|width)$":function(){n={width:j.width,height:j.height},i.create(),i.update(),f.reposition()},"^content.title.text|style.(classes|widget)$":function(){k.tip&&i.update()}},a.extend(i,{init:function(){var b=i.detectCorner()&&(s||a.browser.msie);b&&(i.create(),i.update(),l.unbind(r).bind("tooltipmove"+r,t));return b},detectCorner:function(){var a=j.corner,d=f.options.position,e=d.at,h=d.my.string?d.my.string():d.my;if(a===c||h===c&&e===c)return c;a===b?i.corner=new g.Corner(h):a.string||(i.corner=new g.Corner(a),i.corner.fixed=b),m.corner=new g.Corner(i.corner.string());return i.corner.string()!=="centercenter"},detectColours:function(b){var c,d,e,g=k.tip.css("cssText",""),h=b||i.corner,m=h[h.precedance],p="border-"+m+"-color",r="border"+m.charAt(0)+m.substr(1)+"Color",s=/rgba?\(0, 0, 0(, 0)?\)|transparent|#123456/i,t="background-color",u="transparent",v=" !important",w=a(document.body).css("color"),x=f.elements.content.css("color"),y=k.titlebar&&(h.y==="top"||h.y==="center"&&g.position().top+n.height/2+j.offset<k.titlebar.outerHeight(1)),z=y?k.titlebar:k.content;l.addClass(q),o.fill=d=g.css(t),o.border=e=g[0].style[r]||g.css(p)||l.css(p);if(!d||s.test(d))o.fill=z.css(t)||u,s.test(o.fill)&&(o.fill=l.css(t)||d);if(!e||s.test(e)||e===w)o.border=z.css(p)||u,s.test(o.border)&&(o.border=e);a("*",g).add(g).css("cssText",t+":"+u+v+";border:0"+v+";"),l.removeClass(q)},create:function(){var b=n.width,c=n.height,d;k.tip&&k.tip.remove(),k.tip=a("<div />",{"class":"ui-tooltip-tip"}).css({width:b,height:c}).prependTo(l),s?a("<canvas />").appendTo(k.tip)[0].getContext("2d").save():(d='<vml:shape coordorigin="0,0" style="display:inline-block; position:absolute; behavior:url(#default#VML);"></vml:shape>',k.tip.html(d+d),a("*",k.tip).bind("click mousedown",function(a){a.stopPropagation()}))},update:function(e,f){var h=k.tip,l=h.children(),q=n.width,r=n.height,t="px solid ",v="px dashed transparent",x=j.mimic,y=Math.round,A,B,C,D,E;e||(e=m.corner||i.corner),x===c?x=e:(x=new g.Corner(x),x.precedance=e.precedance,x.x==="inherit"?x.x=e.x:x.y==="inherit"?x.y=e.y:x.x===x.y&&(x[e.precedance]=e[e.precedance])),A=x.precedance,i.detectColours(e),o.border!=="transparent"&&o.border!=="#123456"?(p=u(e,d,b),j.border===0&&p>0&&(o.fill=o.border),i.border=p=j.border!==b?j.border:p):i.border=p=0,C=z(x,q,r),i.size=E=w(e),h.css(E),e.precedance==="y"?D=[y(x.x==="left"?p:x.x==="right"?E.width-q-p:(E.width-q)/2),y(x.y==="top"?E.height-r:0)]:D=[y(x.x==="left"?E.width-q:0),y(x.y==="top"?p:x.y==="bottom"?E.height-r-p:(E.height-r)/2)],s?(l.attr(E),B=l[0].getContext("2d"),B.restore(),B.save(),B.clearRect(0,0,3e3,3e3),B.translate(D[0],D[1]),B.beginPath(),B.moveTo(C[0][0],C[0][1]),B.lineTo(C[1][0],C[1][1]),B.lineTo(C[2][0],C[2][1]),B.closePath(),B.fillStyle=o.fill,B.strokeStyle=o.border,B.lineWidth=p*2,B.lineJoin="miter",B.miterLimit=100,p&&B.stroke(),B.fill()):(C="m"+C[0][0]+","+C[0][1]+" l"+C[1][0]+","+C[1][1]+" "+C[2][0]+","+C[2][1]+" xe",D[2]=p&&/^(r|b)/i.test(e.string())?parseFloat(a.browser.version,10)===8?2:1:0,l.css({antialias:""+(x.string().indexOf("center")>-1),left:D[0]-D[2]*Number(A==="x"),top:D[1]-D[2]*Number(A==="y"),width:q+p,height:r+p}).each(function(b){var c=a(this);c[c.prop?"prop":"attr"]({coordsize:q+p+" "+(r+p),path:C,fillcolor:o.fill,filled:!!b,stroked:!b}).css({display:p||b?"block":"none"}),!b&&c.html()===""&&c.html('<vml:stroke weight="'+p*2+'px" color="'+o.border+'" miterlimit="1000" joinstyle="miter"  style="behavior:url(#default#VML); display:inline-block;" />')})),f!==c&&i.position(e)},position:function(d){var e=k.tip,f={},g=Math.max(0,j.offset),h,l,m;if(j.corner===c||!e)return c;d=d||i.corner,h=d.precedance,l=w(d),m=[d.x,d.y],h==="x"&&m.reverse(),a.each(m,function(a,c){var e,i;c==="center"?(e=h==="y"?"left":"top",f[e]="50%",f["margin-"+e]=-Math.round(l[h==="y"?"width":"height"]/2)+g):(e=u(d,c,b),i=v(d),f[c]=a?p?u(d,c):0:g+(i>e?i:0))}),f[d[h]]-=l[h==="x"?"width":"height"],e.css({top:"",bottom:"",left:"",right:"",margin:""}).css(f);return f},destroy:function(){k.tip&&k.tip.remove(),l.unbind(r)}}),i.init()}function z(a,b,c){var d=Math.ceil(b/2),e=Math.ceil(c/2),f={bottomright:[[0,0],[b,c],[b,0]],bottomleft:[[0,0],[b,0],[0,c]],topright:[[0,c],[b,0],[b,c]],topleft:[[0,0],[0,c],[b,c]],topcenter:[[0,c],[d,0],[b,c]],bottomcenter:[[0,0],[b,0],[d,c]],rightcenter:[[0,0],[b,e],[0,c]],leftcenter:[[b,0],[b,c],[0,e]]};f.lefttop=f.bottomright,f.righttop=f.bottomleft,f.leftbottom=f.topright,f.rightbottom=f.topleft;return f[a.string()]}function y(e,h){var i,j,k,l,m,n=a(this),o=a(document.body),p=this===document?o:n,q=n.metadata?n.metadata(h.metadata):d,r=h.metadata.type==="html5"&&q?q[h.metadata.name]:d,s=n.data(h.metadata.name||"qtipopts");try{s=typeof s==="string"?(new Function("return "+s))():s}catch(u){v("Unable to parse HTML5 attribute data: "+s)}l=a.extend(b,{},f.defaults,h,typeof s==="object"?w(s):d,w(r||q)),j=l.position,l.id=e;if("boolean"===typeof l.content.text){k=n.attr(l.content.attr);if(l.content.attr!==c&&k)l.content.text=k;else{v("Unable to locate content for tooltip! Aborting render of tooltip on element: ",n);return c}}j.container.length||(j.container=o),j.target===c&&(j.target=p),l.show.target===c&&(l.show.target=p),l.show.solo===b&&(l.show.solo=j.container.closest("body")),l.hide.target===c&&(l.hide.target=p),l.position.viewport===b&&(l.position.viewport=j.container),j.container=j.container.eq(0),j.at=new g.Corner(j.at),j.my=new g.Corner(j.my);if(a.data(this,"qtip"))if(l.overwrite)n.qtip("destroy");else if(l.overwrite===c)return c;l.suppress&&(m=a.attr(this,"title"))&&a(this).removeAttr("title").attr(t,m),i=new x(n,l,e,!!k),a.data(this,"qtip",i),n.bind("remove.qtip-"+e+" removeqtip.qtip-"+e,function(){i.destroy()});return i}function x(r,s,v,x){function Q(){var b=[s.show.target[0],s.hide.target[0],y.rendered&&F.tooltip[0],s.position.container[0],s.position.viewport[0],window,document];y.rendered?a([]).pushStack(a.grep(b,function(a){return typeof a==="object"})).unbind(E):s.show.target.unbind(E+"-create")}function P(){function o(a){D.is(":visible")&&y.reposition(a)}function n(a){if(D.hasClass(l))return c;clearTimeout(y.timers.inactive),y.timers.inactive=setTimeout(function(){y.hide(a)},s.hide.inactive)}function k(b){if(D.hasClass(l)||B||C)return c;var f=a(b.relatedTarget||b.target),g=f.closest(m)[0]===D[0],h=f[0]===e.show[0];clearTimeout(y.timers.show),clearTimeout(y.timers.hide);if(d.target==="mouse"&&g||s.hide.fixed&&(/mouse(out|leave|move)/.test(b.type)&&(g||h)))try{b.preventDefault(),b.stopImmediatePropagation()}catch(i){}else s.hide.delay>0?y.timers.hide=setTimeout(function(){y.hide(b)},s.hide.delay):y.hide(b)}function j(a){if(D.hasClass(l))return c;clearTimeout(y.timers.show),clearTimeout(y.timers.hide);var d=function(){y.toggle(b,a)};s.show.delay>0?y.timers.show=setTimeout(d,s.show.delay):d()}var d=s.position,e={show:s.show.target,hide:s.hide.target,viewport:a(d.viewport),document:a(document),body:a(document.body),window:a(window)},g={show:a.trim(""+s.show.event).split(" "),hide:a.trim(""+s.hide.event).split(" ")},i=a.browser.msie&&parseInt(a.browser.version,10)===6;D.bind("mouseenter"+E+" mouseleave"+E,function(a){var b=a.type==="mouseenter";b&&y.focus(a),D.toggleClass(p,b)}),s.hide.fixed&&(e.hide=e.hide.add(D),D.bind("mouseover"+E,function(){D.hasClass(l)||clearTimeout(y.timers.hide)})),/mouse(out|leave)/i.test(s.hide.event)?s.hide.leave==="window"&&e.window.bind("mouseout"+E+" blur"+E,function(a){/select|option/.test(a.target)&&!a.relatedTarget&&y.hide(a)}):/mouse(over|enter)/i.test(s.show.event)&&e.hide.bind("mouseleave"+E,function(a){clearTimeout(y.timers.show)}),(""+s.hide.event).indexOf("unfocus")>-1&&d.container.closest("html").bind("mousedown"+E,function(b){var c=a(b.target),d=!D.hasClass(l)&&D.is(":visible"),e=c.parents(m).filter(D[0]).length>0;c[0]!==r[0]&&c[0]!==D[0]&&!e&&!r.has(c[0]).length&&!c.attr("disabled")&&y.hide(b)}),"number"===typeof s.hide.inactive&&(e.show.bind("qtip-"+v+"-inactive",n),a.each(f.inactiveEvents,function(a,b){e.hide.add(F.tooltip).bind(b+E+"-inactive",n)})),a.each(g.hide,function(b,c){var d=a.inArray(c,g.show),f=a(e.hide);d>-1&&f.add(e.show).length===f.length||c==="unfocus"?(e.show.bind(c+E,function(a){D.is(":visible")?k(a):j(a)}),delete g.show[d]):e.hide.bind(c+E,k)}),a.each(g.show,function(a,b){e.show.bind(b+E,j)}),"number"===typeof s.hide.distance&&e.show.add(D).bind("mousemove"+E,function(a){var b=G.origin||{},c=s.hide.distance,d=Math.abs;(d(a.pageX-b.pageX)>=c||d(a.pageY-b.pageY)>=c)&&y.hide(a)}),d.target==="mouse"&&(e.show.bind("mousemove"+E,function(a){h={pageX:a.pageX,pageY:a.pageY,type:"mousemove"}}),d.adjust.mouse&&(s.hide.event&&(D.bind("mouseleave"+E,function(a){(a.relatedTarget||a.target)!==e.show[0]&&y.hide(a)}),F.target.bind("mouseenter"+E+" mouseleave"+E,function(a){G.onTarget=a.type==="mouseenter"})),e.document.bind("mousemove"+E,function(a){G.onTarget&&!D.hasClass(l)&&D.is(":visible")&&y.reposition(a||h)}))),(d.adjust.resize||e.viewport.length)&&(a.event.special.resize?e.viewport:e.window).bind("resize"+E,o),(e.viewport.length||i&&D.css("position")==="fixed")&&e.viewport.bind("scroll"+E,o)}function O(b,d){function g(b){function i(e){e&&(delete h[e.src],clearTimeout(y.timers.img[e.src]),a(e).unbind(E)),a.isEmptyObject(h)&&(y.redraw(),d!==c&&y.reposition(G.event),b())}var g,h={};if((g=f.find("img[src]:not([height]):not([width])")).length===0)return i();g.each(function(b,c){if(h[c.src]===e){var d=0,f=3;(function g(){if(c.height||c.width||d>f)return i(c);d+=1,y.timers.img[c.src]=setTimeout(g,700)})(),a(c).bind("error"+E+" load"+E,function(){i(this)}),h[c.src]=c}})}var f=F.content;if(!y.rendered||!b)return c;a.isFunction(b)&&(b=b.call(r,G.event,y)||""),b.jquery&&b.length>0?f.empty().append(b.css({display:"block"})):f.html(b),y.rendered<0?D.queue("fx",g):(C=0,g(a.noop));return y}function N(b,d){var e=F.title;if(!y.rendered||!b)return c;a.isFunction(b)&&(b=b.call(r,G.event,y));if(b===c||!b&&b!=="")return J(c);b.jquery&&b.length>0?e.empty().append(b.css({display:"block"})):e.html(b),y.redraw(),d!==c&&y.rendered&&D.is(":visible")&&y.reposition(G.event)}function M(a){var b=F.button,d=F.title;if(!y.rendered)return c;a?(d||L(),K()):b.remove()}function L(){var c=A+"-title";F.titlebar&&J(),F.titlebar=a("<div />",{"class":j+"-titlebar "+(s.style.widget?"ui-widget-header":"")}).append(F.title=a("<div />",{id:c,"class":j+"-title","aria-atomic":b})).insertBefore(F.content).delegate(".ui-tooltip-close","mousedown keydown mouseup keyup mouseout",function(b){a(this).toggleClass("ui-state-active ui-state-focus",b.type.substr(-4)==="down")}).delegate(".ui-tooltip-close","mouseover mouseout",function(b){a(this).toggleClass("ui-state-hover",b.type==="mouseover")}),s.content.title.button?K():y.rendered&&y.redraw()}function K(){var b=s.content.title.button,d=typeof b==="string",e=d?b:"Close tooltip";F.button&&F.button.remove(),b.jquery?F.button=b:F.button=a("<a />",{"class":"ui-state-default ui-tooltip-close "+(s.style.widget?"":j+"-icon"),title:e,"aria-label":e}).prepend(a("<span />",{"class":"ui-icon ui-icon-close",html:"&times;"})),F.button.appendTo(F.titlebar).attr("role","button").click(function(a){D.hasClass(l)||y.hide(a);return c}),y.redraw()}function J(a){F.title&&(F.titlebar.remove(),F.titlebar=F.title=F.button=d,a!==c&&y.reposition())}function I(){var a=s.style.widget;D.toggleClass(k,a).toggleClass(n,s.style.def&&!a),F.content.toggleClass(k+"-content",a),F.titlebar&&F.titlebar.toggleClass(k+"-header",a),F.button&&F.button.toggleClass(j+"-icon",!a)}function H(a){var b=0,c,d=s,e=a.split(".");while(d=d[e[b++]])b<e.length&&(c=d);return[c||s,e.pop()]}var y=this,z=document.body,A=j+"-"+v,B=0,C=0,D=a(),E=".qtip-"+v,F,G;y.id=v,y.rendered=c,y.elements=F={target:r},y.timers={img:{}},y.options=s,y.checks={},y.plugins={},y.cache=G={event:{},target:a(),disabled:c,attr:x,onTarget:c},y.checks.builtin={"^id$":function(d,e,g){var h=g===b?f.nextid:g,i=j+"-"+h;h!==c&&h.length>0&&!a("#"+i).length&&(D[0].id=i,F.content[0].id=i+"-content",F.title[0].id=i+"-title")},"^content.text$":function(a,b,c){O(c)},"^content.title.text$":function(a,b,c){if(!c)return J();!F.title&&c&&L(),N(c)},"^content.title.button$":function(a,b,c){M(c)},"^position.(my|at)$":function(a,b,c){"string"===typeof c&&(a[b]=new g.Corner(c))},"^position.container$":function(a,b,c){y.rendered&&D.appendTo(c)},"^show.ready$":function(){y.rendered?y.toggle(b):y.render(1)},"^style.classes$":function(a,b,c){D.attr("class",j+" qtip ui-helper-reset "+c)},"^style.widget|content.title":I,"^events.(render|show|move|hide|focus|blur)$":function(b,c,d){D[(a.isFunction(d)?"":"un")+"bind"]("tooltip"+c,d)},"^(show|hide|position).(event|target|fixed|inactive|leave|distance|viewport|adjust)":function(){var a=s.position;D.attr("tracking",a.target==="mouse"&&a.adjust.mouse),Q(),P()}},a.extend(y,{render:function(d){if(y.rendered)return y;var e=s.content.text,f=s.content.title.text,h=s.position,i=a.Event("tooltiprender");a.attr(r[0],"aria-describedby",A),D=F.tooltip=a("<div/>",{id:A,"class":j+" qtip ui-helper-reset "+n+" "+s.style.classes+" "+j+"-pos-"+s.position.my.abbrev(),width:s.style.width||"",height:s.style.height||"",tracking:h.target==="mouse"&&h.adjust.mouse,role:"alert","aria-live":"polite","aria-atomic":c,"aria-describedby":A+"-content","aria-hidden":b}).toggleClass(l,G.disabled).data("qtip",y).appendTo(s.position.container).append(F.content=a("<div />",{"class":j+"-content",id:A+"-content","aria-atomic":b})),y.rendered=-1,B=C=1,f&&(L(),a.isFunction(f)||N(f,c)),a.isFunction(e)||O(e,c),y.rendered=b,I(),a.each(s.events,function(b,c){a.isFunction(c)&&D.bind(b==="toggle"?"tooltipshow tooltiphide":"tooltip"+b,c)}),a.each(g,function(){this.initialize==="render"&&this(y)}),P(),D.queue("fx",function(a){i.originalEvent=G.event,D.trigger(i,[y]),B=C=0,y.redraw(),(s.show.ready||d)&&y.toggle(b,G.event,c),a()});return y},get:function(a){var b,c;switch(a.toLowerCase()){case"dimensions":b={height:D.outerHeight(),width:D.outerWidth()};break;case"offset":b=g.offset(D,s.position.container);break;default:c=H(a.toLowerCase()),b=c[0][c[1]],b=b.precedance?b.string():b}return b},set:function(e,f){function m(a,b){var c,d,e;for(c in k)for(d in k[c])if(e=(new RegExp(d,"i")).exec(a))b.push(e),k[c][d].apply(y,b)}var g=/^position\.(my|at|adjust|target|container)|style|content|show\.ready/i,h=/^content\.(title|attr)|style/i,i=c,j=c,k=y.checks,l;"string"===typeof e?(l=e,e={},e[l]=f):e=a.extend(b,{},e),a.each(e,function(b,c){var d=H(b.toLowerCase()),f;f=d[0][d[1]],d[0][d[1]]="object"===typeof c&&c.nodeType?a(c):c,e[b]=[d[0],d[1],c,f],i=g.test(b)||i,j=h.test(b)||j}),w(s),B=C=1,a.each(e,m),B=C=0,D.is(":visible")&&y.rendered&&(i&&y.reposition(s.position.target==="mouse"?d:G.event),j&&y.redraw());return y},toggle:function(e,f){function r(){e?(a.browser.msie&&D[0].style.removeAttribute("filter"),D.css("overflow",""),"string"===typeof i.autofocus&&a(i.autofocus,D).focus(),i.target.trigger("qtip-"+v+"-inactive")):D.css({display:"",visibility:"",opacity:"",left:"",top:""}),q=a.Event("tooltip"+(e?"visible":"hidden")),q.originalEvent=f?G.event:d,D.trigger(q,[y])}if(!y.rendered)return e?y.render(1):y;var g=e?"show":"hide",i=s[g],j=D.is(":visible"),k=!f||i.target.length<2||G.target[0]===f.target,l=f&&i.target.add(f.target).length!==i.target.length,n=s.position,o=s.content,p,q;(typeof e).search("boolean|number")&&(e=!j);if(!D.is(":animated")&&j===e&&k)return y;if(f){if(/over|enter/.test(f.type)&&/out|leave/.test(G.event.type)&&s.show.target.add(f.target).length===s.show.target.length&&D.has(f.relatedTarget).length)return y;G.event=a.extend({},f)}q=a.Event("tooltip"+g),q.originalEvent=f?G.event:d,D.trigger(q,[y,90]);if(q.isDefaultPrevented())return y;a.attr(D[0],"aria-hidden",!e),e?(G.origin=a.extend({},h),y.focus(f),a.isFunction(o.text)&&O(o.text,c),a.isFunction(o.title.text)&&N(o.title.text,c),!u&&n.target==="mouse"&&n.adjust.mouse&&(a(document).bind("mousemove.qtip",function(a){h={pageX:a.pageX,pageY:a.pageY,type:"mousemove"}}),u=b),y.reposition(f,arguments[2]),(q.solo=!!i.solo)&&a(m,i.solo).not(D).qtip("hide",q)):(clearTimeout(y.timers.show),delete G.origin,u&&!a(m+'[tracking="true"]:visible',i.solo).not(D).length&&(a(document).unbind("mousemove.qtip"),u=c),y.blur(f)),D.stop(l,!l),i.effect===c?(D[g](),r.call(D)):a.isFunction(i.effect)?(i.effect.call(D,y),D.queue("fx",function(a){r(),a()})):D.fadeTo(90,e?1:0,r),e&&i.target.trigger("qtip-"+v+"-inactive");return y},show:function(a){return y.toggle(b,a)},hide:function(a){return y.toggle(c,a)},focus:function(b){if(!y.rendered)return y;var c=a(m),d=parseInt(D[0].style.zIndex,10),e=f.zindex+c.length,g=a.extend({},b),h,i;D.hasClass(o)||(i=a.Event("tooltipfocus"),i.originalEvent=g,D.trigger(i,[y,e]),i.isDefaultPrevented()||(d!==e&&(c.each(function(){this.style.zIndex>d&&(this.style.zIndex=this.style.zIndex-1)}),c.filter("."+o).qtip("blur",g)),D.addClass(o)[0].style.zIndex=e));return y},blur:function(b){var c=a.extend({},b),d;D.removeClass(o),d=a.Event("tooltipblur"),d.originalEvent=c,D.trigger(d,[y]);return y},reposition:function(b,d){if(!y.rendered||B)return y;B=1;var e=s.position.target,f=s.position,i=f.my,k=f.at,l=f.adjust,m=l.method.split(" "),n=D.outerWidth(),o=D.outerHeight(),p=0,q=0,r=a.Event("tooltipmove"),t=D.css("position")==="fixed",u=f.viewport,v={left:0,top:0},w=f.container,x=c,A=y.plugins.tip,C={horizontal:m[0],vertical:m[1]=m[1]||m[0],enabled:u.jquery&&e[0]!==window&&e[0]!==z&&l.method!=="none",left:function(a){var b=C.horizontal==="shift",c=-w.offset.left+u.offset.left+u.scrollLeft,d=i.x==="left"?n:i.x==="right"?-n:-n/2,e=k.x==="left"?p:k.x==="right"?-p:-p/2,f=A&&A.size?A.size.width||0:0,g=A&&A.corner&&A.corner.precedance==="x"&&!b?f:0,h=c-a+g,j=a+n-u.width-c+g,m=d-(i.precedance==="x"||i.x===i.y?e:0)-(k.x==="center"?p/2:0),o=i.x==="center";b?(g=A&&A.corner&&A.corner.precedance==="y"?f:0,m=(i.x==="left"?1:-1)*d-g,v.left+=h>0?h:j>0?-j:0,v.left=Math.max(-w.offset.left+u.offset.left+(g&&A.corner.x==="center"?A.offset:0),a-m,Math.min(Math.max(-w.offset.left+u.offset.left+u.width,a+m),v.left))):(h>0&&(i.x!=="left"||j>0)?v.left-=m:j>0&&(i.x!=="right"||h>0)&&(v.left-=o?-m:m),v.left!==a&&o&&(v.left-=l.x),v.left<c&&-v.left>j&&(v.left=a));return v.left-a},top:function(a){var b=C.vertical==="shift",c=-w.offset.top+u.offset.top+u.scrollTop,d=i.y==="top"?o:i.y==="bottom"?-o:-o/2,e=k.y==="top"?q:k.y==="bottom"?-q:-q/2,f=A&&A.size?A.size.height||0:0,g=A&&A.corner&&A.corner.precedance==="y"&&!b?f:0,h=c-a+g,j=a+o-u.height-c+g,m=d-(i.precedance==="y"||i.x===i.y?e:0)-(k.y==="center"?q/2:0),n=i.y==="center";b?(g=A&&A.corner&&A.corner.precedance==="x"?f:0,m=(i.y==="top"?1:-1)*d-g,v.top+=h>0?h:j>0?-j:0,v.top=Math.max(-w.offset.top+u.offset.top+(g&&A.corner.x==="center"?A.offset:0),a-m,Math.min(Math.max(-w.offset.top+u.offset.top+u.height,a+m),v.top))):(h>0&&(i.y!=="top"||j>0)?v.top-=m:j>0&&(i.y!=="bottom"||h>0)&&(v.top-=n?-m:m),v.top!==a&&n&&(v.top-=l.y),v.top<0&&-v.top>j&&(v.top=a));return v.top-a}},E;if(a.isArray(e)&&e.length===2)k={x:"left",y:"top"},v={left:e[0],top:e[1]};else if(e==="mouse"&&(b&&b.pageX||G.event.pageX))k={x:"left",y:"top"},b=(b&&(b.type==="resize"||b.type==="scroll")?G.event:b&&b.pageX&&b.type==="mousemove"?b:h&&h.pageX&&(l.mouse||!b||!b.pageX)?{pageX:h.pageX,pageY:h.pageY}:!l.mouse&&G.origin&&G.origin.pageX&&s.show.distance?G.origin:b)||b||G.event||h||{},v={top:b.pageY,left:b.pageX};else{e==="event"?b&&b.target&&b.type!=="scroll"&&b.type!=="resize"?e=G.target=a(b.target):e=G.target:e=G.target=a(e.jquery?e:F.target),e=a(e).eq(0);if(e.length===0)return y;e[0]===document||e[0]===window?(p=g.iOS?window.innerWidth:e.width(),q=g.iOS?window.innerHeight:e.height(),e[0]===window&&(v={top:(u||e).scrollTop(),left:(u||e).scrollLeft()})):e.is("area")&&g.imagemap?v=g.imagemap(e,k,C.enabled?m:c):e[0].namespaceURI==="http://www.w3.org/2000/svg"&&g.svg?v=g.svg(e,k):(p=e.outerWidth(),q=e.outerHeight(),v=g.offset(e,w)),v.offset&&(p=v.width,q=v.height,x=v.flipoffset,v=v.offset);if(g.iOS<4.1&&g.iOS>3.1||g.iOS==4.3||!g.iOS&&t)E=a(window),v.left-=E.scrollLeft(),v.top-=E.scrollTop();v.left+=k.x==="right"?p:k.x==="center"?p/2:0,v.top+=k.y==="bottom"?q:k.y==="center"?q/2:0}v.left+=l.x+(i.x==="right"?-n:i.x==="center"?-n/2:0),v.top+=l.y+(i.y==="bottom"?-o:i.y==="center"?-o/2:0),C.enabled?(u={elem:u,height:u[(u[0]===window?"h":"outerH")+"eight"](),width:u[(u[0]===window?"w":"outerW")+"idth"](),scrollLeft:t?0:u.scrollLeft(),scrollTop:t?0:u.scrollTop(),offset:u.offset()||{left:0,top:0}},w={elem:w,scrollLeft:w.scrollLeft(),scrollTop:w.scrollTop(),offset:w.offset()||{left:0,top:0}},v.adjusted={left:C.horizontal!=="none"?C.left(v.left):0,top:C.vertical!=="none"?C.top(v.top):0},v.adjusted.left+v.adjusted.top&&D.attr("class",D[0].className.replace(/ui-tooltip-pos-\w+/i,j+"-pos-"+i.abbrev())),x&&v.adjusted.left&&(v.left+=x.left),x&&v.adjusted.top&&(v.top+=x.top)):v.adjusted={left:0,top:0},r.originalEvent=a.extend({},b),D.trigger(r,[y,v,u.elem||u]);if(r.isDefaultPrevented())return y;delete v.adjusted,d===c||isNaN(v.left)||isNaN(v.top)||e==="mouse"||!a.isFunction(f.effect)?D.css(v):a.isFunction(f.effect)&&(f.effect.call(D,y,a.extend({},v)),D.queue(function(b){a(this).css({opacity:"",height:""}),a.browser.msie&&this.style.removeAttribute("filter"),b()})),B=0;return y},redraw:function(){if(y.rendered<1||C)return y;var a=s.position.container,b,c,d,e;C=1,s.style.height&&D.css("height",s.style.height),s.style.width?D.css("width",s.style.width):(D.css("width","").addClass(q),c=D.width()+1,d=D.css("max-width")||"",e=D.css("min-width")||"",b=(d+e).indexOf("%")>-1?a.width()/100:0,d=(d.indexOf("%")>-1?b:1)*parseInt(d,10)||c,e=(e.indexOf("%")>-1?b:1)*parseInt(e,10)||0,c=d+e?Math.min(Math.max(c,e),d):c,D.css("width",Math.round(c)).removeClass(q)),C=0;return y},disable:function(b){"boolean"!==typeof b&&(b=!D.hasClass(l)&&!G.disabled),y.rendered?(D.toggleClass(l,b),a.attr(D[0],"aria-disabled",b)):G.disabled=!!b;return y},enable:function(){return y.disable(c)},destroy:function(){var b=r[0],c=a.attr(b,t),d=r.data("qtip");y.rendered&&(D.stop(1,0).remove(),a.each(y.plugins,function(){this.destroy&&this.destroy()})),clearTimeout(y.timers.show),clearTimeout(y.timers.hide),Q();if(!d||y===d)a.removeData(b,"qtip"),s.suppress&&c&&(a.attr(b,"title",c),r.removeAttr(t)),r.removeAttr("aria-describedby");r.unbind(".qtip-"+v),delete i[y.id];return r}})}function w(b){var e;if(!b||"object"!==typeof b)return c;if(b.metadata===d||"object"!==typeof b.metadata)b.metadata={type:b.metadata};if("content"in b){if(b.content===d||"object"!==typeof b.content||b.content.jquery)b.content={text:b.content};e=b.content.text||c,!a.isFunction(e)&&(!e&&!e.attr||e.length<1||"object"===typeof e&&!e.jquery)&&(b.content.text=c);if("title"in b.content){if(b.content.title===d||"object"!==typeof b.content.title)b.content.title={text:b.content.title};e=b.content.title.text||c,!a.isFunction(e)&&(!e&&!e.attr||e.length<1||"object"===typeof e&&!e.jquery)&&(b.content.title.text=c)}}if("position"in b)if(b.position===d||"object"!==typeof b.position)b.position={my:b.position,at:b.position};if("show"in b)if(b.show===d||"object"!==typeof b.show)b.show.jquery?b.show={target:b.show}:b.show={event:b.show};if("hide"in b)if(b.hide===d||"object"!==typeof b.hide)b.hide.jquery?b.hide={target:b.hide}:b.hide={event:b.hide};if("style"in b)if(b.style===d||"object"!==typeof b.style)b.style={classes:b.style};a.each(g,function(){this.sanitize&&this.sanitize(b)});return b}function v(){v.history=v.history||[],v.history.push(arguments);if("object"===typeof console){var a=console[console.warn?"warn":"log"],b=Array.prototype.slice.call(arguments),c;typeof arguments[0]==="string"&&(b[0]="qTip2: "+b[0]),c=a.apply?a.apply(console,b):a(b)}}"use strict";var b=!0,c=!1,d=null,e,f,g,h,i={},j="ui-tooltip",k="ui-widget",l="ui-state-disabled",m="div.qtip."+j,n=j+"-default",o=j+"-focus",p=j+"-hover",q=j+"-fluid",r="-31000px",s="_replacedByqTip",t="oldtitle",u;f=a.fn.qtip=function(g,h,i){var j=(""+g).toLowerCase(),k=d,l=a.makeArray(arguments).slice(1),m=l[l.length-1],n=this[0]?a.data(this[0],"qtip"):d;if(!arguments.length&&n||j==="api")return n;if("string"===typeof g){this.each(function(){var d=a.data(this,"qtip");if(!d)return b;m&&m.timeStamp&&(d.cache.event=m);if(j!=="option"&&j!=="options"||!h)d[j]&&d[j].apply(d[j],l);else if(a.isPlainObject(h)||i!==e)d.set(h,i);else{k=d.get(h);return c}});return k!==d?k:this}if("object"===typeof g||!arguments.length){n=w(a.extend(b,{},g));return f.bind.call(this,n,m)}},f.bind=function(d,j){return this.each(function(k){function r(b){function d(){p.render(typeof b==="object"||l.show.ready),m.show.add(m.hide).unbind(o)}if(p.cache.disabled)return c;p.cache.event=a.extend({},b),p.cache.target=b?a(b.target):[e],l.show.delay>0?(clearTimeout(p.timers.show),p.timers.show=setTimeout(d,l.show.delay),n.show!==n.hide&&m.hide.bind(n.hide,function(){clearTimeout(p.timers.show)})):d()}var l,m,n,o,p,q;q=a.isArray(d.id)?d.id[k]:d.id,q=!q||q===c||q.length<1||i[q]?f.nextid++:i[q]=q,o=".qtip-"+q+"-create",p=y.call(this,q,d);if(p===c)return b;l=p.options,a.each(g,function(){this.initialize==="initialize"&&this(p)}),m={show:l.show.target,hide:l.hide.target},n={show:a.trim(""+l.show.event).replace(/ /g,o+" ")+o,hide:a.trim(""+l.hide.event).replace(/ /g,o+" ")+o},/mouse(over|enter)/i.test(n.show)&&!/mouse(out|leave)/i.test(n.hide)&&(n.hide+=" mouseleave"+o),m.show.bind("mousemove"+o,function(a){h={pageX:a.pageX,pageY:a.pageY,type:"mousemove"},p.cache.onTarget=b}),m.show.bind(n.show,r),(l.show.ready||l.prerender)&&r(j)})},g=f.plugins={Corner:function(a){a=(""+a).replace(/([A-Z])/," $1").replace(/middle/gi,"center").toLowerCase(),this.x=(a.match(/left|right/i)||a.match(/center/)||["inherit"])[0].toLowerCase(),this.y=(a.match(/top|bottom|center/i)||["inherit"])[0].toLowerCase();var b=a.charAt(0);this.precedance=b==="t"||b==="b"?"y":"x",this.string=function(){return this.precedance==="y"?this.y+this.x:this.x+this.y},this.abbrev=function(){var a=this.x.substr(0,1),b=this.y.substr(0,1);return a===b?a:a==="c"||a!=="c"&&b!=="c"?b+a:a+b},this.clone=function(){return{x:this.x,y:this.y,precedance:this.precedance,string:this.string,abbrev:this.abbrev,clone:this.clone}}},offset:function(b,c){function j(a,b){d.left+=b*a.scrollLeft(),d.top+=b*a.scrollTop()}var d=b.offset(),e=b.closest("body")[0],f=c,g,h,i;if(f){do f.css("position")!=="static"&&(h=f.position(),d.left-=h.left+(parseInt(f.css("borderLeftWidth"),10)||0)+(parseInt(f.css("marginLeft"),10)||0),d.top-=h.top+(parseInt(f.css("borderTopWidth"),10)||0)+(parseInt(f.css("marginTop"),10)||0),!g&&(i=f.css("overflow"))!=="hidden"&&i!=="visible"&&(g=f));while((f=a(f[0].offsetParent)).length);g&&g[0]!==e&&j(g,1)}return d},iOS:parseFloat((""+(/CPU.*OS ([0-9_]{1,3})|(CPU like).*AppleWebKit.*Mobile/i.exec(navigator.userAgent)||[0,""])[1]).replace("undefined","3_2").replace("_","."))||c,fn:{attr:function(b,c){if(this.length){var d=this[0],e="title",f=a.data(d,"qtip");if(b===e&&f&&"object"===typeof f&&f.options.suppress){if(arguments.length<2)return a.attr(d,t);f&&f.options.content.attr===e&&f.cache.attr&&f.set("content.text",c);return this.attr(t,c)}}return a.fn["attr"+s].apply(this,arguments)},clone:function(b){var c=a([]),d="title",e=a.fn["clone"+s].apply(this,arguments);b||e.filter("["+t+"]").attr("title",function(){return a.attr(this,t)}).removeAttr(t);return e}}},a.each(g.fn,function(c,d){if(!d||a.fn[c+s])return b;var e=a.fn[c+s]=a.fn[c];a.fn[c]=function(){return d.apply(this,arguments)||e.apply(this,arguments)}}),a.ui||(a["cleanData"+s]=a.cleanData,a.cleanData=function(b){for(var c=0,d;(d=b[c])!==e;c++)try{a(d).triggerHandler("removeqtip")}catch(f){}a["cleanData"+s](b)}),f.version="nightly",f.nextid=0,f.inactiveEvents="click dblclick mousedown mouseup mousemove mouseleave mouseenter".split(" "),f.zindex=15e3,f.defaults={prerender:c,id:c,overwrite:b,suppress:b,content:{text:b,attr:"title",title:{text:c,button:c}},position:{my:"top left",at:"bottom right",target:c,container:c,viewport:c,adjust:{x:0,y:0,mouse:b,resize:b,method:"flip flip"},effect:function(b,d,e){a(this).animate(d,{duration:200,queue:c})}},show:{target:c,event:"mouseenter",effect:b,delay:90,solo:c,ready:c,autofocus:c},hide:{target:c,event:"mouseleave",effect:b,delay:0,fixed:c,inactive:c,leave:"window",distance:c},style:{classes:"",widget:c,width:c,height:c,def:b},events:{render:d,move:d,show:d,hide:d,toggle:d,visible:d,hidden:d,focus:d,blur:d}},g.tip=function(a){var b=a.plugins.tip;return"object"===typeof b?b:a.plugins.tip=new A(a)},g.tip.initialize="render",g.tip.sanitize=function(a){var c=a.style,d;c&&"tip"in c&&(d=a.style.tip,typeof d!=="object"&&(a.style.tip={corner:d}),/string|boolean/i.test(typeof d.corner)||(d.corner=b),typeof d.width!=="number"&&delete d.width,typeof d.height!=="number"&&delete d.height,typeof d.border!=="number"&&d.border!==b&&delete d.border,typeof d.offset!=="number"&&delete d.offset)},a.extend(b,f.defaults,{style:{tip:{corner:b,mimic:c,width:6,height:6,border:b,offset:0}}}),g.svg=function(b,c){var d=a(document),e=b[0],f={width:0,height:0,offset:{top:1e10,left:1e10}},g,h,i,j,k;if(e.getBBox&&e.parentNode){g=e.getBBox(),h=e.getScreenCTM(),i=e.farthestViewportElement||e;if(!i.createSVGPoint)return f;j=i.createSVGPoint(),j.x=g.x,j.y=g.y,k=j.matrixTransform(h),f.offset.left=k.x,f.offset.top=k.y,j.x+=g.width,j.y+=g.height,k=j.matrixTransform(h),f.width=k.x-f.offset.left,f.height=k.y-f.offset.top,f.offset.left+=d.scrollLeft(),f.offset.top+=d.scrollTop()}return f},g.modal=function(a){var b=a.plugins.modal;return"object"===typeof b?b:a.plugins.modal=new B(a)},g.modal.initialize="render",g.modal.sanitize=function(a){a.show&&(typeof a.show.modal!=="object"?a.show.modal={on:!!a.show.modal}:typeof a.show.modal.on==="undefined"&&(a.show.modal.on=b))},g.modal.zindex=f.zindex+1e3,a.extend(b,f.defaults,{show:{modal:{on:c,effect:b,blur:b,escape:b}}})});

/**
 * jQuery.timers - Timer abstractions for jQuery
 * Written by Blair Mitchelmore (blair DOT mitchelmore AT gmail DOT com)
 * Licensed under the WTFPL (http://sam.zoy.org/wtfpl/).
 * Date: 2009/10/16
 *
 * @author Blair Mitchelmore
 * @version 1.2
 *
 **/
jQuery.fn.extend({
	everyTime: function(interval, label, fn, times) {
		return this.each(function() {
			jQuery.timer.add(this, interval, label, fn, times);
		});
	},
	oneTime: function(interval, label, fn) {
		return this.each(function() {
			jQuery.timer.add(this, interval, label, fn, 1);
		});
	},
	stopTime: function(label, fn) {
		return this.each(function() {
			jQuery.timer.remove(this, label, fn);
		});
	}
});


jQuery.extend({
	timer: {
		global: [],
		guid: 1,
		dataKey: "jQuery.timer",
		regex: /^([0-9]+(?:\.[0-9]*)?)\s*(.*s)?$/,
		powers: {
			// Yeah this is major overkillÉ
			'ms': 1,
			'cs': 10,
			'ds': 100,
			's': 1000,
			'das': 10000,
			'hs': 100000,
			'ks': 1000000
		},
		timeParse: function(value) {
			if (value == undefined || value == null)
				return null;
			var result = this.regex.exec(jQuery.trim(value.toString()));
			if (result[2]) {
				var num = parseFloat(result[1]);
				var mult = this.powers[result[2]] || 1;
				return num * mult;
			} else {
				return value;
			}
		},
		add: function(element, interval, label, fn, times) {
			var counter = 0;
			
			if (jQuery.isFunction(label)) {
				if (!times) 
					times = fn;
				fn = label;
				label = interval;
			}
			
			interval = jQuery.timer.timeParse(interval);

			if (typeof interval != 'number' || isNaN(interval) || interval < 0)
				return;

			if (typeof times != 'number' || isNaN(times) || times < 0) 
				times = 0;
			
			times = times || 0;
			
			var timers = jQuery.data(element, this.dataKey) || jQuery.data(element, this.dataKey, {});
			
			if (!timers[label])
				timers[label] = {};
			
			fn.timerID = fn.timerID || this.guid++;
			
			var handler = function() {
				if ((++counter > times && times !== 0) || fn.call(element, counter) === false)
					jQuery.timer.remove(element, label, fn);
			};
			
			handler.timerID = fn.timerID;
			
			if (!timers[label][fn.timerID])
				timers[label][fn.timerID] = window.setInterval(handler,interval);
			
			this.global.push( element );
			
		},
		remove: function(element, label, fn) {
			var timers = jQuery.data(element, this.dataKey), ret;
			
			if ( timers ) {
				
				if (!label) {
					for ( label in timers )
						this.remove(element, label, fn);
				} else if ( timers[label] ) {
					if ( fn ) {
						if ( fn.timerID ) {
							window.clearInterval(timers[label][fn.timerID]);
							delete timers[label][fn.timerID];
						}
					} else {
						for ( var fn in timers[label] ) {
							window.clearInterval(timers[label][fn]);
							delete timers[label][fn];
						}
					}
					
					for ( ret in timers[label] ) break;
					if ( !ret ) {
						ret = null;
						delete timers[label];
					}
				}
				
				for ( ret in timers ) break;
				if ( !ret ) 
					jQuery.removeData(element, this.dataKey);
			}
		}
	}
});

jQuery(window).bind("unload", function() {
	jQuery.each(jQuery.timer.global, function(index, item) {
		jQuery.timer.remove(item);
	});
});



// JQuery URL Parser
// Written by Mark Perkins, mark@allmarkedup.com
// License: http://unlicense.org/ (i.e. do what you want with it!)
jQuery.url = function()
{
	var segments = {};
	var parsed = {};

	/* Options object. Only the URI and strictMode values can be changed via the setters below. */
  	var options = {
	
		url 		: window.location, // default URI is the page in which the script is running
		strictMode	: false, // 'loose' parsing by default
		key			: ["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"], // keys available to query 
		q : {
			name: "queryKey",
			parser: /(?:^|&)([^&=]*)=?([^&]*)/g
		},
		parser		: {
			strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,  //less intuitive, more accurate to the specs
			loose:  /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/ // more intuitive, fails on relative paths and deviates from specs
		}
	};
	
    /* Deals with the parsing of the URI according to the regex above. Written by Steven Levithan - see credits at top. */		
	var parseUri = function()
	{
		str = decodeURI( options.url );
		
		var m = options.parser[ options.strictMode ? "strict" : "loose" ].exec( str );
		var uri = {};
		var i = 14;

		while ( i-- ) {
			uri[ options.key[i] ] = m[i] || "";
		}

		uri[ options.q.name ] = {};
		uri[ options.key[12] ].replace( options.q.parser, function ( $0, $1, $2 ) {
			if ($1) {
				uri[options.q.name][$1] = $2;
			}
		});

		return uri;
	};

    /* Returns the value of the passed in key from the parsed URI. 
       @param string key The key whose value is required 
    */		
	var key = function( key )
	{
		if ( jQuery.isEmptyObject(parsed) )
		{
			setUp(); // if the URI has not been parsed yet then do this first...	
		} 
		if ( key == "base" )
		{
			if ( parsed.port !== null && parsed.port !== "" )
			{
				return parsed.protocol+"://"+parsed.host+":"+parsed.port+"/";	
			}
			else
			{
				return parsed.protocol+"://"+parsed.host+"/";
			}
		}
	
		return ( parsed[key] === "" ) ? null : parsed[key];
	};
	
	/* Returns the value of the required query string parameter.
	   @param string item The parameter whose value is required
    */		
	var param = function( item )
	{
		if ( jQuery.isEmptyObject(parsed) )
		{
			setUp(); // if the URI has not been parsed yet then do this first...	
		}
		return ( parsed.queryKey[item] === null ) ? null : parsed.queryKey[item];
	};

    /* 'Constructor' (not really!) function.
       Called whenever the URI changes to kick off re-parsing of the URI and splitting it up into segments. 
    */	
	var setUp = function()
	{
		parsed = parseUri();
		getSegments();	
	};
	
    /* Splits up the body of the URI into segments (i.e. sections delimited by '/') */
	var getSegments = function()
	{
		var p = parsed.path;
		segments = []; // clear out segments array
		segments = parsed.path.length == 1 ? {} : ( p.charAt( p.length - 1 ) == "/" ? p.substring( 1, p.length - 1 ) : path = p.substring( 1 ) ).split("/");
	};
	
	return {
		
	    /* Sets the parsing mode - either strict or loose. Set to loose by default.
	       @param string mode The mode to set the parser to. Anything apart from a value of 'strict' will set it to loose!
	    */
		setMode : function( mode )
		{
			options.strictMode = mode == "strict" ? true : false;
			return this;
		},
		
		/* Sets URI to parse if you don't want to to parse the current page's URI. Calling the function with no value for newUri resets it to the current page's URI.
	       @param string newUri The URI to parse.
	     */		
		setUrl : function( newUri )
		{
			options.url = newUri === undefined ? window.location : newUri;
			setUp();
			return this;
		},		
		
		/* Returns the value of the specified URI segment. Segments are numbered from 1 to the number of segments. For example the URI http://test.com/about/company/ segment(1) would return 'about'.  If no integer is passed into the function it returns the number of segments in the URI.
	       @param int pos The position of the segment to return. Can be empty.
	    */	
		segment : function( pos )
		{
			if ( jQuery.isEmptyObject(parsed) )
			{
				setUp(); // if the URI has not been parsed yet then do this first...	
			} 
			if ( pos === undefined )
			{
				return segments.length;
			}
			return ( segments[pos] === "" || segments[pos] === undefined ) ? null : segments[pos];
		},
		
		attr 	: key, // provides public access to private 'key' function - see above
		param 	: param // provides public access to private 'param' function - see above		
	};
}();




/*	Validator - jQuery Plugin
	Awesome form validation and messaging plugin
	Settings are:
	 - element	: Array of elements, contains: selector, rule, field, action (label, border, element)
	 - styles	: Styles for labels and input fields
	 - message	: Is appended to the start of invalid elements 'Please enter a _________'
*/
(function($)
{
	$.validator = function(options) 
	{
		var defaults = 
		{
			elements	: [],
			styles		: { valid : 'form_valid', error : 'form_error' },
			message		: '',
			success		: function(){},
			failed		: function(error_messages){}
		};

		var settings		= $.extend(defaults, options);
		var valid_count		= 0;
		var invalid_count	= 0;
		var element_count	= settings.elements.length;
		var error_messages	= '';

		// Validate Rules
		function validateRequire(value)
		{		
			if (value != '') return true;
			return false;
		}

		function validateInteger(value)
		{		
			if (value > 0) return true;
			return false;
		}

		function validateConfirm(source_value, confirm_selector)
		{
			var confirm_source	= confirm_selector.replace('_confirm', ''); 
			var confirm_value	= $(confirm_source).val();
			var confirm_state	= false;

			if (source_value == confirm_value && source_value != '') confirm_state = true;

			return confirm_state;
		}
		
		function validateEmailAddress(email)
		{
			var email_pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
			return email_pattern.test(email);
		}
		
		function validateUsPhoneNumber(phone_number)
		{
			var phone_number_pattern = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
			return phone_number_pattern.test(phone_number);  
		}
		
		function validateCreditCard(creditcard)
		{
		    if (getCreditCardTypeByNumber(creditcard) == '?') return false;
		    return true;
		}
		
		// Credit Card
		function getCreditCardTypeByNumber(ccnumber) {
		    var cc = (ccnumber + '').replace(/\s/g, ''); //remove space
		 
		    if ((/^(34|37)/).test(cc) && cc.length == 15) {
		        return 'AMEX'; //AMEX begins with 34 or 37, and length is 15.
		    } else if ((/^(51|52|53|54|55)/).test(cc) && cc.length == 16) {
		        return 'MasterCard'; //MasterCard beigins with 51-55, and length is 16.
		    } else if ((/^(4)/).test(cc) && (cc.length == 13 || cc.length == 16)) {
		        return 'Visa'; //VISA begins with 4, and length is 13 or 16.
		    } else if ((/^(300|301|302|303|304|305|36|38)/).test(cc) && cc.length == 14) {
		        return 'DinersClub'; //Diners Club begins with 300-305 or 36 or 38, and length is 14.
		    } else if ((/^(2014|2149)/).test(cc) && cc.length == 15) {
		        return 'enRoute'; //enRoute begins with 2014 or 2149, and length is 15.
		    } else if ((/^(6011)/).test(cc) && cc.length == 16) {
		        return 'Discover'; //Discover begins with 6011, and length is 16.
		    } else if ((/^(3)/).test(cc) && cc.length == 16) {
		        return 'JCB';  //JCB begins with 3, and length is 16.
		    } else if ((/^(2131|1800)/).test(cc) && cc.length == 15) {
		        return 'JCB';  //JCB begins with 2131 or 1800, and length is 15.
		    }
		    return '?';
		}
				
		

		// Message Types
		function messageLabel(valid, element)
		{	
			var selector_error = element.selector + '_error';
			
			// Element has label message
			if (valid && $(selector_error).length != 0)
			{
				$(element.selector + '_error').html('').removeClass(settings.styles.error).addClass(settings.styles.valid);			
				$(element.selector + '_error').oneTime(300, function() { $(this).fadeOut() });
			}
			else
			{	
				// Label exists		
				if ($(selector_error).length != 0)
				{
					$(selector_error).html(settings.message + ' ' + element.field).removeClass(settings.styles.valid).addClass(settings.styles.error);
					$(element.selector + '_error').oneTime(150, function() { $(this).fadeIn() });
				}
			}
		}
		
		function messageBorder(valid, element)
		{
			if (!valid && $(element.selector).length != 0)
			{
				$(element.selector).css('border', '1px solid red');
			}
		}

		function messageElement(valid, element)
		{
			if (!valid && $(element.selector).length != 0)
			{
				$(element.selector).val(element.field).addClass(settings.styles.error);
				$(element.selector).oneTime(1000, function()
				{ 
					$(element.selector).val('').removeClass(settings.styles.error)
				});				
			}
		}
		
		function messageNone()
		{
			return false;
		}


		// Loops through 'elements' and runs values
		$.each(settings.elements, function(index, element)
		{		
			var validate = $(element.selector).val();
			var is_valid = false;
			
			// Validate By Rule
			if (element.rule == 'require')
			{
				is_valid = validateRequire(validate);				
			}
			else if (element.rule == 'require_integer')
			{
				is_valid = validateInteger(validate);				
			}
			else if (element.rule == 'email')
			{
				is_valid = validateEmailAddress(validate);
			}
			else if (element.rule == 'us_phone')
			{
				is_valid = validateUsPhoneNumber(validate);
			}
			else if (element.rule == 'confirm')
			{
				is_valid = validateConfirm(validate, element.selector);
			}
			else if (element.rule == 'credit_card')
			{
				is_valid = validateCreditCard(validate);
			}
			else if (jQuery.isFunction(element.rule))
			{			
				is_valid = element.rule(element.selector);
			}
			else
			{
				is_valid = false;
			}
			
			// Element Action
			if (element.action == 'label')
			{
				messageLabel(is_valid, element);
			}
			else if (element.action == 'border')
			{
				messageBorder(is_valid, element);
			}
			else if (element.action == 'element')
			{
				messageElement(is_valid, element);
			}
			else
			{
				messageNone();
			}
			
			// Valid Count
			if (!is_valid)
			{				
				error_messages += ' ' + element.field + ',';
			}
			else
			{			
				valid_count++;
			}

		});
		
		// Fire Success / Error Callback
		if (valid_count == element_count)
		{
			settings.success();
		}
		else
		{
			var error_output = error_messages.substring(0, error_messages.length - 1);
			settings.failed(error_output);
		}
	};
})(jQuery);



var mysqlDateParser = function(str)
{
	if (str)
	{
		_str = str;
	}
	else
	{
		_str = '0000-00-00 00:00:00';
	}

	var api = 
	{
		date: function(type)
		{
			type = type || 'number';
			m = _str.match(/([0-9])+/gi);

			if (type=='short')
			{
				months = {'00':'00','01':'Jan.','02':'Feb.','03':'Mar.','04':'Apr.','05':'May.','06':'Jun.','07':'Jul.','08':'Aug.','09':'Sep.','10':'Oct.','11':'Nov.','12':'Dec.'};
			}
			else if (type=='long')
			{
				months = {'00':'00','01':'January','02':'February','03':'March','04':'April','05':'May','06':'June','07':'July','08':'August','09':'September','10':'October','11':'November','12':'December'};
			}
			
			if (type!=='number')
			{
				m[1]=months[m[1]];
				d=' ';
			}
			else
			{
				d='/';
			}
			
			return m[1]+d+m[2]+d+m[0];
		},
		time: function()
		{
			m = _str.match(/([0-9])+/gi)
			pmOrAm = 'AM';
			if (m[3]>12)
			{
				m[3] = m[3]-12;
				pmOrAm = 'PM';
			}
			
			return m[3]+':'+m[4]+' '+pmOrAm;
		}
	}
	
	return api;
}


function countElementsArray(item, array)
{
    var count = 0;
	if (array !== undefined)
	{
    	$.each(array, function(i, v) { if (v === item) count++; });
   	}

    return count;
}

