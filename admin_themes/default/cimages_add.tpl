<div class="middle0">
	<h1><a href="?m=cimages"><img src="{THEME}/images/cimages.png" title="Картинки" alt="Картинки" /></a> {TITLEE}</h1>
	<div class="forma">
		{MESS}
		<div class="form">
			<form action="#" method="post" enctype="multipart/form-data">
				<p><input type="hidden" id="kol_image" name="kol_image" value="1" /></p>
				<p><input type="hidden" id="kol_urlimage" name="kol_urlimage" value="1" /></p>			
				<div class="polya">
					<p class="pleft">
						Картинка 
						<img onclick="addImageI();" title="Больше полей" alt="Больше полей" src="{THEME}/images/images_plus.png" style="cursor:pointer;" />
						<img onclick="delImageI();" title="Меньше полей" alt="Меньше полей" src="{THEME}/images/images_minus.png" style="cursor:pointer;" />
					</p>
					<p class="pright" id="imagesI">
						<input type="file" id="image0" name="image0" value="" style="width:210px;" />
       					<input type="text" maxlength="20" id="name_image0" name="name_image0" value="" style="width:130px;" /><br /><br />
					</p>
				</div>
				<div class="polya">
					<p class="pleft">
						URL картинка 
						<img onclick="addUrlImageI();" title="Больше полей" alt="Больше полей" src="{THEME}/images/images_plus.png" style="cursor:pointer;" />
						<img onclick="delUrlImageI();" title="Меньше полей" alt="Меньше полей" src="{THEME}/images/images_minus.png" style="cursor:pointer;" />
					</p>
					<p class="pright" id="urlimagesI">
						<input type="text" id="urlimage0" name="urlimage0" value="" style="width:205px;" />
						<input type="text" id="name_urlimage0" name="name_urlimage0" value="" style="width:130px;" /><br /><br />
					</p>
				</div>
                <p><input type="hidden" name="action" value="submit" /></p>
				<p><input name="action" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" /></p>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
/* <![CDATA[ */
var a = 1;
var a0 = new Array();
var a1 = new Array();
var b = 1;
var b0 = new Array();
var b1 = new Array();
function addImageI() {

    var tbl = document.getElementById('imagesI');
    
    for (i = 0; i < a; i++) {
    	a0[i] = eval("document.getElementById('image"+i+"').value");
    	a1[i] = eval("document.getElementById('name_image"+i+"').value");
    }
    a0[a] = "";
	a1[a] = "";
    
    a++;     
		
    tbl.innerHTML = "";
    for (i = 0; i < a; i++) {
        tbl.innerHTML += "<input type='file' id='image"+i+"' name='image"+i+"' style='width:210px;' value='"+a0[i]+"'> <input type='text' style='width:130px;' id='name_image"+i+"' name='name_image"+i+"' value='"+a1[i]+"'><br /><br />";
    }
    document.getElementById('kol_image').value = a;
}
function delImageI() {

	if (a=="1") return;
    var tbl = document.getElementById('imagesI');
    a--; 
    
    tbl.innerHTML = "";
    for (i = 0; i < a; i++) {
        tbl.innerHTML += "<input type='file' id='image"+i+"' name='image"+i+"' style='width:210px;' value='"+a0[i]+"'> <input type='text' style='width:130px;' id='name_image"+i+"' name='name_image"+i+"' value='"+a1[i]+"'><br /><br />";
    }
    document.getElementById('kol_image').value = a;
}
function addUrlImageI() {

    var tbl = document.getElementById('urlimagesI');
    
    for (i = 0; i < b; i++) {
    	b0[i] = eval("document.getElementById('urlimage"+i+"').value");
    	b1[i] = eval("document.getElementById('name_urlimage"+i+"').value");
    }
    b0[b] = "";
	b1[b] = "";
    
    b++;
    
    tbl.innerHTML = "";
    for (i = 0; i < b; i++) {
        tbl.innerHTML += "<input type='text' style='width:205px;' id='urlimage"+i+"' name='urlimage"+i+"' value='"+b0[i]+"'> <input type='text' style='width:130px;' id='name_urlimage"+i+"' name='name_urlimage"+i+"' value='"+b1[i]+"'><br /><br />";
    }
    document.getElementById('kol_urlimage').value = b;
}
function delUrlImageI() {

	if (b=="1") return;
    var tbl = document.getElementById('urlimagesI');
    b--; 
    
    tbl.innerHTML = "";
    for (i = 0; i < b; i++) {
        tbl.innerHTML += "<input type='text' style='width:205px;' id='urlimage"+i+"' name='urlimage"+i+"' value='"+b0[i]+"'> <input type='text' style='width:130px;' id='name_urlimage"+i+"' name='name_urlimage"+i+"' value='"+b1[i]+"'><br /><br />";
    }
    document.getElementById('kol_urlimage').value = b;
}
/* ]]> */
</script>
