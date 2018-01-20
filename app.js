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

      fetch('vp9.mp4')
            .then(processStatus)
            .then(parseBlob)
            .then(myBlob => {
                  var objURL = URL.createObjectURL(myBlob);
                  $(".background-slider > video > source")[0].src = objURL;
            })


})();