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


                                <form type="POST" id="moduleFormAdd" name="moduleAddForm">
                                    
                                    <div class="form-group"><label for="company" class=" form-control-label">Module Code</label>
                                        <input type="text" id="module-code" name="module_code" placeholder="Enter Module Code" class="form-control">
                                    </div>
                                
                                    <div class="form-group"><label for="company" class=" form-control-label">Module Name</label>
                                        <input type="text" id="module-name" name="module_name" placeholder="Enter Module Name" class="form-control">
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Description</label>
                                        <textarea name="module_description" id="module-description" cols="30" rows="5" class="form-control" placeholder="Enter Module Description"></textarea>
                                    </div>


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

                                    <div class="form-group"><label for="company" class=" form-control-label">Semester</label>
                                        <select name="module_semester" id="module-semester" class="form-control">
                                            <option>Please select</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>

                                    <input type="button" class="btn btn-primary btn-lg" id="add-module" name="addModule" value="Add">

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
        $('#add-module').on('click', function() {
            $("#add-module").attr("disabled", "disabled");

            var mc = $('#module-code').val();
		    var mn = $('#module-name').val();
            var md = $('#module-description').val();
            var mcid = $('#course-id').val();
            var ms = $('#module-semester').val();

            $.ajax({
				url: "ajaxScript.php?action=add",
				type: "POST",
				data: {
					mc: mc,
					mn: mn,
                    md: md,
                    mcid: mcid,	
                    ms: ms
				},
                cache: false,
				success: function(dataResult) {
                    //console.log(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
						$("#add-module").removeAttr("disabled");
                        $('#moduleFormAdd').find('input:text, textarea, select, input[type="date"], input[type="email"], input[type="number"]').val('');
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
