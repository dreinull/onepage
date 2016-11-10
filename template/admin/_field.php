<?php foreach($fields as $field) {
    echo '<div class="form-group">';
    echo '<label for="' . $field->name . '">' . $field->placeholder . '</label>';
    switch($field->type) {
        case 'string':
            echo '<input type="text" name="' . $field->name . '" placeholder="' . $field->placeholder . '" value="' . $data[$field->name] . '" class="form-control input-sm">';
            break;
        case 'text':
            echo '<textarea name="' . $field->name . '" placeholder="' . $field->placeholder . '" class="form-control input-sm" rows="7">' . $data[$field->name] . '</textarea>';
            break; // the rules!
        case 'timestamp':
            $value = array_key_exists($field->name, $data) ? date("Y-m-d\TH:i:s", $data[$field->name]) : '';
            echo '<input type="date" name="' . $field->name . '" placeholder="' . $field->placeholder . '" value="' . $value . '" class="form-control input-sm">';
            break;
        case 'integer':
        case 'float':
            echo '<input type="number" name="' . $field->name . '" placeholder="' . $field->placeholder . '" value="' . $data[$field->name] . '" class="form-control input-sm">';
            break;
        case 'boolean':
            $value = array_key_exists($field->name, $data) ? $data[$field->name] : 0;
            echo '<label><input type="checkbox" name="' . $field->name . '">' . $field->placeholder . ' value="' . $data[$field->name] . '"></label>';
            break;
    }
    echo '</div>';
}
    