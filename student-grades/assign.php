<?php
    include_once('../header.php');
    include_once('../db.php');
    include_once('../nav.php');




    $sql = "SELECT * FROM `students` WHERE `student_id` = ".$_GET['sid'];
    $result = mysqli_query($conn, $sql);
    $list = mysqli_fetch_assoc($result);
    $studentName = $list['student_first_name'].' '.$list['student_last_name'];
    $studentID = $list['student_id'];


    

    $sql2 = "SELECT * FROM student_modules LEFT JOIN `modules` ON student_modules.module_id = modules.module_id WHERE student_modules.student_id = ".$_GET['sid'];
    $result2 = mysqli_query($conn, $sql2);
    $list2 = mysqli_fetch_assoc($result2);
    $moduleName = $list2['modeule_name'];




?>
<body>
    

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Grades</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Grades</a></li>
                                    <li class="active">Add</li>
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
                
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><strong>Grades</strong><small> Form</small></div>
                            <div class="card-body card-block">

	                            <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	                            </div>

                                <div class="alert alert-error alert-dismissible" id="error" style="display:none;">
	                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	                            </div>


                                <form type="POST" id="gradeFormAdd" name="gradeAddForm">


                                    <input type="hidden" value="<?= $_GET['view'] ?>" id="mid">
                                    
                                    <div class="form-group"><label for="company" class=" form-control-label">Student</label>
                                        <input type="text" id="student-name" name="student_name" placeholder="Enter Student Name" class="form-control" value="<?= $studentName?>" readonly disabled>
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Module</label>
                                        <input type="text" id="module-name" name="module_name" placeholder="Enter Module Name" class="form-control" value="<?= $moduleName?>" readonly disabled>
                                    </div>


                                    <div class="form-group"><label for="company" class=" form-control-label">Grade</label>
                                        <input type="text" id="module-grade" name="module_grade" placeholder="Enter Grade" class="form-control">
                                    </div>
                                    


                                    <input type="button" class="btn btn-primary btn-lg" id="add-grade" name="addGrade" value="Add">

                                </form>

            
                           
                           
                           
                           
                           
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
        $('#add-grade').on('click', function() {
            var BASE_URL = '<?= BASE_URL ?>'
            var student_id = '<?= $studentID ?>'
            $("#add-grade").attr("disabled", "disabled");

            var mid = $('#mid').val();
		    var mg = $('#module-grade').val();


            $.ajax({
				url: "ajaxScript.php?action=add",
				type: "POST",
				data: {
					mid: mid,
					mg: mg	
				},
                cache: false,
				success: function(dataResult) {
                    //console.log(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
						$("#add-grade").removeAttr("disabled");
                        $('#gradeFormAdd').find('input:text, textarea, select, input[type="date"], input[type="email"], input[type="number"]').val('');
                        $("#success").show();
						$('#success').html('Data added successfully !'); 
                        setTimeout(function(){window.location.href = BASE_URL+'student-grades/view?view&id='+student_id;}, 2000);
												
					}
                    else if(dataResult.statusCode==201){
                        $("#error").show();
						$('#error').html('Error occurred while adding !'); 
					}
                }
            });
        });
    });
</script>
</body>
</html>
