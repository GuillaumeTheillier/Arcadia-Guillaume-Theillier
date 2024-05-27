<?php

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
            $message =  'L\'extension n\'est pas valide. Extensions valides : jpg, jpeg et png.';
        }
    } else {
        $message = 'Erreur lors du téléchargement de l\'image.';
    }
    /*
    setcookie(
        'SERVICE_ERROR',
        $message,
        [
            'expires' => time() + 2,
            'httponly' => true,
            'secure' => true
        ]
    );*/

    throw new Exception($message);
}
