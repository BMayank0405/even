var slideIndex = 1;

function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      if (n > slides.length) {
            slideIndex = 1
      }
      if (n < 1) {
            slideIndex = slides.length
      }
      for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
      }
      slides[slideIndex - 1].style.display = "block";
}

showSlides(slideIndex);

function plusSlides(n) {
      showSlides(slideIndex += n);
}


$(document).ready(function () {

      async function fetching(urls, sel, i) {
            const blobs = urls.map(async url => {
                  const resp = await fetch(url);
                  return resp.blob();
            });
            for (const blob of blobs) {
                  let parsed_blob = await blob;
                  let response = URL.createObjectURL(parsed_blob);
                  sel[i].src = response;
                  i++;
            }
      }


      let partner = ['./images/index/partner/clovia.png', './images/index/partner/flyrobe.png', './images/index/partner/vajor.jpeg', './images/index/partner/dbs-foundation.jpg', './images/index/partner/singapore-international-foundation.png', './images/index/partner/tiss.jpeg'];
      let partner_sel = $('.carousel-item > img');

      fetching(partner, partner_sel, 0);

      let btm_partners_sel = $('.btm-partner > img');
      let btm_partners = ['./images/index/partner/bottom-partners/amazonhead.png', './images/index/partner/bottom-partners/dbshead.png', './images/index/partner/bottom-partners/delhioyehead.png',
            './images/index/partner/bottom-partners/sifhead.png', './images/index/partner/bottom-partners/tisshead.png', './images/index/partner/bottom-partners/united-india-head.png'
      ];

      if ($(window).width() > 1200) {
            fetching(btm_partners, btm_partners_sel, 0);
      }



      const news_images = ['./images/index/media/hindustan-times.jpeg', './images/index/media/makers.jpeg', './images/index/media/newyorker.jpeg', './images/index/media/ndtv.jpeg'];
      const news_sel = $('.card-image > img');
      fetching(news_images, news_sel, 1);

      const logo_images = ['./images/index/media/hindustan-times-logo.png', './images/index/media/makers-logo.png', './images/index/media/nytime-logo.png', './images/index/media/ndtvindia-logo.png']
      const logo_sel = $('.card-content > img');
      fetching(logo_images, logo_sel, 1);


      let youtube = ['https://www.youtube.com/embed/17Vv24N4sYg?rel=0&amp;showinfo=0',
            'https://www.youtube.com/embed/JLeddWPG6oU?rel=0&amp;showinfo=0',
            'https://www.youtube.com/embed/pWnWb0432KU?rel=0&amp;showinfo=0',
            'https://www.youtube.com/embed/H_2dKgoWvS0?rel=0&amp;showinfo=0',

      ];
      let video_container = $('.youtube-video').children();
      for (let i = 0; i < 4; i++) {
            video_container[i].src = `${youtube[i]}`;
      }

      //'https://www.youtube.com/embed/QN0-B-CIRU8?ecver=2'




});