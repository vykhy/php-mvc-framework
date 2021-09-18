<?php

use app\core\form\Form;
/**@var $model app\models\user */

/**@var $this app\core\View */
$this->title = 'Login';
?>

<h1>Login as a billionaire</h1>
<?php $form = Form::begin('', 'post') ?>
  <?php echo $form->field($model, 'email') ?>
  <?php echo $form->field($model, 'password')->passwordField() ?>

  <button type="submit" class="btn btn-primary">Submit</button>

<?php  Form::end() ?>