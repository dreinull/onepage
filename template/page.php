<?php include 'start.php'; ?>

<?php foreach($sections as $section) : ?>
    <?php Onepage\View\Section::make($section->template, $section->templateContent()); ?>
<?php endforeach; ?>

<?php include 'end.php'; ?>