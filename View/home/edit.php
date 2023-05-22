<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-4 text-center">Update product</h2>
    <form method="post" action="/product/update?id=<?php echo $data->id?>" enctype="multipart/form-data" class="w-50 mx-auto">
        <?php
        if (!empty($erorrs)) {
            foreach ($erorrs as $key => $erorr) {
                foreach ($erorr as $value) {
                    ?>
                    <div class="alert alert-danger d-flex justify-content-between align-items-center" role="alert">
                        <div><?php echo $value ?></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php }
            }
        } ?>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name"
                   value="<?php echo $data->name ? $data->name : null ?>">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" name="price" value="<?php echo $data->price ? $data->price : null ?>">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="<?php echo $data->description ? $data->description : null ?>">
        </div>
        <div class="mb-3">
            <img onerror="this.src='/images/no-image.jpg'" src="<?php echo '/'.$data->image?>" alt="noimage" class="img-fluid mb-3" id="avatar" style="width: 200px; height: auto; display: inline-block">
            <input type="file" id="image" name="image" class="d-block" style="cursor: pointer">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    image.onchange = evt => {
        const [file] = image.files
        if (file) {
            avatar.src = URL.createObjectURL(file)
        }
    }
</script>
</body>
</html>
