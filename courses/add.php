<?php
    include_once('../header.php');
    include_once('../db.php');
    include_once('../nav.php');
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
                            <div class="card-header"><strong>Courses</strong><small> Form</small></div>
                            <div class="card-body card-block">

	                            <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	                            </div>

                                <div class="alert alert-error alert-dismissible" id="error" style="display:none;">
	                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	                            </div>


                                <form type="POST" id="courseFormAdd" name="courseAddForm">
                                    
                                    <div class="form-group"><label for="company" class=" form-control-label">Course</label>
                                        <input type="text" id="course-name" name="course_name" placeholder="Enter Course Name" class="form-control">
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Description</label>
                                        <textarea name="course_description" id="course-description" cols="30" rows="5" class="form-control" placeholder="Enter Course Description"></textarea>
                                    </div>


                                    <div class="form-group"><label for="company" class=" form-control-label">Student Civil Status</label>
                                        <select name="course_department" id="course-department" class="form-control">
                                            <option>Please select</option>
                                    <?php
                                        $sql = "SELECT * FROM departments";
                                        $result = mysqli_query($conn, $sql);
                                        while ($list = mysqli_fetch_assoc($result)) {
                                    
                                    ?>
                                        <option value="<?= $list['department_id'] ?>"><?= $list['department_name']?></option>
                                        
                                    <?php } ?>
                                        </select>
                                    </div>

                                    <input type="button" class="btn btn-primary btn-lg" id="add-course" name="addCourse" value="Add">

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
        $('#add-course').on('click', function() {
            $("#add-course").attr("disabled", "disabled");

            var cn = $('#course-name').val();
		    var cd = $('#course-description').val();
            var cdd = $('#course-department').val();

            $.ajax({
				url: "ajaxScript.php?action=add",
				type: "POST",
				data: {
					cn: cn,
					cd: cd,
                    cdd: cdd	
				},
                cache: false,
				success: function(dataResult) {
                    //console.log(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
						$("#add-course").removeAttr("disabled");
                        $('#courseFormAdd').find('input:text, textarea, select, input[type="date"], input[type="email"], input[type="number"]').val('');
                        $("#success").show();
						$('#success').html('Data added successfully !'); 
												
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
