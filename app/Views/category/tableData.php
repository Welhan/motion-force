<?php if (session('message')) : ?>
    <div class="alert <?= session('alert'); ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <?= session('message'); ?>
    </div>
<?php endif; ?>

<table class="table table-bordered table-hover" id="datatable">
    <thead class="thead-light text-center">
        <th>#</th>
        <th>Category</th>
        <th>Status</th>
        <th>Action</th>
    </thead>
    <tbody class="text-center align-middle">
        <?php
        $no = 1;
        foreach ($categorys as $category) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $category->category; ?></td>
                <td>
                    <button class="btn" role="button" onclick=""><span class="badge badge-pill <?= ($category->active == 1) ? "badge-primary" : "badge-danger"; ?> "><?= ($category->active) ? "Active" : "Not Active"; ?></span></button>
                </td>
                <td>
                    <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                    <button class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></button>
                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $('#datatable').DataTable()
</script>