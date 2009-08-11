<?php

include("adodb5/adodb-exceptions.inc.php");
include("adodb5/adodb.inc.php");


$conn = &ADONewConnection('mysql');  # create a connection
$conn->PConnect('localhost','root','','meteo');# connect to MySQL, agora db
$sql = 'select * from data WHERE TO_DAYS(NOW()) - TO_DAYS(date) <= 7';
$rs = $conn->Execute($sql);
$xdata = array();
$ydata = array();
while (!$rs->EOF) {
$ydata[] = $rs->fields["outdoor_temperature"];
$xdata[] = $rs->fields["date"];
$rs->MoveNext();
}


include ("jpgraph/src/jpgraph.php");
include ("jpgraph/src/jpgraph_line.php");
include ("jpgraph/src/jpgraph_bar.php");
include ("jpgraph/src/jpgraph_mgraph.php");

// Width and height of the graph
$width = 600; $height = 400;
 
// Create a graph instance
$graph = new Graph($width,$height);
 
// Specify what scale we want to use,
// int = integer scale for the X-axis
// int = integer scale for the Y-axis
$graph->SetScale('intint');
 
// Setup a title for the graph
$graph->title->Set('Temperature');
 
// Setup titles and X-axis labels
$graph->xaxis->title->Set('(depuis 1 semaine)');
$graph->xaxis->SetTickLabels($xdata);

$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
$graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,8);

$graph->xaxis->SetTickLabels($xdata);
$graph->xaxis->SetLabelAngle(90);


// Setup Y-axis title
$graph->yaxis->title->Set('(# °C)');
 
// Create the linear plot
$lineplot=new LinePlot($ydata);
$lineplot->SetFillColor('orange@0.5');

// Add the plot to the graph
$graph->Add($lineplot);
 
// Display the graph
$graph->Stroke();



?>