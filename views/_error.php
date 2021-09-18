<?php

/**@var $exception \Exception */
/**@var $this app\core\View */
$this->title = 'Error';

?>

<h1><?php echo $exception->getCode(). ' - ' . $exception->getMessage() ?> </h1>