(function () {
      'use strict';

      var processStatus = response => {
            if (response.status === 200 || response.status === 0) {
                  return Promise.resolve(response)
            } else {
                  return Promise.reject(new Error('Error loading: ' + url))
            }
      };

      var parseBlob = response => {
            return response.blob();
      };

      fetch('de2.webp')
            .then(processStatus)
            .then(parseBlob)
            .then(myBlob => {
                  var objURL = URL.createObjectURL(myBlob);
                  $(".about-img > picture > img ")[0].src = objURL;
            });

      // fetch('vp9.mp4')
      //       .then(processStatus)
      //       .then(parseBlob)
      //       .then(myBlob => {
      //             var objURL = URL.createObjectURL(myBlob);
      //             $(".background-slider > video")[0].src = objURL;
      //       });

      let arr = ['https://www.youtube.com/embed/17Vv24N4sYg?ecver=2',
            'https://www.youtube.com/embed/JLeddWPG6oU?ecver=2',
            'https://www.youtube.com/embed/pWnWb0432KU?ecver=2',
            'https://www.youtube.com/embed/QN0-B-CIRU8?ecver=2'
      ];
      let video_container = $('.youtube-video').children();
      for (let i = 0; i < 4; i++) {
            video_container[i].src = `${arr[i]}`;
      }



})();