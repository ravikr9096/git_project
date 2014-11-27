<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Emailconfig {
    public function getMailSetting() {
       //SET SMTP Configuartion
		$email_setting['smtp_hostdebug'] = 'mail.yourdomain.com';
		$email_setting['smtp_debug'] = 2;
		$email_setting['smtp_auth'] = true;
		$email_setting['smtp_secure'] = 'ssl';
		$email_setting['smtp_host'] = 'smtp.gmail.com';
		$email_setting['smtp_port'] = 465;
		$email_setting['smtp_user'] = 'gfndselva002@gmail.com';
		$email_setting['smtp_pass'] = 'Gfndselvanew2';	
		$email_setting['set_fromEmail'] = 'gfndselva002@gmail.com';	
		$email_setting['set_fromAddress'] = 'Hindigaurav';
		$email_setting['set_replyEmail'] = 'gfndselva002@gmail.com';
		$email_setting['set_replyAddress'] = 'Hindigaurav';		
		return $email_setting;

    }
}
