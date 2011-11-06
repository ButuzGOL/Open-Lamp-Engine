		<div class="foot">
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
