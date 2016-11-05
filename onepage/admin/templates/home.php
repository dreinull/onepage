<?php include 'start.php'; ?>
<?php include 'navigation.php'; ?>

<a href="<?php echo route('admin-add-page'); ?>">Seite hinzufügen</a>
<ul class="pages">
<?php foreach($pages as $page) : ?>
    <li></li>
<?php endforeach; ?>    
</ul>

<?php include 'end.php'; ?>