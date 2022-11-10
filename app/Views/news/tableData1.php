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
            <th>News</th>
            <th>Date Created</th>
            <th>Status</th>
            <th width="100px">Action</th>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($news as $new) : ?>
                <tr class="text-center h5">
                    <td><?= $no++; ?></td>
                    <td><?= ucwords($new->title); ?></td>
                    <td><i class="fas fa-calendar-o"></i> <?= date_format(date_create($new->date_added), 'M d,Y'); ?></td>
                    <td>
                        <button class="btn btn-sm <?= ($new->active == 1) ? "btn-success" : "btn-danger"; ?> rounded-pill text-white" role="button" onclick="updateStatus(<?= $new->id; ?>)"><?= ($new->active) ? "Active" : "Not Active"; ?></button>
                    </td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $('#datatable').DataTable()
</script>