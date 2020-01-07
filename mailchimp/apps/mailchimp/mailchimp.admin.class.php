<?php
namespace App;

/**
 * mailchimp - Admin class
 * 
 * Mailchimp is the leading email marketing platform, that lets you send out fully customized email and newsletter campaigns to your subscribers. It is an imperative tool to build and follow through on your sales funnel, and helps you create and maintain lasting relations with your site visitors and customers.
 *
 * @copyright 2019 calip
 *
 * @license MIT
 *
 * @version 1.0
 * @package mailchimp
 * @author  Alip <asalip.putra@gmail.com>
 * @link    https://github.com/calip/app_mailchimp
 */
class mailchimp_Admin extends \SCHLIX\cmsAdmin_CategorizedList {

    //_________________________________________________________________________//
    /**
     * Constructor
     * @global \SCHLIX\cmsDatabase $SystemDB
     */        
    public function __construct() {
        global $SystemDB;
        
        $datatype = 'basicnestedcategory';
        $methods = array();
        parent::__construct($datatype, $methods);
    }

    private function ajaxGetMailchimpList()
    {
        $authToken = filter_var(fpost_string('mailchimp_api',255), FILTER_SANITIZE_STRING);
        $dataCenter = substr($authToken,strpos($authToken,'-')+1);
        // Setup cURL
        $ch = curl_init('https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/');
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization: apikey '.$authToken,
                'Content-Type: application/json'
            )
        ));
        // Send the request
        $result = curl_exec($ch);    
        $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $this->app->setConfig('str_mailchimp_api_key', $authToken);
        if($response == 200){
            $data = json_decode($result);
            $this->app->setConfig('array_mailchimp_lists', $data->lists);
            return ajax_reply(200, $data);            
        }
        else {
            $this->app->setConfig('array_mailchimp_lists', array());
            return ajax_reply(404, "Mailchimp Account not found");
        }
    }
            
    //_________________________________________________________________________//
    public function Run() {
        switch (fget_alphanumeric('action')) { 
            case 'testconnection': 
                return ajax_echo($this->ajaxGetMailchimpList());
                break;
            default:return parent::Run();
        }
    }

    //_________________________________________________________________________//
    public function Uninstall() {
        return false;
    }

}
            