<?php
/**
 * mailchimp - Main page view template. Only lists categories 
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
if (!defined('SCHLIX_VERSION'))
    die();


$str_mainpage_title =  $this->getConfig('str_mainpage_title') ? $this->getConfig('str_mainpage_title') : $this->getApplicationDescription();
$str_mainpage_text =  $this->getConfig('str_mainpage_text');
 // OPTIONAL - feel free to uncomment
 // $this->processDataOutputWithMacro($str_mainpage_text, 'viewMainPage');
?>
<div class="app-page-main app-<?= $this->app_name; ?>" id="app-<?= $this->app_name; ?>-main">
    <h1 class="main title"><?= ___h($str_mainpage_title); ?></h1>

    <?php if ($mailchimp_api_key && $mailchimp_list_id): ?>
    <!-- ########################################################################### -->
    <!-- #######################  categories / subfolder ########################### -->
    <!-- ########################################################################### -->
    <div id="s_c_h_l_i_x_mailchimp">
        <div id="s_c_h_l_i_x_mailchimp_result" ></div>
        <div id="s_c_h_l_i_x_mailchimp_inner">
            <x-ui:row>
                <x-ui:column sm="12">

                    <x-ui:well size="sm">
                        <x-ui:row>
                            <x-ui:column sm="6">
                                
                                <x-ui:textbox id="mailchimp-email" name="email" fonticon="fa fa-envelope" placeholder="<?= ___('E-mail') ?>" required="required" label="<?= ___('E-mail') ?>" value="<?= ___h($preset_email) ?>" />                            
                                <x-ui:textbox id="mailchimp-firstname" name="firstname" fonticon="fa fa-user" placeholder="<?= ___('Firstname') ?>" label="<?= ___('Firstname') ?>" value="<?= ___h($preset_firstname) ?>" />
                                <x-ui:textbox id="mailchimp-lastname" name="lastname" fonticon="fa fa-user" placeholder="<?= ___('Lastname') ?>" label="<?= ___('Lastname') ?>" value="<?= ___h($preset_lastname) ?>" />
                                <x-ui:textbox id="mailchimp-phone" name="phone" fonticon="fa fa-phone" placeholder="<?= ___('Phone') ?>" label="<?= ___('Phone') ?>" value="<?= ___h($preset_phone) ?>" />
                                <x-ui:row>
                                    <x-ui:column sm="12" class="text-right">
                                        <x-ui:button-primary type="submit" name="subscribe" id="mailchimp-submit-button" value="Submit" label="<?= ___('Subscribe') ?>" fonticon="fa fa-paper-plane" />
                                    </x-ui:column>
                                </x-ui:row>
                            </x-ui:column>

                            <x-ui:column sm="6">
                                
                                
                                <?php if ($pg < 2) : ?>
                                    <?= $str_mainpage_text ?>
                                <?php endif ?>
                                
                            </x-ui:column>
                        </x-ui:row>
                        
                    </x-ui:well>
                </x-ui:column>
            </x-ui:row>
        </div>
    </div>
    <!-- ########################################################################### -->
    <!-- ######################## end categories / subfolder ####################### -->
    <!-- ########################################################################### -->
    <?php else: ?>
        <!-- NOTE - Mailchimp API Key was not set up correctly - please add a Mailchimp API Key -->
        <script>console.error("Mailchimp API Key has not been set from configuration");</script>
    <?php endif ?>    
</div>
 