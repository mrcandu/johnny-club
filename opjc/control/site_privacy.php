<?php
$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_site_privacy.php');
$build['tmpl']->page_path = $site_config['url'];

$page['title'] = "Privacy - One Pound Johnny Club";
$page['body'] = $build['tmpl']->parse();
///////////////////////////////////////////////////////////////////////////////Tidy Up
unset($build);
?>