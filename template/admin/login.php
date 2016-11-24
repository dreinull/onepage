<?php use Markup\Form; ?>

<?php include '_start.php'; ?>

<?php echo Form::open(route('login-post')); ?>

<div class="container">
    <?php echo Form::text('username', 'Benutzername'); ?>
    <?php echo Form::text('password', 'Passwort'); ?>
    <?php echo Form::submit('Login'); ?>
</div>

<?php echo Form::close(); ?> 

<?php include '_end.php'; ?>