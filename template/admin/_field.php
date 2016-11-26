<?php use Markup\Form; ?>

<?php foreach($fields as $field) {
    echo '<div class="form-group">';
    switch($field->type) {
        case 'string':
            echo Form::text($field->name, $field->placeholder, getFromArray($field->name, $data), [
                'class' => 'form-control input-sm field-input',
                'data-type' => $field->type,
                'data-field' => $field->name,
                'data-changed' => 'false',
            ]);
            break;
        case 'text':
            echo Form::textarea($field->name, $field->placeholder, getFromArray($field->name, $data), [
                'class' => 'form-control input-sm field-input',
                'data-type' => $field->type,
                'data-field' => $field->name,
                'data-changed' => 'false',
                'rows' => 8
            ]);;
            break; // the rules!
        case 'date':
                echo Form::text($field->name, $field->placeholder, getFromArray($field->name, $data), [
                'class' => 'form-control input-sm field-input date-input',
                'data-type' => $field->type,
                'data-field' => $field->name,
                'data-changed' => 'false',
            ]);
            break;
        case 'integer':
        case 'float':
            echo Form::text($field->name, $field->placeholder, getFromArray($field->name, $data), [
                'class' => 'form-control input-sm field-input',
                'data-type' => $field->type,
                'data-field' => $field->name,
                'data-changed' => 'false',
            ]);
            break;
        case 'boolean':
            $value = array_key_exists($field->name, $data) ? $data[$field->name] : 0;
            echo Form::checkbox($field->name, $field->placeholder, 1, $value);
            break;
        case 'image':
            echo '<img src="' . getFromArray([$field->name, 'url'], $data) . '" width="30">';
            echo Form::textInput($field->name, getFromArray([$field->name, 'id'], $data), [
                'hidden',
                'data-type' => $field->type,
                'data-field' => $field->name,
                'data-changed' => 'false',
                'class' => 'image-input'
            ]);
            echo '<button class="btn-default btn-small select-image" data-target="#file-select" data-remote="false" data-toggle="modal" data-field="<?php ec($field->name): ?>">Auswählen</button>';
            break;
    }
    echo '</div>';
}
    