(function (a) {
   a(function () {
      a(".button-collapse").sideNav();
      a(".collapsible").collapsible();
      Materialize.scrollFire([{
         selector: ".about-img",
         offset: 100,
         callback: function (b) {
            Materialize.fadeInImage(a(b))
         }
      }, {}])
   });
   a(document).ready(function () {
      a(".carrersLinks").click(function () {
         var b = a(this).parent(),
            f = b.index(),
            c = a(b).siblings(),
            d = c.length;
         for (b = 0; b < d; b++) {
            var e = a(c[b]).children();
            a(e).hasClass("activeLinks") && a(e).removeClass("activeLinks")
         }
         a(this).addClass("activeLinks");
         c = a(".form-content");
         d = c.length;
         for (b = 0; b < d; b++) a(c[b]).hasClass("active-field") && a(c[b]).removeClass("active-field");
         a(c[f]).addClass("active-field")
      });
      a(".carousel").carousel({
         dist: -10,
         shift: 30,
         padding: 30
      });
      setInterval(function () {
         a(".carousel").carousel("next")
      }, 2E3);
      a(".slider").slider({
         indicators: !1,
         transition: 800
      });
      a(".modal").modal({
         opacity: .8
      });
      a(".hid").click(function () {
         var b = a(this).parent();
         a(b).find(".figcaption-text").hide();
         a(b).find(".hid").hide();
         a(b).find(".show").show()
      });
      a(".show").click(function () {
         var b = a(this).parent();
         a(b).find(".figcaption-text").show();
         a(b).find(".hid").show();
         a(b).find(".show").hide()
      })
   })
})(jQuery);