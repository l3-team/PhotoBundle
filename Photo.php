<?php
namespace L3\Bundle\PhotoBundle;

class Photo extends \Twig_Extension {
	private $tokens = array();
	private $uidToQuery = array();

        private $cheminRepimage = "";
        private $cheminReptoken = "";
        
        /*public function __construct($cheminRepimage,$cheminReptoken)
        {
          $this->cheminRepimage = $cheminRepimage;
          $this->cheminReptoken = $cheminReptoken;
        }*/ 
        
        public function __construct($cheminRepimage,$cheminReptoken)
        {
          $this->cheminRepimage = $cheminRepimage;
          $this->cheminReptoken = $cheminReptoken;
        }
        
        public function getCheminRepimage()
        {
            return $this->cheminRepimage;
        }        
        
        public function getCheminReptoken()
        {
            return $this->cheminReptoken;
        }        
        
        
	public function getFunctions() {
		return array(
			new \Twig_SimpleFunction('photo', array($this, 'photo'))
		);
	}

	public function photo($uid) {
		return $this->cheminRepimage. $this->requestToken($uid);             
	}

	/**
	 * Returns the name of the extension.
	 *
	 * @return string The extension name
	 */
	public function getName() {
		return 'photo_extension';
	}

	public function preLoadToken($uid) {
		$this->uidToQuery[] = $uid;
	}

	private function loadToken() {
		if(count($this->uidToQuery) < 1) return;

		$opts = array('http' =>
			array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => json_encode($this->uidToQuery)
			)
		);

		$context  = stream_context_create($opts);

		//$result = json_decode(file_get_contents('http://apps-php-test.univ-lille3.fr/~ppelisset/Lille3Photo/web/token/add', false, $context), true);

                $result = json_decode(file_get_contents($this->cheminReptoken, false, $context), true);
                
                
		foreach($result as $uid => $token) {
			$this->tokens[$uid] = $token;
		}
		$this->uidToQuery = array();
	}

	private function requestToken($uid) {
		$this->loadToken();
		if(array_key_exists($uid, $this->tokens)) return $this->tokens[$uid];

		//$this->tokens[$uid] = file_get_contents('http://apps-php-test.univ-lille3.fr/~ppelisset/Lille3Photo/web/token/add/' . $uid);

                $this->tokens[$uid] = file_get_contents($this->cheminReptoken . "/" . $uid);
                
		return $this->tokens[$uid];
	}
}
