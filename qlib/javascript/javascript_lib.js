// Javascript for Quantum Star SE 2.1.30

// All javascript used in Quantum Star SE is sourced mainly from Open Source sources which are licensed
// under the GNU General Public License or Public Domain. Copywritten to authors as relevant.




var clientVer = parseInt(navigator.appVersion); // Get browser version
var clientPC = navigator.userAgent.toLowerCase(); // Get client info
var clientVer = parseInt(navigator.appVersion); // Get browser version

var is_ie = ((clientPC.indexOf("msie") != -1) && (clientPC.indexOf("opera") == -1));
var is_nav  = ((clientPC.indexOf('mozilla')!=-1) && (clientPC.indexOf('spoofer')==-1)
                && (clientPC.indexOf('compatible') == -1) && (clientPC.indexOf('opera')==-1)
                && (clientPC.indexOf('webtv')==-1) && (clientPC.indexOf('hotjava')==-1));

var is_win   = ((clientPC.indexOf("win")!=-1) || (clientPC.indexOf("16bit") != -1));
var is_mac    = (clientPC.indexOf("mac")!=-1);

bbcode = new Array();
bbtags = new Array('[b]','[/b]','[i]','[/i]','[bi]','[/bi]','[u]','[/u]','[img]','[/img]','[url]','[/url]');
var imageTag = false;
 var theSelection = false;
function modelesswin(url,mwidth,mheight){
if (document.all&&window.print) //if ie5
eval('window.showModelessDialog(url,"","help:0;resizable:1;dialogWidth:'+mwidth+'px;dialogHeight:'+mheight+'px")')
else
eval('window.open(url,"","width='+mwidth+'px,height='+mheight+'px,resizable=1,scrollbars=1")')
}


// Replacement for arrayname.length property
function getarraysize(thearray) {
	for (i = 0; i < thearray.length; i++) {
		if ((thearray[i] == "undefined") || (thearray[i] == "") || (thearray[i] == null))
			return i;
		}
	return thearray.length;
}

// Replacement for arrayname.push(value) not implemented in IE until version 5.5
// Appends element to the array
function arraypush(thearray,value) {
	thearray[ getarraysize(thearray) ] = value;
}

// Replacement for arrayname.pop() not implemented in IE until version 5.5
// Removes and returns the last element of an array
function arraypop(thearray) {
	thearraysize = getarraysize(thearray);
	retval = thearray[thearraysize - 1];
	delete thearray[thearraysize - 1];
	return retval;
}

//Creates a popup window, an alternative to modelesswin
function popUp(URL,WIDTH,HEIGHT) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=" + WIDTH + ",height=" + HEIGHT + ",left = 250,top = 500');");
}

//Highlight image script- By Dynamic Drive
//For full source code and more DHTML scripts, visit http://www.dynamicdrive.com
//This credit MUST stay intact for use

function makevisible(cur,which){
strength=(which==0)? 1 : 0.6

if (cur.style.MozOpacity)
cur.style.MozOpacity=strength
else if (cur.filters)
cur.filters.alpha.opacity=strength*100
}
function emoticon(msg)
{
 msg = ' ' + msg + ' ';
 document.get_var_form.text.value  += msg;
 document.get_var_form.text.focus();
}

function bbstyle(bbnumber) {

	donotinsert = false;
	theSelection = false;
	bblast = 0;

	if (bbnumber == -1) { // Close all open tags & default button names
		while (bbcode[0]) {
			butnumber = arraypop(bbcode) - 1;
			document.get_var_form.text.value += bbtags[butnumber + 1];
			buttext = eval('document.get_var_form.addbbcode' + butnumber + '.value');
			eval('document.get_var_form.addbbcode' + butnumber + '.value ="' + buttext.substr(0,(buttext.length - 1)) + '"');
		}
		imageTag = false; // All tags are closed including image tags :D
		document.get_var_form.text.focus();
		return;
	}

	if ((clientVer >= 4) && is_ie && is_win)
		theSelection = document.selection.createRange().text; // Get text selection

	if (theSelection) {
		// Add tags around selection
		document.selection.createRange().text = bbtags[bbnumber] + theSelection + bbtags[bbnumber+1];
		document.get_var_form.text.focus();
		theSelection = '';
		return;
	}

	// Find last occurance of an open tag the same as the one just clicked
	for (i = 0; i < bbcode.length; i++) {
		if (bbcode[i] == bbnumber+1) {
			bblast = i;
			donotinsert = true;
		}
	}

	if (donotinsert) {		// Close all open tags up to the one just clicked & default button names
		while (bbcode[bblast]) {
				butnumber = arraypop(bbcode) - 1;
				document.get_var_form.text.value += bbtags[butnumber + 1];
				buttext = eval('document.get_var_form.addbbcode' + butnumber + '.value');
				eval('document.get_var_form.addbbcode' + butnumber + '.value ="' + buttext.substr(0,(buttext.length - 1)) + '"');
				imageTag = false;
			}
			document.get_var_form.text.focus();
			return;
	} else { // Open tags

		if (imageTag && (bbnumber != 6)) {		// Close image tag before adding another
			document.get_var_form.text.value += bbtags[15];
			lastValue = arraypop(bbcode) - 1;	// Remove the close image tag from the list
			document.get_var_form.addbbcode14.value = "Img";	// Return button back to normal state
			imageTag = false;
		}

		// Open tag
		document.get_var_form.text.value += bbtags[bbnumber];
		if ((bbnumber == 6) && (imageTag == false)) imageTag = 1; // Check to stop additional tags after an unclosed image tag
		arraypush(bbcode,bbnumber+1);
		eval('document.get_var_form.addbbcode'+bbnumber+'.value += "*"');
		document.get_var_form.text.focus();
		return;
	}
	storeCaret(document.get_var_form.text);
}

function bbfontstyle(bbopen, bbclose) {
var temp;
temp = "[color=" + bbopen + "]";
	if ((clientVer >= 4) && is_ie && is_win) {
		theSelection = document.selection.createRange().text;
		if (!theSelection) {
			document.get_var_form.text.value += temp + bbclose;
			document.get_var_form.text.focus();
			return;
		}
		document.selection.createRange().text = bbopen + theSelection + bbclose;
		document.get_var_form.text.focus();
		return;
	} else {
		document.get_var_form.text.value += temp + bbclose;
		document.get_var_form.text.focus();
		return;
	}
	storeCaret(document.get_var_form.text);
}




// Insert at Claret position. Code from
// http://www.faqts.com/knowledge_base/view.phtml/aid/1052/fid/130
function storeCaret(textEl) {
	if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
}


// function to block multiple submits
function submitonce(theform) {	// if IE 4+ or NS 6+
	if (document.all || document.getElementById) {
		// hunt down "submit" and "reset"
		for (i=0;i<theform.length;i++) {
			var tempobj=theform.elements[i];
			if(tempobj.type.toLowerCase()=="submit"||tempobj.type.toLowerCase()=="reset"||tempobj.type.toLowerCase()=="yes") {
				//disable it
				tempobj.disabled=true;
			}
		}
	}
}


// function to block bad immoral language...lol
function smutEngine() {
	smut="#@&*%!#@&*%!#@&*%!";
	cmp="sex shit fuck piss dick porno cum cunt prick arse feck  "
	+"asshole pedophile man-boy man/boy dong twat ";
	txt=document.isn.dirt.value;
	tstx="";
	for (var i=0;i<16;i++){
		pos=cmp.indexOf(" ");
		wrd=cmp.substring(0,pos);
		wrdl=wrd.length
		cmp=cmp.substring(pos+1,cmp.length);
		while (txt.indexOf(wrd)>-1){
			pos=txt.indexOf(wrd);
			txt=txt.substring(0,pos)+smut.substring(0,wrdl)
			+txt.substring((pos+wrdl),txt.length);
		}
	}
	document.isn.dirt.value=txt;
}


// function to display the gametime clock - thanks to javascript.internet.com
function clock() {
	if (!document.layers && !document.all) return;
	var digital = new Date();
	var hours = digital.getHours();
	var minutes = digital.getMinutes();
	var seconds = digital.getSeconds();
	var amOrPm = "AM";
	if (hours > 11) amOrPm = "PM";
	if (hours > 12) hours = hours - 12;
	if (hours == 0) hours = 12;
	if (minutes <= 9) minutes = "0" + minutes;
	if (seconds <= 9) seconds = "0" + seconds;
	dispTime = hours + ":" + minutes + ":" + seconds + " " + amOrPm;
	if (document.layers) {
		document.layers.pendule.document.write(dispTime);
		document.layers.pendule.document.close();
	}
	else
	if (document.all)
	pendule.innerHTML = dispTime;
	setTimeout("clock()", 1000);
}

// function to open a small pop-up window showing specified url (an alternative)
function modelesswin2(url,mwidth,mheight){
	if (document.all&&window.print) {
		if (document.all || document.getElementById) {
			// hunt down "submit" and "reset"
			for (i=0;i<theform.length;i++) {
				var tempobj=theform.elements[i];
				if(tempobj.type.toLowerCase()=="submit"||tempobj.type.toLowerCase()=="reset") {
					//disable it
					tempobj.disabled=true;
				}
			}
		}
	}
}

// function to open a small pop-up window showing specified url
function modelesswin(url,mwidth,mheight){
	if (document.all&&window.print) //if ie5
		eval('window.showModelessDialog(url,"","help:0;resizable:1;dialogWidth:'+mwidth+'px;dialogHeight:'+mheight+'px")')
	else
		eval('window.open(url,"","width='+mwidth+'px,height='+mheight+'px,resizable=1,scrollbars=1")')
}

function open_win(u,w,h) {
	w+=5;h+=8;
	window.open(""+u,"Game",'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,width='+w+',height='+h+',screenx='+((screen.availWidth/2)-(w/2))+',screeny='+((screen.availHeight/2)-(h/2)));
}

// inverts all ticks in any form with checkboxes
function TickAll(form_name){
	alpha = eval("document."+form_name);
	len = alpha.elements.length;
	var index = 0;
	for( index=0; index < len; index++ ) {
		if(alpha.elements[index].checked == false && alpha.elements[index].name != 'tow_release') {
			alpha.elements[index].checked = true;
		} else {
			alpha.elements[index].checked = false;
		}
	}
}
