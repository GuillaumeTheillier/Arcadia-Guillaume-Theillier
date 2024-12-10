<?php
require_once(__DIR__ . '/../lib/functions.php');
var_dump($_SESSION);

function isGranted(string $roleGranted): void
{
    if (isset($_SESSION['ROLE'])) {
        $roleConnected = $_SESSION['ROLE'];
    } else {
        $roleConnected = 'ROLE_VISITOR';
    }

    if ($roleConnected !== $roleGranted) {
        redirectToUrl('index.php?action=staffLogin');
    }
}
