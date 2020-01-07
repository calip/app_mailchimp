<?php
/**
 * mailchimp - Category view template
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
<?php 
    $field_cid = $this->getFieldCategoryID();
    $field_id = $this->getFieldID();
    $current_category_id = $category[$field_cid];        
?>
<div class="app-page-category app-<?= $this->app_name; ?>" id="app-<?= $this->app_name; ?>-category-<?= $category[$field_cid]; ?>" >   
    <?= $category['macro_processed_text_outside_article_top'] ?>    
    <!-- ########################################################################### -->
    <!-- ####################### main info of this category  ####################### -->
    <!-- ########################################################################### -->
    <article class="main category">
	<?php if ($category_meta_options['display_pagetitle']): ?>
            <h1 class="category title"><?= ___h($category['title']); ?></h1>
        <?php endif; ?>
        <?php if ($category['macro_processed_text_before_article']): ?>        
        <!-- Macro - Pre -->            
            <div class="meta before-article">        
            <?= $category['macro_processed_text_before_article'] ?>            
            </div>
        <!-- End Macro - Pre -->        
        <?php endif ?>
        <div class="text">
            <?= $category['summary'].$category['description'] ?>
        </div>
        <?php if ($category['macro_processed_text_after_article']): ?>
        <!-- Macro - Post -->                
            <div class="meta after-article">
                <?= $category['macro_processed_text_after_article'] ?>
            </div>
        <?php endif ?>
        <!-- End Macro - Post -->                
    </article>
    <!-- ########################################################################### -->
    <!-- ######################## end info of this category  ####################### -->
    <!-- ########################################################################### -->

    <?php if ($items):  ?>
    <!-- ########################################################################### -->
    <!-- ########################## child items #################################### -->
    <!-- ########################################################################### -->
       <div class="category child items">
            <?php foreach ($items as $child_item): ?>
                <?php if ($child_item['status'] > 0): ?>            
                <section class="child-item">    
                    <?= $child_item['macro_processed_text_outside_article_top'] ?>
                    <?php 
                        $child_item_id = $child_item_id = $child_item[$this->field_id];                    
                        $this->processDataOutputWithMacro($child_item, 'viewChildItem', array('parent_category_meta_options' => $category_meta_options));
                        $link = $this->createFriendlyURL("action=viewitem&id={$child_item_id}");
                        $child_item_title = ___h($child_item['title']);
                        $child_item_title_text = ($category_meta_options['display_child_item_read_more_link']==false || $category_meta_options['display_link_title']==true) ? 
                            \__Html::A($child_item_title,$link) : $child_item_title;
                        
                    ?>
                    <?php if ($child_item_title_text): ?>
                        <h2 class="item title"><?= $child_item_title_text; ?></h2>
                    <?php endif ?>

                    <?php if ($category_meta_options['display_child_item_read_more_link']): ?>
                        <a class="child category" href="<?= $link; ?>"><?= ___('Read More'); ?></a>
                    <?php endif; ?>
                    <!-- Macro - Pre -->
                    <?php if ($child_item['macro_processed_text_before_article']): ?>        
                        <div class="meta before-article">        
                            <?= $child_item['macro_processed_text_before_article'] ?>            
                        </div>
                    <?php endif ?>
                    <!-- End Macro - Pre -->

                    <!-- text -->
                    <?php if ($category_meta_options['display_item_summary']): ?>
                        <div class="text">
                            <?= $child_item['summary'] ?>
                        </div>
                    <?php endif; ?>
                    <!-- end text -->

                    <!-- Macro - Post -->   
                    <?php if ($child_item['macro_processed_text_after_article']): ?>                
                        <div class="meta after-article">
                            <?= $child_item['macro_processed_text_after_article'] ?>
                        </div>
                    <?php endif ?>
                    <!-- End Macro - Post --> 
                    <?= $child_item['macro_processed_text_outside_article_bottom'] ?>
                </section>
                <?php endif ?>
            <?php endforeach ?>       
        </div>     
    <!-- ########################################################################### -->
    <!-- ####################### end child items ################################### -->
    <!-- ########################################################################### -->
    <?php endif; ?>
    <!-- pagination -->
    <?php $pagination_str = $this->displayItemPagination($pg,$pagination['total'],"action=viewcategory&cid={$current_category_id}"); ?>
    <?php if ($pagination_str &&  $category_meta_options['display_items']): ?>
        <div class="pagination"><?= $pagination_str; ?></div>
    <?php endif?>
    <!-- end pagination -->
    <?= $category['macro_processed_text_outside_article_bottom'] ?>
</div>