var uagent    = navigator.userAgent.toLowerCase();
var is_safari = ( (uagent.indexOf('safari') != -1) || (navigator.vendor == "Apple Computer, Inc.") );
var is_ie     = ( (uagent.indexOf('msie') != -1) && (!is_opera) && (!is_safari) && (!is_webtv) );
var is_ie4    = ( (is_ie) && (uagent.indexOf("msie 4.") != -1) );
var is_moz    = (navigator.product == 'Gecko');
var is_ns     = ( (uagent.indexOf('compatible') == -1) && (uagent.indexOf('mozilla') != -1) && (!is_opera) && (!is_webtv) && (!is_safari) );
var is_ns4    = ( (is_ns) && (parseInt(navigator.appVersion) == 4) );
var is_opera  = (uagent.indexOf('opera') != -1);
var is_kon    = (uagent.indexOf('konqueror') != -1);
var is_webtv  = (uagent.indexOf('webtv') != -1);
ie_range_cache = "";

var is_win    =  ( (uagent.indexOf("win") != -1) || (uagent.indexOf("16bit") !=- 1) );
var is_mac    = ( (uagent.indexOf("mac") != -1) || (navigator.vendor == "Apple Computer, Inc.") );
var ua_vers   = parseInt(navigator.appVersion);

var text_enter_url      = "Введите полный URL ссылки";
var text_enter_url_name = "Введите название сайта";
var text_enter_image    = "Введите полный URL изображения";
var error_no_url        = "Вы должны ввести URL";
var error_no_title      = "Вы должны ввести название";
var img_title   		= "Введите по какому краю выравнивать картинку (left, center, right)";
var img_alt   		    = "Введите название картинки";


var b_open = 0;
var i_open = 0;
var u_open = 0;
var s_open = 0;
var left_open = 0;
var center_open = 0;
var right_open = 0;
var hide_open = 0;
var color_open = 0;
var b1_open = 0;
var i1_open = 0;
var u1_open = 0;
var s1_open = 0;
var left1_open = 0;
var center1_open = 0;
var right1_open = 0;
var color1_open = 0;

var selField = "short_story";

var bbtags  = new Array();
var bbtags1 = new Array();

var fombj = document.forms[getNomForm()];

function getNomForm() {
	for (i = 0; i < 100; i++)
		if (document.forms[i].id=="formata") return i;
}
function stacksize(thearray) {

	for (i = 0 ; i < thearray.length; i++) {

        if ( (thearray[i] == "") || (thearray[i] == null) || (thearray == 'undefined') ) return i;
	}

	return thearray.length;
}
function pushstack(thearray, thearray1, tag, kod) {
    arraysize = stacksize(thearray);
    thearray[arraysize]  = tag;
    thearray1[arraysize] = kod;
}
function popstack(thearray, thearray1) {
    theval = new Array();
    arraysize = stacksize(thearray);
    theval[0] = thearray[arraysize - 1];
    theval[1] = thearray1[arraysize - 1];
    delete thearray[arraysize - 1];
	return theval;
}
function setFieldName(which) {
    if (which != selField) {
        allcleartags();
        selField = which;
    }
}
function image_upload() {

    window.open('admin.php?m=cimages', '_Addimage', 'toolbar=0,location=0,status=0, left=0, top=0, menubar=0,scrollbars=yes,resizable=0,width=640,height=550');
}
function cstat() {

	var c = stacksize(bbtags);

	if ( (c < 1) || (c == null) ) c = 0;
	if ( ! bbtags[0] ) c = 0;
}
function closeall() {
	if (bbtags[0]) {
		while (bbtags[0]) {

			tagRemove = popstack(bbtags, bbtags1)
			var closetags = "[/" + tagRemove[1] + "]";

			eval ("fombj." +selField+ ".value += closetags");

			if ( (tagRemove[1] != 'font') && (tagRemove[1] != 'size') ) {
				eval(tagRemove[0] + "_open = 0");
				document.getElementById('b_' + tagRemove[0]).border = '0';
			}
		}
	}
	bbtags = new Array();
}
function allcleartags() {
	if (bbtags[0]) {
		while (bbtags[0]) {
			tagRemove = popstack(bbtags, bbtags1)

			eval(tagRemove[0] + "_open = 0");
			document.getElementById( 'b_' + tagRemove[0] ).border = '0';
		}
	}
	bbtags  = new Array();
    bbtags1 = new Array();
}
function simpletag(thetag, kod) {
	var tagOpen = eval(thetag + "_open");

		if (tagOpen == 0) {

			if (doInsert("[" + kod + "]", "[/" + kod + "]", true)) {
				eval(thetag + "_open = 1");
				document.getElementById( 'b_' + thetag ).border = '1';

				pushstack(bbtags, bbtags1, thetag, kod);
				cstat();
			}
		}
		else {
			lastindex = 0;

			for (i = 0 ; i < bbtags.length; i++ ) {
				if ( bbtags[i] == thetag ) lastindex = i;
			}

			while (bbtags[lastindex])
			{

				tagRemove = popstack(bbtags, bbtags1);

                doInsert("[/" + tagRemove[1] + "]", "", false)


				if ( (tagRemove[1] != 'font') && (tagRemove[1] != 'size') ) {

					eval(tagRemove[0] + "_open = 0");
					document.getElementById( 'b_' + tagRemove[0] ).border = '0';
				}
			}
			cstat();
		}
}
function tag_url() {
    var FoundErrors = '';
	var thesel ='';
	if ( (ua_vers >= 4) && is_ie && is_win) {
		thesel = document.selection.createRange().text;
	} else thesel ="";

    var enterURL   = prompt(text_enter_url, "http://");
        	
	obj_ta  = eval('fombj.'+ selField);
			
	if (enterURL != null) {
		if (obj_ta.selectionEnd - obj_ta.selectionStart > 0) {
			doInsert("[url="+enterURL+"]", "[/url]", false);
		}
		else {
			var enterTITLE = prompt(text_enter_url_name, thesel);
			if (enterTITLE == null) enterTITLE = ""
			doInsert("[url="+enterURL+"]"+enterTITLE+"[/url]", "", false);
		}
	}
}
function tag_image() {
    var FoundErrors = '';
    var enterURL = prompt(text_enter_image, "http://");
	
	if (enterURL != null) {
		var Title = prompt(img_title, "left");
		var Alt   = prompt(img_alt, "");
		if (Alt==null) Alt = ""
		if (Title=="center") doInsert("[center][img="+enterURL+"]"+Alt+"[/img][/center]", "", false);
		else if (Title=="left") doInsert("[ileft][img="+enterURL+"]"+Alt+"[/img][/ileft]", "", false);
		else if (Title=="right") doInsert("[iright][img="+enterURL+"]"+Alt+"[/img][/iright]", "", false);
		else doInsert("[img="+enterURL+"]"+Alt+"[/img]", "", false);
		
	}
}
function doInsert(ibTag, ibClsTag, isSingle) {

	var isClose = false;
	var obj_ta  = eval('fombj.'+ selField);

	if ( (ua_vers >= 4) && is_ie && is_win) {
		if (obj_ta.isTextEdit) {

			obj_ta.focus();
			var sel = document.selection;
			var rng = ie_range_cache ? ie_range_cache : sel.createRange();
			rng.colapse;
			if ((sel.type == "Text" || sel.type == "None") && rng != null) {
				if (ibClsTag != "" && rng.text.length > 0)
					ibTag += rng.text + ibClsTag;
				else if(isSingle)
					isClose = true;

				rng.text = ibTag;
			}
		}
		else {
			if(isSingle) isClose = true;

			obj_ta.value += ibTag;
		}
		rng.select();
		ie_range_cache = null;
	}
	else if ( obj_ta.selectionEnd ) {
		var ss = obj_ta.selectionStart;
		var st = obj_ta.scrollTop;
		var es = obj_ta.selectionEnd;

		if (es <= 2) es = obj_ta.textLength;

		var start  = (obj_ta.value).substring(0, ss);
		var middle = (obj_ta.value).substring(ss, es);
		var end    = (obj_ta.value).substring(es, obj_ta.textLength);

		if (obj_ta.selectionEnd - obj_ta.selectionStart > 0) middle = ibTag + middle + ibClsTag;
		else {
			middle = ibTag + middle;

			if (isSingle) isClose = true;
		}

		obj_ta.value = start + middle + end;

		var cpos = ss + (middle.length);

		obj_ta.selectionStart = cpos;
	  	obj_ta.selectionEnd   = cpos;
		obj_ta.scrollTop      = st;
	}
	else {

		if (isSingle) isClose = true;

		obj_ta.value += ibTag;
	}

	obj_ta.focus();
	return isClose;
}
function getOffsetTop(obj) {
	var top = obj.offsetTop;

	while( (obj = obj.offsetParent) != null ) top += obj.offsetTop;
	
	return top;
}
function getOffsetLeft(obj)
{
	var top = obj.offsetLeft;

	while( (obj = obj.offsetParent) != null )
	{
		top += obj.offsetLeft;
	}

	return top;
}
function ins_color(div, tag) {

	if (color_open == 0 && color1_open == 0) {

		var buttonElement = document.getElementById('b_'+div);
        document.getElementById(selField).focus();

		if ( is_ie ) {
			document.getElementById(selField).focus();
			ie_range_cache = document.selection.createRange();
		}

		var iLeftPos  = getOffsetLeft(buttonElement);
		var iTopPos   = getOffsetTop(buttonElement) + (buttonElement.offsetHeight + 3);

		document.getElementById(tag).style.left = (iLeftPos) + "px";
		document.getElementById(tag).style.top  = (iTopPos)  + "px";

		if (document.getElementById(tag).style.visibility == "hidden") {
			document.getElementById(tag).style.visibility = "visible";
			document.getElementById(tag).style.display    = "block";
		}
		else {
			document.getElementById(tag).style.visibility = "hidden";
			document.getElementById(tag).style.display    = "none";
			ie_range_cache = null;
		}
	}
	else {
		lastindex = 0;

		for (i = 0 ; i < bbtags.length; i++ ) {
			if ( bbtags1[i] == 'color' ) lastindex = i;
		}

		while (bbtags[lastindex]) {
			tagRemove = popstack(bbtags, bbtags1);
			doInsert("[/" + tagRemove[1] + "]", "", false)
			eval(tagRemove[0] + "_open = 0");
			document.getElementById( 'b_' + tagRemove[0] ).border = '0';
		}
	}
}
function setColor(color, tag) {

	if ( doInsert("[color=" +color+ "]", "[/color]", true ) ) {
        if (selField=="vote_body") {
		    color1_open = 1;
		    document.getElementById( 'b_color1' ).border = '1';
            pushstack(bbtags, bbtags1, "color1", "color");
        }
        else {
            color_open = 1;
		    document.getElementById( 'b_color' ).border = '1';
            pushstack(bbtags, bbtags1, "color", "color");
        }
    }

    if (selField=="vote_body") {
        document.getElementById('cp1').style.visibility = "hidden";
	    document.getElementById('cp1').style.display    = "none";
    }
	else {
        document.getElementById('cp').style.visibility = "hidden";
	    document.getElementById('cp').style.display    = "none";
    }
    cstat();
}
function insert_font(value, tag, kod) {
    if (value == 0) return;
	
	if ( doInsert("[" +kod+ "=" +value+ "]", "[/" +kod+ "]", true ) ) pushstack(bbtags, bbtags1, tag, kod);
	
    fombj.bbfont.selectedIndex  = 0;
    fombj.bbsize.selectedIndex  = 0;
    fombj.bbfont1.selectedIndex  = 0;
    fombj.bbsize1.selectedIndex  = 0;
}
