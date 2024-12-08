<?php
include "models/products.php";


$categories = getCategories();
$brands = getBrands();

if(isLogged() && currentUser()->role_id==1):
?>

<form action="models/insertProduct.php" method="POST" class="row d-block p-0 m-0" enctype="multipart/form-data">
    <div class="control-group col-3 mx-auto mb-2">
        <input type="text" class="form-control" placeholder="Product Name" name="prodName">
    </div>
    <div class="control-group col-3 mx-auto mb-2">
        <input type="text" class="form-control" placeholder="Price" name="price">
    </div>
    <div class="control-group col-3 mx-auto mb-2">
        <input type="file" name="input-image" class="form-control d-none" id="input-image" />
        <label for="input-image" class="mt-2 form-control">Product Picture</label>
    </div>
    <div class="control-group col-3 mx-auto mb-2">
        <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Product Description"></textarea>
    </div>
    <div class="control-group col-3 mx-auto mb-2">
        <select name="category" id="category" class="form-control">
            <option value="0">Category</option>
            <?php foreach ($categories as $c): ?>
                <option value="<?= $c->category_id ?>"><?= $c->category_name ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="control-group col-3 mx-auto mb-2">
        <select name="brand" id="brand" class="form-control">
            <option value="0">Brand</option>
            <?php foreach ($brands as $b): ?>
                <option value="<?= $b->brand_id ?>"><?= $b->brand_name ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="control-group col-3 mx-auto mb-2">
        <input type="submit" value="Submit" class="btn-primary btn btn-block" name="addProd">
    </div>
</form>
<?php else:
    header("Location: index.php?page=404");
    ?>

<?php endif; ?>