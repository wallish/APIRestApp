<?php


class Acl
{
	private static $ressource = [
    						'1' => ['get','post','put','delete'],
    						'2' => ['get'],
    					];


    public static function checkAcl($userid = null, $request = null)
    {
    	$user = User::getInstance()->fetchEntry(array('field' => 'id', 'search' => $userid));
    	return in_array(strtolower($request), self::$ressource[$user[0]['role_id']]);
    }

}