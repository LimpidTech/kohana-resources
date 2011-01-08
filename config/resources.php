<?php defined('SYSPATH') or die('No direct script access.');

return array(
		 // By default, use the Apache XSendfile action
	'default_action' => 'sendfile',

		// Processors which can be used to further prepare files for the response
	'processors' => array(
		'css' => array('css_minifier'),
    'js' => array('ecma_minifier'),
		'html' => array('html_minifier'),
	),

	'collections' => array()
);

