<?php
CakePlugin::load('Uploader');
App::uses('CakeEmail', 'Network/Email');

App::uses('Folder', 'Utility');
App::import('Vendor', 'Uploader.Uploader');
	class User extends  AppModel{
	public $name = 'User';
	public $hasMany  =  array('Property');
	public $actsAs = array( 
	"Uploader.Attachment" => array(
		'profile_picture' => array(
			'baseDir'	=> '',			// See UploaderComponent::$baseDir
			'uploadDir'	=> 'profile_pictures/' ,		// See UploaderComponent::$uploadDir
			'dbColumn'	=> 'profile_picture',	// The database column name to save the path to
			'importFrom'	=> '',			// Path or URL to import file
			'defaultPath'	=> '',			// Default file path if no upload present
			'maxNameLength'	=> 30,			// Max file name length
			'overwrite'	=> true,		// Overwrite file with same name if it exists
			'stopSave'	=> true,		// Stop the model save() if upload fails
			'allowEmpty'	=> true,		// Allow an empty file upload to continue
			'transforms'	=> array()		// What transformations to do on images: scale, resize, etc
		)
	),

);

	public $validate = array(
		'username'=>array(
				'username_must_be_email'=>array(
					'rule'=>'email',
					'message'=>'Please enter a valid email address'
				),
				'username_must_be_unique'=>array(
					'rule'=>'isUnique',
					'message'=>'This email already exists'
				),
				'username_must_not_be_blank'=>array(
					'rule'=>'notEmpty',
					'message'=>'Email address cannot be blank'
				),
				'username_must_match' => array(
					'rule' =>'emailMustMatch',
					'message'=>'Your email address do not match'
				)
		
			),

		'password' => array(
			'password_must_not_be_empty' =>array(
				'rule' => 'notEmpty',
				'message' => 'Please enter a password'
			),
			'password_must_match' =>array(
				'rule' => 'mustMatch',
				'message' => 'Passwords do not Match'
			)
		),
		'first_name' => array(
			'firstname_cannotbe_blank' =>array(
				'rule' =>'notEmpty',
				'message'  =>'Ooops! I think you forgot your first name'
			)
		
		),
		'last_name' => array(
			'lastname_cannotbe_blank' =>array(
				'rule' => 'notEmpty',
				'message' => 'Ooops! I think you forgot your last name'
			)
		),
		'phone' => array(
			'phone_mus_be_valid' =>array(
				'rule' => array('phone', null, 'us'),
				'message' => 'Please provide a valid contact number in case of an emergency'
			)
		
		),
		'address' => array(
			'address_not_empty' =>array(
				'rule' => 'notEmpty',
				'message' => 'Please provide and address in case we need to contact you'
			)
		
		),
		'city' => array(
			'city_not_empty' =>array(
				'rule' => 'notEmpty',
				'message' => 'Please provide your current city'
			)
		
		),
		'state' => array(
			'state_not_empty' =>array(
				'rule' => 'notEmpty',
				'message' => 'Please provide your state'
			)
		
		),
		'zip' => array(
			'state_not_empty' =>array(
				'rule' => array('postal', null, 'us'),
				'message' => 'Please enter a valid US zipcode'
			)
		
		),
		'country' => array(
			'country_not_empty' =>array(
				'rule' => 'notEmpty',
				'message' => 'Please provide your country'
			)
		
		),
		'TermsofService'=>array(
			'must_be_true' =>array(
				'rule'=>'mustBeTrue',
				'message' => 'Please agree to the Terms of Service'
			)
		)
	);
	
	public function mustMatch($data){
		if($this->data['User']['password'] == $this->data['User']['password_confirmation']  ){
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
			return true;
		}
		else{
			return false;
		}
	}
	public function mustBeTrue($data){
		if($this->data['User']['TermsofService'] == true){
			return true;
		}
		else{
			return false;
		}
	
	}
	public function emailMustMatch($data){
		if($this->data['User']['username'] == $this->data['User']['confirm_username']  ){
			return true;
		}
		else{
			return false;
		}
	}
	public function hashPassword(){
		return  AuthComponent::password($this->data['User']['password']);
	}
	public function afterSave($created){
		if($created){
			$email = new CakeEmail('smtp');
			$email->viewVars(array('first' =>$this->data['User']['first_name'],'last'=>$this->data['User']['last_name'],'messagetitle'=>'Dear Guest and Customer','action'=>'http://reservationresources.com/users'));
			$email->template('welcome', 'email_layout')->emailFormat('html');
			$email->sender('noreply@reservationresources.com')->to($this->data['User']['username'])->subject('Welcome to Reservation Resources')->send(); 
		
		}
		
	
	}
	//we will set up user directory if successfully saved
	public function createUserDirectory($id){
		$dir = new Folder();//default constructor sets up a path to directory instance NOT create!
		$dir->create(WWW_ROOT.'images'.DS.$id);
	}
	public function passwordReset($username,$first,$password){
			$email = new CakeEmail('smtp');
			$email->viewVars(array('first'=>$first,'password'=>$password,'messagetitle'=>'Your new password','action'=>'http://reservationresources.com/users'));
			$email->template('password_reset', 'email_layout')->emailFormat('html');
			$email->sender('noreply@reservationresources.com')->to($username)->subject('Password Reset')->send(); 
	}
	

}
?>