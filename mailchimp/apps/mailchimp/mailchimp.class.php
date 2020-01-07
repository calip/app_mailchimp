<?php
namespace App;
/**
 * mailchimp - Main Class
 * 
 * Mailchimp is the leading email marketing platform, that lets you send out fully customized email and newsletter campaigns to your subscribers. It is an imperative tool to build and follow through on your sales funnel, and helps you create and maintain lasting relations with your site visitors and customers.
 * 
 * @copyright 2019 calip
 *
 * @license MIT
 *
 * @package mailchimp
 * @version 1.0
 * @author  Alip <asalip.putra@gmail.com>
 * @link    https://github.com/calip/app_mailchimp
 */
class mailchimp extends \SCHLIX\cmsApplication_CategorizedList {

    public function __construct() {
        parent::__construct('mailchimp', 'app_mailchimp_items', 'app_mailchimp_categories');
        $this->schema_org_type_item = '';
        
        /* You can modify this  */
        $this->has_versioning = true; // set to false if you don't need versioning capability if this app wants versioning enabled
        $this->disable_frontend_runtime = false; //  set this to true if this is a backend only app         
        
    }

    /**
     * View Main Page
     * @param int $pg
     */
    public function viewMainPage($pg = 1)
    {
        global $HTMLHeader;
        global $__mailchimp_loaded;
        
        $HTMLHeader->Javascript_SCHLIX_UI();
        $HTMLHeader->Javascript('/system/js/schlix-cms/initjs.php');

        $HTMLHeader->CSS($this->getURLofScript('mailchimp.css'));
        $HTMLHeader->Javascript($this->getURLofScript('mailchimp.js'));

        
        // Set Page Title
        $str_page_title = $this->getConfig('str_mainpage_title', true);
        $pg = intval($pg);
        if ($pg > 1)
            $str_page_title.=' - '.___('Page').' '.$pg;
        $this->setPageTitle($str_page_title);
        // Set Max Posts per page
        $max_posts_perpage = $this->getConfig('int_mainpage_max_items_per_page', 10);
        if ($max_posts_perpage == 0)
            $max_posts_perpage = 10;
        // Set total item count
        // category_id = 1 is Approved guestbook comments
        $total_item_count = $this->getTotalItemCount('status > 0 AND category_id = 1');
        if ($max_posts_perpage * $pg > $total_item_count + $max_posts_perpage) {
            display_http_error(404);
            return false;
        }
        // Set Pagination
        $pagination = $this->getStartAndEndForItemPagination($pg, $max_posts_perpage, $total_item_count);
        $sort_by = $this->getConfig('str_mainpage_item_sortby', 'date_created');
        $sort_dir = $this->getConfig('str_mainpage_item_sortdirection', 'DESC');
        // Get Items to display
        $items = $this->getAllItems('*', 'status > 0 AND category_id = 1', $pagination['start'], $pagination['end'], $sort_by, $sort_dir);
        $this->declarePageLastModified($this->getMaxDateFromArray($items));
        // Get main page meta options
        $main_meta_options = convert_array_values_to_keys($this->getConfig('array_mainpage_meta_options'));        
        
        if (!$__mailchimp_loaded)
        {
            $mailchimp_title = $this->getConfig('str_mailchimp_title');
            $mailchimp_api_key = $this->getConfig('str_mailchimp_api_key', true);
            $mailchimp_list_id = $this->getConfig('str_list_id', true);

            $__mailchimp_loaded = true;
            $local_variables = compact(array_keys(get_defined_vars()));
            $this->loadTemplateFile('view.main', $local_variables);
        }
    } 

    /**
     * Creates a friendly URL
     * @param string $str
     * @return string
     */
    public function createFriendlyURL($str) {

        if (SCHLIX_SEF_ENABLED) {
            $command_array = array();
            parse_str($str, $command_array);
            if (array_key_exists('action', $command_array) && $command_array['action'] == 'main') {
                if ($command_array['pg'])
                    $final_url.="/pg{$command_array['pg']}.html";
                else
                    $final_url.='/';
            } else
                return parent::createFriendlyURL($str);
            $final_url = SCHLIX_SITE_HTTPBASE . '/' . $this->app_name . $final_url;
        } else
            return parent::createFriendlyURL($str);
        return remove_multiple_slashes($final_url);
    }

    /**
     * Interprets command from SEO-friendly URL
     * @param string $urlpath
     * @return array
     */
    public function interpretFriendlyURL($urlpath) {
        if (SCHLIX_SEF_ENABLED && !fget_string('app')) {
            $parsedurl = $this->probeFriendlyURLDestination($urlpath);
            $url = $parsedurl['url'];
            $url_array = $parsedurl['url_array'];
            if ($url_array[0] == 'rss')
                $command['action'] = 'rss';
            else
            if ($c = preg_match_all("/(pg)(\d+).*?(html)/is", $url_array[0], $x)) {
                $command = array();
                $folder_requestpage = $x[2][0];
                $command['pg'] = $folder_requestpage;
                $command['action'] = 'main';
            } else
                return parent::interpretFriendlyURL($urlpath);
        } else {
            return parent::interpretFriendlyURL($urlpath);
        }
        return $command;
    }

    /**
     * Returns the default category ID 
     * @global \SCHLIX\cmsDatabase $SystemDB
     * @return int
     */
    public function getDefaultCategoryID() {
        global $SystemDB;
                
        return 1;
    }  

    //_______________________________________________________________________________________________________________//
    /**
     * Returns an array containing on array of main page options. 
     * The values of the options will still be evaluated as a flat list array, 
     * however it is sectioned into array with the following keys:
     * header, value, type, and options.
     * - Label: section title (not used for any evaluation
     * - Type: checkboxgroup, dropdownlist, or none. If none, then it means there 
     *         are suboptions which contain another array of this
     * - Key: the key option. Please note that checkboxgroup doesn't have a key
     *        since the keys are in the options
     * - Options: an array with 2 keys: label and key
     * 
     * @return array
     */    
    
    public function getMainpageMetaOptionKeys() {
        return parent::getMainpageMetaOptionKeys();
    }
    //_______________________________________________________________________________________________________________//
    /**
     * Returns an array containing on array of main page options. In this base
     * class, the key is almost similar to getCategoryMetaOptionKeys
     * The values of the options will still be evaluated as a flat list array, 
     * however it is sectioned into array with the following keys:
     * header, value, type, and options.
     * - Label: section title (not used for any evaluation
     * - Type: checkboxgroup, dropdownlist, or none. If none, then it means there 
     *         are suboptions which contain another array of this
     * - Key: the key option. Please note that checkboxgroup doesn't have a key
     *        since the keys are in the options
     * - Options: an array with 2 keys: label and key
     * 
     * @return array
     */        
    public function getCategoryMetaOptionKeys() {
        return parent::getCategoryMetaOptionKeys();
    }
    
    //_______________________________________________________________________________________________________________//
    /**
     * Returns an array containing on array of item options.
     * The values of the options will still be evaluated as a flat list array, 
     * however it is sectioned into array with the following keys:
     * header, value, type, and options.
     * - Label: section title (not used for any evaluation
     * - Type: checkboxgroup, dropdownlist, or none. If none, then it means there 
     *         are suboptions which contain another array of this
     * - Key: the key option. Please note that checkboxgroup doesn't have a key
     *        since the keys are in the options
     * - Options: an array with 2 keys: label and key
     * 
     * @return array
     */
    public function getItemMetaOptionKeys() {
        return parent::getItemMetaOptionKeys();
    }

    /**
     * Returns true if email is valid - no DNS check
     * @param type $email
     * @return boolean
     */
    private function verifyEmailAddress($email) {

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) 
            return false;
        list($name, $domain) = explode('@', $email);
        if (strpos($domain,'.') !== FALSE)
        {
            $arr = dns_get_record($domain, DNS_MX);
            return count($arr) > 0;
        } else return false;
    }

    /**
     * Validate post submission
     * @global \App\Users $CurrentUser
     * @param string $input_name
     * @param string $input_email
     * @param string $input_website
     * @param string $input_comment
     * @return array
     */
    protected function validatePostSubmission($input_firstname, $input_lastname, $input_email, $input_phone)
    {   
        $error_list = array();
        
        if (!is_valid_csrf()) 
        {
            $error_list[] = ___('Invalid CSRF Verification');
            return $error_list;
        }
        
        if (!$this->verifyEmailAddress($input_email))
        {
            $error_list[] = ___('Invalid email address');
            return $error_list;
        }
        
        // $flood_control = $this->getLastCommentCountByIPWithinLimit(get_user_real_ip_address());
        // if ($flood_control > 0)
        //     $error_list[] = ___("You have posted more comments than allowed in this period. Please wait for a few moments and then try again");
        return $error_list;
    }

    /**
     * Process the AJAX message submission
     * @deprecated since version 2.2.0
     * @return array
     */
    public function ajaxSubmitContacts()
    {
        if (is_ajax_request()) {
            
            global $CurrentUser, $SystemMail;
            
            $input_firstname = fpost_string('firstname', 255);
            $input_lastname = fpost_string('lastname', 255);
            $input_email = fpost_string('email', 255);
            $input_phone = fpost_string('phone', 255);

            $error_list = $this->validatePostSubmission($input_firstname, $input_lastname, $input_email, $input_phone);
            
            if (empty($error_list)) {
                $list_id = $this->getConfig('str_list_id');
                $authToken = $this->getConfig('str_mailchimp_api_key');
                $dataCenter = substr($authToken,strpos($authToken,'-')+1);
                // The data to send to the API

                $postData = array(
                    "email_address" => $input_email, 
                    "status" => "subscribed", 
                    "merge_fields" => array(
                    "FNAME"=> $input_firstname,
                    "LNAME"=> $input_lastname,
                    "PHONE"=> $input_phone)
                );

                // Setup cURL
                $ch = curl_init('https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/'.$list_id.'/members/');
                curl_setopt_array($ch, array(
                    CURLOPT_POST => TRUE,
                    CURLOPT_RETURNTRANSFER => TRUE,
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: apikey '.$authToken,
                        'Content-Type: application/json'
                    ),
                    CURLOPT_POSTFIELDS => json_encode($postData)
                ));
                // Send the request
                $result = curl_exec($ch);
                $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if($response == 200){
                    $data = json_decode($result);
                    return ajax_reply(200, $data);            
                } 
                else {
                    return ajax_reply(300, "whoops! it looks like something went wrong, Please try again");
                }
            } else
            {
                return ajax_reply(300, $error_list);
            }
            
        } else
            echo "Only Ajax Request is accepted";
    }

    /**
     * Run command passed by the main router
     * @param array $command
     * @return bool
     */
    public function Run($command) {
        
        switch ($command['action']) {
            case 'viewitem':
                $this->viewItemByID($command['id'], $this->cache);
                break;
            case 'viewcategory': $this->viewCategoryByID($command['cid'], $command['pg'], 'date_created', 'DESC', $this->cache);
                break;
            case 'postentry':
                return ajax_echo($this->ajaxSubmitContacts());
                break;
            case 'main': $this->viewMainPage($command['pg']);
                break;

            default: return parent::Run($command);
        }

        return RETURN_FULLPAGE;
    }
}
            