<?php
/**
 * mailchimp - Main page view template. Lists both categories and items with parent_id = 0 and category_id = 0 
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
<div class="panel panel-primary" id="<?= ___h($this->block_name) ?>">
    <div class="panel-heading">
        <h2><?= $example_1 ? ___h($example_1) : ___('Untitled').' '.___h($this->block_name) ?></h2>
    </div>
    <div class="panel-body">
<?= $example_2 ? ___h($example_2) : ___('Unconfigured option') ?>
    </div>
</div>