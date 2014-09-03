<?php
#
function stnum($num)
{
 $b4 = '';
 $af = '';
 $fmt = number_format($num, 0);
 if ($num > 99999999)
	$b4 = '<span class=urg>';
 else if ($num > 9999999)
	$b4 = '<span class=warn>';
 if ($b4 != '')
	$af = '</span>';
 return $b4.$fmt.$af;
}
#
function dockp($data, $user)
{
 $pg = '<h1>CKPool</h1>';

 $msg = msgEncode('stats', 'stats', array());
 $rep = sendsockreply('stats', $msg);
 if ($rep == false)
	$ans = array();
 else
	$ans = repDecode($rep);

 $pg .= 'TotalRAM: '.stnum($ans['totalram']).'<br>';
 $pg .= "<table callpadding=0 cellspacing=0 border=0>\n";
 $pg .= '<tr class=title>';
 $pg .= '<td class=dl>Name</td>';
 $pg .= '<td class=dr>Allocated</td>';
 $pg .= '<td class=dr>Store</td>';
 $pg .= '<td class=dr>RAM</td>';
 $pg .= "</tr>\n";
 if ($ans['STATUS'] == 'ok')
 {
	for ($i = 0; $i < 999; $i++)
	{
		if ($i == 0)
			$name = 'stats.name';
		else
			$name = 'name';

		if (!isset($ans[$name.$i]))
			break;

		if (($i % 2) == 0)
			$row = 'even';
		else
			$row = 'odd';

		$pg .= "<tr class=$row>";
		$pg .= '<td class=dl>'.$ans[$name.$i].'</td>';
		$pg .= '<td class=dr>'.stnum($ans['allocated'.$i]).'</td>';
		$pg .= '<td class=dr>'.stnum($ans['store'.$i]).'</td>';
		$pg .= '<td class=dr>'.stnum($ans['ram'.$i]).'</td>';
		$pg .= "</tr>\n";
	}
 }
 $pg .= "</table>\n";

 return $pg;
}
#
function show_ckp($page, $menu, $name, $user)
{
 gopage(NULL, 'dockp', $page, $menu, $name, $user);
}
#
?>
