<?php include '_start.php'; ?>
<?php include '_navigation.php'; ?>

    <div class="container">

        <form action="<?php echo route('admin-add-page-post') ?>" accept-charset="UTF-8" method="post">

            <h1>Seite erstellen</h1>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name">
            </div>

            <div class="form-group">
                <label for="name">Slug</label>
                <input type="text" name="slug">
            </div>

            <button type="submit" class="btn btn-default">Erstellen</button>

        </form>
    </div>

<?php include '_end.php'; ?>