	<div class="foot">
	</div>
</div>

<script type="text/javascript">
/* <![CDATA[ */
var img_alt   = "Введите название картинки";
var img_title = "Введите по какому краю выравнивать картинку (left, center, right)";
    function insertimage(selectedImage) {
        
        var Title = prompt(img_title, "left");
		var Alt   = prompt(img_alt, "");

		if (Alt==null) Alt = "";
		if (Title=="center") finalImage = "[center][img="+selectedImage+"]"+Alt+"[/img][/center]";
		else if (Title=="left") finalImage = "[ileft][img="+selectedImage+"]"+Alt+"[/img][/ileft]";
		else if (Title=="right") finalImage = "[iright][img="+selectedImage+"]"+Alt+"[/img][/iright]";
		else finalImage = "[img="+selectedImage+"]"+Alt+"[/img]";
        
	    window.opener.doInsert(finalImage, '', false); window.focus();
    }
/* ]]> */
</script>
