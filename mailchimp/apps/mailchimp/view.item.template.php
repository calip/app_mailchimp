<?php
/**
 * mailchimp - View Item template
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
    die('No Access');
?>
<div class="app-page-item app-<?= $this->app_name; ?>" >
    <?= $item['macro_processed_text_outside_article_top'] ?>
    <article class="item" id="app-<?= $this->app_name; ?>-item-<?= $item[$this->field_id]; ?>">
        <!-- Page Title -->
        <?php if ($item_meta_options['display_pagetitle']): ?>
            <h1 class="item title" itemprop="headline"><?= ___h($item['title']); ?></h1>
        <?php endif; ?>
        <!-- End Page Title -->

        <!-- Macro - Pre -->
        <?php if ($item['macro_processed_text_before_article']): ?>        
            <div class="meta before-article">        
            <?= $item['macro_processed_text_before_article'] ?>            
            </div>
        <?php endif ?>
        <!-- End Macro - Pre -->
        <!-- content -->
        <div class="text" itemprop="articleSection">
            <?= $item['summary'] ?>
            <?= $item['description'] ?>
        </div>
        <!-- end content -->
        <?php if ($item['macro_processed_text_after_article']): ?>
            <div class="meta after-article">
                <?= $item['macro_processed_text_after_article'] ?>
            </div>
        <?php endif ?>
    </article>
    <?= $item['macro_processed_text_outside_article_bottom'] ?>
</div>