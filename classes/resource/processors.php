<?php defined('SYSPATH') or die('No direct script access.');

class Resource_Processors
{
		// TODO: Make this minify CSS
	static public function css_minifier($css)
	{
		$css = preg_replace('/\s*([{}|:;,])\s+/', '$1', $css);
		$css = preg_replace('/^\s*|\/\*.*?\*\/|\s*$/', '', $css);
		$css = preg_replace('/;}/', '}', $css);

		return $css;
	}

		// TODO: Make this minify ECMAScript
	static public function ecma_minifier($ecma)
	{
			return $ecma;
	}

		// TODO: Make this minify HTML
	static public function html_minifier($html)
	{
		$html = preg_replace('/\s+/', ' ', $html);
		$match = preg_match('/(\<[^<]+)="(\s+)?([^\s>"]+)(\s+)?"((\s+)?[^>]*\>)/', $html, $matches);
		$html = preg_replace('/(\<[^<]+)="(\s+)?([^\s>"]+)(\s+)?"((\s+)?[^>]*\>)/', '$1=$3$5', $html);

		return $html;
	}
}

