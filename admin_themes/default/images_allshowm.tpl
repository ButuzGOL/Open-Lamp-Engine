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
            <input name="selected[]" value="{FULL_NAME}" type='checkbox' onclick="diss();" />
            <a href="?m=images&amp;a=del&amp;i={FULL_NAME}"><img title="Удалить" src="{THEME}/images/del.png" alt="Удалить" /></a>
		</div>
	</div>
</div>
