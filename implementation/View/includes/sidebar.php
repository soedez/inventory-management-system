<ul class="list-group sidebar m-0">
    <li class="list-group-item"><a href="index.php">Home</a></li>
    <li class="list-group-item"><a href="category.php">Category</a></li>
    <li class="list-group-item"><a href="supplier.php">Supplier</a></li>
    <li class="list-group-item"><a href="customer.php">Customer</a></li>
    <li class="list-group-item"><a href="product.php">Product</a></li>
    <li class="list-group-item"><a href="purchases.php">Purchases</a></li>
    <li class="list-group-item"><a href="sales.php">Sales</a></li>
    <li class="list-group-item"><a href="stock.php">Stock</a></li>

    <?php if(Admin::getUserRole($_SESSION["ims_user_id"])){ ?>
        <li class="list-group-item"><a href="users.php">Users</a></li>
    <?php } ?>

</ul>