<?php
namespace Bcash\Http;

class PostRequest{
		
	private $url;
	private $headers;	
	private $content;
	
	public function __construct($url) 
	{
		$this->headers = Array();
		$this->url = $url;
	}
	
	public function getUrl()
	{
		return $this->url;
	}
	
	public function addHeader($header) 
	{
		array_push($this->headers, $header);
	}

	public function getHeaders() 
	{
		return $this->headers;
	}

	public function setContent($content)
	{
		$this->content = $content;
	}
		
	public function getContent()
	{
		return $this->content;
	}
}