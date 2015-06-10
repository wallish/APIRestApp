<?php

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $game = Game::getInstance()->fetchAll(1);
      
        $xml = new MyXMLParser();
        //echo $xml->generate($game);

        
        $xmlstring =  $xml->generate($game);
        $sxe = simplexml_load_string($xmlstring);
        
        echo $xmlstring;
       
        die();
        $xml = new DOMDocument();
        $xml->load($out1);
        if (!$xml->schemaValidate('XML/jeuxvideo.xsd')) {
            print '<b>DOMDocument::schemaValidate() Generated Errors!</b>';
        } else {
            echo 'ok';
        }





        /*$xml = simplexml_load_string($xmlstring);
        $json = json_encode($xml);
        
        echo $json;*/

        //$this->getView()->render('index/index', ['users' => $foo]);
    }

    public function showAction()
    {
        $user = User::getInstance()->fetchEntry(['field' => 'id', 'search' => 1]);

        $this->getView()->render('index/show', ['user' => $user[0]]);
    }
}
