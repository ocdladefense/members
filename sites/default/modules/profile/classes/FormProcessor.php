<?php
class FormProcessor
{
  // class to
  //global $UserID;
  private $form_id_prefix = "ocdla_";
	
	
	protected $form_id;
	
	
	protected $user_id;
	
	
	protected $user_message;
	
	/**
	 * Http Request
	 *
	 * The Http Request associated with this form submission.
	 */
	protected $request;
	
	protected $sess;

	public function __construct($params)
	{
		global $request, $sess, $user;
		$this->request 	= $request;
		$this->user			= $user;
		$this->session 	= $sess;
		$this->form_id 	= $_POST["{$this->form_id_prefix}id"];
		$this->user_id 	= $params["user_id"];
	}
	
	private function getId() {
		return $this->form_id;
	}
	
	protected function getUserId() {
		return $this->user_id;
	}
	
	public function exec() {	
		$this->id();		//triggers an error because id is undefined
	}
	
	
	public function __toString() {
		$str = "";
		foreach( $_POST AS $key=>$value ) {
			$str .= "<p>$key: $value</p>";
		}
		return $str;
	}

	protected function setStatus( $message ) {
		$this->user_message .= "<p class=\"status\">{$message}</p>";
	}
	
	public function getStatus() {
		return $this->user_message;
	}

}