<?php
//Sat_
//calendario perpetuo, non serve altro che chiamare la funzione con calendario($mese,$anno)
//open source, fanne un po' che ti pare.


function calendario($mese,$anno){
Global $_GET;

if ($_GET['x'] == NULL){
$mese_ = $mese;
$anno_ = $anno;
}
else{
$mese_ = (int)strftime( "%m" ,(int)$_GET['x']);
$anno_ = (int)strftime( "%Y" ,(int)$_GET['x']);
}


$prev = mktime(0, 0, 0, $mese_ -1, 1,  $anno_);

$next = mktime(0, 0, 0, $mese_ +1, 1,  $anno_);


$human_month = array("error", "Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre" ); 


$settimana   = array("Lun", "Mar", "Mer", "Gio", "Ven", "Sab", "Dom"); 
$colonne     = 7;
$giorni      = date("t",mktime(0, 0, 0, $mese, 1, $anno));  //giorni del mese in questione
$primo_lunedi= date("w",mktime(0, 0, 0, $mese, 1, $anno));  //Array_parte da 0

if($primo_lunedi==0){
$primo_lunedi = 7;  //siamo mica americani
}

print("<table width=\"210\" colspacing=\"0\" border=\"0\">"); //table
print("\n\t<tr height=\"20\" class=\"txtredB\">\n\t\t<td colspan=\"".$colonne."\" align=\"center\"><a href=\"?x=".$prev."\">&lt;&lt;</a> <span class=\"txtwhiteB\">".$human_month[(int)$mese]." ".$anno_."</span> <a href=\"?x=".$next."\">&gt;&gt;</a></td>\n\t</tr>"); //mese/anno

foreach($settimana as $val){

print("\n\t\t<td height=\"20\" class=\"txtwhiteB\">".$val."\t</td>");

}
print("</tr>");

for($i = 1; $i<$giorni+$primo_lunedi; $i++){

if($i%$colonne+1==0){

print("\n\t<tr>");

}
if($i<$primo_lunedi){

print("\n\t\t<td>&nbsp;</td>");

}
else{

$giorno_= $i-($primo_lunedi-1);
$a = strtotime(date($anno_."-".$mese_."-".$giorno_));
$b = strtotime(date("Y-m-d"));

/* uncomment when debugging
print($giorno_."-".$mese_."-".$anno_);
print(" -> ");
print(strftime("%d-%m-%Y",$a));
//print($a);
print(" -> ");
print(strftime("%d-%m-%Y",$b));
//print($b);
print("<br>");
*/

if($a != $b){
print("\n\t\t<td class=\"txtredB\"><a href=\"?x=".$a."\">".$giorno_."</a></td>");
}
else{
print("\n\t\t<td><a href=\"?x=".$a."\"><span class=\"txtwhiteB\">".$giorno_."</span></a></td>");
}
}
if($i%$colonne==0){
print("\n\t</tr>");
}
}                                                                                                       
print("\n\t<tr height=\"30\">&nbsp;\n\t</tr>");
print("\n</table>");
}
calendario(date("m"),date("Y"));
?>