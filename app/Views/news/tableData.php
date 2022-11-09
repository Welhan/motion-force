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

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>