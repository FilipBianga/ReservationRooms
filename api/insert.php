<?php
include("../config.php");

if (isset($_POST['card'])) {

    // $colors = array('#FF7F50','#E9967A','#00FF00','#00FFFF','#66CDAA','#FFA07A','#FFE4B5','#FAFAD2','#E6E6FA','#00FF7F');
    //collect data from form
    $error        = null;
    $name         = $_POST['name'];
    $card         = $_POST['card'];
    $item         = $_POST['item'];
    $start_day    = $_POST['start_day'];
    $start_hour   = $_POST['start_hour'];
    $start_minute = $_POST['start_minute'];
    $end_hour     = $_POST['end_hour'];
    $end_minute   = $_POST['end_minute'];
    $canceled     = 0;
    // $color        = $colors[array_rand($colors)];
    $text_color   = '#000000';

    if ($item == 'Room 1')
    {
        $color = '#00FF7F';
    }
    elseif ($item == 'Room 2')
    {
        $color = '#E6E6FA';
    }
    elseif ($item == 'Room 3')
    {
        $color = '#FFD700';
    }
    elseif ($item == 'Room 4')
    {
        $color = '#FFA07A';
    }
    elseif ($item == 'Room 5')
    {
        $color = '#CD5C5C';
    }
    elseif ($item == 'Room 6')
    {
        $color = '#40E0D0';
    }


    //validation
    if ($card == '') {
        $error['card'] = 'CArd is required';
    }

    if ($start_day == '') {
        $error['start_day'] = 'Start date is required';
    }


    //if there are no errors, carry on
    if (! isset($error)) {

        //format date
        $start = date('Y-m-d H:i', strtotime($start_day))+date('H:i', strtotime($start_hour));
        $end = date('Y-m-d', strtotime($start_day));
        
        $data['success'] = true;
        $data['message'] = 'Success!';

        //store
        $insert = [
            'name'       => $name,
            'card'       => $card,
            'item'       => $item,
            'start_event' => $start,
            'end_event'   => $end,
            'canceled'    => $canceled,
            'color'       => $color,
            'text_color'  => $text_color
        ];
        $db->insert('reservation', $insert);
      
    } else {

        $data['success'] = false;
        $data['errors'] = $error;
    }

    echo json_encode($data);
}
