<?php
    include_once('../header.php');
    include_once('../db.php');
    include_once('../nav.php');

    $sql = "SELECT * FROM courses LEFT JOIN `departments` ON courses.course_department = departments.department_id WHERE courses.courses_id =".$_GET['id'] ;
    $result = mysqli_query($conn, $sql);
    $list = mysqli_fetch_assoc($result);

    $courseID = $list['courses_id'];
    $courseName = $list['course_name'];
    $courseDescription = $list['course_description'];
    $courseDepartment = $list['department_name'];
    $departmentID = $list['department_id'];
  
?>
<body>
    

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Courses</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Courses</a></li>
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
                                    <h5 class="text-sm-center mt-2 mb-1"><?= $courseName ?></h5> <br>
                                    <div class="location text-sm-center"><i class="fa fa-comments-o"></i> <?= nl2br($courseDescription) ?></div>
                                    
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


                                <form type="POST" id="courseFormEdit" name="courseEditForm">


                                    <input type="hidden" id="course-id" value="<?= $courseID ?>">
                                    

                                    <div class="form-group"><label for="company" class=" form-control-label">Course</label>
                                        <input type="text" id="course-name" name="course_name" placeholder="Enter Course Name" class="form-control" value="<?= $courseName ?>">
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Description</label>
                                        <textarea name="course_description" id="course-description" cols="30" rows="5" class="form-control" placeholder="Enter Course Description"><?= $courseDescription ?></textarea>
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Department</label>
                                        <select name="course_department" id="course-department" class="form-control">
                                            <option value="<?= $list['department_id'] ?>" selected><?= $list['department_name']?></option>
                                    <?php
                                        $sql = "SELECT * FROM departments WHERE department.department_id !=".$departmentID;
                                        $result = mysqli_query($conn, $sql);
                                        while ($list = mysqli_fetch_assoc($result)) {
                                    
                                    ?>
                                        <option value="<?= $list['department_id'] ?>"><?= $list['department_name']?></option>
                                        
                                    <?php } ?>
                                        </select>
                                    </div>


                                    <input type="button" class="btn btn-primary btn-lg" id="edit-Course" name="editCourse" value="Update">

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
        $('#edit-Course').on('click', function() {

		    var cid = $('#course-id').val();
            var cn = $('#course-name').val();
		    var cd = $('#course-description').val();
            var cdd = $('#course-department').val();

            $.ajax({
				url: "ajaxScript.php?action=edit",
				type: "POST",
				data: {
                    cid: cid,
					cn: cn,
					cd: cd,	
                    cdd: cdd
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
