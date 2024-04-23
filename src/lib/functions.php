<?php

function redirectToUrl(string $url)
{
    header('Location: ' . $url);
    exit();
}
