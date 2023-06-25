<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css" />
    <link rel="stylesheet" type="text/css" href="public/css/product.css" />
    <link rel="stylesheet" type="text/css" href="public/css/main.css" />
    <link rel="stylesheet" type="text/css" href="public/css/add-product.css" />
    <title>BrewReview</title>
</head>

<body>
    <div class="main-container">
        <?php require_once __DIR__ . '/../templates/navbar.php'; ?>
        <div class="content-container">
            <div class="box product-box">
                <h2>Add Coffee</h2>
                <form class="product-form" action="addProduct" method="POST" enctype="multipart/form-data">
                    <label for="name">Name</label>
                    <input name="name" type="text" placeholder="Name" />
                    <label for="description">Description</label>
                    <textarea name="description" placeholder="Description"></textarea>
                    <label for="brand">Brand</label>
                    <input name="brand" type="text" placeholder="Brand"></input>
                    <label for="tags">Tags</label>
                    <input name="tags" type="text" placeholder="Tags, seperated by spaces."></input>
                    <label for="image">Image</label>
                    <input type="file" name="image" accept="image/*" />
                    <button type="submit">Add</button>
                    <?php
                    if (isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
    <?php require_once __DIR__ . '/../templates/footer.php'; ?>
</body>