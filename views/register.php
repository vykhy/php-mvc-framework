
<h1>Register a billionaire</h1>
<?php $form = app\core\form\Form::begin('', 'post') ?>
  <?php echo $form->field($model, 'name') ?>
  <?php echo $form->field($model, 'email') ?>
  <?php echo $form->field($model, 'password')->passwordField() ?>
  <?php echo $form->field($model, 'confirmPassword')->passwordField() ?>

  <button type="submit" class="btn btn-primary">Submit</button>

<?php  \app\core\form\Form::end() ?>
