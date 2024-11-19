<?php

/**
 * Redirect to the url specified in param
 * 
 * @param string $url Url to redirect
 */
function redirectToUrl(string $url)
{
    header('Location: ' . $url);
    //exit();
}
