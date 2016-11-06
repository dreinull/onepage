<?php include '_start.php'; ?>
<?php include '_navigation.php'; ?>

    <div class="container">

        <form action="<?php ec(route('admin-options-post')) ?>" accept-charset="UTF-8" method="post">

            <h1>Optionen</h1>

            <h2>Design</h2>

            <div class="form-group">
                <label for="primary-color">Primärfarbe</label>
                <input type="color" name="primary-color">
            </div>

            <div class="form-group">
                <label for="secondary-color">Sekundärfarbe</label>
                <input type="color" name="secondary-color">
            </div>

            <button type="submit" class="btn btn-default">Speichern</button>

        </form>
    </div>

<?php include '_end.php'; ?>