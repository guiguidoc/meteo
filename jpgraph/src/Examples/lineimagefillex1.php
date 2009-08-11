<?php
include ("../jpgraph.php");
include ("../jpgraph_line.php");

$datay = array(0,3,5,12,15,18,22,36,37,41);

// Setup the graph
$graph = new Graph(400,250);
$graph->title->Set('Education growth');
$graph->SetScale('intlin');

$graph->SetGridDepth(DEPTH_FRONT);
$graph->ygrid->SetColor('gray@0.7');
$graph->SetBackgroundImage('classroom.jpg',BGIMG_FILLPLOT);

// Masking graph
$p1 = new LinePlot($datay);
$p1->SetFillColor('white');
$p1->SetFillFromYMax();
$p1->SetWeight(0);
$graph->Add($p1);

// Line plot
$p2 = new LinePlot($datay);
$p2->SetColor('darkred');
$p2->SetWeight(2);
$p2->mark->SetType(MARK_SQUARE);
$p2->mark->SetColor('red@0.5');
$p2->mark->SetFillColor('red@0.5');
$graph->Add($p2);

// Output line
$graph->Stroke();

?>


