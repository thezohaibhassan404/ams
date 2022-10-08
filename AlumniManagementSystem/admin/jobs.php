<?php include('db_connect.php');?>
<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
  
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

<div class="container-fluid">
<style>
	input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.5); /* IE */
  -moz-transform: scale(1.5); /* FF */
  -webkit-transform: scale(1.5); /* Safari and Chrome */
  -o-transform: scale(1.5); /* Opera */
  transform: scale(1.5);
  padding: 10px;
}
</style>
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
			<form style="float: left; display: inline; width: 82%;" >
				<label for="date_select" style="margin-right: 25px;">Select Date </label>
				<span id="date_required" style="display:none;color:red">Please Select date</span>
				<input type="date" id="job_post_date" name="job_post_date" required></br>
				<label for="date_select" style="margin-right: 25px;">Job Status </label>
				<span id="job_required" style="display:none;color:red">Please Select Job Status</span>
				<input type="radio" id="active_r" name="select_status" value="1" required> Active
				
				<input type="radio" id="inactive_r" name="select_status" value="0" required> InActive</br>
				
				<input class="btn btn-primary btn-sm col-sm-2 " type="button" value="Search" onclick="get_jobs(0)">
				</form>

				<form style="display: inline">
				<input class="btn btn-primary btn-sm col-sm-2" style="display:block" type="button" value="View All" onclick="get_jobs(1)">

				</form>

				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">

				

				<div class="card">
					<div class="card-header">
						<b>Jobs List</b>
						<span class="">

							<button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_career">
					<i class="fa fa-plus"></i> New</button>
				</span>
					</div>
					<div class="card-body" id="jobs_table">
				<!--		
						<table class="table table-bordered table-condensed table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Company</th>
									<th class="">Job Title</th>
									<th class="">Posted By</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$jobs =  $conn->query("SELECT c.*,u.name from careers c inner join users u on u.id = c.user_id order by id desc");
								while($row=$jobs->fetch_assoc()):
									
								?>
								<tr>
									
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										 <p><b><?php echo ucwords($row['company']) ?></b></p>
										 
									</td>
									<td class="">
										 <p><b><?php echo ucwords($row['job_title']) ?></b></p>
										 
									</td>
									<td class="">
										 <p><b><?php echo ucwords($row['name']) ?></b></p>
										 
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary view_career" type="button" data-id="<?php echo $row['id'] ?>" >View</button>
										<button class="btn btn-sm btn-outline-primary edit_career" type="button" data-id="<?php echo $row['id'] ?>" >Edit</button>
										<button class="btn btn-sm btn-outline-danger delete_career" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>

								-->
					</div>




				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	$('#new_career').click(function(){
		uni_modal("New Entry","manage_career.php",'mid-large')
	})
	
	$('.edit_career').click(function(){
		uni_modal("Manage Job Post","manage_career.php?id="+$(this).attr('data-id'),'mid-large')
		
	})
	$('.view_career').click(function(){
		uni_modal("Job Opportunity","view_jobs.php?id="+$(this).attr('data-id'),'mid-large')
		
	})
	$('.delete_career').click(function(){
		_conf("Are you sure to delete this post?","delete_career",[$(this).attr('data-id')],'mid-large')
	})

	function delete_career($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_career',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}


	function get_jobs(a){
		$('#jobs_table').empty();
		var status=null;
		var date=document.getElementById("job_post_date").value;
		if(document.getElementById("active_r").checked){

			status=1;

		
		}else if(document.getElementById("inactive_r").checked){

			status=0;


		}

		if(a==0){
		//	console.log(date);
			if(!date){

			

				document.getElementById("date_required").style.display="inline";
				return false;


			}else if(status == null){

				document.getElementById("job_required").style.display="inline";
				return false;


			}


		
		}


		if(a==1){
						$.ajax({
				type: "POST",
				url: "get_jobs.php",
				data: {a:a},
				success: function (result) {
					// do something here

					//  console.log(result);

					
					$('#jobs_table').append(result);
				}
			});




		}else{

			$.ajax({
      type: "POST",
      url: "get_jobs.php",
      data: {d:date, s:status},
      success: function (result) {
           // do something here

		 //  console.log(result);

		  
		  $('#jobs_table').append(result);
      }
 });

		}




	}

</script>