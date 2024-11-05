<?php
error_reporting(E_ALL ^ E_WARNING);

function setupResponse($callback)
{
    header('Content-Type: application/json; charset=utf-8');
    $response = array();
    try {
        $response['status'] = 'success';
        $response['content'] = $callback();
    } catch (Throwable $err) {
        $response['status'] = 'error';
        $response['content'] = $err->getMessage();
    }
    return $response;
}
