<?php
$title = REDIRECT_DASHBOARD_TITLE_ADD;
$description = REDIRECT_DASHBOARD_DESC;

$scripts = '<script rel="script" src="'.getenv("PATH_SUBFOLDER").'app/package/redirect/views/ressources/js/main.js"></script>';

ob_start();
?>


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form action="" method="post">
                    <div class="card card-primary">

                        <div class="card-header">
                            <h3 class="card-title"><?=REDIRECT_DASHBOARD_TITLE_ADD?> :</h3>
                        </div>

                        <div class="card-body">

                            <label for="name"><?=REDIRECT_DASHBOARD_NAME?></label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                </div>
                                <input type="text" name="name" class="form-control" placeholder="<?=REDIRECT_DASHBOARD_NAME_PLACEHOLDER?>" required>

                            </div>

                            <label class="mt-4" for="slug"><?=REDIRECT_DASHBOARD_SLUG?></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><?= "https://" . $_SERVER['SERVER_NAME'] . getenv("PATH_SUBFOLDER") . "r/"?></span>
                                </div>
                                <input type="text" name="slug" class="form-control" placeholder="<?=REDIRECT_DASHBOARD_SLUG_PLACEHOLDER?>" required>
                            </div>
                            <small class="form-text"><?= REDIRECT_DASHBOARD_SLUG_HINT ?></small>

                            <label class="mt-4" for="target"><?=REDIRECT_DASHBOARD_TARGET?></label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                                </div>
                                <input type="text" name="target" class="form-control" placeholder="<?=REDIRECT_DASHBOARD_TARGET_PLACEHOLDER?>" required>

                            </div>

                        </div>



                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right"><?=REDIRECT_DASHBOARD_BUTTON_SAVE?></button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>








<?php $content = ob_get_clean(); ?>

<?php require(getenv("PATH_ADMIN_VIEW") . 'template.php'); ?>

