<div class="middle0">
	<h1><a href="?m=users"><img src="{THEME}/images/users.png" title="Пользователи" alt="Пользователи" /></a> {TITLEE}</h1>
	<div class="back"><a href="?m=users"><img src="{THEME}/images/back.png" title="Пользователи" alt="Пользователи" /></a></div>
	<div class="forma">
		{MESS}
		<div class="form">
			<p class="uava"><img src="{AVATAR}" alt="{NAME}" title="{NAME}" /></p>
			<form action="#" method="post" enctype="multipart/form-data">
				<div class="polya">
					<p class="pleft">Имя *</p>
					<p class="pright"><input type="text" maxlength="40" name="login" style="width:230px;" value="{NAME}" /></p>
				</div>
				<div class="polya">
					<p class="pleft">E-mail *</p>
					<p class="pright"><input type="text" maxlength="50" name="email" style="width:230px;" value="{EMAIL}" /></p>
				</div>
				<div class="polya">
					<p class="pleft">Пароль **</p>
					<p class="pright"><input type="text" maxlength="32" name="password" style="width:230px;" value="{PASSWORD}" /></p>
				</div>
				<div class="polya">
					<p class="pleft">Группа</p>
					<p class="pright">
						<select name="usersgroup" {IS_ADM}>
        					{USERSGROUP}
        				</select>
					</p>
				</div>
				<div class="polya">
					<p class="pleft">Забанин</p>
					<p class="pright"><input type="radio" name="banned" value="1" {BANNED_YES} {IS_ADM} class="check" /> Да <input type="radio" name="banned" value="0" {BANNED_NO} class="check" /> Нет</p>
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
