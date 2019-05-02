<?php


$router->get('/api/images', function() {
    return (new Ziki\Core\UploadImage)->getAllImages();
});
  
$router->post('/api/upload-image', function() {
    return (new Ziki\Core\UploadImage)->upload();
});
  

