<?php
/*
  This function below is to check the language
 */
function count_subarray($array)
{
	if (!is_array($array)) {
		return 1;
	}
	$count = 0;
	foreach($array as $sub_array) {
		$count ++;
	}
	//$ha="";
	//$ha .=$array[0]['name']."</br>";$ha .=$array[1]['name']."</br>"; return $ha;
	echo"<span style='position:absolute; left:1125px;'>";
	
	for($i=0;$i<$count;$i++)
	{    
		echo($array[$i]['name']);
	}
	echo "</span>";
}

$country=$_POST['postcountry'];

if(empty($country))
	{echo "please do not leave you input box empty before submission!";}
else{
	$jsonData=file_get_contents("https://restcountries.eu/rest/v2/all");
	
	$json=json_decode($jsonData,true);
	echo"<table>";
	
	usort($json,function($a,$b){return strnatcasecmp($a['name'],$b['name']);});
	                
	$i=0;
	foreach($json as $row)
	{   
		$record=strtolower(trim($row['name']));
		$record_code2=strtolower(trim($row['alpha2Code']));
		$record_code3=strtolower(trim($row['alpha2Code']));
		$input=strtolower(trim($country));
		
	 	if($input==$record or strpos($record,$input)!==false or $input==$record_code2 or $input==$record_code3){
			//var_dump($row);
			$i++;
			if($i<=50){
				echo "<tr><td>".$row["name"]."</td><td>".$row["alpha2Code"]."</td><td>".$row["alpha3Code"]."</td><td><img src='".$row["flag"]."'width='50' height='20'></td><td>".$row["region"]."</td><td>".$row["subregion"]."</td><td>".$row["population"]."</td><td>".count_subarray($row["languages"])./*<td>we have.count_subarray($row["languages"]).for($i=0;$i<=count_subarray($row["languages"]);$i++){$row["languages"][$i]["name"]}*/"</td></tr>";
			}
		}		
	}
	if($i==0){echo "Sorry, the search result is 0";}
	echo "<text style='color:red'>we have ".$i." results</text>";
	echo "</table>";
}


?>