<?php use Markup\Form; ?>

<?php foreach($fields as $field) {
    echo '<div class="form-group">';
    switch($field->type) {
        case 'string':
            echo Form::text($field->name, $field->placeholder, $data[$field->name], [
                'class' => 'form-control input-sm'
            ]);
            break;
        case 'text':
            echo Form::textarea($field->name, $field->placeholder, $data[$field->name], [
                'class' => 'form-control input-sm',
                'rows' => 8
            ]);;
            break; // the rules!
        case 'timestamp':
            $value = array_key_exists($field->name, $data) ? date("Y-m-d H:i:s", $data[$field->name]) : '';
            echo Form::date($field->name, $field->placeholder, $value, [
                'class' => 'form-control input-sm'
            ]);
            break;
        case 'integer':
        case 'float':
            echo Form::text($field->name, $field->placeholder, $data[$field->name], [
                'class' => 'form-control input-sm'
            ]);
            break;
        case 'boolean':
            $value = array_key_exists($field->name, $data) ? $data[$field->name] : 0;
            echo '<label><input type="checkbox" name="' . $field->name . '">' . $field->placeholder . ' value="' . $data[$field->name] . '"></label>';
            break;
    }
    echo '</div>';
}
    