<div class="middle0">
	<h1><a href="?m=profile"><img src="{THEME}/images/profile.png" title="Профиль" alt="Профиль" /></a> {TITLEE}</h1>
	<div class="back"><a href="?m=start"><img src="{THEME}/images/back.png" title="Главная" alt="Главная" /></a></div>
	<div class="forma">
		{MESS}
		<div class="form">
			<p class="uava"><img src="{AVATAR}" alt="{NAME}" title="{NAME}" /></p>
			<div class="polya1">
				<p class="pleft">Имя:</p>
				<p class="pright">{NAME1}</p>
			</div>
			<div class="polya1">
				<p class="pleft">Группа:</p>
				<p class="pright">{USERGROUP}</p>
			</div>
			<div class="polya1">
				<p class="pleft">Публикаций:</p>
				<p class="pright">{NEWS_NUM}</p>
			</div>
			<div class="polya1">
				<p class="pleft">Комментариев:</p>
				<p class="pright">{COMM_NUM}</p>
			</div>
			<div class="polya1">
				<p class="pleft">Дата регистрации:</p>
				<p class="pright">{REG_DATE}</p>
			</div>
			<form action="#" method="post" enctype="multipart/form-data">
				<div class="polya">
					<p class="pleft">Имя *</p>
					<p class="pright"><input type="text" maxlength="40" name="login" value="{NAME}" {NAME_DIS} /></p>
				</div>
				<div class="polya">
					<p class="pleft">E-mail *</p>
					<p class="pright"><input type="text" maxlength="50" name="email" value="{EMAIL}" /></p>
				</div>
				<div class="polya">
					<p class="pleft">Старый пароль</p>
					<p class="pright"><input type="password" maxlength="32" name="old_password" value="" /></p>
				</div>
				<div class="polya">
					<p class="pleft">Новый пароль <br /><span class="small">минимально 5 символов</span></p>
					<p class="pright"><input type="password" maxlength="32" name="password" value="" /></p>
				</div>
				<div class="polya">
					<p class="pleft">Разрешить отправку почты на ваш email</p>
					<p class="pright"><input type="radio" name="allow_mail" value="1" {ALLOW_MAIL_YES} class="check" /> Да <input type="radio" name="allow_mail" value="0" {ALLOW_MAIL_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Загрузка аватара <br /><span class="small">макс 100x100</span></p>
					<p class="pright"><input type="file" name="avatar" style="width:215px;" /> <input type="checkbox" name="del_avatar" {DEL_AVATAR_CHE} {DEL_AVATAR_DIS} class="check" /> <span class="small">Удалить аватор</span></p>
				</div>
				<div class="polya">
					<p class="pleft">Полное имя</p>
					<p class="pright"><input type="text" maxlength="100" name="fullname" value="{FULLNAME}" /></p>
				</div>
				<div class="polya">
					<p class="pleft">Место жительства</p>
					<p class="pright"><input type="text" name="land" value="{LAND}" /></p>
				</div>
				<div class="polya">
					<p class="pleft">ICQ</p>
					<p class="pright"><input type="text" maxlength="20" name="icq" value="{ICQ}" /></p>
				</div>
				<div class="polya">
					<p class="pleft">О себе</p>
					<p class="pright"><textarea name="info" cols="" rows="" class="smallta">{INFO}</textarea></p>
				</div>
				<div class="polya">
					<p class="pleft">Блокировка по IP <br /><span class="small">Пример: 192.169.82.106 или 129.42.*.*</span></p>
					<p class="pright"><input type="text" maxlength="20" name="allowed_ip" value="{ALLOWED_IP}" /></p>
				</div><br />
                <p><input type="hidden" name="action" value="submit" /></p>	
				<p><input name="action" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" /></p>
			</form>
		</div>
	</div>
</div>
