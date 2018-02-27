      var head = document.getElementsByTagName('head')[0];

      // Save the original method
      var insertBefore = head.insertBefore;

      // Replace it!
      head.insertBefore = function (newElement, referenceElement) {
    
      if (newElement.href && newElement.href.indexOf('https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/fonts/roboto/Roboto-Regular.woff2') === 0) {
          return;
      }
    
      insertBefore.call(head, newElement, referenceElement);
};
      function initMap() {
      
        var even = {lat: 28.516668, lng: 77.198741};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: even
        });
        var marker = new google.maps.Marker({
          position: even,
          map: map
        });
      }