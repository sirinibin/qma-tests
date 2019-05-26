<?php 
require_once("common.php");
class FamilyPlusUserTicketPurchaseCest
{
    public $email;
    public $password;
    public $firstName;
    public $lastName;
    public $phone;

    public function _before(AcceptanceTester $I)
    {
         // Register a new user account with Individual membership plan
         $I->amOnPage('/');
         $I->see('BOOK YOUR TICKETS');
         $I->executeJS("window.scrollTo(0,500);");
         $I->wait(2);
         $I->click("join");
         $I->wait(2);
         $I->executeJS("window.scrollTo(0,document.body.scrollHeight);");
         $I->wait(2);
         //Select FamilyPlus plan
         $I->waitForElementVisible(CP_FAMILY);
         $I->click(CP_FAMILY);
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
         $I->wait(3);
    
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
         $I->waitForText("Please wait while your payment is processed");
         $I->waitForText("Your payment has been approved.");
 
 
         //$I->waitForText('MEMBERSHIP PURCHASED SUCCESSFULY!');
         $I->waitForElementVisible('//h2[text()="MEMBERSHIP PURCHASED SUCCESSFULY!"]');
         $I->executeJS("window.scrollTo(0,700);");
         $I->wait(3);


         //Login
        $I->amOnPage('/');
        $I->see('BOOK YOUR TICKETS');
        $I->executeJS("window.scrollTo(0,document.body.scrollHeight);");
        $I->wait(2);
        $I->fillField('username',$this->email);
        $I->fillField('password',$this->password);
        //Click Login
        $I->click('//*[@id="edit-submit"]');
        
        $I->waitForElementVisible('//a[text()="Log out"]');
        $I->waitForElementVisible('//a[text()="Edit Profile"]');
        $I->wait(2);
        $I->executeJS("window.scrollTo(0,600);");
        $I->wait(2);
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->wantTo('Test Family Plus User Ticket Purchase');
        // Land on home page and Press next button
        $I->amOnPage('/');
        $I->see('BOOK YOUR TICKETS');
        $I->executeJS("window.scrollTo(0,document.body.scrollHeight);");
        $I->wait(2);
        //Click Next button
        $I->click('next');
        $I->wait(2);

        //Select ticket types
        $I->executeJS("window.scrollTo(0,600);");
        $I->wait(2);
        $I->waitForElementVisible("/html/body/section[2]/div/div/div[1]/div[2]/h2");
        $I->see('select tickets');
        $I->wait(2);
        $I->waitForElementVisible(ADULT_TICKET);
        $I->click(ADULT_TICKET);
        $I->wait(2);
        //Click Next button
        $I->click('next');
        $I->wait(2);
        $I->executeJS("window.scrollTo(0,600);");
        $I->wait(2);
        $I->waitForElementVisible('/html/body/section[2]/div/div/div[1]/div[3]/h2');
        $I->see("enter your information to receive tickets");
        $I->wait(2);
        
        $I->fillField('#qmatkt-firstname', $this->firstName);
        $I->fillField('#qmatkt-lastname', $this->lastName);
        $I->fillField('#qmatkt-email', $this->email);
        $I->fillField('#qmatkt-phone', $this->phone);

        $I->wait(2);
        //Click Next button
        $I->click('next');
        $I->wait(2);
        $I->executeJS("window.scrollTo(0,600);");
        $I->wait(2);
        $I->see("please check your order");
        $I->wait(2);
        //Click Next button
        $I->click('next');
        $I->wait(3);
        //Select Master Card
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
        $I->executeJS("window.scrollTo(0,700);");
        $I->wait(2);
        $I->waitForElementVisible("//h2[text()='TICKET PURCHASED SUCCESFULLY!']",15);
        $I->executeJS("window.scrollTo(0,500);");
        $I->wait(3);
    }
}
