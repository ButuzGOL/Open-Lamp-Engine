<div class="wheim">
	<div class="image" style="background-color:#FFF;" onmouseover="this.style.backgroundColor='#f9f2a9';" onmouseout="this.style.backgroundColor='#FFF';">
		<div style="height:115px;">
		<img src="{IMG}" alt="{FULL_NAME}" title="{FULL_NAME}" height="{I_HEIGHT}" width="{I_WIDTH}" onmouseover="this.style.cursor='pointer';" onclick="window.open('{IMG}', 'win1', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width={WIDTH},height={HEIGHT},directories=no,location=no,left=120,top=80');" />
		</div>
		<div class="text">
			Имя: {NAME}<br />
			Ширина: {WIDTH} px<br />
			Высота: {HEIGHT} px<br />
			Размер: {SIZE} б<br />
            <img src="{THEME}/images/cimages_code.png" style="cursor:pointer;" title="Код" alt="Код" onclick="document.getElementById('html_cod').value = '[img={IMG}][/img]'; document.getElementById('html_cod').select();" />
            <img src="{THEME}/images/cimages_pcode.png" style="cursor:pointer;" title="Код в поле" alt="Код в поле" onclick="insertimage('{IMG}');" />
		</div>
	</div>
</div>
