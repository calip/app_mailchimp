<?php
/**
 * mailchimp - Edit Category Template (Admin)
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
if (!defined('SCHLIX_VERSION')) die('No Access');
?>
<?php

global $CurrentUser;

if ($id == 'new') {
    $category['permission_read'] = serialize('everyone');
    $category['items_per_page'] = 10;
}
else {
    $id = (int) $id;
    $preview_link = $this->app->createFriendlyURL("action=viewcategory&cid={$id}");
}
?>
<!-- {top_menu} -->
<x-ui:schlix-category-editor  data-type-desc="<?= ___('category') ?>" data-schlix-controller="SCHLIX.CMS.mailchimpAdminController" >    
        
        <x-ui:schlix-editor-form id="form-edit-category" method="post" admin-action="savecategory">
            
            <x-ui:csrf id="_csrftoken" />
            
            <x-ui:hidden id="cid" name="cid" data-field="cid" />
            <x-ui:hidden id="parent_id" data-field="parent_id" name="parent_id" />
            <x-ui:hidden id="guid" data-field="guid" name="guid" />
            <x-ui:schlix-editor-top-row>    
                <x-ui:schlix-editor-top-left>
                    <!-- Page Title -->
                    <x-ui:schlix-document-title id="title" maxlength="190"  required="required"  data-field="title" label="<?= ___('Category Title') ?>" table-type="category" />
                    <!-- Virtual Filename -->
                    <x-ui:schlix-document-virtual-filename id="virtual_filename" data-field="virtual_filename" />
                    
                </x-ui:schlix-editor-top-left>
                <x-ui:schlix-editor-top-right>
                    <x-ui:schlix-editor-action-buttons />
                </x-ui:schlix-editor-top-right>            
            </x-ui:schlix-editor-top-row>

            <!-- main -->
            <x-ui:clearboth />
            
            <x-ui:schlix-document-save-result />
            <!-- end main section -->
            <!-- begin tabs -->
            <x-ui:schlix-tab-container>
                <!-- tab -->
                <x-ui:schlix-tab id="tab_content" fonticon="far fa-file-alt" label="<?= ___('Content') ?>"> 
                    <x-ui:wysiwyg id="summary" name="summary" data-field="summary" label="<?= ___('Summary') ?>" />
                    <x-ui:clearboth />
                    <x-ui:wysiwyg id="description" name="description" data-field="description" label="<?= ___('Description') ?>" />
                </x-ui:schlix-tab>
                <!-- tab -->
                <x-ui:schlix-tab id="tab_meta" fonticon="fa fa-hashtag" label="<?= ___('Meta') ?>">    
                    <x-ui:textbox id="meta_description" name="meta_description"  data-field="meta_description" label="<?= ___('Meta Description') ?>" />
                    <x-ui:tagbox id="meta_key" name="meta_key" data-field="meta_key" label="<?= ___('Meta Keywords') ?>" />
                    <x-ui:tagbox id="tags" name="tags" data-field="tags" label="<?= ___('Tags') ?>" />
                </x-ui:schlix-tab>
                <!-- tab -->
                <x-ui:schlix-tab id="tab_dates" fonticon="far fa-calendar" label="<?= ___('Dates') ?>"> 
                    
                    <x-ui:schlix-datetime-picker id="date_created" data-field="date_created" label="<?= ___('Created') ?>" />
                    <x-ui:schlix-datetime-picker id="date_modified" data-field="date_modified" label="<?= ___('Modified') ?>" />
                    <x-ui:schlix-datetime-picker id="date_available" name="date_available" data-field="date_available" label="<?= ___('Available on') ?>" />
                    <x-ui:schlix-datetime-picker id="date_expiry" name="date_expiry" data-field="date_expiry" label="<?= ___('Expiry') ?>" />
                    
                </x-ui:schlix-tab>
                <!-- tab -->
                <x-ui:schlix-tab id="tab_options" fonticon="fa fa-sliders-h" label="<?= ___('Options') ?>">
                    <x-ui:textbox type="number" min="1" max="10000" size="5"  id="items_per_page" name="items_per_page"  data-field="items_per_page" label="<?= ___('Maximum mumber of items to be displayed per page') ?>" class="schlix-input-auto-width"/>
                        
                    
                    <x-ui:schlix-editor-category-meta-options name="options" data-field="options" max-item-per-column="1" column="3" />
                </x-ui:schlix-tab>
                <!-- tab -->
                <?= \SCHLIX\cmsHooks::output('getApplicationAdminExtraEditCategoryTab', $this, $category) ?>
            </x-ui:schlix-tab-container>            
            <!-- end tabs -->
        </x-ui:schlix-editor-form>
</x-ui:schlix-category-editor >