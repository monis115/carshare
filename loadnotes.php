<!-- <?php
session_start();
include('connection.php');


//   Get the user id 
$user_id=$_SESSION['user_id'];

//  run a query to delete the empty notes 
$sql="DELETE from notes where note =''";
$result=mysqli_query($link,$sql);
if(!$result)
{
     echo "<div class='alert alert-danger'>  There was an error while running the Query ! </div>";
     exit;
}



//  runn a query  to look for the notes corresponding to user_id
$sql="SELECT * FROM notes WHERE user_id='$user_id' ORDER BY time DESC";
if($result=mysqli_query($link,$sql))
{
    if(mysqli_num_rows($result)){

         while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
         {
            $note=$row['note'];
            $time=$row['time'];
            $note_id=$row['id'];
            $time=date("F d,Y h:i:s A",$time);
            echo " <div class='note'>
                  <div class='col-xs-5 col-sm-3 delete'>
                <button class='btn btn-lg btn-danger' style='width: 100px;'>delete</button>
        
                 </div>
            <div class='notehead' id='$note_id'> 

               <div class='notetext'>$note </div>
                <div class='notetime'> $time</div>
      
           </div>
           </div>"
           ;

         }
    }else 
    {
        echo "<div class='alert alert-info'> You have note created note yet !</div>";
        exit;
    }

}else{
    echo "<div class='alert alert-danger'>  There was an error while running the Query ! </div>";
    exit;
}


//  show notes or alert message

 



?> -->