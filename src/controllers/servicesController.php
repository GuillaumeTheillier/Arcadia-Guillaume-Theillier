<?php

use function PHPSTORM_META\type;

require_once('src/model/services.php');

function servicesRepository()
{
    $servicesRepository = new ServicesRepository;

    return $servicesRepository;
}

function services()
{
    $services = servicesRepository()->getServices();

    require('templates/services.php');
}

function editService()
{
    if (isset($_POST['editServiceId']) && isset($_POST['serviceTitle']) && isset($_POST['serviceDescription']) && isset($_POST['serviceDescAdd']) && isset($_FILES['serviceImage'])) {
        $id = $_POST['editServiceId'];
        $title = $_POST['serviceTitle'];
        $description = $_POST['serviceDescription'];
        $descAdd = $_POST['serviceDescAdd'];

        $imageFile = $_FILES['serviceImage'];
        $imageExt = explode('/', $imageFile['type']);
        $imageExt = $imageExt[1];
        $extensions = ['jpg', 'png', 'jpeg'];
        //Image max size 
        $maxSize = 400000;

        //var_dump($imageExt);

        if (true) { //in_array($imageExt[0], $extensions)) && $imageFile['size'] <= $maxSize && $imageFile['error'] === 0) {
            //move_uploaded_file($imageFile['tmp_name'], 'tmp/' . $imageFile['name']);

            $data = file_get_contents('B:\Etude\STUDI\DWWM\ECF\Images\Services\petit-train.jpg');
            //var_dump(base64_encode($data));
            $success = servicesRepository()->editService($id, $title, $description, $data, $descAdd);
        } else {
            setcookie(
                'SERVICE_ERROR',
                'Erreur lors du téléchargement de l\'image',
                [
                    'expires' => time() + 1,
                    'httponly' => true,
                    'secure' => true
                ]
            );
            var_dump('fffffff');
        }

        //var_dump([$id, $title, $description, $imageFile, $descAdd]);

        setcookie(
            'SERVICE_SUCCESS',
            $success,
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );

        //redirect to the service page
        services();
    }
}

function imageUpload()
{
}

function deleteService()
{
    $id = $_POST['deleteServiceId'];

    servicesRepository()->deleteService($id);
    //redirect to the service page
    services();
}

function newService()
{
    $title = $_POST['serviceTitle'];
    $description = $_POST['serviceDescription'];
    $descAdd = $_POST['serviceDescAdd'];
    $image = '';

    servicesRepository()->newService($title, $description, $image, $descAdd);
    //redirect to the service page
    services();
}
