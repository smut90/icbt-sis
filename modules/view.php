<?php
    include_once('../header.php');
    include_once('../db.php');
    include_once('../nav.php');

    $sql = "SELECT * FROM modules LEFT JOIN `courses` ON modules.course_id = courses.courses_id WHERE modules.module_id =".$_GET['id'] ;
    $result = mysqli_query($conn, $sql);
    $list = mysqli_fetch_assoc($result);

    $moduleID = $list['module_id'];
    $moduleCode = $list['module_code'];
    $moduleName = $list['modeule_name'];
    $moduleDescription = $list['module_description'];
    $moduleCourse = $list['course_name'];
    $moduleSemester = $list['module_semester'];
    $moduleCourseID = $list['courses_id'];
  
?>
<body>
    

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Modules</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Modules</a></li>
                                    <li class="active">Index</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-12 row">
                        
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title mb-3">Profile Card</strong>
                            </div>
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <h5 class="text-sm-center mt-2 mb-1"><?= $moduleName ?></h5> <br>
                                    <div class="location text-sm-center"><i class="fa fa-comments-o"></i> <?= nl2br($moduleDescription) ?></div>
                                    
                                </div>
                                <hr>
                            
                            </div>
                        </div>


                    </div>

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header"><strong>Student</strong><small> Form</small></div>
                            <div class="card-body card-block">

	                            <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	                            </div>

                                <div class="alert alert-error alert-dismissible" id="error" style="display:none;">
	                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	                            </div>


                                <form type="POST" id="moduleFormEdit" name="moduleEditForm">

                                    <input type="hidden" id="module-id" value="<?= $moduleID ?>">

                                    <div class="form-group"><label for="company" class=" form-control-label">Module Code</label>
                                        <input type="text" id="module-code" name="module_code" placeholder="Enter Module Code" class="form-control" value="<?= $moduleCode ?>">
                                    </div>
                                
                                    <div class="form-group"><label for="company" class=" form-control-label">Module Name</label>
                                        <input type="text" id="module-name" name="module_name" placeholder="Enter Module Name" class="form-control" value="<?= $moduleName ?>">
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Description</label>
                                        <textarea name="module_description" id="module-description" cols="30" rows="5" class="form-control" placeholder="Enter Module Description"><?= $moduleDescription ?></textarea>
                                    </div>


                                    <div class="form-group"><label for="company" class=" form-control-label">Course</label>
                                        <select name="course_id" id="course-id" class="form-control">
                                        <option value="<?= $list['courses_id'] ?>" selected><?= $list['course_name']?></option>
                                    <?php
                                        $sql = "SELECT * FROM courses WHERE `courses_id` !=".$moduleCourseID;
                                        $result = mysqli_query($conn, $sql);
                                        while ($list = mysqli_fetch_assoc($result)) {
                                    
                                    ?>
                                        <option value="<?= $list['courses_id'] ?>"><?= $list['course_name']?></option>
                                        
                                    <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Semester</label>
                                        <select name="module_semester" id="module-semester" class="form-control">
                                            <option value="<?= $moduleSemester ?>"><?= $moduleSemester ?></option>
                                            <?php
                                                if ($moduleSemester == 1) {
                                                    echo '<option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>';
                                                } else if ($moduleSemester == 2) {
                                                    echo '<option value="1">1</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>';
                                                } else if ($moduleSemester == 3) {
                                                    echo '<option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="4">4</option>';
                                                } else {
                                                    echo '<option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>';
                                                }
                                            ?>
                                            
                                        </select>
                                    </div>


                                    <input type="button" class="btn btn-primary btn-lg" id="edit-Module" name="editModule" value="Update">

                                </form>
                           
                            </div>
                        </div>
                    </div>
                        


                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <?php include_once('../footer-2.php') ?>

</div><!-- /#right-panel -->

<!-- Right Panel -->

<?php include_once('../footer.php') ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
        <link rel='stylesheet' type='text/css' href="https://bitnami-mx-kdbnbjq.el.r.appspot.com/assets/css/style.css">

        <script type="text/javascript" src="/assets/js/jquery.min.js"></script>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->

<script>
    $(document).ready(function() {
        $('#edit-Module').on('click', function() {

		    var mid = $('#module-id').val();
            var mc = $('#module-code').val();
		    var mn = $('#module-name').val();
            var mf = $('#module-description').val(); 
            var mcid = $('#course-id').val();
            var ms = $('#module-semester').val();

            $.ajax({
				url: "ajaxScript.php?action=edit",
				type: "POST",
				data: {
                    mid: mid,
					mc: mc,
					mn: mn,	
                    mf: mf,
                    mcid: mcid,
                    ms: ms
				},
                cache: false,
				success: function(dataResult) {
                    //console.log(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        $("#success").show();
						$('#success').html('Data updated successfully !'); 
												
					}
                    else if(dataResult.statusCode==201){
                        $("#error").show();
						$('#error').html('Error occurred while updating !'); 
					}
                }
            });
        });
    });
</script>


</body>
</html>
