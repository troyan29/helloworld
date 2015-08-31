<?php


namespace Hi\core\Http;

class HttpResponse
{
    protected $response;

    private $contentType;

    private $contentTypes = array(
        'json' => 'application/json', 
        'text' => 'text/plain',
        'html' => 'text/html',
        'css' => 'text/css',
        '7zip' => 'application/x-7z-compressed',
        'pdf' => 'application/pdf');


    public function body($bodyContent)
    {
        header('Content-Type: '.$this->contentTypes[$this->contentType]);
    	
        if(is_array($bodyContent) && $this->contentType == 'json')
            $bodyContent = json_encode($bodyContent);

        echo $bodyContent; 
    }

    public function setContentType($key)
    {	
    	if(array_key_exists($key, $this->contentTypes))
    		$this->contentType = $key;
    	else
    		return false;
    }


}
