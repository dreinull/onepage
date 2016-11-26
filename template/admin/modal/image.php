<?php // Images have the attribues: id, url, title, alt
include '_start.php';
?>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-9">
            <?php foreach(array_chunk($images, 4) as $row) : ?>
                <div class="row">
                    <?php foreach($row as $image) : ?>
                        <div class="col-xs-3">
                            <img src="<?php echo getImageUrl($image->filename); ?>" alt="<?php ec($image->alt); ?>" data-id="<?php ec($image->id); ?>" class="img-responsive">
                            <p><?php ec($image->title); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include '_end.php';