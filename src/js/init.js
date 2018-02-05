(function ($) {
  $(function () {
    $('.button-collapse').sideNav();
    $('.collapsible').collapsible();
    //scroll fire for materialize
    var options = [{
      selector: '.about-img',
      offset: 100,
      callback: function (el) {
        Materialize.fadeInImage($(el));
      }
    }, {

    }];
    Materialize.scrollFire(options);

    
var slideIndex = 1;
function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      if (n > slides.length) {slideIndex = 1}    
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      slides[slideIndex - 1].style.display = "block";
      }
      
showSlides(slideIndex);

function plusSlides(n) {
      showSlides(slideIndex += n);
}


  });
  $(document).ready(function () {
    $(".carrersLinks").click(function () {
      var parent = $(this).parent();
      var sectionShown = parent.index();
      var sibling = $(parent).siblings();
      var len = sibling.length;
      for (var i = 0; i < len; i++) {
        var anchor = $(sibling[i]).children();
        if ($(anchor).hasClass("activeLinks")) {
          $(anchor).removeClass("activeLinks");
        }
      }
      $(this).addClass("activeLinks");
      var form = $(".form-content");
      var len2 = form.length;
      for (var i = 0; i < len2; i++) {
        if ($(form[i]).hasClass("active-field")) {
          $(form[i]).removeClass("active-field");
        }
      }
      $(form[sectionShown]).addClass("active-field");
    });
    $('.carousel').carousel({
      dist: -10,
      shift: 30,
      padding: 30
    });
    setInterval(function () {
      $('.carousel').carousel('next');
    }, 2000);
    $('.slider').slider({
      indicators: false,
      transition: 800
    });
    $('.modal').modal({
      opacity: 0.8
    });

    $(".hid").click(function () {
      var parent = $(this).parent();
      $(parent).find('.figcaption-text').hide();
      $(parent).find('.hid').hide();
      $(parent).find('.show').show();
    });
    $(".show").click(function () {
      var parent = $(this).parent();
      $(parent).find('.figcaption-text').show();
      $(parent).find('.hid').show();
      $(parent).find('.show').hide();
    });


  });

})(jQuery);