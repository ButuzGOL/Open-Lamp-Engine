<div class="profile">
	<div class="text">
		<div class="ava"><img src="{AVATAR}" alt="{NAME}" title="{NAME}" /></div>
	
		<div class="pro">
			<div class="proo">Логин: {NAME}</div>
			<div class="proo">Дата регистрации: {REG_DATE}</div>
			<div class="proo">Последнее посещение: {LAST_DATE}</div>
			<div class="proo">Последнее посещение IP: {LAST_IP}</div>
			<div class="proo">Группа: {USERSGROUP}</div>
			<div class="proo">Забанен: {BANNED}</div><br />
			<div class="proo">Количество комментариев: {KOL_COMM}</div>
			<div class="proo">Кол-во публикации: {KOL_NEWS}</div><br />
			<div class="proo">Полное имя: {FULLNAME1}</div>
			<div class="proo">Место жительства: {LAND1}</div>
			<div class="proo">Номер ICQ: {ICQ1}</div>
			<div class="proo">Немного о себе: {INFO1}</div>
		</div>
	</div>
	
	<div class="menu">
		<img src="{THEME}/images/profile_email{ALLOW_EM}.png" title="отправить EMail" alt="отправить EMail" onclick="if ('{ALLOW_EM}'!='_dis') tab('email');" />
		<img src="{THEME}/images/profile_pm{ALLOW_PM}.png" title="написать ПС" alt="написать ПС" onclick="if ('{ALLOW_PM}'!='_dis') tab('pm');" />
		<img src="{THEME}/images/profile_rp{ALLOW_RP}.png" title="редактировать профиль" alt="" onclick="if ('{ALLOW_RP}'!='_dis') tab('rp');" />
	</div>										
						
	<div class="mess" id="mess">{MESS}</div>
	<div id="email" style="display:{DISP_EM};">
		<div class="profileform">
			<form action="#" method="post">
    			<div class="polya"><input type="text" maxlength="100" name="subj1" value="{SUBJ1}" /> * Тема</div>
    			<p><textarea name="text1" cols="" rows="">{TEXT1}</textarea></p>
                <p><input type="hidden" name="action_em" value="submit" /></p>
    			<p><input name="action_em" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" /></p>
			</form>
		</div>
	</div>

	<div id="pm" style="display:{DISP_PM};">
		<div class="profileform">
			<form action="#" method="post">
		        <div class="polya"><input type="text" maxlength="100" name="subj" value="{SUBJ}" /> * Тема</div>
    			<p><textarea name="text" cols="" rows="">{TEXT}</textarea></p>
    			<div class="polya"><input type="checkbox" {IS_DEL_FROM} name="is_del_from" class="check" /> Сохранить сообщение в папке "Отправленные"</div>
                <p><input type="hidden" name="action_pm" value="submit" /></p>
                <p><input name="action_pm" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" /></p>
    		</form>
    	</div>
    </div>    
	<div id="rp" style="display:{DISP_RP};">
		<div class="profileform">
			<form action="#" method="post" enctype="multipart/form-data">
				<div class="polya"><input type="text" maxlength="50" name="email" value="{EMAIL}" /> * E-mail</div>
    			<div class="polya"><input type="password" maxlength="32" name="pass" value="" /> Старый пароль</div>
    			<div class="polya"><input type="password" maxlength="32" name="pass2" value="" /> Новый пароль <span class="small">минимально 5 символов</span></div>
    			<div class="polya"><input type="text" maxlength="100" name="fullname" value="{FULLNAME}" /> Полное имя</div>
    			<div class="polya"><input type="text" maxlength="100" name="land" value="{LAND}" /> Место жительства</div>
    			<div class="polya"><input type="text" maxlength="20" name="icq" value="{ICQ}" /> ICQ</div>
    			<p><textarea name="info" cols="" rows="">{INFO}</textarea></p>	  
    			<div class="polya"><input type="file" name="avatar" style="width: 270px;" /> Загрузка аватара <span class="small">макс 100 x 100</span></div>
    			<div class="polya"><input type="checkbox" name="del_avatar" class="check" /> Удалить аватор</div>
    			<div class="polya"><input type="text" maxlength="16" name="allowed_ip" value="{ALLOWED_IP}" /> Блокировка по IP <span class="small">Пример: 192.48.25.71 или 129.42.*.*</span></div>	
    			<div class="polya">Да <input type="radio" name="allow_mail" value="1" {ALLOW_MAIL_YES} class="check" /> Нет <input type="radio" name="allow_mail" value="0" {ALLOW_MAIL_NO} class="check" />  Отправка почты <span class="small">Отправка почты на email с этого сайта</span></div>
                <p><input type="hidden" name="action_rp" value="submit" /></p>
                <p><input name="action_rp" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" /></p>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
/* <![CDATA[ */
function tab(div) {
    
	if (document.getElementById(div).style.display == 'none') {
    	document.getElementById(div).style.display = '';
    	document.getElementById('mess').innerHTML = '';
    	
    	if (div!='email') document.getElementById('email').style.display = 'none';
    	if (div!='pm') document.getElementById('pm').style.display = 'none';
    	if (div!='rp') document.getElementById('rp').style.display  = 'none';
	}
	else {
		document.getElementById(div).style.display = 'none';
    	document.getElementById('mess').innerHTML = '';
	} 
}
/* ]]> */
</script>
