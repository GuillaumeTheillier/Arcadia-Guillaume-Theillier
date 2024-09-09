<?php

/**
 * Check if data of image is correct and encode them in base64.
 * 
 * @param array $imageFile Array of all image information.
 * @return string data encode in base64.
 *//*
function imageVerification(array $imageFile): string
{
    //initialize variable $data for image data
    $data = '';
    //check if user want upload an image to modify them
    //$_Files[] Error code 4 : No file was uploaded
    if ($imageFile['error'] !== 4 || $imageFile === null) {
        $imageExt = pathinfo($imageFile['name'], PATHINFO_EXTENSION);
        $extensions = ['jpg', 'png', 'jpeg'];
        //Image max size : 400Ko
        $maxSize = 400000;

        //Test image extension
        if (in_array($imageExt, $extensions)) {
            //test image size
            if ($imageFile['size'] <= $maxSize) {
                //Move image to a tmp folder
                move_uploaded_file($imageFile['tmp_name'], 'tmp/' . $imageFile['name']);
                $data = file_get_contents('tmp/' . $imageFile['name']);
                $data = base64_encode($data);
                //var_dump($data);
                //delete image saved in tmp folder
                unlink('tmp/' . $imageFile['name']);
                return $data;
            } else {
                $message =  'L\'image est trop volumineuse. La taille maximale est de 400Ko.';
            }
        } else {
            $message =  'L\'extension n\'est pas valide. Extensions valides : jpg, jpeg, png et webp.';
        }
    } else {
        $message = 'Erreur lors du téléchargement de l\'image.';
    }
    throw new Exception($message);
}*/

/**
 * Check if data of image is correct and encode them in base64.
 * 
 * @param array $imageFile Array of all image information.
 * @return string data encode in base64.
 */
function imageVerification(array $imageFile): string
{
    //initialize variable $data for image data
    $data = '';
    //check if user want upload an image to modify them
    //$_Files[] Error code 4 : No file was uploaded
    if ($imageFile['error'] !== 4 || $imageFile === null) {
        $imageExt = pathinfo($imageFile['name'], PATHINFO_EXTENSION);
        $extensions = ['jpg', 'png', 'jpeg', 'webp'];
        //Image max size : 500Ko
        $maxSize = 500000;

        //Test image extension
        if (in_array($imageExt, $extensions)) {
            //test image size
            if ($imageFile['size'] <= $maxSize) {
                $filename = 'tmp/' . $imageFile['name'];
                //Move image to a tmp folder
                move_uploaded_file($imageFile['tmp_name'], $filename);
                //Convert image in webp format
                ConvertImage($filename, $imageExt);
                $data = file_get_contents('tmp/convertImageWebp.webp');
                $data = base64_encode($data);
                //var_dump($data);
                //delete image saved in tmp folder
                unlink('tmp/convertImageWebp.webp');
                unlink($filename);
                return $data;
            } else {
                $message =  'L\'image est trop volumineuse. La taille maximale est de ' . ($maxSize / 1000) . 'Ko.';
            }
        } else {
            $message =  'L\'extension n\'est pas valide. Extensions valides : jpg, jpeg, png et webp.';
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
