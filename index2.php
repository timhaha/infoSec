<?php
/*
  *This function below is to check the language array
  *for later invoke(if language has subarray )
  *check how many languages the country use
 */
function count_subarray($array)
{   //if it has no subarray
	if (!is_array($array)) {
		return 1;
	}
	//count subarray numbers.check how many languages the country is using
	$count = 0;
	foreach($array as $sub_array) {
		$count ++;
	}
	//$ha="";
	//$ha .=$array[0]['name']."</br>";$ha .=$array[1]['name']."</br>"; return $ha;
	echo"<span style='position:absolute; left:1105px;'>";
	//check how many languages the country is using.
	for($i=0;$i<$count;$i++)
	{    
		echo($array[$i]['name']);
	}
	echo "</span>";
}

$country=$_POST['postcountry'];
//check if the input box is empty
if(empty($country))
	{echo "<div style='font-size:34px; color:red'>please do not leave you input box empty before submission!</div>";}
else{
	$jsonData=file_get_contents("https://restcountries.eu/rest/v2/all");
	$json=json_decode($jsonData,true);
	echo"<table>";
	
	//sort the json data alphabetically according the the country name
	usort($json,function($a,$b){return strnatcasecmp($a['name'],$b['name']);});
	 
	//set i=0 as the time to count the number of results               
	$i=0;
	foreach($json as $row)
	{   
		$record=strtolower(trim($row['name']));
		$record_code2=strtolower(trim($row['alpha2Code']));
		$record_code3=strtolower(trim($row['alpha2Code']));
		$input=strtolower(trim($country));
		//filtering the search result below, find the matched results
	 	if($input==$record or strpos($record,$input)!==false or $input==$record_code2 or $input==$record_code3){
			//var_dump($row);
			$i++;
			//if the search results are more the 50, only show the first 50 results
			if($i<=50){
				echo "<tr><td>".$row["name"]."</td><td>".$row["alpha2Code"]."</td><td>".$row["alpha3Code"]."</td><td><img src='".$row["flag"]."'width='50' height='20'></td><td>".$row["region"]."</td><td>".$row["subregion"]."</td><td>".$row["population"]."</td><td>".count_subarray($row["languages"])./*<td>we have.count_subarray($row["languages"]).for($i=0;$i<=count_subarray($row["languages"]);$i++){$row["languages"][$i]["name"]}*/"</td></tr>";
			}
		}		
	}
	//if the search results equal to 0, then give an indication message, tell the user the result is 0.
	if($i==0){echo "<div style='font-size:34px; color:red'>Sorry, the search result is 0</div>";}
	echo "<text style='color:red'>we have ".$i." results</text>";
	echo "</table>";
}


?>