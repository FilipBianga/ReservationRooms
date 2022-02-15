<?php
include("../config.php");

if (isset($_POST['id'])) {
    $row = $db->row("SELECT * FROM reservation where id=?", [$_POST['id']]);
    $data = [
        'id'        => $row->id,
        'item'     => $row->item,
        'card'      => $row->card,
        'start'     => date('d-m-Y H:i', strtotime($row->start_event)),
        'end'       => date('d-m-Y H:i', strtotime($row->end_event)),
        'color'     => $row->color,
        'textColor' => $row->text_color
    ];

    echo json_encode($data);
}
