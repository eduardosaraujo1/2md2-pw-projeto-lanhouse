<?php
function raiseInvalidRequestMethod()
{
    throw new Exception("Invalid request method. Expected 'POST' received '" . $_SERVER["REQUEST_METHOD"] . "'");
}

function raiseMissingParameters($campos)
{
    throw new Exception("Missing Fields. Could not find '" . implode(', ', $campos) . "'");
}

function raiseInvalidParameter($fieldname, $extra = "")
{
    $extra = empty($extra) ? $extra : ". $extra";
    throw new Exception("Invalid Parameter. Field '$fieldname' is not in a valid format$extra");
}

function raiseInvalidSession()
{
    throw new Exception("Invalid Session. Please sign in to use the app.");
}

function raiseQueryError($error)
{
    throw new Exception("SQL query error. " . $error);
}
