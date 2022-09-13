<?php
include 'backend/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Documents</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="ajax/ajax.js"></script>
</head>
<style>
img {
  border: 1px solid #ddd; /* Gray border */
  border-radius: 4px;  /* Rounded border */
  padding: 5px; /* Some padding */
  width: 150px; /* Set a small width */
}

/* Add a hover effect (blue shadow) */
img:hover {
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}
</style>
<body>

<div class="container">
<p id="success"></p>
	<div class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-6">
					<h2>Manage Files</b></h2>
				</div>
				<div class="col-sm-6">
					<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Add New Document</span></a>
					<a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i class="material-icons"></i> <span>Delete</span></a>						
				</div>
			</div>
		</div>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>
						<span class="custom-checkbox">
							<input type="checkbox" id="selectAll">
							<label for="selectAll"></label>
						</span>
					</th>
					
					<th>YEAR</th>
					<th>BRAND</th>
					<th>MODEL</th>
					<th>TYPE</th>
					<th>Manual TYPE</th>
					<th>FILE</th>
					<th>ACTION</th>
				</tr>
			</thead>
			<tbody>
			
			<?php
			$result = mysqli_query($conn,"SELECT * FROM gck");
				$i=1;
				while($row = mysqli_fetch_array($result)) {
			?>
			<tr>
			<td>
						<span class="custom-checkbox">
							<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["id"]; ?>">
							<label for="checkbox2"></label>
						</span>
					</td>
				
				<td><?php echo $row["year"]; ?></td>
				<td><?php echo $row["brand"]; ?></td>
				<td><?php echo $row["model"]; ?></td>
				<td><?php echo $row["type"]; ?></td>
				<td><?php echo $row["manual_type"]; ?></td>				
				<td><a target="_blank" href="\gck\includes\display.php?id=<?=$row['id']?>">
				<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['thumbnail'])?> alt="PDF"></a></td>
				
				<td>
					<a href="#editEmployeeModal" class="edit" data-toggle="modal">
						<i class="material-icons update" data-toggle="tooltip" 
						data-id="<?php echo $row["id"]; ?>"
						data-year="<?php echo $row["year"]; ?>"
						data-brand="<?php echo $row["brand"]; ?>"
						data-model="<?php echo $row["model"]; ?>"
						data-type="<?php echo $row["type"]; ?>"					
						data-manual="<?php echo $row["manual_type"]; ?>"
						data-manual="<?php echo $row["manual_type"]; ?>"
						
						title="Edit"></i>
					</a>
					<a href="#deleteEmployeeModal" class="delete" data-id="<?php echo $row["id"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" 
						title="Delete"></i></a>
				</td>
			</tr>
			<?php
			$i++;
			}
			?>
			</tbody>
		</table>
		
	</div>
</div>
<!-- Add Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="user_form">
				<div class="modal-header">						
					<h4 class="modal-title">Add Document</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
				<div class="form-group">
						<label>YEAR</label>
						<input type="text" id="year" name="year" class="form-control" required>
					</div>					
					<div class="form-group">
						<label>BRAND</label>
						<input type="text" id="brand" name="brand" class="form-control" required>
					</div>
					<div class="form-group">
						<label>MODEL</label>
						<input type="text" id="model" name="model" class="form-control" required>
					</div>
					<div class="form-group">
						<label>TYPE</label>
						<input type="txt" id="type" name="type" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Manual TYPE</label>
						<input type="txt" id="manual_type" name="manual_type" class="form-control" required>
					</div>
					<div class="form-group">
						<label>FILE</label>
						<input type="txt" id="file" name="file" class="form-control" required>
					</div>					
				</div>
				<div class="modal-footer">
					<input type="hidden" value="1" name="type">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<button type="button" class="btn btn-success" id="btn-add">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="update_form">
				<div class="modal-header">						
					<h4 class="modal-title">Edit Record</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id_u" name="id" class="form-control" required>	
					<div class="form-group">
						<label>Year</label>
						<input type="text" id="year_u" name="year" class="form-control" required>
					</div>				
					<div class="form-group">
						<label>Brand</label>
						<input type="text" id="brand_u" name="brand" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Model</label>
						<input type="model" id="model_u" name="model" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Type</label>
						<input type="txt" id="type_u" name="type" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Manual Type</label>
						<input type="txt" id="manual_u" name="manual_type" class="form-control" required>
					</div>
					<div class="form-group">
						<label>File</label>
						<input type="file" id="file_u" name="file" class="form-control" required>
					</div>					
				</div>
				<div class="modal-footer">
				<input type="hidden" value="2" name="type">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<button type="button" class="btn btn-info" id="update">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Delete Document</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id_d" name="id" class="form-control">					
					<p>Are you sure you want to delete these Records?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<button type="button" class="btn btn-danger" id="delete">Delete</button>
				</div>
			</form>
		</div>
	</div>
</div>

</body>
</html>