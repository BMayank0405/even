(function () {
   'use strict';
   var starting = "<span><b>E</b>ven</span><span><b>C</b>argo</span>is a social enterprise that < strong > employs women</strong > from resource poor communities and trains them for employment opportunities with the major e - commerce companies.<br/> <br/>Our focus is to overcome the barriers of unemployment through < strong > skill development of women</strong >";
   var about_us = " to increase the participation of women workforce in labour market.";

   var about_img = $('.about-img > img');
   fetch('./de2.webp')
      .then(function (response) {
         if (response.ok) return response.blob;
         throw new Error('NEtwork error');
      })
      .then(function (myBlob) {
         var objURL = URL.createObjectURL(myBlob);
         about_img.src = objURL;
      })
      .catch(function (error) {
         console.log(`problem ${error.message}`);
      });


   $('.about-text > p').textContent = about_us;
})();