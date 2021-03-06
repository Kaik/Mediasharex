/* Load this script using conditional IE comments if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'Mediasharex\'">' + entity + '</span>' + html;
	}
	var icons = {
			'mediasharex-icon-glass' : '&#xf000;',
			'mediasharex-icon-music' : '&#xf001;',
			'mediasharex-icon-search' : '&#xf002;',
			'mediasharex-icon-envelope' : '&#xf003;',
			'mediasharex-icon-heart' : '&#xf004;',
			'mediasharex-icon-star' : '&#xf005;',
			'mediasharex-icon-star-empty' : '&#xf006;',
			'mediasharex-icon-user' : '&#xf007;',
			'mediasharex-icon-film' : '&#xf008;',
			'mediasharex-icon-th-large' : '&#xf009;',
			'mediasharex-icon-th' : '&#xf00a;',
			'mediasharex-icon-th-list' : '&#xf00b;',
			'mediasharex-icon-ok' : '&#xf00c;',
			'mediasharex-icon-remove' : '&#xf00d;',
			'mediasharex-icon-zoom-in' : '&#xf00e;',
			'mediasharex-icon-zoom-out' : '&#xf010;',
			'mediasharex-icon-off' : '&#xf011;',
			'mediasharex-icon-cog' : '&#xf013;',
			'mediasharex-icon-signal' : '&#xf012;',
			'mediasharex-icon-home' : '&#xf015;',
			'mediasharex-icon-file' : '&#xf016;',
			'mediasharex-icon-time' : '&#xf017;',
			'mediasharex-icon-download-alt' : '&#xf019;',
			'mediasharex-icon-download' : '&#xf01a;',
			'mediasharex-icon-upload' : '&#xf01b;',
			'mediasharex-icon-play-circle' : '&#xf01d;',
			'mediasharex-icon-repeat' : '&#xf01e;',
			'mediasharex-icon-refresh' : '&#xf021;',
			'mediasharex-icon-list-alt' : '&#xf022;',
			'mediasharex-icon-lock' : '&#xf023;',
			'mediasharex-icon-flag' : '&#xf024;',
			'mediasharex-icon-headphones' : '&#xf025;',
			'mediasharex-icon-volume-off' : '&#xf026;',
			'mediasharex-icon-volume-down' : '&#xf027;',
			'mediasharex-icon-volume-up' : '&#xf028;',
			'mediasharex-icon-qrcode' : '&#xf029;',
			'mediasharex-icon-tag' : '&#xf02b;',
			'mediasharex-icon-tags' : '&#xf02c;',
			'mediasharex-icon-book' : '&#xf02d;',
			'mediasharex-icon-bookmark' : '&#xf02e;',
			'mediasharex-icon-print' : '&#xf02f;',
			'mediasharex-icon-camera' : '&#xf030;',
			'mediasharex-icon-facetime-video' : '&#xf03d;',
			'mediasharex-icon-picture' : '&#xf03e;',
			'mediasharex-icon-pencil' : '&#xf040;',
			'mediasharex-icon-map-marker' : '&#xf041;',
			'mediasharex-icon-adjust' : '&#xf042;',
			'mediasharex-icon-tint' : '&#xf043;',
			'mediasharex-icon-edit' : '&#xf044;',
			'mediasharex-icon-share' : '&#xf045;',
			'mediasharex-icon-check' : '&#xf046;',
			'mediasharex-icon-move' : '&#xf047;',
			'mediasharex-icon-step-backward' : '&#xf048;',
			'mediasharex-icon-fast-backward' : '&#xf049;',
			'mediasharex-icon-backward' : '&#xf04a;',
			'mediasharex-icon-play' : '&#xf04b;',
			'mediasharex-icon-pause' : '&#xf04c;',
			'mediasharex-icon-stop' : '&#xf04d;',
			'mediasharex-icon-forward' : '&#xf04e;',
			'mediasharex-icon-fast-forward' : '&#xf050;',
			'mediasharex-icon-share-alt' : '&#xf064;',
			'mediasharex-icon-arrow-down' : '&#xf063;',
			'mediasharex-icon-arrow-up' : '&#xf062;',
			'mediasharex-icon-arrow-right' : '&#xf061;',
			'mediasharex-icon-arrow-left' : '&#xf060;',
			'mediasharex-icon-ban-circle' : '&#xf05e;',
			'mediasharex-icon-ok-circle' : '&#xf05d;',
			'mediasharex-icon-remove-circle' : '&#xf05c;',
			'mediasharex-icon-screenshot' : '&#xf05b;',
			'mediasharex-icon-info-sign' : '&#xf05a;',
			'mediasharex-icon-ok-sign' : '&#xf058;',
			'mediasharex-icon-remove-sign' : '&#xf057;',
			'mediasharex-icon-minus-sign' : '&#xf056;',
			'mediasharex-icon-plus-sign' : '&#xf055;',
			'mediasharex-icon-chevron-right' : '&#xf054;',
			'mediasharex-icon-chevron-left' : '&#xf053;',
			'mediasharex-icon-eject' : '&#xf052;',
			'mediasharex-icon-step-forward' : '&#xf051;',
			'mediasharex-icon-resize-full' : '&#xf065;',
			'mediasharex-icon-resize-small' : '&#xf066;',
			'mediasharex-icon-plus' : '&#xf067;',
			'mediasharex-icon-minus' : '&#xf068;',
			'mediasharex-icon-asterisk' : '&#xf069;',
			'mediasharex-icon-exclamation-sign' : '&#xf06a;',
			'mediasharex-icon-gift' : '&#xf06b;',
			'mediasharex-icon-eye-open' : '&#xf06e;',
			'mediasharex-icon-warning-sign' : '&#xf071;',
			'mediasharex-icon-calendar' : '&#xf073;',
			'mediasharex-icon-chevron-up' : '&#xf077;',
			'mediasharex-icon-chevron-down' : '&#xf078;',
			'mediasharex-icon-magnet' : '&#xf076;',
			'mediasharex-icon-retweet' : '&#xf079;',
			'mediasharex-icon-folder-close' : '&#xf07b;',
			'mediasharex-icon-folder-open' : '&#xf07c;',
			'mediasharex-icon-resize-vertical' : '&#xf07d;',
			'mediasharex-icon-resize-horizontal' : '&#xf07e;',
			'mediasharex-icon-bar-chart' : '&#xf080;',
			'mediasharex-icon-twitter-sign' : '&#xf081;',
			'mediasharex-icon-facebook-sign' : '&#xf082;',
			'mediasharex-icon-camera-retro' : '&#xf083;',
			'mediasharex-icon-cogs' : '&#xf085;',
			'mediasharex-icon-thumbs-up' : '&#xf087;',
			'mediasharex-icon-thumbs-down' : '&#xf088;',
			'mediasharex-icon-star-half' : '&#xf089;',
			'mediasharex-icon-heart-empty' : '&#xf08a;',
			'mediasharex-icon-signout' : '&#xf08b;',
			'mediasharex-icon-linkedin-sign' : '&#xf08c;',
			'mediasharex-icon-pushpin' : '&#xf08d;',
			'mediasharex-icon-external-link' : '&#xf08e;',
			'mediasharex-icon-signin' : '&#xf090;',
			'mediasharex-icon-trophy' : '&#xf091;',
			'mediasharex-icon-github-sign' : '&#xf092;',
			'mediasharex-icon-upload-alt' : '&#xf093;',
			'mediasharex-icon-check-empty' : '&#xf096;',
			'mediasharex-icon-bookmark-empty' : '&#xf097;',
			'mediasharex-icon-twitter' : '&#xf099;',
			'mediasharex-icon-facebook' : '&#xf09a;',
			'mediasharex-icon-github' : '&#xf09b;',
			'mediasharex-icon-unlock' : '&#xf09c;',
			'mediasharex-icon-rss' : '&#xf09e;',
			'mediasharex-icon-hdd' : '&#xf0a0;',
			'mediasharex-icon-bullhorn' : '&#xf0a1;',
			'mediasharex-icon-bell' : '&#xf0a2;',
			'mediasharex-icon-certificate' : '&#xf0a3;',
			'mediasharex-icon-hand-right' : '&#xf0a4;',
			'mediasharex-icon-hand-left' : '&#xf0a5;',
			'mediasharex-icon-hand-up' : '&#xf0a6;',
			'mediasharex-icon-hand-down' : '&#xf0a7;',
			'mediasharex-icon-circle-arrow-left' : '&#xf0a8;',
			'mediasharex-icon-circle-arrow-right' : '&#xf0a9;',
			'mediasharex-icon-circle-arrow-up' : '&#xf0aa;',
			'mediasharex-icon-circle-arrow-down' : '&#xf0ab;',
			'mediasharex-icon-globe' : '&#xf0ac;',
			'mediasharex-icon-wrench' : '&#xf0ad;',
			'mediasharex-icon-tasks' : '&#xf0ae;',
			'mediasharex-icon-filter' : '&#xf0b0;',
			'mediasharex-icon-fullscreen' : '&#xf0b2;',
			'mediasharex-icon-group' : '&#xf0c0;',
			'mediasharex-icon-link' : '&#xf0c1;',
			'mediasharex-icon-cloud' : '&#xf0c2;',
			'mediasharex-icon-cut' : '&#xf0c4;',
			'mediasharex-icon-copy' : '&#xf0c5;',
			'mediasharex-icon-paper-clip' : '&#xf0c6;',
			'mediasharex-icon-save' : '&#xf0c7;',
			'mediasharex-icon-sign-blank' : '&#xf0c8;',
			'mediasharex-icon-reorder' : '&#xf0c9;',
			'mediasharex-icon-list-ul' : '&#xf0ca;',
			'mediasharex-icon-table' : '&#xf0ce;',
			'mediasharex-icon-magic' : '&#xf0d0;',
			'mediasharex-icon-pinterest' : '&#xf0d2;',
			'mediasharex-icon-pinterest-sign' : '&#xf0d3;',
			'mediasharex-icon-google-plus-sign' : '&#xf0d4;',
			'mediasharex-icon-google-plus' : '&#xf0d5;',
			'mediasharex-icon-linkedin' : '&#xf0e1;',
			'mediasharex-icon-sitemap' : '&#xf0e8;',
			'mediasharex-icon-paste' : '&#xf0ea;',
			'mediasharex-icon-lightbulb' : '&#xf0eb;',
			'mediasharex-icon-cloud-download' : '&#xf0ed;',
			'mediasharex-icon-cloud-upload' : '&#xf0ee;',
			'mediasharex-icon-file-alt' : '&#xf0f6;',
			'mediasharex-icon-desktop' : '&#xf108;',
			'mediasharex-icon-laptop' : '&#xf109;',
			'mediasharex-icon-tablet' : '&#xf10a;',
			'mediasharex-icon-mobile' : '&#xf10b;',
			'mediasharex-icon-circle-blank' : '&#xf10c;',
			'mediasharex-icon-circle' : '&#xf111;',
			'mediasharex-icon-folder-close-alt' : '&#xf114;',
			'mediasharex-icon-folder-open-alt' : '&#xf115;',
			'mediasharex-icon-smile' : '&#xf118;',
			'mediasharex-icon-frown' : '&#xf119;',
			'mediasharex-icon-meh' : '&#xf11a;',
			'mediasharex-icon-gamepad' : '&#xf11b;',
			'mediasharex-icon-flag-alt' : '&#xf11d;',
			'mediasharex-icon-flag-checkered' : '&#xf11e;',
			'mediasharex-icon-reply-all' : '&#xf122;',
			'mediasharex-icon-location-arrow' : '&#xf124;',
			'mediasharex-icon-star-half-full' : '&#xf123;',
			'mediasharex-icon-crop' : '&#xf125;',
			'mediasharex-icon-question' : '&#xf128;',
			'mediasharex-icon-info' : '&#xf129;',
			'mediasharex-icon-exclamation' : '&#xf12a;',
			'mediasharex-icon-eraser' : '&#xf12d;',
			'mediasharex-icon-puzzle' : '&#xf12e;',
			'mediasharex-icon-microphone' : '&#xf130;',
			'mediasharex-icon-microphone-off' : '&#xf131;',
			'mediasharex-icon-unlock-alt' : '&#xf13e;',
			'mediasharex-icon-chevron-sign-down' : '&#xf13a;',
			'mediasharex-icon-chevron-sign-up' : '&#xf139;',
			'mediasharex-icon-chevron-sign-right' : '&#xf138;',
			'mediasharex-icon-chevron-sign-left' : '&#xf137;',
			'mediasharex-icon-check-sign' : '&#xf14a;',
			'mediasharex-icon-edit-sign' : '&#xf14b;',
			'mediasharex-icon-external-link-sign' : '&#xf14c;',
			'mediasharex-icon-share-sign' : '&#xf14d;',
			'mediasharex-icon-collapse' : '&#xf150;',
			'mediasharex-icon-level-down' : '&#xf149;',
			'mediasharex-icon-level-up' : '&#xf148;',
			'mediasharex-icon-check-minus' : '&#xf147;',
			'mediasharex-icon-minus-sign-alt' : '&#xf146;',
			'mediasharex-icon-collapse-top' : '&#xf151;',
			'mediasharex-icon-expand' : '&#xf152;',
			'mediasharex-icon-file-2' : '&#xf15b;',
			'mediasharex-icon-file-text' : '&#xf15c;',
			'mediasharex-icon-thumbs-up-2' : '&#xf164;',
			'mediasharex-icon-thumbs-down-2' : '&#xf165;',
			'mediasharex-icon-youtube-sign' : '&#xf166;',
			'mediasharex-icon-youtube' : '&#xf167;',
			'mediasharex-icon-youtube-play' : '&#xf16a;',
			'mediasharex-icon-instagram' : '&#xf16d;',
			'mediasharex-icon-apple' : '&#xf179;',
			'mediasharex-icon-windows' : '&#xf17a;',
			'mediasharex-icon-android' : '&#xf17b;',
			'mediasharex-icon-linux' : '&#xf17c;',
			'mediasharex-icon-foursquare' : '&#xf180;',
			'mediasharex-icon-question-sign' : '&#xf059;',
			'mediasharex-icon-caret-down' : '&#xf0d7;',
			'mediasharex-icon-caret-up' : '&#xf0d8;',
			'mediasharex-icon-caret-left' : '&#xf0d9;',
			'mediasharex-icon-caret-right' : '&#xf0da;',
			'mediasharex-icon-sort' : '&#xf0dc;',
			'mediasharex-icon-sort-down' : '&#xf0dd;',
			'mediasharex-icon-sort-up' : '&#xf0de;',
			'mediasharex-icon-undo' : '&#xf0e2;',
			'mediasharex-icon-ellipsis-horizontal' : '&#xf141;',
			'mediasharex-icon-ellipsis-vertical' : '&#xf142;',
			'mediasharex-icon-reply' : '&#xf112;',
			'mediasharex-icon-plus-sign-2' : '&#xf0fe;',
			'mediasharex-icon-angle-down' : '&#xf107;',
			'mediasharex-icon-angle-up' : '&#xf106;',
			'mediasharex-icon-angle-right' : '&#xf105;',
			'mediasharex-icon-angle-left' : '&#xf104;',
			'mediasharex-icon-double-angle-down' : '&#xf103;',
			'mediasharex-icon-double-angle-up' : '&#xf102;',
			'mediasharex-icon-double-angle-right' : '&#xf101;',
			'mediasharex-icon-double-angle-left' : '&#xf100;',
			'mediasharex-icon-play-2' : '&#xe000;',
			'mediasharex-icon-images' : '&#xe001;',
			'mediasharex-icon-image' : '&#xe002;',
			'mediasharex-icon-image-2' : '&#xe003;',
			'mediasharex-icon-film-2' : '&#xe004;',
			'mediasharex-icon-camera-2' : '&#xe005;',
			'mediasharex-icon-key' : '&#xe006;',
			'mediasharex-icon-settings' : '&#xe007;',
			'mediasharex-icon-equalizer' : '&#xe008;',
			'mediasharex-icon-remove-2' : '&#xe009;',
			'mediasharex-icon-libreoffice' : '&#xe00a;',
			'mediasharex-icon-file-pdf' : '&#xe00b;',
			'mediasharex-icon-file-openoffice' : '&#xe00c;',
			'mediasharex-icon-file-word' : '&#xe00d;',
			'mediasharex-icon-file-excel' : '&#xe00e;',
			'mediasharex-icon-file-zip' : '&#xe00f;',
			'mediasharex-icon-file-powerpoint' : '&#xe010;',
			'mediasharex-icon-folder' : '&#xe011;',
			'mediasharex-icon-plus-2' : '&#xe012;',
			'mediasharex-icon-file-add' : '&#xe013;',
			'mediasharex-icon-file-remove' : '&#xe014;',
			'mediasharex-icon-file-3' : '&#xe015;',
			'mediasharex-icon-file-download' : '&#xe016;',
			'mediasharex-icon-foldertree' : '&#xf0f0;',
			'mediasharex-icon-addfolder' : '&#xe017;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, html, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		attr = el.getAttribute('data-icon');
		if (attr) {
			addIcon(el, attr);
		}
		c = el.className;
		c = c.match(/mediasharex-icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
};