function videoHere_SelectionHandler(selectedVideo) {
	backlight_insert(selectedVideo.embedCode);
}
function backlight_insert(h) {
    var win = window.dialogArguments || opener || parent || top;
	
	if (typeof win.send_to_editor == 'function') {
		win.send_to_editor(h);
		if (typeof win.tb_remove == 'function') 
			win.tb_remove();
		return false;
	}
	tinyMCE = win.tinyMCE;
	if ( typeof tinyMCE != 'undefined' && tinyMCE.getInstanceById('content') ) {
		tinyMCE.selectedInstance.getWin().focus();
		tinyMCE.execCommand('mceInsertContent', false, h);
	} else win.edInsertContent(win.edCanvas, h);

	return false;
}