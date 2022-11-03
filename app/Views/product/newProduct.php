<?= $this->extend('layout/be_template'); ?>

<?= $this->section('content'); ?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>New Product</h5>
            </div>
            <div class="card-body">
                <form action="/saveProduct" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product" class="form-label">Product Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?= ($validation->hasError('product')) ? 'is-invalid' : ''; ?>" id="product" name="product" value="<?= old('product'); ?>">
                                <div id="errProduct" class="invalid-feedback">
                                    <?= $validation->getError('product'); ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control <?= ($validation->hasError('category')) ? 'is-invalid' : ''; ?>" placeholder="Choose Category" id="category_selected" name="category" readonly value="<?= old('category'); ?>">
                                    <button class="btn btn-info" type="button" id="modalCategory" data-toggle="modal" data-target="#listCategory"><i class="fa fa-ellipsis-v"></i></button>
                                    <div id="errProduct" class="invalid-feedback">
                                        <?= $validation->getError('category'); ?>
                                    </div>
                                </div>
                                <input type="hidden" name="category_id" id="category_id" value="<?= old('category_id'); ?>">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control"><?= old('description'); ?></textarea>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="active" name="active" value="1">
                                    <label class="custom-control-label" for="active">Active</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="custom-file mb-1">
                                <input type="file" class="custom-file-input <?= ($validation->hasError('pic')) ? 'is-invalid' : ''; ?>" id="pic" name="pic" onchange="previewImg()">
                                <div id="errProduct" class="invalid-feedback">
                                    <?= $validation->getError('pic'); ?>
                                </div>
                                <label class="custom-file-label" for="customFile">Choose file<span class="text-danger">*</span></label>
                            </div>
                            <img src="/img/product/default.png" alt="Product Image" class="img-thumbnail img-preview">
                        </div>
                    </div>

                    <div class="card-footer mb-3 mt-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="listCategory" tabindex="-1" aria-labelledby="listCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="listCategoryLabel">Category List</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="datatable">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Catgory</th>
                                <th>Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($categorys as $category) :
                            ?>
                                <tr class="text-center">
                                    <td><?= $no++; ?></td>
                                    <td><?= ucwords($category->category); ?></td>
                                    <td><button class="btn btn-info btn-sm select" data-bs-id="<?= $category->id; ?>" data-bs-category="<?= $category->category; ?>" data-dismiss="modal"><i class="fa fa-check"></i></button></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>

<script>
    $('#datatable').DataTable();

    let select = document.querySelectorAll('.select');

    for (let i = 0; i < select.length; i++) {
        select[i].addEventListener('click', function() {

            let categoryID = document.querySelector('#category_id');
            let category = document.querySelector('#category_selected');

            let categoryResult = select[i].getAttribute('data-bs-category');

            category.value = categoryResult.charAt(0).toUpperCase() + categoryResult.slice(1);
            categoryID.value = select[i].getAttribute('data-bs-id');
        });
    }

    // CKEDITOR.replace('description', {
    //     // removePlugins: 'about,insert,forms,others',
    //     // Remove the redundant buttons from toolbar groups defined above.
    //     removeButtons: 'Strike,Subscript,Superscript,Specialchar,PasteFromWord,Table,Image,Anchor'
    // });
</script>

<?= $this->endSection(); ?>