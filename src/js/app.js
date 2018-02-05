(function () {
      'use strict';


      // fetch('de2.webp')
      //       .then(processStatus)
      //       .then(parseBlob)
      //       .then(myBlob => {
      //             var objURL = URL.createObjectURL(myBlob);
      //             $(".about-img > picture > img ")[0].src = objURL;
      //       });

})();

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

    function fetching( arr , sel) {
      for(let i=0 ; i < arr.length ; i++){
            let url  = arr[i];
            fetch(url)
            .then(status)
            .then(blob)
            .then(myBlob => {
                  let objURL = URL.createObjectURL(myBlob);
                  sel[i].src = objURL;
            });
      }
    }  

    let btm_partners = ['./img/aboutus/amazonhead.png','./img/aboutus/dbshead.png','./img/aboutus/delhioyehead.png',
    './img/aboutus/sifhead.png','./img/aboutus/tisshead.png','./img/aboutus/united-india-head.png'];  
    let partners = $('.btm-partner > picture > img');
    if($(window).width() > 1200) {fetching(btm_partners , partners)
    }

    let news_images = ['.img/bi.png' ,''];
    let bg = $('.activator');
    fetching(news_images,bg);


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