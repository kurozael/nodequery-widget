<?php
namespace NodeQuery;

class Client
{
    private $key;
    private $serverListUrl = "https://nodequery.com/api/servers?api_key=";

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function account()
	{
        $url = "https://nodequery.com/api/account?api_key=" . $this->key;
		
        return json_decode(Request::get($url), true);
    }

    public function servers()
    {
        $url = $this->serverListUrl . $this->key;
		
        return json_decode(Request::get($url), true);
    }

    public function server($id)
	{
        $server = new Server($this->key, $id);
		
        return $server;
    }

    public function load($id, $interval)
	{
    	$load = new Load($this->key, $id, $interval);
		
    	return $load;
    }
}
?>