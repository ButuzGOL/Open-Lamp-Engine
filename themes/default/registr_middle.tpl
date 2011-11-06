<div class="mess">{MESS}</div>
<div id="registr">
	<form action="#" method="post">
		<div class="polya"><input type="text" name="login" maxlength="40" value="{LOGIN}" /> * Логин</div>
		<div class="polya"><input type="password" name="pass" maxlength="32" /> * Пароль (не менее 5 символов)</div>
		<div class="polya"><input type="password" name="pass2" maxlength="32" /> * Повторите пароль</div>
		<div class="polya"><input type="text" name="email" maxlength="50" value="{EMAIL}" /> * E-Mail</div>
		{CAPTCHA}
        <p><input type="hidden" name="action_reg" value="submit" /></p>
		<p><input name="action_reg" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" /></p> 
	</form>
</div>
