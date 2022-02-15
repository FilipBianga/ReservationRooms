<?php
include("../config.php");
$data = [];

$result = $db->rows("SELECT * FROM reservation ORDER BY id");
foreach($result as $row) {
    $data[] = [
        'id'              => $row->id,
        'item'           => $row->item,
        'card'            => $row->card,
        'start'           => $row->start_event,
        'end'             => $row->end_event,
        'backgroundColor' => $row->color,
        'textColor'       => $row->text_color
    ];
}

echo json_encode($data);
