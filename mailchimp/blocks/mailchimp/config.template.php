<?php
/**
 * mailchimp - Config
 * 
 * Mailchimp is the leading email marketing platform, that lets you send out fully customized email and newsletter campaigns to your subscribers. It is an imperative tool to build and follow through on your sales funnel, and helps you create and maintain lasting relations with your site visitors and customers.
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
<p><?= ___('Example Configuration') ?></p>
<!-- Example begins -->
<schlix-config:textbox config-key='str_example_1' label='<?= ___('Textbox Example') ?>' class='form-control' />
<schlix-config:textarea config-key='str_example_2' label="<?= ___('Textarea Example') ?>" class='wysiwyg' />             
<schlix-config:textarea config-key='str_example_3' label="<?= ___('Non-WYSIWYG textarea example') ?>" class='form-control'  />             

<schlix-config:integerbox config-key='int_integerbox_example' config-default-value="1" min="1" max="200"  label='<?= ___('Integer box example with default value') ?>' class='form-control' />

<schlix-config:checkbox config-key='bool_checkbox_example' label='<?= ___('Checkbox Example') ?>' />

<schlix-config:dropdownlist class="form-control" config-key="str_option_select" label="<?= ___('Dropdown list example') ?>" >
    <schlix-config:option value="0"><?= ___('Please select') ?></schlix-config:option>
    <schlix-config:option value="<?= ___h('opt1') ?>"><?= ___h('Option 1') ?></schlix-config:option>
    <schlix-config:option value="<?= ___h('opt2') ?>"><?= ___h('Option 2') ?></schlix-config:option>
    <schlix-config:option value="<?= ___h('opt3') ?>"><?= ___h('Option 3') ?></schlix-config:option>
</schlix-config:dropdownlist> 

<schlix-config:radiogroup config-key="int_option_radio" label="<?= ('Radio group example') ?>">
    <schlix-config:option value="1"><?= ___h('Option 1') ?></schlix-config:option>
    <schlix-config:option value="2"><?= ___h('Option 2') ?></schlix-config:option>
    <schlix-config:option value="3"><?= ___h('Option 3') ?></schlix-config:option>
</schlix-config:radiogroup>

<schlix-config:checkboxgroup config-key="int_option_checkbox" label="<?= ('Checkbox group example') ?>">
    <schlix-config:option value="1"><?= ___h('Option 1') ?></schlix-config:option>
    <schlix-config:option value="2"><?= ___h('Option 2') ?></schlix-config:option>
    <schlix-config:option value="3"><?= ___h('Option 3') ?></schlix-config:option>
</schlix-config:checkboxgroup>    
<!-- Example Ends -->
