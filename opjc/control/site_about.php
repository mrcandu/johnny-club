<?php
$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_site_about.php');
$build['tmpl']->page_path = $site_config['url'];

$page['title'] = "About - One Pound Johnny Club";
$page['body'] = $build['tmpl']->parse();
///////////////////////////////////////////////////////////////////////////////Tidy Up
unset($build);
?>