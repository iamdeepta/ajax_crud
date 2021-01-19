<?php 

include 'db.php';

extract($_POST);

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['designation'])) {
	

	$query = "INSERT INTO tbl_users 
                    SET 
                        `name` = '{$name}',
                        `email` = '{$email}',
                        `phone` = '{$phone}',
                        `designation_id` = '{$designation}'
                        
                      
                ";

            

        $insert_q = mysqli_query($conn, $query);


}


if (isset($_POST['check'])) {
	
	$select_query = "SELECT tu.*,td.* from tbl_users as tu left outer join tbl_designation as td on tu.designation_id = td.ID where tu.active_status = 0 order by tu.name asc";

	$sql = mysqli_query($conn,$select_query);

	$select_div = '<table class="table table-striped table-hover table-bordered">
						<thead>
							<tr>
							<th>SL.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Designation</th>
							<th>Action</th>
							</tr>
						</thead>';

			$sl = 0;
			while($users = mysqli_fetch_array($sql)){ 
			$sl++;

			$select_div .= '<tr>
					<td>'.$sl.'</td>
					<td>'.$users['name'].'</td>
					<td>'.$users['email'].'</td>
					<td>'.$users['phone'].'</td>
					<td>'.$users['designation_name'].'</td>
					<td><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal'.$users['id'].'">x</button><button type="button" style="margin-left: 5px" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal'.$users['id'].'">Edit</button></td>



<div class="modal fade" data-backdrop="false" id="deleteModal'.$users['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are You Sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
      <div>
      <p>Once you delete it, it cannot be undone.</p>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger" onclick="deleteData('.$users['id'].')">Yes</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" data-backdrop="false" id="editModal'.$users['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
      <div class="form-group">
        	<label>Name</label>
        	<input class="form-control" type="text" name="" value="'.$users['name'].'" id="name1'.$users['id'].'">
        </div>
        <div class="form-group">
        	<label>Email</label>
        	<input class="form-control" type="text" name="" value="'.$users['email'].'" id="email1'.$users['id'].'">
        </div>
        <div class="form-group">
        	<label>Phone</label>
        	<input class="form-control" type="text" name="" value="'.$users['phone'].'" id="phone1'.$users['id'].'">
        </div>

        <div class="form-group">



                      <label>Designation <span style="color: red; margin-left: 4px">*</span></label>

                      <select class="custom-select" id="designation1'.$users['id'].'" name="" >';

   
				$tbl_designation1	=  mysqli_query($conn, "SELECT * FROM tbl_designation") or die(mysqli_error($conn));

                      while($designation1=mysqli_fetch_array($tbl_designation1)){

    

                      $select_div .='<option  value="'.$designation1['ID'].'"';

                      if($users['designation_id']==$designation1['ID']){  
                       }

                     $select_div .=' >'.$designation1['designation_name'].'</option>';

                         } 

                    $select_div .='</select>

                    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" id="edit'.$users['id'].'" class="btn btn-success" onclick="editData('.$users['id'].')">Update</button>
      </div>
    </div>
  </div>
</div>


				</tr>';

			}

			$select_div .= '</table>';

			echo $select_div;
}


if (isset($_POST['user_id'])) {

	$one = 1;

	$users_id = $_POST['user_id'];

	$delete_query = "UPDATE tbl_users 
                    SET 
                        
                        `active_status` = '{$one}'

                        WHERE id = $users_id
                        
                      
                ";

            

        $delete_q = mysqli_query($conn, $delete_query);
}



if (isset($_POST['u_id']) && isset($_POST['name1']) && isset($_POST['email1']) && isset($_POST['phone1']) && isset($_POST['designation1'])) {

/*	$one = 1;*/

	$u_id = $_POST['u_id'];

	$update_query = "UPDATE tbl_users 
                    SET 
                        
                        `name` = '{$name1}',
                        `email` = '{$email1}',
                        `phone` = '{$phone1}',
                        `designation_id` = '{$designation1}'

                        WHERE id = $u_id
                        
                      
                ";

            

        $update_q = mysqli_query($conn, $update_query);
}

?>