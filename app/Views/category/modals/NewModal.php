<!-- Modal -->
<div class="modal fade" id="modal-new" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/saveCategory" method="post" class="formSubmit">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" id="category" autocomplete="off" name="category">
                        <div id="errCategory" class="invalid-feedback"></div>
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
    $(document).ready(() => {
        $('.formSubmit').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
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
                        getDataCategory();

                        // Notification.requestPermission().then(perm => {
                        //     if (perm === "granted") {
                        //         const notification = new Notification("Example Notification", {
                        //             body: "Hello, test notification",
                        //             tag: "notification"
                        //         })
                        //     }
                        // })

                        // let notification;

                        // document.addEventListener("visbilitychange", () => {
                        //     if (document.visibilityState === "hidden") {
                        //         notification = new Notification('New Catergoy Added', {
                        //             body: "New Category Added",
                        //             tag: "notification"
                        //         })
                        //     } else {
                        //         notification.close();
                        //     }
                        // })
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        })
    })
</script>