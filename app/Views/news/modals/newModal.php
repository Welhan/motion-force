<!-- Modal -->
<div class="modal fade" id="modal-new" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Create News</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="news" method="post" class="formSubmit" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <img src="<?= base_url('/img/articles/default.png'); ?>" alt="Article Image" class="img-thumbnail img-preview" width="50%">
                            <div class="custom-file mt-1">
                                <input type="file" class="custom-file-input" id="pic" name="pic" onchange="previewImg()">
                                <label class="custom-file-label" for="customFile">Choose file<span class="text-danger">*</span></label>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" autocomplete="off" name="title">
                        <div id="errTitle" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="news">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                        <div id="errNews" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input type="text" class="form-control" id="tag" autocomplete="off" name="tag">
                        <div id="errTags" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="active" name="active" value="1">
                            <label class="custom-control-label" for="active">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnProcess">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    CKEDITOR.replace('description', {
        removeButtons: 'Specialchar,PasteFromWord,Table,Image,Anchor,ShowBlocks'
        // Strike,Subscript,Superscript,
    });

    $(document).ready(() => {
        $('.formSubmit').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('#btnProcess').attr('disabled', 'disabled');
                    $('#btnProcess').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                success: function(response) {
                    if (response.error) {
                        $('#btnProcess').removeAttr('disabled');
                        $('#btnProcess').html('Save');
                        if (response.error.logout) {
                            window.location.href = response.error.logout
                        }

                        if (response.error.category) {
                            $('#category').addClass('is-invalid');
                            $('#errCategory').html(response.error.category)
                        } else {
                            $('#category').removeClass('is-invalid');
                            $('#errCategory').html('')
                        }
                    } else {
                        $('#modal-new').modal('hide');
                        getDataNews();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        })
    })
</script>