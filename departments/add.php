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
                                <h1>Departments</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Departments</a></li>
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
                            <div class="card-header"><strong>Department</strong><small> Form</small></div>
                            <div class="card-body card-block">

	                            <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	                            </div>

                                <div class="alert alert-error alert-dismissible" id="error" style="display:none;">
	                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	                            </div>


                                <form type="POST" id="departmentFormAdd" name="departmentAddForm">
                                    
                                    <div class="form-group"><label for="company" class=" form-control-label">Department</label>
                                        <input type="text" id="department-name" name="department_name" placeholder="Enter Department Name" class="form-control">
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Description</label>
                                        <textarea name="department_description" id="department-description" cols="30" rows="5" class="form-control" placeholder="Enter Department Description"></textarea>
                                    </div>

                                    <input type="button" class="btn btn-primary btn-lg" id="add-department" name="addDepartment" value="Add">

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
        $('#add-department').on('click', function() {
            $("#add-department").attr("disabled", "disabled");

            var dna = $('#department-name').val();
		    var ddd = $('#department-description').val();

            $.ajax({
				url: "ajaxScript.php?action=add",
				type: "POST",
				data: {
					dna: dna,
					ddd: ddd	
				},
                cache: false,
				success: function(dataResult) {
                    //console.log(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
						$("#add-department").removeAttr("disabled");
                        $('#departmentFormAdd').find('input:text, textarea, select, input[type="date"], input[type="email"], input[type="number"]').val('');
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
