<?php include '_start.php'; ?>
<?php include '_navigation.php'; ?>

<div class="container">
    <a href="<?php echo route('admin-add-page'); ?>">Seite hinzufügen</a>
    <ul class="pages">
    <?php foreach($pages as $page) : ?>
        <li><?php ec($page->name); ?></li>
    <?php endforeach; ?>
    </ul>
</div>

<?php include '_end.php'; ?>