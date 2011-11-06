<div class="mess">
	<h3>Настройка конфигурации системы <span style="color:#b12b2b; font-size:9px; font-weight:bold;">{ER}</span></h3>
	<form action="" method="post">
		<div class="mtext">
			<input type="hidden" value="3" name="step" />	
			
			<div class="polya1"><input type="text" name="title" value="{TITLE}" /> <span style="padding-left:10px;">Название сайта</span></div>
 			 			
 			<br /><span style="font-size:20px; font-weight:bold;">Данные для доступа к базе данных MySQL <span style="color:#b12b2b; font-size:13px;">{ER_DB}</span></span><br /><br />
 			
 			<div class="polya1"><input type="text" name="db_host" value="{DB_HOST}" /> <span style="padding-left:10px;">* Сервер MySQL</span></div>
 			<div class="polya1"><input type="text" name="db_name" value="{DB_NAME}" /> <span style="padding-left:10px;">* Имя базы данных</span> <span style="color:#b12b2b; font-size:11px;">{ER_DB_NAME}</span></div>
 			<div class="polya1"><input type="text" name="db_username" value="{DB_USERNAME}" /> <span style="padding-left:10px;">Имя пользователя базы данных</span></div>
 			<div class="polya1"><input type="text" name="db_userpass" value="{DB_USERPASS}" /> <span style="padding-left:10px;">Пароль пользователя базы данных</span></div>
 			<div class="polya1"><input type="text" name="db_pref" value="{DB_PREF}" /> <span style="padding-left:10px;">Префикс таблиц базы данных</span></div>
 			
 			<br /><span style="font-size:20px; font-weight:bold;">Данные для доступа к панели управления</span><br /><br />
 			
 			<div class="polya1"><input type="text" name="name" value="{NAME}" maxlength="40" /> <span style="padding-left:10px;">* Имя администратора</span> <span style="color:#b12b2b; font-size:13px;">{ER_NAME}</span></div>
 			<div class="polya1"><input type="text" name="pass" value="{PASS}" maxlength="32" /> <span style="padding-left:10px;">* Пароль</span> <span style="color:#b12b2b; font-size:18px;">{ER_PASS}</span></div>
 			<div class="polya1"><input type="text" name="email" value="{EMAIL}" maxlength="50" /> <span style="padding-left:10px;">* E-mail</span> <span style="color:#b12b2b; font-size:18px;">{ER_EMAIL}</span></div>
 				
			<input type="image" src="acceptform.png" class="submit" />
		</div>
	</form>
</div>
