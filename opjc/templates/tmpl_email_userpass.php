<h1>Password Reset</h1>
<p>Hello <?php print $this->user_forename; ?>, Oh dear you have forgotten your password - Fool!</p>
<p>Here are you new user details to access the admin site</p>
<ul>
  <li>User: <?php print $this->user_email; ?></li>
  <li>Password: <?php print $this->user_temppass; ?></li>
</ul>
<p>Your password is temporary and you will be asked to enter a new password when 
  you first log in.</p>
<p>Catch ya later.</p>
<p>Johnny.</p>