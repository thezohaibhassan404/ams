<?php include('db_connect.php');?>
<?php

if(isset($_POST["d"]) && isset($_POST["s"])){
    $d=$_POST['d'];
    $s=$_POST['s'];
}


//echo $d;

?>

<div class="loader" id="t" style="display:none">
</div>
<table class="table table-bordered table-condensed table-hover">
<thead>
    <tr>
        <th class="text-center">#</th>
        <th class="">Company</th>
        <th class="">Job Title</th>
        <th class="">Posted By</th>
        <th class="text-center">Status</th>
        <th class="text-center">Action</th>
    </tr>
</thead>
<tbody>
    <?php 
    $i = 1;
   // status=".$s." and 
  //  $jobs =  $conn->query("SELECT c.*,u.name from careers c inner join users u on u.id = c.user_id where order by id desc" );
    $jobs1 =  $conn->query("Select * from users");

    while($row1=$jobs1->fetch_assoc()){
        $u_id=$row1['id'];


if(isset($_POST["d"]) && isset($_POST["s"])){

    $jobs =  $conn->query("Select * from careers where user_id=".$u_id." AND job_status=".$s." AND date_created='".$d."'");


}else{

    $jobs =  $conn->query("Select * from careers where user_id=".$u_id."");

}



    
    while($row=$jobs->fetch_assoc()){
        
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
             <p><b><?php echo ucwords($row1['name']) ?></b></p>
             
        </td>
        <td id="td_<?php echo $i;?>">
        <?php 
                if($row['job_status'] == 1) {
        
                echo ' <input type="button" onclick=change_status("b_'.$i.'","td_'.$i.'",0,'.$row["id"].') value="In-Active" id="i_b_'.$i.'">';
                echo ' <input style="display:none" type="button" onclick=change_status("b_'.$i.'","td_'.$i.'",1,'.$row["id"].') value="Active" id="a_b_'.$i.'">';
                }
                else if($row['job_status'] == 0){
                 echo ' <input type="button" onclick=change_status("b_'.$i.'","td_'.$i.'",1,'.$row["id"].') value="Active" id="a_b_'.$i.'">';
                 echo ' <input style="display:none" type="button" onclick=change_status("b_'.$i.'","td_'.$i.'",0,'.$row["id"].') value="In-Active" id="i_b_'.$i.'">';
                }
                 ?>


       
        </td>
        <td class="text-center">
            <button class="btn btn-sm btn-outline-primary view_career" type="button" data-id="<?php echo $row['id'] ?>" >View</button>
            <button class="btn btn-sm btn-outline-primary edit_career" type="button" data-id="<?php echo $row['id'] ?>" >Edit</button>
            <button class="btn btn-sm btn-outline-danger delete_career" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
        </td>
    </tr>


    <?php } ?>
    <?php } ?>
</tbody>
</table>

<script>
$(document).ready(function(){
		$('table').dataTable()
	})


   function change_status(b_id,c_id,st,id){

    document.getElementById("t").style.display ="";

		$.ajax({
      type: "POST",
      url: "update_jobs_s.php",
      data: {b_id:b_id,c_id:c_id,s:st,id:id},
      success: function (result) {
       
           if(result=="1"){
            //show button active because status is in-active
         //   console.log("1");
        
         document.getElementById("i_"+b_id).style.display = "none";
         document.getElementById("a_"+b_id).style.display = "inline";
       
      
         document.getElementById("t").style.display ="none";

           
           }else{
            //show button inactive because status is active
    //   console.log("0");
            document.getElementById("a_"+b_id).style.display = "none";
         document.getElementById("i_"+b_id).style.display = "inline";
         document.getElementById("t").style.display ="none";

           }

		 
      }
 });


   
   }

    </script>