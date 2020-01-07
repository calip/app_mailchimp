<?php
namespace Block;
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
class mailchimp extends \SCHLIX\cmsBlock
{
	public function Run()
	{
                $example_1 = $this->config['str_example_1'];
                $example_2 = $this->config['str_example_2'];			
                $this->loadTemplateFile('view.block',compact(array_keys(get_defined_vars())));
  	}
}
