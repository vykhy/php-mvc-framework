<?php

/**@var $this app\core\View */
/**@var $model \app\models\ContactForm */
use app\core\form\Form;
use app\core\form\TextArea;

$this->title = 'Contact';

?>
<h1>Contact the billionaire</h1>

<?php $form = Form::begin('', 'post') ?>
  <?php echo $form->field($model, 'subject') ?>
  <?php echo $form->field($model, 'email') ?>
  <?php echo new TextArea($model, 'body') ?>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php $form = Form::end() ?>

