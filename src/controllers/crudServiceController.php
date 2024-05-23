<?php

require_once('src/lib/functions.php');
require_once('src/model/services.php');

function servicesRepository()
{
    return $servicesRepository = new ServicesRepository;
}

function editService()
{
    if (isset($_POST['editServiceId']) && isset($_POST['serviceTitle']) && isset($_POST['serviceDescription'])) {

        $id = (int)$_POST['editServiceId'];
        var_dump($id);
        $title = htmlspecialchars($_POST['serviceTitle']);
        $description = nl2br(htmlspecialchars($_POST['serviceDescription']));
        $descAdd = nl2br(htmlspecialchars($_POST['serviceDescAdd']));

        //initialize variable $data for image data
        $data = '';

        //check if user want upload an image to modify them
        //$_Files[] Error code 4 : No file was uploaded
        if ($_FILES['serviceImage']['error'] !== 4) {
            $imageFile = $_FILES['serviceImage'];
            $imageExt = pathinfo($_FILES['serviceImage']['name'], PATHINFO_EXTENSION);
            $extensions = ['jpg', 'png', 'jpeg'];

            //Image max size 
            $maxSize = 400000;

            if (in_array($imageExt, $extensions) && $imageFile['size'] <= $maxSize) {

                //Move image to a tmp folder
                move_uploaded_file($imageFile['tmp_name'], 'tmp/' . $imageFile['name']);
                $data = file_get_contents('tmp/' . $imageFile['name']);
                $data = base64_encode($data);
                //var_dump($data);


                //delete image saved in tmp folder
                unlink('tmp/' . $imageFile['name']);
            } else {
                setcookie(
                    'SERVICE_ERROR',
                    'Erreur lors du téléchargement de l\'image',
                    [
                        'expires' => time() + 2,
                        'httponly' => true,
                        'secure' => true
                    ]
                );
            }
        }

        //var_dump([$id, $title, $description, $data, $descAdd]);
        //send information to modify them in database
        $success = servicesRepository()->editService($id, $title, $description, $data, $descAdd);

        setcookie(
            'SERVICE_SUCCESS',
            $success,
            [
                'expires' => time() + 2,
                'httponly' => true,
                'secure' => true
            ]
        );
    } else {
        setcookie(
            'SERVICE_ERROR',
            'Toutes les entrées obligatoires n\'ont pas été rempli',
            [
                'expires' => time() + 5,
                'httponly' => true,
                'secure' => true
            ]
        );
    }

    //redirect to the service page
    redirectToUrl('index.php?action=services');
}

function deleteService()
{
    $id = $_POST['deleteServiceId'];

    servicesRepository()->deleteService($id);

    //redirect to the service page
    redirectToUrl('index.php?action=services');
}

function createService()
{
    var_dump($_FILES['serviceImage']);
    //var_dump($_POST['serviceTitle']);
    //var_dump($_POST['serviceDescription']);
    //var_dump($_POST['serviceDescAdd']);

    if (isset($_POST['serviceTitle']) && isset($_POST['serviceDescription']) && $_FILES['serviceImage']['error'] !== 4) {

        $title = htmlspecialchars($_POST['serviceTitle']);
        $description = nl2br(htmlspecialchars($_POST['serviceDescription']));
        $descAdd = nl2br(htmlspecialchars($_POST['serviceDescAdd']));

        $imageFile = $_FILES['serviceImage'];
        $imageExt = pathinfo($_FILES['serviceImage']['name'], PATHINFO_EXTENSION);
        $extensions = ['jpg', 'png', 'jpeg'];

        //Image max size 
        $maxSize = 400000;
        //var_dump($imageExt);
        //var_dump($imageFile['error']);

        if (in_array($imageExt, $extensions) && $imageFile['size'] <= $maxSize) {

            //Move image to a tmp folder
            move_uploaded_file($imageFile['tmp_name'], 'tmp/' . $imageFile['name']);
            $data = file_get_contents('tmp/' . $imageFile['name']);
            $data = base64_encode($data);
            //var_dump($data);
            //var_dump([$id, $title, $description, $imageFile, $descAdd]);
            $success = servicesRepository()->newService($title, $description, $data, $descAdd);

            //delete image saved in tmp folder
            unlink('tmp/' . $imageFile['name']);

            setcookie(
                'CREATE_SERVICE_SUCCESS',
                $success,
                [
                    'expires' => time() + 2,
                    'httponly' => true,
                    'secure' => true
                ]
            );
        } else {
            setcookie(
                'CREATE_SERVICE_ERROR',
                'Erreur lors du téléchargement de l\'image',
                [
                    'expires' => time() + 1,
                    'httponly' => true,
                    'secure' => true
                ]
            );
        }
    } else {
        setcookie(
            'CREATE_SERVICE_ERROR',
            'Toutes les entrées obligatoires n\'ont pas été rempli',
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );
    }

    //redirect to the service page
    //redirectToUrl('index.php?action=services');
}
