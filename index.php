<?php 

include 'db.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="dropzone.css">
  
</head>
<body>

	<div class="card" id="success_message" style="display: none;position: fixed;top: 0">
      			<div class="card-body" style="height: 50px">
      				<p id="success_error_message" style="margin-top: -10px"></p>
      			</div>
      		</div>

<div class="container">
	<div class="d-flex justify-content-center">
		<h1>AJAX CRUD OPERATION</h1>
	</div>



	<div class="d-flex justify-content-end">
		<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Create User</button>
	</div>


	<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
  		
  		<div class="card" id="error_message" style="display: none;">
      			<div class="card-body" style="background-color: pink;height: 50px">
      				<p style="color: red;margin-top: -10px">Please enter all field value.</p>
      			</div>
      		</div>

        <div class="form-group">
        	<label>Name</label>
        	<input class="form-control" type="text" name="" id="name">
        </div>
        <div class="form-group">
        	<label>Email</label>
        	<input class="form-control" type="text" name="" id="email">
        </div>
        <div class="form-group">
        	<label>Phone</label>
        	<input class="form-control" type="text" name="" id="phone">
        </div>

        <div class="form-group">



                      <label>Designation <span style="color: red; margin-left: 4px">*</span></label>

                      <select class="custom-select" id="designation" name="" >

                        <?php

				$tbl_designation	=  mysqli_query($conn, "SELECT * FROM tbl_designation") or die(mysqli_error($conn));

                      while($designation=mysqli_fetch_array($tbl_designation)){

                        ?>

                        <option  value="<?php echo $designation['ID'];?>" ><?php echo $designation['designation_name'];?></option>

                        <?php } ?>

                      </select>

                    </div>

                    <!-- <div class="form-group">
                    	<input type="file" name="multiple_files" id="multiple_files" multiple />
                    </div> -->

                    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save" onclick="insertData()">Save</button>
      </div>
    </div>
  </div>
</div>

	<div class="d-flex justify-content">
		<h4>Users List</h4>
	</div>

	<?php 
	$select_query = "SELECT tu.*,td.* from tbl_users as tu left outer join tbl_designation as td on tu.designation_id = td.ID order by tu.name asc";

	$sql = mysqli_query($conn,$select_query);
	?>

	<div id="table_div">
		
	</div>


	
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="dropzone.js"></script>


  <script type="text/javascript">



  	$(document).ready(function(){

  		readData();

  	});

  	function readData(){

  		var check = "check";

  		$.ajax({


  			url: 'insert.php',
  			type: 'post',
  			data: {

  				check: check
  			},

  			success: function(data,status){

  				$('#table_div').html(data);
  			}
  		});
  	}


  	function deleteData(user_id){

  		//var user_id = user_id;

  		$.ajax({

  			url: 'insert.php',
  			type: 'post',
  			data: { user_id: user_id },

  			success: function(data,status){

  				//$("#deleteModal"+user_id).modal('toggle');


  				$("#success_error_message").html("User has been deleted!");
  				$(".card-body").css('background-color','pink');
  				$("#success_message").css('color','red');
  				$("#success_message").slideDown();

  				readData();
  			}

  		});

  		setInterval(function(){ $("#success_message").slideUp(); }, 5000);
  	}


  	function editData(u_id){

  		var name1 = $("#name1"+u_id).val();
  		var email1 = $("#email1"+u_id).val();
  		var phone1 = $("#phone1"+u_id).val();
  		var designation1 = $("#designation1"+u_id).val();

  			$.ajax({

  				url: 'insert.php',
  				type: 'post',
  				data:{
  					u_id: u_id,
  					name1: name1,
  					email1: email1,
  					phone1: phone1,
  					designation1: designation1
  				},

  				beforeSend: function(){
  				$("#edit"+u_id).prop("disabled",true);
  				$("#edit"+u_id).css("cursor","no-drop");

  			},

  				success: function(data, status){

  					$("#success_error_message").html("User has been updated!");
  					$(".card-body").css('background-color','#bbf5a2');
	  				$("#success_message").css('color','green');
	  				$("#success_message").slideDown();

	  				readData();
  				}

  			});
  			setInterval(function(){ $("#success_message").slideUp(); }, 5000);
  	}
  	
  	function insertData(){


  		var name = $("#name").val();
  		var email = $("#email").val();
  		var phone = $("#phone").val();
  		var designation = $("#designation").val();


  		if (name!='' && email!='' && phone!='') {

  		$.ajax({

  			url: 'insert.php',
  			type: 'post',
  			data: {

  				name: name,
  				email: email,
  				phone: phone,
  				designation: designation
  			},

  			beforeSend: function(){
  				$("#save").prop("disabled",true);
  				$("#save").css("cursor","no-drop");

  			},

  			success: function(data,status){

  				$("#exampleModal").modal('toggle');

  				$("#name").val('');
  				$("#email").val('');
  				$("#phone").val('');
  				$("#designation").val('1');

  				$("#success_error_message").html("User added successfully!");
  				$(".card-body").css('background-color','#bbf5a2');
  				$("#success_message").css('color','green');
  				$("#success_message").slideDown();

  				//setInterval(function(){ $("#success_message").slideUp(); }, 5000);

  				readData();
  			}
  		});

  		setInterval(function(){ $("#success_message").slideUp(); }, 5000);

  	}else if(name=='' || email=='' || phone==''){

  			$("#error_message").slideDown();

  			//setInterval(function(){ $("#error_message").slideUp(); }, 5000);

  	}
  	}
  	//setInterval(function(){ $("#error_message").slideUp(); }, 3000);
  </script>
</body>
</html>