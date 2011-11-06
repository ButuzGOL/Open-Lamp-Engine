		<div class="foot">
            <input type="hidden" name="action" value="submit" />
			<input type="image" src="{THEME}/images/accept_dis.png" id="image" name="action" class="submit" disabled="disabled" />
			<select name="make" onchange="diss();">
				<option value="" onclick="diss();">-- Действие --</option>
				<option value="1">Включить баннер</option>
				<option value="1_1">Выключить баннер</option>
				<option value="2">Зафиксировать баннер</option>
				<option value="2_1">Снять фиксацию</option>
				<option value="3">Вывод на главной</option>
				<option value="3_1">Не выводить на главной</option>
				<option value="4">Вывод в категориях</option>
				<option value="4_1">Не выводить в категориях</option>
				<option value="5">Вывод в статических страницах</option>
				<option value="5_1">Не выводить в статических страницах</option>
				<option value="6">Вывод в полной новости</option>
				<option value="6_1">Не выводить в полной новости</option>
				<option value="7">Вывод в архиве новостей</option>
				<option value="7_1">Не выводить в архиве новостей</option>
				<option value="8">Вывод в поиске</option>
				<option value="8_1">Не выводить в поиске</option>
				<option value="9">Расположить: Верх</option>
				<option value="9_1">Расположить: Центр</option>
				<option value="9_2">Расположить: Низ</option>
				<option value="9_3">Расположить: Верх, центр</option>
				<option value="9_4">Расположить: Верх, низ</option>
				<option value="9_5">Расположить: Низ, центр</option>
				<option value="9_6">Расположить: Верх, центр, низ</option>
				<option value="10">Удалить</option>
			</select>
		</div>
	</form>
</div>

<script type="text/javascript">
/* <![CDATA[ */
dis();
function dis() {
   var frm = document.getElementById('formata');
    for (var i = 0, k = 0; i < frm.elements.length; i++) {
        var elmnt = frm.elements[i];
        if (elmnt.type=='checkbox') k++;
    }
    if (k > 1) return;
    frm.master_box.disabled = true;
    frm.make.disabled       = true;
}

function check_uncheck_all() {
   var frm = document.getElementById('formata');
    for (var i = 0; i < frm.elements.length; i++) {
        var elmnt = frm.elements[i];
        if (elmnt.type=='checkbox') {
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
