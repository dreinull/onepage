<?php include '_start.php'; ?>
<?php include '_navigation.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3" id="section-editing">
                
                <button id="" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok"></span></button>
                <button id="" class="btn btn-danger  btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
                <button id="fullscreen-editing" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-fullscreen"></span></button>
                <h3><?php ec($page->name) ?></h3>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php foreach($sections as $section) : ?>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php ec($section->id); ?>" aria-expanded="true" aria-controls="collapseOne">
                                        <?php ec($section->name); ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse<?php ec($section->id); ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <?php \Onepage\View\SectionEdit::make($section->template, $section->content); ?>
                                </div>
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