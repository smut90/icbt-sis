<?php
    include_once('../header.php');
    include_once('../nav.php');
    include_once('../db.php');
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
                            <div class="card-header"><strong>Student</strong><small> Form</small></div>
                            <div class="card-body card-block">

	                            <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	                            </div>

                                <div class="alert alert-error alert-dismissible" id="error" style="display:none;">
	                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	                            </div>


                                <form type="POST" id="studentFormAdd" name="studentAddForm">
                                    
                                    <div class="form-group"><label for="company" class=" form-control-label">Student ID</label>
                                        <input type="text" id="student-id" name="student_id" placeholder="Enter Student ID" class="form-control">
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Student First Name</label>
                                        <input type="text" id="student-fname" name="student_fname" placeholder="Enter Student First Name" class="form-control">
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Student Last Name</label>
                                        <input type="text" id="student-lname" name="student_lname" placeholder="Enter Student Last Name" class="form-control">
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Student Gender</label> <br>
                                        <input type="radio" id="student-sex" name="student_sex" class="" value="Male">
                                        <label for="student-male">Male</label>

                                        <input type="radio" id="student-sex" name="student_sex" class="" value="Female">
                                        <label for="student-female">Female</label>
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Student Date of Birth</label>
                                        <input type="date" id="student-dob" name="student_dob" class="form-control" placeholder="Enter Student DOB">
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Student Age</label>
                                        <input type="number" id="student-age" name="student_age" class="form-control" placeholder="Enter Student Age">
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Student Nationality</label>
                                        <input type="text" id="student-nationality" name="student_nationality" class="form-control" placeholder="Enter Student Nationality">
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Student Address</label>
                                        <textarea name="student_address" id="student-address" cols="30" rows="5" class="form-control" placeholder="Enter Student Address"></textarea>
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Student Contact Number</label>
                                        <input type="text" id="student-contact" name="student_contact" class="form-control" placeholder="Enter Student Contact Number">
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Student Email</label>
                                        <input type="email" id="student-email" name="student_email" class="form-control" placeholder="Enter Student Email">
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Student Guardian Name</label>
                                        <input type="text" id="student-guardian-name" name="student_guardian_name" class="form-control" placeholder="Enter Student Guardian Name">
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Student Guardian Number</label>
                                        <input type="text" id="student-guardian-number" name="student_guardian_number" class="form-control" placeholder="Enter Student Guardian Number">
                                    </div>

                                    <div class="form-group"><label for="company" class=" form-control-label">Student Civil Status</label>
                                        <select name="student_civil" id="student-civil" class="form-control">
                                            <option>Please select</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <input type="button" class="btn btn-primary btn-lg" id="add-Student" name="addStudent" value="Add">

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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
<link rel='stylesheet' type='text/css' href="https://bitnami-mx-kdbnbjq.el.r.appspot.com/assets/css/style.css">

<script type="text/javascript" src="/assets/js/jquery.min.js"></script>


<script>
    $(document).ready(function() {
        $('#add-Student').on('click', function() {
            $("#add-Student").attr("disabled", "disabled");

            var sid = $('#student-id').val();
		    var sfname = $('#student-fname').val();
		    var slname = $('#student-lname').val();
		    var ssex = $('#student-sex').val();
            var sdob = $('#student-dob').val();
            var sag = $('#student-age').val();
            var snat = $('#student-nationality').val();
            var sadd = $('#student-address').val();
            var scont = $('#student-contact').val();
            var sem = $('#student-email').val();
            var sgn = $('#student-guardian-name').val();
            var sgnu = $('#student-guardian-number').val();
            var sciv = $('#student-civil').val();

            $.ajax({
				url: "ajaxScript.php?action=add",
				type: "POST",
				data: {
					sid: sid,
					sfname: sfname,
					slname: slname,
					ssex: ssex,
                    sdob: sdob,
                    sag: sag,
					snat: snat,
					sadd: sadd,
					scont: scont,
                    sem : sem,	
                    sgn: sgn,	
                    sgnu: sgnu,	
                    sciv: sciv		
				},
                cache: false,
				success: function(dataResult) {
                    //console.log(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode === 200){
						$("#add-Student").removeAttr("disabled");
                        $('#studentFormAdd').find('input:text, textarea, select, input[type="date"], input[type="email"], input[type="number"]').val('');
                        $('input[name=student_sex]').prop('checked',false);
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
