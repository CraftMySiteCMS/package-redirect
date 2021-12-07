<?php
$title = REDIRECT_DASHBOARD_TITLE;
$description = REDIRECT_DASHBOARD_DESC;
?>

<?php $styles = '<link rel="stylesheet" href="'.getenv("PATH_SUBFOLDER").'admin/resources/vendors/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="'.getenv("PATH_SUBFOLDER").'admin/resources/vendors/datatables-responsive/css/responsive.bootstrap4.min.css">';?>

<?php $scripts = '<script src="'.getenv("PATH_SUBFOLDER").'admin/resources/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="'.getenv("PATH_SUBFOLDER").'admin/resources/vendors/datatables/jquery.dataTables.min.js"></script>
<script src="'.getenv("PATH_SUBFOLDER").'admin/resources/vendors/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="'.getenv("PATH_SUBFOLDER").'admin/resources/vendors/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="'.getenv("PATH_SUBFOLDER").'admin/resources/vendors/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="'.getenv("PATH_SUBFOLDER").'admin/resources/vendors/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script>
    $(function () {
        $("#redirect_table").DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false,
            language: {
                processing:     "'.REDIRECT_LIST_PROCESSING.'",
                search:         "'.REDIRECT_LIST_SEARCH.'",
                lengthMenu:    "'.REDIRECT_LIST_LENGTHMENU.'",
                info:           "'.REDIRECT_LIST_INFO.'",
                infoEmpty:      "'.REDIRECT_LIST_INFOEMPTY.'",
                infoFiltered:   "'.REDIRECT_LIST_INFOFILTERED.'",
                infoPostFix:    "'.REDIRECT_LIST_INFOPOSTFIX.'",
                loadingRecords: "'.REDIRECT_LIST_LOADINGRECORDS.'",
                zeroRecords:    "'.REDIRECT_LIST_ZERORECORDS.'",
                emptyTable:     "'.REDIRECT_LIST_EMPTYTABLE.'",
                paginate: {
                    first:      "'.REDIRECT_LIST_FIRST.'",
                    previous:   "'.REDIRECT_LIST_PREVIOUS.'",
                    next:       "'.REDIRECT_LIST_NEXT.'",
                    last:       "'.REDIRECT_LIST_LAST.'"
                },
                aria: {
                    sortAscending:  "'.REDIRECT_LIST_SORTASCENDING.'",
                    sortDescending: "'.REDIRECT_LIST_SORTDESCENDING.'"
                }
            },
        });
    });
</script>';?>

<?php ob_start(); ?>

    <div class="content">

        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title"><?= REDIRECT_DASHBOARD_TITLE ?></h3>
                        </div>

                        <div class="card-body">

                            <table id="redirect_table" class="table table-bordered table-striped">

                                <thead>
                                <tr>
                                    <th><?= REDIRECT_LIST_TABLE_ID ?></th>
                                    <th><?= REDIRECT_LIST_TABLE_NAME ?></th>
                                    <th><?= REDIRECT_LIST_TABLE_URL ?></th>
                                    <th><?= REDIRECT_LIST_TABLE_SLUG ?></th>
                                    <th><?= REDIRECT_LIST_TABLE_TARGET ?></th>
                                    <th><?= REDIRECT_LIST_TABLE_CLICK ?></th>
                                    <th><?= REDIRECT_LIST_TABLE_EDIT ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php /** @var redirectModel[] $redirectList */
                                foreach ($redirectList as $redirect) : ?>
                                    <tr>
                                        <td><?= $redirect['id'] ?></td>
                                        <td><?= $redirect['name'] ?></td>
                                        <td><?= $redirect['url'] ?></td>
                                        <td><?= $redirect['slug'] ?></td>
                                        <td><?= $redirect['target'] ?></td>
                                        <td><?= $redirect['click'] ?></td>
                                        <td class="text-center">

                                            <button onclick="window.location.href='../redirect/edit/<?= $redirect['id'] ?>'" class="btn btn-warning"><i class="fas fa-edit"></i></button>

                                            <a href="delete/<?= $redirect['id'] ?>" type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>


                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>

                                <tfoot>
                                <tr>
                                    <th><?= REDIRECT_LIST_TABLE_ID ?></th>
                                    <th><?= REDIRECT_LIST_TABLE_NAME ?></th>
                                    <th><?= REDIRECT_LIST_TABLE_URL ?></th>
                                    <th><?= REDIRECT_LIST_TABLE_SLUG ?></th>
                                    <th><?= REDIRECT_LIST_TABLE_TARGET ?></th>
                                    <th><?= REDIRECT_LIST_TABLE_CLICK ?></th>
                                    <th><?= REDIRECT_LIST_TABLE_EDIT ?></th>
                                </tr>
                                </tfoot>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php $content = ob_get_clean(); ?>

<?php require(getenv("PATH_ADMIN_VIEW").'template.php'); ?>