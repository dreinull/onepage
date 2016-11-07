<?php include '_start.php'; ?>
<?php include '_navigation.php'; ?>

<div class="container">
    <a href="<?php echo route('admin-add-page'); ?>">Seite hinzufügen</a>
    <ul class="pages-list">
    <?php foreach($pages as $page) : ?>
        <li><a href="#">
            <img src="<?php component('admin', 'icons', 'page.png'); ?>" alt="Seite">
            <p><?php ec($page->name); ?></p>
        </a></li>
    <?php endforeach; ?>
    </ul>
</div>

<?php include '_end.php'; ?>