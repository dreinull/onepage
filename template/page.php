<?php include 'start.php'; ?>

<?php foreach($sections as $section) : ?>
    <?php Onepage\View\Section::make($section->template, sectionContent($section)); ?>
<?php endforeach; ?>

<?php include 'end.php'; ?>