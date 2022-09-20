<?php if (session('message')) : ?>
    <div class="alert <?= session('alert'); ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <?= session('message'); ?>
    </div>
<?php endif; ?>

<div class="table-responsive">

    <table class="table table-bordered table-hover" id="datatable">
        <thead class="thead-light text-center">
            <th width="50px">#</th>
            <th>Product</th>
            <th>Category</th>
            <th>Status</th>
            <th width="100px">Action</th>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($products as $product) : ?>
                <tr class="text-center h5">
                    <td class="align-middle"><?= $no++; ?></td>
                    <td class="align-middle">
                        <figure class="figure">
                            <img src="img/product/<?= ($product->image) ? $product->image : "default.png" ?>" class="figure-img img-fluid rounded">
                            <figcaption class="figure-caption"><?= ucwords($product->name); ?></figcaption>
                        </figure>
                    </td>
                    <td class="align-middle"><?= $product->category; ?></td>
                    <td class="align-middle"><?php if ($product->active == 0) : ?>
                            <a href="/updateStatus/<?= $product->productID; ?>" class="btn btn-sm btn-danger rounded-pill text-white">Not Active</a>
                            <!-- <span class="badge rounded-pill badge-danger">Not Active</span> -->
                        <?php else : ?>
                            <a href="/updateStatus/<?= $product->productID; ?>" class="btn btn-sm btn-success rounded-pill text-white">Active</a>
                            <!-- <span class="badge rounded-pill bg-green">Active</span> -->
                        <?php endif; ?>
                    </td>
                    <td class="align-middle" width="150px">
                        <button class="btn btn-success btn-sm"><i class="fa fa-eye"></i></button>
                        <button class="btn btn-primary btn-sm" onclick="editProduct(<?= $product->id; ?>)"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm" onclick="deleteProduct(<?= $product->id; ?>)"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $('#datatable').DataTable()

    window.setTimeout(function() {
        $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
            $(this).remove();
        });
    }, 5000);

    function editCategory(id) {
        $.ajax({
            type: 'POST',
            url: '/Category/getFormEdit',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    if (response.error.logout) {
                        window.location.href = response.error.logout
                    }
                } else {
                    $('#viewModal').html(response.data).show();
                    $('#modal-edit').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function deleteCategory(id) {
        $.ajax({
            type: 'POST',
            url: '/Category/getFormDelete',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    if (response.error.logout) {
                        window.location.href = response.error.logout
                    }
                } else {
                    $('#viewModal').html(response.data).show();
                    $('#modal-delete').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function updateStatus(id) {
        // console.log('OK')
        $.ajax({
            type: 'POST',
            url: '/Category/updateStatus',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    if (response.error.logout) {
                        window.location.href = response.error.logout
                    }
                } else {
                    getDataCategory();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }
</script>