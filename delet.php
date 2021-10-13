<?php
    include ('conect.php');



    switch ($_POST['tipdel']) {
        case 'client': 
            $client = mysqli_query($connection,"SELECT * FROM `client` WHERE id_cl = ".$_POST['idcl']);
            while ( ($client_one = mysqli_fetch_assoc($client)) ) { $idabon = $client_one['id_abon']; }

            mysqli_query($connection, "DELETE FROM abonement WHERE id_abon ='".$idabon."'");   
            mysqli_query($connection, "DELETE FROM client WHERE id_cl ='".$_POST['idcl']."'"); 
        break;

        case 'abon': 
            mysqli_query($connection, "DELETE FROM client WHERE id_abon ='".$_POST['idab']."'");
            mysqli_query($connection, "DELETE FROM abonement WHERE id_abon ='".$_POST['idab']."'");   
        break;

        case 'tren': 
            mysqli_query($connection, "DELETE FROM trener WHERE id_tr ='".$_POST['idtr']."'");
        break;

        case 'tar': 
            mysqli_query($connection, "DELETE FROM tarif WHERE id_tarif ='".$_POST['idtar']."'");                
        break;
    }

    mysqli_close($connection);


?>
