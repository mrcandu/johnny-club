<?php
if(!empty($_POST['action'])){

if(trim($_POST['enq_forename'])=="Forename"){$_POST['enq_forename'] = "";}
if(trim($_POST['enq_surname'])=="Surname"){$_POST['enq_surname'] = "";}
if(trim($_POST['enq_email'])=="Email"){$_POST['enq_email'] = "";}
if(trim($_POST['enq_enq'])=="Enquiry"){$_POST['enq_enq'] = "";}

$site['customer']->spam = trim($_POST['spm']);
$site['customer']->sc_a = $_SESSION['spam']['sc_a'];
$site['customer']->sc_w = $_SESSION['spam']['sc_w'];

$site['customer']->enq_forename = trim($_POST['enq_forename']);
$site['customer']->enq_surname = trim($_POST['enq_surname']);
$site['customer']->enq_email = trim($_POST['enq_email']);
$site['customer']->enq_enq = trim($_POST['enq_enq']);
/*$site['customer']->enq_check = trim($_POST['enq_check']);*/
$site['customer']->create_enquiry();

if(!empty($site['customer']->success)){unset($_POST);}
}

//set spam check question
if(!isset($_SESSION['spam']))
{
$sc = spamcheck();
$_SESSION['spam']['sc_q'] = $sc['q'];
$_SESSION['spam']['sc_a'] = $sc['a'];
$_SESSION['spam']['sc_w'] = $sc['w'];
}

$build['form'] = new form(1);
$build['tmpl'] = new Templater($site_config['path'].'templates/tmpl_site_contact.php');

if(trim($_POST['enq_forename'])==""){$_POST['enq_forename'] = "Forename";}
if(trim($_POST['enq_surname'])==""){$_POST['enq_surname'] = "Surname";}
if(trim($_POST['enq_email'])==""){$_POST['enq_email'] = "Email";}
if(trim($_POST['enq_enq'])==""){$_POST['enq_enq'] = "Enquiry";}

$build['tmpl']->enq_forename = $build['form']->formInput('enq_forename',$_POST['enq_forename']);
$build['tmpl']->enq_surname = $build['form']->formInput('enq_surname',$_POST['enq_surname']);
$build['tmpl']->enq_email = $build['form']->formInput('enq_email',$_POST['enq_email']);
$build['tmpl']->enq_enq = $build['form']->formText('enq_enq',$_POST['enq_enq']);
/*$build['tmpl']->enq_check = $build['form']->formHidden('enq_check',''); //accept terms
$build['tmpl']->enq_check2 = $build['form']->formCheck('enq_check2',$_POST['enq_check']); //accept terms*/
$build['tmpl']->spam = $build['form']->formHidden('spm','');
$build['tmpl']->spam2 = '<p class="marg_bot"><em>To prove you are a person (not a spam bot), please type the answer to this math question: '.$_SESSION['spam']['sc_q']."</em></p>".$build['form']->formInput('spm2','');

$build['tmpl']->error = $site['customer']->error;
$build['tmpl']->success = $site['customer']->success;

$build['tmpl']->page_path = $site_config['url'];

$page['jquery'] = '<script src="'.$site_config['url'].'incfiles/js_site_contact.js"></script>';

$page['title'] = "Contact Us - One Pound Johnny Club";
$page['body'] = $build['tmpl']->parse();
///////////////////////////////////////////////////////////////////////////////Tidy Up
unset($build);
?>