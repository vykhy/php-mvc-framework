<?php

namespace app\core\exceptions;

class NotFoundException extends \Exception
{
    protected $message = "This page does not exist";
    protected $code = 404;

}
?>