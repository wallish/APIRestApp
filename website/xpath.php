<?php
	require 'CURL/Curl.php';

	if(isset($_POST["path"])) {
		$path = "";
		if($_POST["path"] != "all") {
			$path = $_POST["path"];
		}
		$curl = new Curl("foobar","bar","foo");
		
		//$xml_content = file_get_contents($curl->get());

		//$xml_content = file_get_contents("jeuvideos.xml");

		//echo print_r($curl->get(),true);
		
		$xml = new SimpleXMLElement($curl->get());
		//echo print_r($xml, true);	
		//$results = $xml->xpath($path);


		//echo print_r($results,true);
	}
	/*foreach ($results as $result) {
		echo "Résultat trouvé : {$result}<br>";
	}*/
?>
