<?php

/**@var $this app\core\View */
$this->title = 'Contact';

?>
<h1>Contact the billionaire</h1>
<form action="" method="POST">
  <div class="mb-3">
    <label >Subject </label>
    <input type="text" name="subject" class="form-control">
  </div>
  <div class="mb-3">
    <label >Email </label>
    <input type="text" name="email" class="form-control">
  </div>
  <div class="mb-3">
    <label >Body</label>
    <input type="text" name="body" class="form-control" >
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>