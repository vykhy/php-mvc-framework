<?php

namespace app\core\exceptions;

class ForbiddenException extends \Exception
{
    protected $message = "You don't have perimssion to access this page";
    protected $code = 403;
}
?>