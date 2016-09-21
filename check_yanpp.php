<?php
#min=0.36ms;100;1000 max=0.503ms;100;1000 avg=0.414ms;100;1000 stdev=0.065ms;100;1000 pl=0%;10;50
#
# RTA
#
$ds_name[1] = "Round Trip Times";
$opt[1]  = "--vertical-label \"RTA\"  --title \"Ping times\" ";
$def[1]  =  rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE") ;
$def[1] .=  rrd::gprint("var1", array("LAST", "MAX", "AVERAGE"), "%6.2lf $UNIT[1]") ;
$def[1] .=  rrd::line1("var1", "#A4A4A4") ;

$def[1] .=  rrd::def("var2", $RRDFILE[1], $DS[2], "AVERAGE") ;
$def[1] .=  rrd::gprint("var2", array("LAST", "MAX", "AVERAGE"), "%6.2lf $UNIT[1]") ;
$def[1] .=  rrd::line1("var2", "#A4A4A4") ;

$def[1] .=  rrd::def("var3", $RRDFILE[1], $DS[3], "AVERAGE") ;
$def[1] .=  rrd::gprint("var3", array("LAST", "MAX", "AVERAGE"), "%6.2lf $UNIT[1]") ;
$def[1] .=  rrd::line1("var3", "#000000") ;

if($WARN[1] != ""){
        if($UNIT[1] == "%%"){ $UNIT[1] = "%"; };
        $def[1] .= rrd::hrule($WARN[1], "#FFFF00", "Warning  ".$WARN[1].$UNIT[1]."\\n");
}
if($CRIT[1] != ""){
        if($UNIT[1] == "%%"){ $UNIT[1] = "%"; };
        $def[1] .= rrd::hrule($CRIT[1], "#FF0000", "Critical ".$CRIT[1].$UNIT[1]."\\n");
}
#
# Packets Lost
$ds_name[2] = "Packets Lost";
$opt[2] = "--vertical-label \"Packets lost\" -l0 -u105 --title \"Packets lost\" ";

$def[2]  =  rrd::def("var1", $RRDFILE[2], $DS[5], "AVERAGE");
$def[2] .=  rrd::gradient("var1", "ff5c00", "ffdc00", "Packets Lost", 20) ;
$def[2] .=  rrd::gprint("var1", array("LAST", "MAX", "AVERAGE"), "%3.0lf $UNIT[2]") ;
$def[2] .=  rrd::line1("var1", "#000000") ;

$def[2] .= rrd::hrule("100", "#000000") ;

if($WARN[2] != ""){
        if($UNIT[2] == "%%"){ $UNIT[2] = "%"; };
        $def[2] .= rrd::hrule($WARN[2], "#FFFF00", "Warning  ".$WARN[2].$UNIT[2]."\\n");
}
if($CRIT[2] != ""){
        if($UNIT[2] == "%%"){ $UNIT[2] = "%"; };
        $def[2] .= rrd::hrule($CRIT[2], "#FF0000", "Critical ".$CRIT[2].$UNIT[2]."\\n");
}

?>
