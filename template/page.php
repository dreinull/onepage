<?php include 'start.php'; ?>

<?php foreach($sections as $section) : ?>
    <?php Onepage\View\Section::make($section->template, $section->content); ?>
<?php endforeach; ?>

<?php include 'end.php'; ?>