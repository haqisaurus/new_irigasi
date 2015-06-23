<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            User <small>role</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> User
            </li>
            <li>
                <i class="fa fa-file"></i> Role list
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($table as $key => $role) {
                    ?>
                    <tr>
                        <td><?php echo $key +1 ?></td>
                        <td><?php echo $role->role; ?></td>
                    </tr>
                    <?php 
                    }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>