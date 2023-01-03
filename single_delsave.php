<?php
    include("session_init.php");
    if(!isset($_SESSION["user_id"])){
        header('Location: ./index.php');
        exit;
    }
	echo $_POST["cloth_id"];
	if (isset($_POST["cloth_id"]) && !empty($_POST["cloth_id"]))
	{
	  $cloth_id = $_POST["cloth_id"];
	  //用trigger刪cloth_detail
      $sql = "DELETE FROM cloth_number WHERE cloth_id = ?";
	  if($stmt = $db->prepare($sql)){
		$success = $stmt->execute(array($cloth_id));
		  
		  if (!$success) {
			echo "刪除失敗!".$stmt->errorInfo();
		  }else{
			header('Location: single.php');
		  }
	  }
	} 
	else 
	{
	  $cloth_id = NULL;
	  echo "no supplied";
	}	
	
	
?>