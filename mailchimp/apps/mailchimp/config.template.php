<?php
/**
 * Mailchimp is the leading email marketing platform, that lets you send out fully customized email and newsletter campaigns to your subscribers. It is an imperative tool to build and follow through on your sales funnel, and helps you create and maintain lasting relations with your site visitors and customers. - Config
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
    die('No Access');
?>
<!-- {top_menu} -->
<schlix-config:data-editor data-schlix-controller="SCHLIX.CMS.mailchimpAdminController" type="config">

    <x-ui:schlix-config-save-result />
    <x-ui:schlix-editor-form id="form-edit-config" method="post" data-config-action="save" action="<?= $this->createFriendlyAdminURL('action=saveconfig') ?>" autocomplete="off">

        <schlix-config:action-buttons />
        <x-ui:csrf />

        <x-ui:schlix-tab-container>
            <!-- tab -->
            <x-ui:schlix-tab id="tab_general" fonticon="far fa-file" label="<?= ___('General') ?>"> 
                <!--content -->

                <schlix-config:app_alias />
                <schlix-config:app_description />
                <schlix-config:checkbox config-key='bool_disable_app' label='<?= ___('Disable application') ?>' />
                <fieldset>
                    <legend><?= ___('Mailchimp Settings') ?></legend>
                <schlix-config:textbox config-key='str_mailchimp_api_key' required='required' label='<?= ___('API Key') ?>' />
                <p><a href="https://admin.mailchimp.com/account/api" target="_blank">Get your API key here</a></p>
                </fieldset>
                
                <?php if (empty($this->app->getConfig('array_mailchimp_lists'))) : ?>
                    <x-ui:link-button-warning id="btn_test_connection" label="<?= ___('Connect to Mailchimp') ?>" fonticon="fas fa-plug" />
                <?php else : ?>
                    <x-ui:link-button-ok id="btn_test_connection" label="<?= ___('Connected') ?>" fonticon="fas fa-check" />
                    <schlix-config:radiogroup config-key="str_list_id" label="<?= ___('List ID') ?>" required="required" >
                        <?php foreach ($this->app->getConfig('array_mailchimp_lists') as $list): ?>
                        <schlix-config:option value="<?= ___h($list->id) ?>"><?= ___h($list->name) ?></schlix-config:option>
                        <?php endforeach ?>
                    </schlix-config:radiogroup> 
                <?php endif ?>
            </x-ui:schlix-tab>
            <!-- tab -->
            <x-ui:schlix-tab id="tab_main_opt" fonticon="fa fa-newspaper" label="<?= ___('Default Main page Options') ?>"> 

                <x-ui:row>
                    <x-ui:column md="6">

                        <schlix-config:textbox config-key='str_mainpage_title' label='<?= ___('Main page title') ?>'   />                        
                        <schlix-config:textarea config-key='str_mainpage_text' label="<?= ___('Main page introduction text') ?>" class="wysiwyg" />
                    </x-ui:column>
                    <!-- col -->
                    <x-ui:column md="6">
                        <schlix-config:integerbox config-key='int_mainpage_items_per_page' config-default-value="10" label='<?= ___('Default maximum mumber of items to be displayed per page') ?>'   />
                        <schlix-config:main-page-meta-options config-key="array_mainpage_meta_options" item-per-column="5" column-count="1" />
                    </x-ui:column>
                </x-ui:row>
            </x-ui:schlix-tab>
            <!-- tab -->
            <x-ui:schlix-tab id="tab_category_opt" fonticon="fa fa-folder" label="<?= ___('Default Category Options') ?>"> 

                <schlix-config:integerbox config-key='int_category_items_per_page' config-default-value="10" label='<?= ___('Default maximum mumber of items to be displayed per page') ?>'   />
                <schlix-config:checkbox config-key='reset_category_items_per_page' label='<?= ___('Reset the number of items per page for all categories') ?>' />
                <schlix-config:category-meta-options config-key='array_default_category_meta_options'  item-per-column="1" column-count="3" />
                <schlix-config:checkbox config-key='reset_category_options' label='<?= ___('Reset all categories options') ?>' />
            </x-ui:schlix-tab>
            <!-- tab -->
            <x-ui:schlix-tab id="tab_item_opt" fonticon="fa fa-file-alt" label="<?= ___('Default Item Options') ?>"> 


                <schlix-config:item-meta-options config-key='array_default_item_meta_options' item-per-column="1" column-count="3" />
                <schlix-config:checkbox config-key='reset_item_options' label='<?= ___('Reset all item options') ?>' />
            </x-ui:schlix-tab>
            <!-- hooks -->
            <?= \SCHLIX\cmsHooks::output('getApplicationAdminExtraEditConfigTab', $this) ?>                       
        </x-ui:schlix-tab-container>

    </x-ui:schlix-editor-form>
</schlix-config:data-editor>     