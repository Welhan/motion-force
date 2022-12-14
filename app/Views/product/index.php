<?= $this->extend('layout/be_template'); ?>

<?= $this->section('content'); ?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle btn btn-primary btn-sm" id="btnNew" role="button" href="/newProduct">
                        <i class="fas fa-plus fa-sm fa-fw text-gray-400"></i>New
                    </a>
                    <a class="dropdown-toggle btn btn-info btn-sm" role="button" id="btnBack" style="display: none;">
                        <i class="fas fa-arrow-left fa-sm fa-fw text-gray-400"></i>Back
                    </a>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">

                <div id="loader" class="mx-auto" style="width: 200px; display: none;">
                    <button class=" btn btn-primary" type="button" disabled>
                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                </div>

                <?php if (session('message')) : ?>
                    <div class="alert <?= session('alert'); ?> alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <?= session('message'); ?>
                    </div>
                <?php endif; ?>

                <div id="tableData"></div>

            </div>
        </div>
    </div>
</div>

<div id="viewModal" style="display: none;"></div>

<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<!-- untuk table responsive -->

<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
            $(this).remove();
        });
    }, 5000);

    function getDataProduct() {
        $.ajax({
            url: '/Product/getDataProduct',
            dataType: 'json',
            beforeSend: function() {
                $('#tableData').hide();
                $('#loader').show();
            },
            success: function(response) {
                if (response.error) {
                    if (response.error.logout) {
                        window.location.href = response.error.logout
                    }
                } else {
                    $('#tableData').show();
                    $('#loader').hide();
                    $('#tableData').html(response.data);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    $(document).ready(() => {
        getDataProduct();

        $('#btnBack').click((e) => {
            e.preventDefault();
            $.ajax({
                url: '/Product/getDataProduct',
                dataType: 'json',
                beforeSend: function() {
                    $('#tableData').hide();
                    $('#loader').show();
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.logout) {
                            window.location.href = response.error.logout
                        }
                    } else {
                        $('#tableData').show();
                        $('#loader').hide();
                        $('.card-header h6').show()
                        $('#btnNew').show()
                        $('#btnBack').hide()
                        $('#tableData').html(response.data);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        })
    })
</script>

<?= $this->endSection(); ?>