<?php if (session('message')) : ?>
    <div class="alert <?= session('alert'); ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <?= session('message'); ?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            <h3>Logo</h3>
            <img src="/img/<?= $company->img; ?>" class="img-fluid" style="width: 100px;">
        </div>
    </div>
    <div class="col-md-7">
        <div class="form-group">
            <label for="company_name"><i class="fas fa-home"></i> Company Name:</label>
            <input type="text" class="form-control" id="company_name" name="company_name" value="<?= $company->name; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="company_email"> <i class="fas fa-envelope"></i> Email:</label>
            <input type="text" class="form-control" id="company_email" name="company_email" value="<?= $company->email; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="wechat"><i class="fa fa-weixin"></i> Wechat ID:</label>
            <input type="text" class="form-control" id="wechat" name="wechat" value="<?= $company->wechat; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="whatsapp"><i class="fa fa-whatsapp"></i> Whatsapp:</label>
            <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?= $company->whatsapp; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="phone"><i class="fas fa-phone"></i> Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?= $company->phone; ?>" readonly>
        </div>
    </div>
</div>

<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
            $(this).remove();
        });
    }, 5000);
</script>