!function(i){i(function(){i(".button-collapse").sideNav(),i(".collapsible").collapsible();var e=[{selector:".about-img",offset:100,callback:function(e){Materialize.fadeInImage(i(e))}},{}];Materialize.scrollFire(e)}),i(document).ready(function(){i(".carrersLinks").click(function(){for(var e=i(this).parent(),a=e.index(),s=i(e).siblings(),t=s.length,n=0;n<t;n++){var l=i(s[n]).children();i(l).hasClass("activeLinks")&&i(l).removeClass("activeLinks")}i(this).addClass("activeLinks");for(var o=i(".form-content"),c=o.length,n=0;n<c;n++)i(o[n]).hasClass("active-field")&&i(o[n]).removeClass("active-field");i(o[a]).addClass("active-field")}),i(".carousel").carousel({dist:-10,shift:30,padding:30}),setInterval(function(){i(".carousel").carousel("next")},2e3),i(".slider").slider({indicators:!1,transition:800}),i(".modal").modal({opacity:.8}),i(".hid").click(function(){var e=i(this).parent();i(e).find(".figcaption-text").hide(),i(e).find(".hid").hide(),i(e).find(".show").show()}),i(".show").click(function(){var e=i(this).parent();i(e).find(".figcaption-text").show(),i(e).find(".hid").show(),i(e).find(".show").hide()})})}(jQuery);