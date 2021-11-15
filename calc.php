<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if(
	     isset($_GET['o'])
	  && !empty($_GET['o'])
	  && isset($_GET['fv'])
	  && is_numeric($_GET['fv']) 
	  && isset($_GET['sv'])
	  && is_numeric($_GET['sv'])
	  ){
		  $fv = (float)$_GET['fv'];
		  $sv = (float)$_GET['sv'];
		  $o = $_GET['o'];
		  if($o == 'p'){
			  echo $fv+$sv;
		  }else if($o == 'm'){
			  echo $fv-$sv;
		  }else if($o == 'x'){
			  echo $fv*$sv;
		  }else if($o == 'd'){
			  echo $fv/$sv;
		  }
	  }else{
		  echo 0;
	  }
}else{
	echo 0;
}

?>