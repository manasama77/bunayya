<?php
/*************************************************************************
php easy :: pagination scripts set - Version One
==========================================================================
Author:      php easy code, www.phpeasycode.com
Web Site:    http://www.phpeasycode.com
Contact:     webmaster@phpeasycode.com
*************************************************************************/
function paginate_one($reload, $page, $tpages) {
	
	$firstlabel = "&laquo;&nbsp;";
	$prevlabel  = "Prev";
	$nextlabel  = "Next";
	$lastlabel  = "&nbsp;&raquo;";
	$akhir="#";
	
	$out = "<ul class=\"pagination pagination-split justify-content-end\">";
 

	
	// first
if($page==1 || $page=='') {

	
$out.= "<li  class='page-item'><a class='page-link' href=\"#\">" . $firstlabel . "</a></li>
		<li  class='page-item'><a class='page-link'  href=\"#\">" . $prevlabel . "</a></li>
		<li  class='page-item active'><a class='page-link'  href=\"#\">Page " . $page . " of " . $tpages ."</a></li>
		<li  class='page-item'><a class='page-link'  href=\"" . $reload . "&amp;page=" .($page+1) . "\">" . $nextlabel . "</a></li>
		<li  class='page-item'><a class='page-link'  href=\"" . $reload . "&amp;page=" .($tpages) . "\">" . $lastlabel . "</a></li>
		";
		
} else if( $page<$tpages) {

$out.= "<li  class='page-item'><a class='page-link' href=\"" . $reload . "&amp;page=" .(1) . "\">" . $firstlabel . "</a></li>
		<li  class='page-item'><a class='page-link'  href=\"" . $reload . "&amp;page=" .($page-1) . "\">" . $prevlabel . "</a></li>
		<li  class='page-item active'><a class='page-link'  href=\"#\">Page " . $page . " of " . $tpages ."</a></li>
		<li  class='page-item'><a class='page-link'  href=\"" . $reload . "&amp;page=" .($page+1) . "\">" . $nextlabel . "</a></li>
		<li  class='page-item'><a class='page-link'  href=\"" . $reload . "&amp;page=" .($tpages) . "\">" . $lastlabel . "</a></li>
		";
} else if ($page>=$tpages){
$out.= "<li  class='page-item'><a class='page-link' href=\"" . $reload . "&amp;page=" .(1) . "\">" . $firstlabel . "</a></li>
		<li  class='page-item'><a class='page-link'  href=\"" . $reload . "&amp;page=" .($page-1) . "\">" . $prevlabel . "</a></li>
			<li  class='page-item active'><a class='page-link'  href=\"#\">Page " . $page . " of " . $tpages ."</a></li>
		<li  class='page-item'><a class='page-link'  href=\"#\">" . $akhir . "</a></li>
		<li  class='page-item'><a class='page-link'  href=\"#\">" . $lastlabel . "</a></li>
		";

}		
	
	$out.= "</ul>";
	
	return $out;
}
?>