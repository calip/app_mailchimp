<?php
/**
 * mailchimp - Main admin view template
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
if (!defined('SCHLIX_VERSION')) die();
?>
<!-- {top_menu} -->
<x-ui:schlix-data-explorer-blank data-schlix-controller="SCHLIX.CMS.mailchimpAdminController" data-default-item-icon="fa fa-file fa-2x">
    <!-- Toolbar -->
    <x-ui:schlix-explorer-toolbar>
        <x-ui:schlix-explorer-toolbar-menu data-position="left">    
            <x-ui:schlix-explorer-menu-command data-schlix-command="config" data-schlix-app-action="editconfig" fonticon="fas fa-cog" label="<?= ___('Configuration') ?>" />
            <?php /* optional 
            <x-ui:schlix-explorer-menu-folder fonticon="fa fa-gears" label="<?= ___('Configuration') ?>">
                <x-ui:schlix-explorer-menu-command data-schlix-command="config" data-schlix-app-action="editconfig"  fonticon="fas fa-cog" label="<?= ___('Default Settings') ?>" />
                <x-ui:schlix-explorer-menu-command data-schlix-command="custom-table-config" data-custom-table="app_mailchimp_items" fonticon="fas fa-terminal" label="<?= ___('Custom table fields: Item') ?>" />
                <x-ui:schlix-explorer-menu-command data-schlix-command="custom-table-config" data-custom-table="app_mailchimp_categories"  fonticon="fas fa-terminal" label="<?= ___('Custom table fields: Category') ?>" />
            </x-ui:schlix-explorer-menu-folder> */ ?>
            <!-- {end config -->
            <?= \SCHLIX\cmsHooks::output('getApplicationAdminExtraToolbarMenuItem', $this) ?>
        </x-ui:schlix-explorer-toolbar-menu>
        <x-ui:schlix-explorer-toolbar-search />
        <!-- {help-about} -->
        <x-ui:schlix-explorer-toolbar-menu data-position="right">
            <x-ui:schlix-explorer-menu-folder fonticon="fa fa-question-circle" label="<?= ___('Help') ?>">
                <x-ui:schlix-explorer-menu-command data-schlix-command="help-about" data-schlix-app-action="help-about" fonticon="fas fas-cog" label="<?= ___('About') ?>" />
            </x-ui:schlix-explorer-menu-folder>
        </x-ui:schlix-explorer-toolbar-menu>
        <!-- {end help-about} -->

    </x-ui:schlix-explorer-toolbar>
    <div class="content"><?= ___('Enter your API key to connect to your Mailchimp account: <a href="https://admin.mailchimp.com/account/api" target="_blank">Read Mailchimp API Documentation</a>.') ?></div>
</x-ui:schlix-data-explorer-blank>