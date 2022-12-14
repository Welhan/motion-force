<?php if (session('message')) : ?>
    <div class="alert <?= session('alert'); ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <?= session('message'); ?>
    </div>
<?php endif; ?>

<div class="table-responsive animated--grow-in">

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
                    <!-- <td class="align-middle">
                        <figure class="figure">
                            <img src="img/product/<?= ($product->image) ? $product->image : "default.png" ?>" class="figure-img img-fluid rounded">
                            <figcaption class="figure-caption"><?= ucwords($product->name); ?></figcaption>
                        </figure>
                    </td> -->

                    <td><?= ucwords($product->name); ?></td>
                    <td class="align-middle"><?= $product->category; ?></td>
                    <td class="align-middle">
                        <button type="button" class="btn btn-sm <?= ($product->active == 0) ? 'btn-danger' : 'btn-success'; ?>  rounded-pill text-white" onclick="updateStatus(<?= $product->id; ?>)"><?= ($product->active == 0) ? 'Not Active' : "Active"; ?></button>
                    </td>
                    <td class="align-middle" width="150px">
                        <button class="btn btn-info btn-sm" onclick="addImg(<?= $product->id; ?>)"><i class="fas fa-plus"></i></button>
                        <button class="btn btn-success btn-sm" onclick="detailProduct(<?= $product->id; ?>)"><i class="fa fa-eye"></i></button>
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

    function editProduct(id) {
        $.ajax({
            type: 'POST',
            url: '/Product/getFormEdit',
            data: {
                id: id
            },
            dataType: 'json',
            beforeSend: function() {
                $('#tableData').hide();
                $('#loader').show();
            },
            success: function(response) {
                if (response.error) {
                    if (response.error.logout) {
                        window.location.href = response.error.logout
                    }
                } else {
                    $('#tableData').show();
                    $('#loader').hide();
                    $('.card-header h6').hide()
                    $('#btnNew').hide()
                    $('#btnBack').show()
                    $('#tableData').html(response.data);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function deleteProduct(id) {
        $.ajax({
            type: 'POST',
            url: '/Product/getFormDelete',
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
            url: '/Product/updateStatus',
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
                    getDataProduct();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }
</script>