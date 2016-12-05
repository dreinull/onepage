<?php use Markup\Form; ?>
<?php foreach($fields as $field) {
    
    echo '<div class="form-group">';
    switch($field->type) {
        case 'string':
            echo Form::text($field->name, $field->placeholder, f($field->value), [
                'class' => 'form-control input-sm field-input',
                'data-type' => $field->type,
                'data-name' => $field->name,
                'data-id' => $field->id,
                'data-section' => $field->section,
                'data-changed' => 'false',
            ]);
            break;
        case 'text':
            echo Form::textarea($field->name, $field->placeholder, f($field->value), [
                'class' => 'form-control input-sm field-input',
                'data-type' => $field->type,
                'data-name' => $field->name,
                'data-id' => $field->id,
                'data-section' => $field->section,
                'data-changed' => 'false',
                'rows' => 8
            ]);;
            break; // the rules!
        case 'date':
                echo Form::text($field->name, $field->placeholder, f($field->value), [
                'class' => 'form-control input-sm field-input date-input',
                'data-type' => $field->type,
                'data-field' => $field->name,
                'data-id' => $field->id,
                'data-section' => $field->section,
                'data-changed' => 'false',
            ]);
            break;
        case 'integer':
        case 'float':
            echo Form::text($field->name, $field->placeholder, f($field->value), [
                'class' => 'form-control input-sm field-input',
                'data-type' => $field->type,
                'data-field' => $field->name,
                'data-id' => $field->id,
                'data-section' => $field->section,
                'data-changed' => 'false',
            ]);
            break;
        case 'boolean':
            $value = array_key_exists($field->name, $data) ? $data[$field->name] : 0;
            echo Form::checkbox($field->name, $field->placeholder, 1, $value);
            break;
        case 'image':
            echo '<label>' . f($field->placeholder) . '</label>';
            echo '<img src="' . f($field->value) . '" width="30" id="image-preview-'
                . f($field->name) . '">';
            echo Form::textInput($field->name, $field->value, [
                'hidden',
                'data-type' => $field->type,
                'data-field' => $field->name,
                'data-changed' => 'false',
                'data-section' => $field->section,
                'class' => 'field-input image-input',
                'id' => 'image-' . $field->name . $field->id,
            ]);
            echo '<button class="btn-default btn-small select-image" data-target="#file-select" data-remote="false" data-toggle="modal" data-for="#image-' . e($field->name) . '" data-preview="#image-preview-' . e($field->name) . '">Auswählen</button>';
            break;
    }
    echo '</div>';
}
    