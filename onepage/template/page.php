<?php include '_start.php'; ?>

<?php foreach($sections as $section) : ?>
    <section><?php // echo $section->head ?></section>
        
    <?php show($section, 'Datum'); ?>
<?php endforeach; ?>

<?php include '_end.php'; ?>