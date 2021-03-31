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



    $studentArray = [];


    $sql = "SELECT * FROM student_courses LEFT JOIN `courses` ON student_courses.course_id = courses.courses_id WHERE student_courses.student_id = $studentID";
    $result = mysqli_query($conn, $sql);
    while ($list = mysqli_fetch_assoc($result)) {
        $cid = $list['courses_id'];
        $student = [
            'student_course_name' => $list['course_name'],
            'modules' => fetchme($cid),
            'student_course_grade' => $list['course_overall_grade']
        ]; 
        array_push($studentArray, $student);
        //echo $list['course_id'];
    }






    function fetchme($id) {
        include('../db.php');
        $sqlfetch = "SELECT * FROM student_modules LEFT JOIN `modules` ON student_modules.module_id = modules.module_id WHERE modules.course_id = $id";
        $resultfetch = mysqli_query($conn, $sqlfetch);
        while ($listfetch = mysqli_fetch_assoc($resultfetch)) {
            $modules[] = [
                'module_id' => $listfetch['student_module_id'],
                'student_id' => $listfetch['student_id'],
                'module_name' => $listfetch['modeule_name'],
                'module_grade' => $listfetch['module_overall_grade']
            ];
        }
        return $modules;
    }
    // echo "<pre>";
    // print_r($studentArray); exit;
    // echo '</pre>';







?>
<body>
    

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Student Grades</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Students</a></li>
                                    <li class="active">Grades</li>
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



                        <!-- <div class="card">
                            <div class="card-header">
                                <strong class="card-title mb-3">Courses <?= $count ?></strong>
                            </div>
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <h5 class="text-sm-center mt-2 mb-1"><?= $list['course_name'] ?></h5>
                                    
                                </div>
                                <hr>
                            
                            </div>
                        </div> -->

                        <?php } ?>


                    </div>

                    
                    <div class="col-lg-8">
                        <?php
                            foreach ($studentArray as $student) {
                        ?>
                                <div class="card">
                                    <div class="card-header"><strong> Course <?= $student['student_course_name'] ?> </strong></div>
                                    <div class="card-body card-block">

                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Module Name</th>
                                                    <th scope="col">Grade</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>

                                                <?php
                                                    foreach ($student['modules'] as $courseModules) {
                                                ?>


                                                    <tr>
                                                        <th scope="row"><?= $courseModules['module_id']?></th>
                                                        <td><?= $courseModules['module_name']?></td>
                                                        <td><?= (!empty($courseModules['module_grade']) ? $courseModules['module_grade'] : '<a href="'.BASE_URL.'student-grades/assign?view&view='.$courseModules['module_id'].'&sid='.$courseModules['student_id'].'" class="btn btn-primary btn-sm" >Assign Grade</a>')?></td>
                                                    </tr>

                                                <?php } ?>

                                                
                                            </tbody>
                                        </table>
                                        
                                
                                    </div>
                                </div>
                        <?php } ?>
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
