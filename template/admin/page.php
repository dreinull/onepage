<?php include '_start.php'; ?>
<?php include '_navigation.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3" id="section-editing">
                
                <button id="" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok"></span></button>
                <button id="" class="btn btn-danger  btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
                <button id="fullscreen-editing" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-fullscreen"></span></button>
                <h3><?php ec($page->name) ?></h3>
                <div class="section-list">
                    <?php foreach($sections as $section) : ?>
                        <div class="item">
                            <a class="section-head" role="button" data-toggle="collapse" href="#section<?php ec($section->id); ?>" aria-expanded="false" aria-controls="section<?php ec($section->id); ?>">
                                <span class="glyphicon glyphicon-align-justify"></span> <?php ec($section->name); ?>
                            </a>
                            <div class="collapse section-body" id="section<?php ec($section->id); ?>">
                                <?php \Onepage\View\SectionEdit::make($section->template, $section->content); ?>
                            </div>
                        </div>
                        
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe src="<?php ec(route('home')); ?>"></iframe>
                </div>
            </div>
        </div>

    </div>

<?php include '_end.php'; ?>