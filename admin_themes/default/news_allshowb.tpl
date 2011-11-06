		<div class="foot">
            <input type="hidden" name="action" value="submit" />
			<input type="image" src="{THEME}/images/accept_dis.png" id="image" name="action" value="submit" class="submit" disabled="disabled" />
			<select name="make" onchange="diss();">
				<option value="" onclick="diss();">-- Действие --</option>
				<option value="1" {MODERATION_DIS}>Опубликовать новости</option>
				<option value="1_1" {MODERATION_DIS}>Снять c публикации</option>
				<option value="2" {MODERATION_DIS}>Отправить на модерацию</option>
				<option value="2_1" {MODERATION_DIS}>Снять с модерации</option>
				<option value="3">Зафиксировать новости</option>
				<option value="3_1">Снять фиксацию</option>
				<option value="4">Разрешить комментарии</option>
				<option value="4_1">Запретить комментарии</option>
				<option value="5">Разрешить рейтинг</option>
				<option value="5_1">Запретить рейтинг</option>
				<option value="6" {ALLOW_MAIN_DIS}>Опубликовать на главной</option>
				<option value="6_1" {ALLOW_MAIN_DIS}>Снять публикацию на главной</option>
				<option value="7">Удалить</option>
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
            if (elmnt.checked==true && elmnt.name!="master_box" && elmnt.name!="master_box" && frm.make.value!="") {
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

