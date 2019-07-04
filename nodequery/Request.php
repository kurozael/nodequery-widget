<?php
namespace NodeQuery;

class Request
{
    static public function get($url)
	{
        $curl = curl_init();
		
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL,$url);
		
        $result = curl_exec($curl);
		
        curl_close($curl);
		
        return $result;
    }
}
?>