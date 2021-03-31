<?php
    include_once('../header.php');
    include_once('../db.php');
    include_once('../nav.php');

    $sql = "SELECT * FROM students WHERE `student_id` =".$_GET['id'] ;
    $result = mysqli_query($conn, $sql);
    $list = mysqli_fetch_assoc($result);


    $studentID = $list['student_id'];
    $fname = $list['student_first_name'];
    $lname = $list['student_last_name'];
    $address = $list['student_address'];
    $mobile = $list['student_contact_number'];
    $email = $list['student_email'];
    $guardianName = $list['student_guardian'];
    $guardianMobile = $list['student_guradian_number'];

?>
<body>
    

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Students</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Students</a></li>
                                    <li class="active">Index</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	                    </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="alert alert-error alert-dismissible" id="error" style="display:none;">
	                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	                    </div>
                    </div>
                </div>
            </div>
        </div>



       

       

        <!-- Modal -->
        <div id="course" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Course</h4>
                    </div>
                    <div class="modal-body">

                        <form type="POST" id="assignCourse">

                            <input type="hidden" value="<?= $studentID?>" id="student-id">
                        
                            <div class="form-group"><label for="company" class=" form-control-label">Course</label>
                                <select name="course_id" id="course-id" class="form-control">
                                    <option>Please select</option>
                                        <?php
                                            $sql = "SELECT * FROM courses";
                                            $result = mysqli_query($conn, $sql);
                                            while ($list = mysqli_fetch_assoc($result)) {
                                        
                                        ?>
                                        <option value="<?= $list['courses_id'] ?>"><?= $list['course_name']?></option>
                                        
                                    <?php } ?>
                                </select>
                            </div>

                            <input type="button" class="btn btn-primary btn-lg" id="assign-student" name="assignStudent" value="Add">
                        
                        </form>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">

                <div class="row">
                    <div class="col-lg-12 row">
                        
                    <div class="col-lg-4">

                        <button class="btn btn-primary" data-toggle="modal" data-target="#course">Assign Course </button> <br><br>
                    
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title mb-3">Profile Card</strong>
                            </div>
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <h5 class="text-sm-center mt-2 mb-1"><?= $fname.' '.$lname ?></h5>
                                    <div class="location text-sm-center"><i class="fa fa-phone"></i> <?= $mobile ?></div>
                                    <div class="location text-sm-center"><i class="fa fa-envelope"></i> <?= $email ?></div>
                                    <div class="location text-sm-center"><i class="fa fa-map-marker"></i> <?= $address ?></div>
                                    
                                </div>
                                <hr>
                            
                            </div>
                        </div>

                        <?php
                            $count = 0;
                            $sql = "SELECT * FROM student_courses LEFT JOIN `courses` ON student_courses.course_id = courses.courses_id WHERE student_courses.student_id = $studentID";
                            $result = mysqli_query($conn, $sql);
                            while ($list = mysqli_fetch_assoc($result)) {
                                $count ++;
                        
                        ?>



                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title mb-3">Courses <?= $count ?></strong>
                            </div>
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <h5 class="text-sm-center mt-2 mb-1"><?= $list['course_name'] ?></h5>
                                    <!-- <div class="location text-sm-center"><i class="fa fa-map-marker"></i> California, United States</div> -->
                                </div>
                                <hr>
                            
                            </div>
                        </div>

                        <?php } ?>


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


                                <form type="POST" id="studentFormEdit" name="studentEditForm">


                                    <input type="hidden" id="student-id" value="<?= $studentID ?>">
                                    

                                    <div class="form-group"><label for="company" class=" form-control-label">Student First Name</label>
                                        <input type="text" id="student-fname" name="student_fname" placeholder="Enter Student First Name" class="form-control" value="<?= $fname ?>">
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Student Last Name</label>
                                        <input type="text" id="student-lname" name="student_lname" placeholder="Enter Student Last Name" class="form-control" value="<?= $lname ?>">
                                    </div>


                                    <div class="form-group"><label for="company" class=" form-control-label">Student Contact Number</label>
                                        <input type="text" id="student-contact" name="student_contact" class="form-control" placeholder="Enter Student Contact Number" value="<?= $mobile ?>">
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Student Email</label>
                                        <input type="email" id="student-email" name="student_email" class="form-control" placeholder="Enter Student Email" value="<?= $email ?>">
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Student Guardian Name</label>
                                        <input type="text" id="student-guardian-name" name="student_guardian_name" class="form-control" placeholder="Enter Student Guardian Name" value="<?= $guardianName ?>">
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Student Guardian Number</label>
                                        <input type="text" id="student-guardian-number" name="student_guardian_number" class="form-control" placeholder="Enter Student Guardian Number" value="<?= $guardianMobile ?>">
                                    </div>

                                    <input type="button" class="btn btn-primary btn-lg" id="edit-Student" name="editStudent" value="Update">

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

<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<!--<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->

<script>
    $(document).ready(function() {

        $('#assign-student').on('click', function() {

            var sid = $('#student-id').val();
            var cid = $('#course-id').val();

            $.ajax({
                url: "ajaxScript.php?action=assign",
                type: "POST",
                data: {
                    sid: sid,
                    cid: cid	
                },
                cache: false,
                success: function(dataResult) {
                //console.log(dataResult);
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    $('#course').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $("#success").show();
                    $('#success').html('Successfully assigned to course !'); 
                                            
                }
                else if(dataResult.statusCode==201){
                    $("#error").show();
                    $('#error').html('Error occurred while assigning !'); 
                }
            }
        });
        
        $('#edit-Student').on('click', function() {

		    var sid = $('#student-id').val();
            var sfname = $('#student-fname').val();
		    var slname = $('#student-lname').val();
            var scont = $('#student-contact').val();
            var sem = $('#student-email').val();
            var sgn = $('#student-guardian-name').val();
            var sgnu = $('#student-guardian-number').val();

            $.ajax({
				url: "ajaxScript.php?action=edit",
				type: "POST",
				data: {
                    sid: sid,
					sfname: sfname,
					slname: slname,
					scont: scont,
                    sem : sem,	
                    sgn: sgn,	
                    sgnu: sgnu,		
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
});
</script>


</body>
</html>
