<?php

/**
 * Check if data of image is correct and encode them in base64.
 * 
 * @param array $imageFile Array of all image information.
 * @return string data encode in base64.
 */
function imageVerification(array $imageFile): string
{
    //check if user want upload an image to modify them
    //$_Files[]['error'] UPLOAD_ERR_OK : There is no error, the file uploaded with success.
    if ($imageFile['error'] === UPLOAD_ERR_OK) {
        //initialize variable to check image file uploaded
        $data = null;
        $extensions = ['jpg', 'png', 'jpeg', 'webp'];
        $mimeTypeApproved = ['image/jpeg', 'image/png', 'image/webp'];
        //Image max size : 500Ko
        $maxSize = 500000;
        $imageExt = pathinfo($imageFile['name'], PATHINFO_EXTENSION);
        //MIME type
        $mimeTypeImage = mime_content_type($imageFile['tmp_name']);
        //Check image extension and MIME type
        if (in_array($imageExt, $extensions) && in_array($mimeTypeImage, $mimeTypeApproved)) {
            //test image size
            if ($imageFile['size'] <= $maxSize) {
                $filename = 'tmp/' . $imageFile['name'];
                //Check if it's image data inside file
                if ($re = exif_imagetype($imageFile['tmp_name']) !== false) {
                    //Move image to a tmp folder
                    move_uploaded_file($imageFile['tmp_name'], $filename);
                    //Convert image in webp format
                    ConvertImage($filename, $imageExt);
                    $data = file_get_contents('tmp/convertImageWebp.webp');
                    $data = base64_encode($data);
                    //delete image saved in tmp folder
                    unlink('tmp/convertImageWebp.webp');
                    unlink($filename);
                    return $data;
                } else {
                    $message = 'Le fichier téléchargé ne contient pas de donnée d\'image.';
                }
            } else {
                $message =  'L\'image est trop volumineuse. La taille maximale est de ' . ($maxSize / 1000) . 'Ko.';
            }
        } else {
            $message =  'L\'extension n\'est pas valide. Extensions valides : jpeg, png et webp.';
        }
    } else {
        $message = 'Erreur lors du téléchargement de l\'image.';
    }
    throw new Exception($message);
}
/**
 * Convert image into webp format
 */
function ConvertImage(string $filename, string $extension)
{
    switch ($extension) {
        case 'jpg':
            $image = imagecreatefromjpeg($filename);
            break;
        case 'jpeg':
            $image = imagecreatefromjpeg($filename);
            break;
        case 'png':
            $image = imagecreatefrompng($filename);
            break;
        case 'webp':
            break;
        default:
            $message =  'L\'extension n\'est pas valide. Extensions valides : jpg, jpeg, png et webp.';
            break;
    }
    imagewebp($image, 'tmp/convertImageWebp.webp');
}
