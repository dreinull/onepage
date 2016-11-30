<?php include '_start.php'; ?>
<?php include '_navigation.php'; ?>
<div id="app">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3" id="section-editing">
                <button id="save-sections" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok"></span></button>
                <button id="" class="btn btn-danger  btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
                <button id="fullscreen-editing" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-fullscreen"></span></button>
                <h3><?php ec($page->name) ?></h3>
                <div class="section-list">
                    <?php foreach($sections as $section) : ?>
                        <div class="item" id="s<?php ec($section->id); ?>">
                            <div class="section-head" >
                                <span class="glyphicon glyphicon-align-justify"></span>
                                <div class="section-name clickable">
                                    <?php echo \Markup\Form::textInput('sectionname', $section->name, ['disabled', 'data-changed' => 'false', 'data-section' => $section->id]) ?>
                                </div>
                                <a role="button" data-toggle="collapse" href="#section<?php ec($section->id); ?>" aria-expanded="false" aria-controls="section<?php ec($section->id); ?>">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                            </div>
                            <div class="collapse section-body" id="section<?php ec($section->id); ?>" data-id="<?php ec($section->id); ?>">
                                <?php \Onepage\View\SectionEdit::make($section->template, $section->content); ?>
                            </div>
                        </div>
                        
                    <?php endforeach; ?>
                </div>
                <div class="add-section">
                    <button class="btn btn-default btn-xs" type="button" data-toggle="collapse" data-target="#add-section-list" aria-expanded="false" aria-controls="add-section-list">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                    <div id="add-section-list" class="collapse">
                        <?php foreach(getAllSections() as $section) : ?>
                            <a href="#" class="add-this-section" data-template="<?php ec($section->name); ?>" data-page="<?php ec($page->id); ?>"><?php ec($section->conf->title); ?></a>
                        <?php endforeach; ?>
                    </div>
                    <?php echo \Markup\Form::open(route('admin-section-post'), ['id' => 'add-section-form']); ?>
                        <?php echo \Markup\Form::hidden('template', null, ['id' => 'add-section-template']); ?>
                        <?php echo \Markup\Form::hidden('page_id', null, ['id' => 'add-section-page']); ?>
                        <?php echo \Markup\Form::text('name', 'Name', null, ['id' => 'add-section-name']); ?>
                    <?php echo \Markup\Form::close(); ?>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe id="page-preview" src="<?php ecRoute('home'); ?>"></iframe>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include '_end.php'; ?>