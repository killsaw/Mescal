<?php

class Analytics
{
	public $ua;
	public $ip;
	public $sid;
	public $referer;
	public $page;
	
	public function __construct()
	{
		$this->ua = $_SERVER['HTTP_USER_AGENT'];
		$this->ip = $_SERVER['REMOTE_ADDR'];
		$this->sid = session_id();
		$this->referer = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:NULL;
		$this->page = $_SERVER['REQUEST_URI'];
			
	}
	
	public function logAccess()
	{
		return dibi::insert('analytics', array(
					'ua' => $this->ua,
					'ip' => $this->ip,
					'sid' => $this->sid,
					'referer' => $this->referer,
					'page' => $this->page
				))->execute();
	}
}
