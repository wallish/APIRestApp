<?php
	require 'CURL/Curl.php';

	if(isset($_POST["path"])) {
		$path = "";
		if($_POST["path"] != "all") {
			$path = $_POST["path"];
		}
		$curl = new Curl("foobar","bar","foo");
		
		$xml_content = substr($curl->get(), 0, -1);

		$xml = new SimpleXMLElement($xml_content);

		$results = $xml->xpath($path);	
		
		//echo print_r($results, true);
		$response = array();
		foreach ($results as $result) {
			if(!isset($_POST["id"]))
				$response[] = array("id" => (string) $result->attributes()["jeuId"], "titre"=> (string) $result->{"titre"});
			else {
				$consoles = $jaquettes = array();
				foreach($result->consoles->console as $console){
					$consoles[] = (string) $console->nomConsole;
					$jaquettes[] = (string) $console->medias->media;
				}
				$response[] = array( "titre"=> (string) $result->{"titre"}, "consoles" => $consoles, "jaquettes" => $jaquettes, "description" => (string) $result->description);	
			}
				
			//$reponse[] = $result->{'titre'};
		}

		echo json_encode($response);
	}
	/**/
?>
