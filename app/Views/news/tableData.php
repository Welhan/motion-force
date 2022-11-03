<?php if (empty($news)) : ?>
    <h4 class="text-muted text-center">No Data to Show</h4>
<?php endif; ?>

<?php foreach ($news as $new) : ?>
    <div class="card" style="width: 15rem;">
        <img src="..." class="card-img-top" alt="..." title="">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
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