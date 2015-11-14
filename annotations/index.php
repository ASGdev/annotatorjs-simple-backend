<?php
// read incoming data
$jsonObj = file_get_contents('php://input');
$jsonObj = json_decode($jsonObj, true);
// open annotations file
$file = file_get_contents('data.json');
$data = json_decode($file, true);

//header('Content-Type: application/json');

/* For debug */
//echo $_SERVER['REQUEST_METHOD'];
//var_dump(file_get_contents('php://input'));
//var_dump($_SERVER['REQUEST_URI']);
/**/

switch ($_SERVER['REQUEST_METHOD']) {
	case 'GET':
		// FETCHING
		returnData($data);
		break;

	case 'POST':
		// CREATING
		//var_dump($jsonObj);
		$data[] = $jsonObj;
		returnData($data);
		saveData($data);
		break;

	case 'PUT':
		//var_dump($data);
		//var_dump($jsonObj);
		// MODIFYING
		// iterate data array until it founds the same properties (start, startOffset...) then update
		foreach($data as &$val) {
			// the & update the original array
		    if(($val['ranges']['0']['start'] == $jsonObj['ranges']['0']['start']) && ($val['ranges']['0']['startOffset'] == $jsonObj['ranges']['0']['startOffset']) && ($val['ranges']['0']['end'] == $jsonObj['ranges']['0']['end']) && ($val['ranges']['0']['endOffset'] == $jsonObj['ranges']['0']['endOffset']) && ($val['quote'] == $jsonObj['quote'])){
		    	$val['text'] = $jsonObj['text'];
		    }		    
		}
		returnData($data);
		saveData($data);
		break;

	case 'DELETE':
		$index = 0;
		$i = 0;
		foreach($data as $val) {
		    if(($val['ranges']['0']['start'] == $jsonObj['ranges']['0']['start']) && ($val['ranges']['0']['startOffset'] == $jsonObj['ranges']['0']['startOffset']) && ($val['ranges']['0']['end'] == $jsonObj['ranges']['0']['end']) && ($val['ranges']['0']['endOffset'] == $jsonObj['ranges']['0']['endOffset']) && ($val['quote'] == $jsonObj['quote'])){
		    	$index = $i;
		    }
	    	$i++;
		}
		unset($data[$index]);
		returnData($data);
		saveData($data);
		break;
}

/* TODO 
-> authentication
-> multi-users
*/

/**/
function saveData($data){
	$data = json_encode($data);
	file_put_contents('data.json', $data);
}

function returnData($data){
	$data = json_encode($data);
	echo $data;
}
?>