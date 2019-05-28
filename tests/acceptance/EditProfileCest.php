<?php 
require_once("common.php");
class EditProfileCest
{
    public $email;
    public $password;
    public $firstName;
    public $lastName;
    public $phone;

    public function _before(AcceptanceTester $I)
    {
        // Register a new user account
        $I->amOnPage('/');
        $I->see('BOOK YOUR TICKETS');
        $I->executeJS("window.scrollTo(0,500);");
        $I->wait(2);
        $I->click("join");
        $I->wait(2);
        $I->executeJS("window.scrollTo(0,document.body.scrollHeight);");
        $I->wait(2);
        //Select basic plan
        $I->waitForElementVisible(CP_BASIC);
        $I->click(CP_BASIC);
        //Click Next button
        $I->click('next');

        //Fill the Your account details form
        $this->email='test'.mt_rand().'@gmail.com';
        $this->password="#Infoboyz123";
        $this->firstName="test";
        $this->lastName="test";
        $this->phone=9633977699;


        $I->waitForElementVisible('#usrfrm_email');

        $I->fillField('#usrfrm_email',$this->email);
        $I->fillField('#usrfrm_pass1',$this->password);
        $I->fillField('#usrfrm_pass2',$this->password);

        $I->executeJS("window.scrollTo(0,200);");
        $I->fillField('#usrfrm_firstname',$this->firstName);
        $I->fillField('#usrfrm_lastname',$this->lastName);
        $I->fillField('#usrfrm_phone',$this->phone);

        //Click Next button
        $I->click('next');
      //  
        $I->waitForElementVisible('//h2[text()="please check your order"]');
       // $I->waitForText('please check your order');
        $I->see($this->email);
        $I->wait(2);

        //Click Next button
        $I->click('next');
        $I->wait(4);
   
        //$I->waitForText('MEMBERSHIP PURCHASED SUCCESSFULY!');
        $I->waitForElementVisible('//h2[text()="MEMBERSHIP PURCHASED SUCCESSFULY!"]');
        $I->executeJS("window.scrollTo(0,700);");
        $I->wait(2);
    
        //Login
        $I->wantTo('Test Login');
        $I->amOnPage('/');
        $I->see('BOOK YOUR TICKETS');
        $I->executeJS("window.scrollTo(0,document.body.scrollHeight);");
        $I->wait(2);
        $I->fillField('username',$this->email);
        $I->fillField('password',$this->password);
        //Click Login
        $I->click('//*[@id="edit-submit"]');
        $I->wait(4);
        $I->executeJS("window.scrollTo(0,700);");
        $I->wait(2);
        $I->waitForElementVisible(LOGOUT_BUTTON,15);   
        
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->wantTo('Test Edit Profile');
        $I->click(EDIT_PROFILE_BUTTON);
        $I->wait(4);
        $I->waitForElementVisible('//h2[text()="edit your profile"]');
        $I->executeJS("window.scrollTo(0,300);");
        $I->wait(2);
        $this->phone=9633977690;
        $this->firstName=$this->firstName."-updated";
        $this->lastName=$this->lastName."-updated";

        $I->fillField('firstname',$this->firstName);
        $I->fillField('lastname',$this->lastName);
        
        $I->fillField('phone',$this->phone);

        $I->click("SUBMIT");
        $I->wait(4);
        $I->executeJS("window.scrollTo(0,700);");
        $I->wait(2);
        $I->see('Your details has been updated');
        $I->wait(3);
    }
}
