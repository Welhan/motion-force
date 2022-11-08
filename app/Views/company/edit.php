<form action="/saveCompany" enctype="multipart/form-data" class="formSubmit">
    <?= csrf_field(); ?>
    <input type="hidden" name="oldImg" value="<?= $company->img; ?>">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <h3>Logo</h3>
                <img src="/img/<?= $company->img; ?>" class="img-fluid img-preview" style="width: 100px;">
                <div class="input-group mt-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="pic" name="pic" onchange="previewImg()">
                        <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02"><?= $company->img; ?></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="form-group">
                <label for="company_name"><i class="fas fa-home"></i> Company Name:</label>
                <input type="text" class="form-control" id="company_name" name="company_name" value="<?= $company->name; ?>">
                <div id="errCompanyName" class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <label for="company_email"> <i class="fas fa-envelope"></i> Email:</label>
                <input type="email" class="form-control" id="company_email" name="company_email" value="<?= $company->email; ?>">
            </div>
            <div class="form-group">
                <label for="wechat"><i class="fa fa-weixin"></i> Wechat ID:</label>
                <input type="text" class="form-control" id="wechat" name="wechat" value="<?= $company->wechat; ?>">
            </div>
            <div class="form-group">
                <label for="whatsapp"><i class="fa fa-whatsapp"></i> Whatsapp:</label>
                <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?= $company->whatsapp; ?>">
            </div>
            <div class="form-group">
                <label for="phone"><i class="fas fa-phone"></i> Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= $company->phone; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary" id="btnProcess">Save</button>
        </div>
    </div>
</form>

<script>
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

                        if (response.error.company_name) {
                            $('#company_name').addClass('is-invalid');
                            $('#errCompanyName').html(response.error.company_name)
                        } else {
                            $('#company_name').removeClass('is-invalid');
                            $('#errCompanyName').html('')
                        }
                    } else {
                        $('#btnBack').hide()
                        $('#btnEdit').show()
                        getDataProfile();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        })
    })
</script>