<?php

class CacheFile {
	protected $date;
	protected $data;
	protected $filename;

	public function __construct( $f/*file*/ ) {
		$this->date = time();
		$this->filename = $f;
		print $f;
	}
	public function load( /*string*/$str){
		$this->data = $str;
		return $this;
	}
	
	public function saveFile( $appendDateTime = true) {/* return FALSE on error */
		$this->data = $appendDateTime ? $this->data = '<!-- Cache file generated on ' .date( 'D, d M Y H:i:s' ) . '-->' .$this->data : $this->data;
		$h = fopen( $this->filename, 'w');// or die('Could not open Cache file for writing.');
		$len = fwrite($h,$this->data);// or die('No data written to Cache file.');
		fclose( $h );
		return $this;
	}

}


class TwitterCacheFile extends CacheFile {
	
	public function __construct( $f/*file*/ ) {
		parent::__construct( $f );
	}
	
	public function saveFile( $appendDateTime = true) {/* return FALSE on error */
		$this->data = $appendDateTime ? $this->data = '<!-- Queried using Twitter 1.1 API on ' .date( 'D, d M Y H:i:s' ) . '-->' .$this->data : $this->data;
		$h = fopen( $this->filename, 'w');// or die('Could not open Twitter Cache file.');
		$len = fwrite($h,$this->data);// or die('no data written');
		fclose( $h );
		return $this;
	}
}