<?= $this->extend('layout/be_template'); ?>

<?= $this->section('content'); ?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <!-- <h6 class="m-0 font-weight-bold text-primary">Category List</h6> -->
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle btn btn-primary btn-sm" role="button" id="btnEdit">
                        <i class="fas fa-pencil-alt fa-sm fa-fw text-gray-400"></i>Edit
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

                <div id="tableData"></div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>

<script>
    function getDataProfile() {
        $.ajax({
            url: '/Company/getProfile',
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
        getDataProfile();

        $('#btnEdit').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: '/Company/getFormEdit',
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
                        $('#btnEdit').hide()
                        $('#btnBack').show()
                        $('#tableData').html(response.data);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        $('#btnBack').click((e) => {
            e.preventDefault();
            $.ajax({
                url: '/Company/getProfile',
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
                        $('#btnEdit').show()
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