<?
// 
// LigaManager Online 3.02b
// Copyright (C) 1997-2002 by Frank Hollwitz
// webmaster@hollwitz.de / http://php.hollwitz.de
// 
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License as
// published by the Free Software Foundation; either version 2 of
// the License, or (at your option) any later version.
// 
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
// General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
// 
if($file!=""){
  $addp=$_SERVER['PHP_SELF']."?action=program&amp;file=".$file."&amp;selteam=";
  $addr=$_SERVER['PHP_SELF']."?action=results&amp;file=".$file."&amp;st=";
?>

<table class="lmosta" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td valign="top" align="center">
      <table cellspacing="0" cellpadding="0" border="0">
<?
  for ($i=1; $i<=$anzteams; $i++) {
    echo "<tr><td align=\"center\" ";
    if ($i<>$selteam) {
      echo "class=\"lmost0\"><a href=\"".$addp.$i."\" title=\"".$text[23]." ".$teams[$i]."\">".$teamk[$i]."</a>";
    } else {
      echo "class=\"lmost1\">".$teamk[$i];
    }
    echo "</td></tr>";
  }
?>
      </table>
    </td>
    <td valign="top" align="center" class="lmost3">
      <table class="lmostb" cellspacing="0" cellpadding="0" border="0">
<?
  if($selteam==0){
    echo "<tr><td align=\"center\" class=\"lmost5\">&nbsp;<br>".$text[24]."<br>&nbsp;</td></tr>";
  }else{
    for($j=0;$j<$anzst;$j++){
      for($i=0;$i<$anzsp;$i++){
        if(($selteam==$teama[$j][$i]) || ($selteam==$teamb[$j][$i])){
?>
        <tr>
          <td class="lmost5" align="right">&nbsp;<a href="<? echo $addr.($j+1); ?>" title="<? echo $text[25]; ?>"><? echo $j+1; ?></a>&nbsp;</td>
<?        if($datm==1){
            if($mterm[$j][$i]>0){
              $dum1=strftime($datf, $mterm[$j][$i]);
            }else{
              $dum1="";
            }
?>
          <td class="lmost5" width="2">&nbsp;</td>
          <td class="lmost5"><nobr><? echo $dum1; ?></nobr></td>
<?        } ?>
          <td class="lmost5" width="2">&nbsp;</td>
          <td class="lmost5" align="right">
            <nobr>
<?
          if ($selteam==$teama[$j][$i]){
            echo "<strong>";
          }
          echo $teams[$teama[$j][$i]];
          if ($selteam==$teama[$j][$i]){
            echo "</strong>";
          }
?>
            </nobr>
          </td>
          <td class="lmost5" align="center" width="10">-</td>
          <td class="lmost5">
            <nobr>
<?
          if ($selteam==$teamb[$j][$i]){
            echo "<strong>";
          }
          echo $teams[$teamb[$j][$i]];
          if ($selteam==$teamb[$j][$i]){
            echo "</strong>";
          }
?>
            </nobr>
          </td>
          <td class="lmost5" width="2">&nbsp;</td>
          <td class="lmost5" align="right"><? echo $goala[$j][$i]; ?></td>
          <td class="lmost5" align="center" width="8">:</td>
          <td class="lmost5"><? echo $goalb[$j][$i]; ?></td>
<? 
          if($spez==1){ ?>
          <td class="lmost5" width="2">&nbsp;</td>
          <td class="lmost5"><? echo $mspez[$j][$i]; ?></td>
<?        }
?>
          <td class="lmost5" width="2">&nbsp;</td>
          <td class="lmost5">
            <nobr><? 
          /** Mannschaftsicons finden
           */
          $lmo_teamaicon="";
          $lmo_teambicon="";
          if($urlb==1 || $mnote[$j][$i]!="" || $msieg[$j][$i]>0){
            if (file_exists(PATH_TO_IMGDIR."/teams/small/".$teams[$teama[$j][$i]].".gif")) {
              $imgdata=getimagesize(PATH_TO_IMGDIR."/teams/small/".$teams[$teama[$j][$i]].".gif");
              $lmo_teamaicon="<img border='0' src='".URL_TO_IMGDIR."/teams/small/".rawurlencode($teams[$teama[$j][$i]]).".gif' {$imgdata[3]} alt=''> ";
            }
            if (file_exists(PATH_TO_IMGDIR."/teams/small/".$teams[$teamb[$j][$i]].".gif")) {
              $imgdata=getimagesize(PATH_TO_IMGDIR."/teams/small/".$teams[$teamb[$j][$i]].".gif");
              $lmo_teambicon="<img border='0' src='".URL_TO_IMGDIR."/teams/small/".rawurlencode($teams[$teamb[$j][$i]]).".gif' {$imgdata[3]} alt=''> ";
            }
          }
          
          /** Spielbericht verlinken
           */
          if($urlb==1){
            if($mberi[$j][$i]!=""){
              $lmo_spielbericht=$lmo_teamaicon."<strong>".$teams[$teama[$j][$i]]."</strong> - ".$lmo_teambicon."<strong>".$teams[$teamb[$j][$i]]."</strong><br><br>";
              echo "<a href='".$mberi[$j][$i]."'  target='_blank' title='".$text[270]."'><img src='img/lmo-st1.gif' width='10' height='12' border='0' alt=''><span class='popup'><!--[if IE]><table><tr><td style=\"width: 23em\"><![endif]-->".$lmo_spielbericht.nl2br($text[270])."<!--[if IE]></td></tr></table><![endif]--></span></a>";
            }else{
              echo "&nbsp;";
            }
          }
         /** Notizen anzeigen
           *
           * Da IE kein max-width kann, Workaround lt. http://www.bestviewed.de/css/bsp/maxwidth/
           */
          if ($mnote[$j][$i]!="" || $msieg[$j][$i]>0) {
            $lmo_spielnotiz=$lmo_teamaicon."<strong>".$teams[$teama[$j][$i]]."</strong> - ".$lmo_teambicon."<strong>".$teams[$teamb[$j][$i]]."</strong> ".$goala[$j][$i].":".$goalb[$j][$i];
            //Beidseitiges Ergebnis
            if ($msieg[$j][$i]==3) {
              $lmo_spielnotiz.=" / ".$goalb[$j][$i].":".$goala[$j][$i];
            }
            if ($spez==1) {
              $lmo_spielnotiz.=" ".$mspez[$j][$i];
            }
            //Gr�ner Tisch: Heimteam siegt
            if ($msieg[$j][$i]==1) {
              $lmo_spielnotiz.="\n\n<strong>".$text[219].":</strong> ".$teams[$teama[$j][$i]]." ".$text[211];
            }
            //Gr�ner Tisch: Gastteam siegt
            if ($msieg[$j][$i]==2) {
              $lmo_spielnotiz.="\n\n<strong>".$text[219].":</strong> ".addslashes($teams[$teamb[$j][$i]]." ".$text[211]);
            }
            //Beidseitiges Ergebnis
            if ($msieg[$j][$i]==3) {
              $lmo_spielnotiz.="\n\n<strong>".$text[219].":</strong> ".addslashes($text[212]);
            }
            //Allgemeine Notiz
            if ($mnote[$j][$i]!="") {
              $lmo_spielnotiz.="\n\n<strong>".$text[22].":</strong> ".$mnote[$j][$i];
            }
            echo "<a href='#' onclick=\"alert('".mysql_escape_string(strip_tags($lmo_spielnotiz))."');window.focus();return false;\"><span class='popup'><!--[if IE]><table><tr><td style=\"width: 23em\"><![endif]-->".nl2br($lmo_spielnotiz)."<!--[if IE]></td></tr></table><![endif]--></span><img src='img/lmo-st2.gif' width='10' height='12' border='0' alt=''></a>";
            $lmo_spielnotiz="";
          } else {
            echo "&nbsp;";
          }
            ?></nobr>
            </td>
          </tr>
<?      }
      }
    }
  }?>
      </table>
    </td>
  </tr>
</table><?
}?>