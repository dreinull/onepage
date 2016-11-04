<?php include 'start.php'; ?>
<?php include 'navigation.php'; ?>

    <div class="container">

        <form action="<?php self(); ?>" accept-charset="UTF-8">

            <h1>Seite erstellen</h1>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name">
            </div>

            <div class="form-group">
                <label for="name">Slug</label>
                <input type="text" name="slug">
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="visible"> Sichtbar
                </label>
            </div>

            <button type="submit" class="btn btn-default">Erstellen</button>

        </form>
    </div>

<?php include 'end.php'; ?>