function wf_get_rfsqv() {
  var q = (WS_rfs_3p && WS_ref.indexOf('?') > 0)?WS_ref.substring(WS_ref.indexOf('?')+1):WS_rfs.location.search.substring(1),v = q.split("&");
  for (var i=0;i<v.length;i++) {
    var m = v[i].split("=");
    if (m[0] == 'WSCam') WS_Cam = m[1];
    else if (m[0] == 'WSEvt') WS_Evt = m[1];
  } 
}

function wf_rfs_main (wd)
{
	var fr,ua=navigator.userAgent, getit=1;
    if (ua.indexOf('MAC')>=0&&ua.indexOf('MSIE 4')>=0) return WS_w;
    else
    {
        if (WS_d.cookie)
        {
           var cv = ' ' + WS_d.cookie;
           if (cv.indexOf (' ws_rfs=') >= 0) return WS_w;
        }
        
        WS_w.tmp_oe = WS_w.onerror;
        WS_w.onerror = wf_rfs_oe;
        fr = wf_rfs_loop (wd);
        WS_w.onerror = (WS_w.tmp_oe)?WS_w.tmp_oe:'';
        return fr;
    }
}

function wf_rfs_loop (wd) {
	var d = wd.parent, w = wd.location;
    WS_rfs = wd; 
	if (d && d.location != w && d.location.host == w.host) { WS_rfs = d; return wf_rfs_loop (WS_rfs) } return WS_rfs;
}

function wf_rfs_oe (e) 
{
    if (! WS_rfs_3p)
    {
        WS_rfs_3p = 1;
        wf_doit();
    }
    return true;
}
function wf_rfs_get() { if (! WS_rfs) { WS_rfs = WS_w; WS_rfs = wf_rfs_main (WS_rfs); } return WS_rfs; }
function wf_evt_trk(et){var i=new Image();i.src=et;}

var WS_ac="125722";
var WS_w=window, WS_d=document, WS_rfs = 0, WS_rfs_3p = 0, WS_ref = WS_d.referrer;

var WS_aref;
var WS_pn;
var WS_pnj = "";
var WS_Cam, WS_Evt;
if (WS_pn) WS_pn = escape(WS_pn);
else if (WS_pnj) WS_pn = escape(WS_pnj);
else WS_pn = "";

var WS_c= (WS_c) ? WS_c : "yes";
var WS_vp = (typeof(document.location) != "undefined") ? document.location : "";
if (WS_vp == "[object]") WS_vp = "";
if (!WS_vp) WS_vp = (typeof(document.URL) != "undefined") ? document.URL : "";

var WS_dobj = new Date();
var tzoffset = "";
if (WS_dobj.getTimezoneOffset) tzoffset = WS_dobj.getTimezoneOffset();
var WS_langs = "";
if (navigator.systemLanguage) WS_langs =  navigator.systemLanguage;

var WS_sw=screen.width,WS_sh=screen.height,WS_sc=screen.colorDepth,WS_sp=screen.pixelDepth;
if (!WS_sw){var WS_sw="";}
if (!WS_sh){var WS_sh="";}
if (!WS_sc){var WS_sc=WS_sp;}
if (!WS_sc){var WS_sc="";}
if (!WS_pg){var WS_pg="123";}

var WS_js="Undetermined";
/*
WS_d.write('<sc'+'ript language="JavaS'+'cript">WS_js = "1"</script'+'>');
WS_d.write('<sc'+'ript language="JavaS'+'cript1.1">WS_js = "1.1"</script'+'>');
WS_d.write('<sc'+'ript language="JavaS'+'cript1.2">WS_js = "1.2"</script'+'>');
WS_d.write('<sc'+'ript language="JavaS'+'cript1.3">WS_js = "1.3"</script'+'>');
WS_d.write('<sc'+'ript language="JavaS'+'cript1.4">WS_js = "1.4"</script'+'>');
WS_d.write('<sc'+'ript language="JavaS'+'cript1.5">WS_js = "1.5"</script'+'>');
*/
WS_d.write('<sc'+'ript language="JavaS'+'cript1.6">WS_js = "1.6"</script'+'>');
// WS_d.write('<sc'+'ript language="JavaS'+'cript2.0">WS_js = "2.0"</script'+'>');

var WS_burl = 'http://hv3.webstat.com/scripts/wsb.php?';
if (window.location.protocol.toLowerCase().indexOf('https') >= 0) WS_burl = 'https://secure.webstat.com/scripts/wsb.php?';

function wf_doit()
{
    var lurl = "http://www.webstat.com/";
    var WS_pgload_et;
    var WS_pg = Math.round(Math.random()*(99999 - 1))+1;
    
    if (WS_aref) lurl = "http://www.webstat.com/" + "?aref=" + WS_aref;
    
    if (WS_rfs && WS_rfs!=WS_w) WS_d.cookie = 'ws_rfs=1; path=/;';
    WS_ref = WS_rfs.document.referrer;
    wf_get_rfsqv();
    
    if(WS_ref) {
      WS_ref.toLowerCase();
      if(WS_ref.indexOf("unknown") != -1) WS_ref = "";
      WS_ref = escape(WS_ref); 
    }
	WS_vp = escape(WS_vp);
    WS_pgload_et = WS_burl + 'WSc=' +WS_c+ '&WSpn=' +WS_pn+ '&WSref=' +WS_ref+ '&pg=' +WS_pg+ '&ac=' +WS_ac+ '&w=' +WS_sw+ '&h=' +WS_sh+ '&c=' +WS_sc+ '&js=' +WS_js+ '&WSvp=' +WS_vp+ '&tz=' +tzoffset+'&ls=' + WS_langs + '&cam='+WS_Cam+'&evt='+WS_Evt;
    	 WS_d.write('<div style="visibility: visible; z-index:1000;">');     WS_d.write('<a href="' + lurl + '"><img src="'+WS_pgload_et+'" alt="webstat code" width=1 height=1 /></a>');
	 WS_d.write('</div>');         WS_didit = 1;
}

var WS_didit = 0;
wf_rfs_get();
if (! WS_didit) wf_doit();