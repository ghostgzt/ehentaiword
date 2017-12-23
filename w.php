<?php
header("Content-Type:text/html;charset=UTF-8");
$w=file_get_contents("w.txt");
$w=explode("\r\n",$w);
$out=array();
$group="";
foreach($w as $key=>$value){
	if(!$value){
		continue;
	}
	if(is_numeric(substr($value,0,1)) and substr($value,1,1)=="."){
		$group=substr($value,2);
		$out[$group]=array();
	}else{
		if(strstr($value,"=")){
			$a=explode("=",$value);
			if(preg_match("/^[A-Za-z0-9]+$/",substr($value,0,1))){
				$k=$a[0];
				$v=$a[1];
			}else{
				$k=$a[1];
				$v=$a[0];
			}
			array_push($out[$group],array("key"=>$k,"value"=>$v));
		}
	}
}
die(json_encode($out));