<?php
require_once('InstagramScraper.php');
if ($_SERVER['REQUEST_METHOD'] == "GET") {
  //   -----------------------------------------------------------------------------------------------------------------------
  //  | use different url to "define" endpoint where request can be sent, modify .htaccess wit ReWrite Engine to make it work |
  //   -----------------------------------------------------------------------------------------------------------------------
 
//if only $_GET['user'] is set and not empty than return only userInfo with search($user) function

if(isset($_GET['user']) && !isset($_GET['nPost'])){
	if(!empty($_GET['user'])){
		$user=$_GET['user'];
        //echo "dentro is set only user";
    	$responseData=searchInfo($user);
        //manda risposta
  		echo json_encode($responseData, JSON_FORCE_OBJECT);
        //var_dump( $responseData);
		http_response_code(200);
	} 
}  
	
    
    
//if $_GET['user'] is set and $_GET['userData'] is set and === true than 
//return userData with searchData($user) function
if(isset($_GET['nPost'])){
	if(!empty($_GET['nPost'])){
        $username=$_GET['user'];
        $nPost=$_GET['nPost'];     
  		$responseData=searchPost($username);
       echo json_encode($responseData);
    	http_response_code(200);
    }
}
	
    
if(isset($_GET['user']) && isset($_GET['userData'])){
	if(empty($_GET['user']) && empty($_GET['userData'])){
   		http_response_code(404);
   		echo json_encode( array("message" => "Missing data."));
    }
} 

if(isset($_GET['user']) && isset($_GET['userData'])){
	if(empty($_GET['user']) && !empty($_GET['userData'])){
   		http_response_code(404);
   		echo json_encode( array("message" => "Missing user data.") );
   }
}

if(isset($_GET['user']) && isset($_GET['userData'])){
	if(!empty($_GET['user']) && empty($_GET['userData'])){
   		http_response_code(404);
   		echo json_encode( array("message" => "Missing post data.") );
    }
}

}
   


?>
