'use strict';

var processStatus = response => {
   if (response.status === 200 || response.status === 0) {
      return Promise.resolve(response);
   } else {
      return Promise.reject(new Error('Error loading: ' + url));
   }
};

var parseBlob = response => {
   return response.blob();
};

fetch(imageUrl)
   .then(processStatus)
   .then(parseBlob)
   .then(blobData => createImageBitmap(blobData))
   .then(imageBitmap => {
      self.postMessage({
         imageBitmap
      }, [imageBitmap]);
   }, err => {
      self.postMessage({
         err
      });
   });