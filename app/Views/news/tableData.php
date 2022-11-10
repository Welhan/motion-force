<?php if (empty($news)) : ?>
    <h4 class="text-muted text-center">No Data to Show</h4>
<?php endif; ?>

<div class="d-flex justify-content-center mb-3">
    <?php foreach ($news as $new) : ?>
        <div class="card mr-2" style="width: 15rem;">
            <img src="<?= ($new->image) ? base_url('/img/articles/' . $new->image) : base_url('/img/articles/default.png'); ?>" class="card-img-top" alt="" title="<?= $new->title; ?>">
            <div class="card-body">
                <h5 class="card-title"><?= ucwords($new->title); ?></h5>
                <h5 class="text-muted"><i class="fas fa-calendar-o"></i> <?= date_format(date_create($new->date_added), 'M d,Y'); ?></h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <button class="btn btn-sm <?= ($new->active == 1) ? "btn-success" : "btn-danger"; ?> rounded-pill text-white" role="button" onclick="updateStatus(<?= $new->id; ?>)"><?= ($new->active) ? "Active" : "Not Active"; ?></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <a href="#" class="btn btn-primary">Edit</a>
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>