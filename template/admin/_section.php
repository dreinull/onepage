<div class="item">
    <a class="section-head" role="button" data-toggle="collapse" href="#section<?php ec($section->id); ?>" aria-expanded="false" aria-controls="section<?php ec($section->id); ?>">
        <span class="glyphicon glyphicon-align-justify"></span> <?php ec($section->name); ?>
    </a>
    <div class="collapse section-body" id="section<?php ec($section->id); ?>" data-id="<?php ec($section->id); ?>">
        <?php \Onepage\View\SectionEdit::make($section->template, $section->content); ?>
    </div>
</div>