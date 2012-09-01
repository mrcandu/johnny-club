<h1>Hello New Admin User</h1>
<p>Hello <?php print $this->user_forename; ?>, welcome to Johnny Club ... ahhh yeah!</p>
<p>Here are you new admin user details to access the site</p>
<ul>
  <li>User: <?php print $this->user_email; ?></li>
  <li>Password: <?php print $this->user_temppass; ?></li>
</ul>
<p>Your password is temporary and you will be asked to enter a new password when 
  you first log in.</p>
<p>Catch ya later.</p>
<p>Johnny.</p>