<?php

use Khill\Lavacharts\Lavacharts;

$lava = new Lavacharts; // See note below for Laravel

$population = $lava->DataTable();

$population->addDateColumn('Year')
    ->addNumberColumn('Number of People')
    ->addRow(['2006', 623452])
    ->addRow(['2007', 685034])
    ->addRow(['2008', 716845])
    ->addRow(['2009', 757254])
    ->addRow(['2010', 778034])
    ->addRow(['2011', 792353])
    ->addRow(['2012', 839657])
    ->addRow(['2013', 842367])
    ->addRow(['2014', 873490]);

$lava->AreaChart('Population', $population, [
    'title' => 'Population Growth',
    'legend' => [
        'position' => 'in'
    ]
]);


?>

<div id="pop_div"></div>
// With the lava object
<?= $lava->render('AreaChart', 'Population', 'pop_div') ?>