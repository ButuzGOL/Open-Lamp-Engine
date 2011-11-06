<div class="mess">
	<h3 style="font-size:24px;">Проверка установленных компонентов и прав на запись папок</h3>
	<div style="position: absolute; margin-left:750px;">
		<form action="" method="post">
			<p><input type="hidden" value="1" name="step" /></p>
			<p><input type="image" src="reloadform.png" class="submit" /></p>
		</form>
	</div>
	<div class="rel">
		<form action="" method="post">
			<div class="mtext">
				<p><input type="hidden" value="2" name="step" /></p>
				<div class="polya">
					<p class="lt" style="font-weight:bold;">Требования скрипта</p> 
					<p class="rt" style="font-weight:bold;">Текщее значение</p>
	 			</div>
	 			<div class="polya">
					<p class="lt">Версия PHP 4 и выше</p> 
					<p class="rt">{PHP}</p>
	 			</div>
	 			<div class="polya">
					<p class="lt">Поддержка MySQL</p> 
					<p class="rt">{MYSQL}</p>
	 			</div>
	 			<div class="polya">
					<p class="lt">Поддержка XML</p> 
					<p class="rt">{XML}</p>
	 			</div>
	 			<br />
	 			
	 			<span style="font-weight:bold;">Если любой из этих пунктов красный, то пожалуйста выполните действия, для исправления положения</span><br /><br />
	 			
	 			<div class="polya">
					<p class="lt" style="font-weight:bold;">Папка</p> 
					<p class="rt" style="font-weight:bold;">Разрешена запись</p>
	 			</div>
	 			<div class="polya">
					<p class="lt">../uploads/avatars/</p> 
					<p class="rt">{AVATARS}</p>
	 			</div>
	 			<div class="polya">
					<p class="lt">../uploads/images/</p> 
					<p class="rt">{IMAGES}</p>
	 			</div>
	 			<div class="polya">
					<p class="lt">../uploads/dbbackups/</p> 
					<p class="rt">{DBBACKUP}</p>
	 			</div>
	 			<div class="polya">
					<p class="lt">../engine/config/</p> 
					<p class="rt">{CONFIG}</p>
	 			</div>
				<br />
			
				<span style="font-weight:bold;">Если любой из этих пунктов красный, то поставти им права 777</span> <br /><br />
			
				<span style="font-weight:bold; font-size:13px;">В случае несоблюдения минимальных требований скрипта, возможно его некорректная работа в системе</span><br /><br />
				<p><input type="image" src="acceptform.png" class="submit" /></p>
			</div>
		</form>
	</div>
</div>
