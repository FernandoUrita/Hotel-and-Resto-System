<?php

    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();

    if(isset($_POST['add_add']))
    {
        $frm_data = filteration($_POST);

        $q = "INSERT INTO `check_in`(`name`,`type`,`roomnum`,`payment`,`in`) VALUES (?,?,?,?,?)";
        $values = [$frm_data['name'],$frm_data['type'],$frm_data['roomnum'],
            $frm_data['payment'],$frm_data['in'],];
        $res = insert($q,$values,'ssiss');
        echo $res;
    }

    if(isset($_POST['get_adds']))
    {
        $res = selectAll('check_in');
        $i=1;
        
        while($row = mysqli_fetch_assoc($res))
        {
            echo <<<data
                <tr>
                    <td>$i</td>
                    <td>$row[name]</td>
                    <td>$row[type]</td>
                    <td>$row[roomnum]</td>
                    <td>$row[payment]</td>
                    <td>$row[in]</td>
                    <td>
                        <button type="button" onclick="rem_add($row[id])" class="btn btn-danger btn-sm shadow-none">
                            <i class="bi bi-door-open"></i> Check-out
                        </button>
                    </td>
                </tr>
            data;
            $i++;
        }
    }

    if(isset($_POST['rem_add']))
    {
        
        
    }
    
?>