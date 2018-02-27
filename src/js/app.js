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
  $('.arrow-left').on('click', plusSlides(-1));
  $('.arrow-right').on('click', plusSlides(1));
});


function status(response) {
  if (response.status >= 200 && response.status < 300) {
    return Promise.resolve(response)
  } else {
    return Promise.reject(new Error(response.statusText))
  }
}

function blob(response) {
  return response.blob()
}

$(document).ready(function () {

  function fetching(arr, sel) {
    for (let i = 0; i < arr.length; i++) {
      let url = arr[i];
      fetch(url)
        .then(status)
        .then(blob)
        .then(myBlob => {
          let objURL = URL.createObjectURL(myBlob);
          sel[i].src = objURL;
        });
    }
  }

  let btm_partners = ['./images/index/partner/bottom-partners/amazonhead.png', './images/index/partner/bottom-partners/dbshead.png', './images/index/partner/bottom-partners/delhioyehead.png',
    './images/index/partner/bottom-partners/sifhead.png', './images/index/partner/bottom-partners/tisshead.png', './images/index/partner/bottom-partners/united-india-head.png'
  ];
  let partners = $('.btm-partner > img');
  if ($(window).width() > 1200) {

  }

  let news_images = ['.img/bi.png', ''];
  let bg = $('.activator');
  fetching(news_images, bg);


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