<?php 
require_once("common.php");
class UpgradeIndividualToFamilyPlusCest
{
    public $email;
    public $password;
    public $firstName;
    public $lastName;
    public $phone;

    public function _before(AcceptanceTester $I)
    {
        //Purchase individual plus Membership
        $I->amOnPage('/');
        $I->see('BOOK YOUR TICKETS');
        $I->executeJS("window.scrollTo(0,500);");
        $I->wait(2);
        $I->click("join");
        $I->wait(2);
        $I->executeJS("window.scrollTo(0,document.body.scrollHeight);");
        $I->wait(2);
        //Select IndividualPlus plan
        $I->waitForElementVisible(CP_PLUS);
        $I->click(CP_PLUS);
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
        $I->wait(2);
   
          //Select Master Card & Make Payment
        $I->waitForElementVisible('/html/body/center/table[6]/tbody/tr[3]/td/table/tbody/tr/td[1]/a/img',15);
        $I->click('/html/body/center/table[6]/tbody/tr[3]/td/table/tbody/tr/td[1]/a/img');
          
        $I->waitForElementVisible('#CardNumber');
        $I->fillField('#CardNumber',"5123456789012346");
        $I->fillField('#CardMonth','12');
        $I->fillField('#CardYear','21');
        $I->fillField('cardsecurecode','000');
        $I->click("#Paybutton");
        $I->waitForElementVisible('//*[@id="ContainerContent"]/center/form/table/tbody/tr[13]/td/input');
        $I->click("Submit");
        $I->waitForText("Please wait while your payment is processed",15);
        $I->waitForText("Your payment has been approved.",15);


        //$I->waitForText('MEMBERSHIP PURCHASED SUCCESSFULY!');
        $I->waitForElementVisible('//h2[text()="MEMBERSHIP PURCHASED SUCCESSFULY!"]',15);
        $I->executeJS("window.scrollTo(0,700);");
        $I->wait(3);

        //Login
        
        $I->amOnPage('/');
        $I->see('BOOK YOUR TICKETS');
        $I->executeJS("window.scrollTo(0,900);");
        $I->wait(2);
        $I->fillField('username',$this->email);
        $I->fillField('password',$this->password);
        //Click Login
        $I->click('//*[@id="edit-submit"]');
        $I->wait(4);
        $I->executeJS("window.scrollTo(0,700);");
        $I->wait(2);
        $I->waitForElementVisible(LOGOUT_BUTTON,15);
        $I->wait(2);
        $I->executeJS("window.scrollTo(0,900);");
        $I->wait(2);

    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
         $I->wantTo('Test Upgrade Individual to Family Plus Membership upgrdation');
         $I->see("CULTURE PASS PLUS");
         //Click Upgrade button
         $I->click('//span[text()="Renew/Upgrade membership"]');
         $I->wait(3);
         $I->waitForElementVisible('//h2[text()="upgrade your cultural pass type"]');
         $I->executeJS("window.scrollTo(0,document.body.scrollHeight);");
         $I->wait(2);
          //Select Family Plus plan
         $I->waitForElementVisible(CP_FAMILY_UPGRADE);
         $I->click(CP_FAMILY_UPGRADE);
         //Click Next button
         $I->click('next');

         $I->wait(3);

          $I->waitForElementVisible('//h2[text()="please check your order"]',15);
          $I->see($this->email);
          $I->wait(2);
  
          //Click Next button
          $I->click('next');
          $I->wait(2);
     
          //Select Master Card & Make Payment
          $I->waitForElementVisible('/html/body/center/table[6]/tbody/tr[3]/td/table/tbody/tr/td[1]/a/img',15);
          $I->click('/html/body/center/table[6]/tbody/tr[3]/td/table/tbody/tr/td[1]/a/img');
            
          $I->waitForElementVisible('#CardNumber');
          $I->fillField('#CardNumber',"5123456789012346");
          $I->fillField('#CardMonth','12');
          $I->fillField('#CardYear','21');
          $I->fillField('cardsecurecode','000');
          $I->click("#Paybutton");
          $I->waitForElementVisible('//*[@id="ContainerContent"]/center/form/table/tbody/tr[13]/td/input');
          $I->click("Submit");
          $I->waitForText("Please wait while your payment is processed",15);
          $I->waitForText("Your payment has been approved.",15);
  
  
          //$I->waitForText('MEMBERSHIP PURCHASED SUCCESSFULY!');
          $I->waitForElementVisible('//h2[text()="MEMBERSHIP PURCHASED SUCCESSFULY!"]',15);
          $I->executeJS("window.scrollTo(0,700);");
          $I->wait(1);

           //Check the Current MemberShip
           $I->amOnPage('/');
           $I->see('BOOK YOUR TICKETS');
           $I->executeJS("window.scrollTo(0,900);");
           $I->see("CULTURE PASS FAMILY");
           $I->wait(6);

    }
}
