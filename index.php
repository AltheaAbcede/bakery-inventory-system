<?php include 'database.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bakery Inventory Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="container mt-5">
    <h2 class="mb-4">Bakery Inventory Management System</h2>

    <!-- ADD BUTTON -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProduct">
        Add New Product
    </button>

    <!-- PRODUCT TABLE -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Product Name</th>
                <th>Price (₱)</th>
                <th>Stock</th>
                <th width="170">Action</th>
            </tr>
        </thead>

        <tbody>
        <?php
        $query = mysqli_query($conn, "SELECT * FROM products");
        while ($row = mysqli_fetch_assoc($query)):
        ?>
            <tr>
                <td><?= $row['product_name']; ?></td>
                <td><?= number_format($row['price'], 2); ?></td>
                <td><?= $row['stock']; ?></td>
                <td>
                    <button class="btn btn-warning btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#edit<?= $row['id']; ?>">
                        Edit
                    </button>

                    <a href="delete.php?id=<?= $row['id']; ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete this item?');">
                        Delete
                    </a>
                </td>
            </tr>

            <!-- EDIT MODAL -->
            <div class="modal fade" id="edit<?= $row['id']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="update.php" method="post">

                            <div class="modal-header">
                                <h5>Edit Product</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">

                                <label>Product Name</label>
                                <input type="text" name="product_name" class="form-control"
                                       value="<?= $row['product_name']; ?>" required>

                                <label class="mt-2">Price</label>
                                <input type="number" step="0.01" name="price"
                                       class="form-control" value="<?= $row['price']; ?>" required>

                                <label class="mt-2">Stock</label>
                                <input type="number" name="stock" class="form-control"
                                       value="<?= $row['stock']; ?>" required>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>
        </tbody>
    </table>

</div>

<!-- ADD MODAL -->
<div class="modal fade" id="addProduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="insert.php" method="post">

                <div class="modal-header">
                    <h5>Add New Product</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label>Product Name</label>
                    <input type="text" name="product_name" class="form-control" required>

                    <label class="mt-2">Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" required>

                    <label class="mt-2">Stock</label>
                    <input type="number" name="stock" class="form-control" required>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>