		<div class="foot">
            <input type="hidden" name="action" value="submit" />
			<input type="image" src="{THEME}/images/accept_dis.png" id="image" name="action" class="submit" disabled="disabled" />
			<select name="make" onchange="diss();">
				<option value="" onclick="diss();">-- Действие --</option>
				<option value="1">Разрешить просмотр отключенного сайта</option>
				<option value="1_1">Запретить просмотр отключенного сайта</option>
				<option value="2">Разрешить доступ в админпанель</option>
				<option value="2_1">Запретить доступ в админпанель</option>
				<option value="3">Скрывать только полную новость из недоступных разделов</option>
				<option value="3_1">Не скрывать только полную новость из недоступных разделов</option>
				<option value="4">Разрешить голосовать в опросах</option>
				<option value="4_1">Запретить голосовать в опросах</option>
				<option value="5">Разрешить добавлять новости</option>
				<option value="5_1">Запретить добавлять новости</option>
				<option value="6">Разрешить публиковать новости без проверки</option>
				<option value="6_1">Запретить публиковать новости без проверки</option>
				<option value="7">Разрешить публиковать на главной</option>
				<option value="7_1">Запретить публиковать на главной</option>
				<option value="8">Разрешить редактирование собственных новостей</option>
				<option value="8_1">Запретить редактирование собственных новостей</option>
				<option value="9">Разрешить редактирование всех новостей</option>
				<option value="9_1">Запретить редактирование всех новостей</option>
				<option value="10">Разрешить добавление комментариев</option>
				<option value="10_1">Запретить добавление комментариев</option>
				<option value="11">Разрешить изменение своих комментариев</option>
				<option value="11_1">Запретить изменение своих комментариев</option>
				<option value="12">Разрешить удаление своих комментариев</option>
				<option value="12_1">Запретить удаление своих комментариев</option>
				<option value="13">Показывать код безопасности</option>
				<option value="13_1">Не показывать код безопасности</option>
				<option value="14">Разрешить изменение всех комментариев</option>
				<option value="14_1">Запретить изменение всех комментариев</option>
				<option value="15">Разрешить удаление всех комментариев</option>
				<option value="15_1">Запретить удаление всех комментариев</option>
				<option value="16">Разрешить просмотр скрытого текста</option>
				<option value="16_1">Запретить просмотр скрытого текста</option>
				<option value="17">Разрешить использование PM</option>
				<option value="17_1">Запретить использование PM</option>
				<option value="18">Разрешить использование поиска по сайту</option>
				<option value="18_1">Запретить использование поиска по сайту</option>
				<option value="19">Разрешить выставление рейтинга новостей</option>
				<option value="19_1">Запретить выставление рейтинга новостей</option>
				<option value="20">Разрешить добавлять статические страницы</option>
				<option value="20_1">Запретить добавлять статические страницы</option>
				<option value="21">Разрешить публиковать статические страницы без проверки</option>
				<option value="21_1">Запретить публиковать статические страницы без проверки</option>
				<option value="22">Разрешить редактирование собственных статических страниц</option>
				<option value="22_1">Запретить редактирование собственных статических страниц</option>
				<option value="23">Разрешить редактирование всех статических страниц</option>
				<option value="23_1">Запретить редактирование всех статических страниц</option>
				<option value="24">Разрешить HTML код</option>
				<option value="24_1">Запретить HTML код</option>
				<option value="25">Удалить</option>
			</select>
		</div>
	</form>
</div>
	
<script type="text/javascript">
/* <![CDATA[ */
dis();
function dis() {
   var frm = document.getElementById('formata');
   frm.elements[1].disabled = true;
   for (var i = 0, k = 0; i < frm.elements.length; i++) {
        var elmnt = frm.elements[i];
        if (elmnt.type=='checkbox') k++;
    }
    if (k > 2) return;
    frm.master_box.disabled = true;
    frm.make.disabled     = true;

}

function check_uncheck_all() {
   var frm = document.getElementById('formata');
    for (var i = 0; i < frm.elements.length; i++) {
        var elmnt = frm.elements[i];
        if (elmnt.type=='checkbox' && i!=1) {
            if (frm.master_box.checked==true) elmnt.checked=false;
            else elmnt.checked=true;
        }
    }
    if (frm.master_box.checked == true) frm.master_box.checked = false;
    else frm.master_box.checked = true;
}

function diss() {

	var frm = document.getElementById('formata');
    for (var i = 0; i < frm.elements.length; i++) {
        var elmnt = frm.elements[i];
        if (elmnt.type=='checkbox') {
            if (elmnt.checked==true && elmnt.name!="master_box" && frm.make.value!="") { 
            	document.getElementById('image').disabled = false;  
            	document.getElementById('image').src = "{THEME}/images/accept.png"
            	return 0;
            	}
        }
    }
    document.getElementById('image').disabled = true;
    document.getElementById('image').src = "{THEME}/images/accept_dis.png"       
}
/* ]]> */
</script>
