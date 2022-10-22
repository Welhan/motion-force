<form action="">
    <?= csrf_field(); ?>
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
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>