<?php
    include ('conect.php');


    switch ($_POST['tipup']) {
        case 'updatecl':
            mysqli_query($connection, "UPDATE `client` SET
                                            `fam` = '".$_POST['update-client-fam']."',
                                            `imya` = '".$_POST['update-client-imya']."',
                                            `otch` = '".$_POST['update-client-otch']."',
                                            `data_roj` = '".$_POST['update-client-data_rojd']."',
                                            `pol` = '".$_POST['update-client-pol']."',
                                            `nomer_tel` = '".$_POST['update-client-nomer_tel']."',
                                            `id_tr` = ".$_POST['update-client-trener']."
                                        WHERE `id_cl` = ". $_POST['update-client-id']);
        break;

        case 'updatetr': 
            mysqli_query($connection, "UPDATE `trener` SET
                                            `fam_tr` = '".$_POST['update-trener-fam']."',
                                            `imya_tr` = '".$_POST['update-trener-imya']."',
                                            `otch_tr` = '".$_POST['update-trener-otch']."',
                                            `data_roj_tr` = '".$_POST['update-trener-data_rojd']."',
                                            `pol_tr` = '".$_POST['update-trener-pol']."'
                                        WHERE `id_tr` = ". $_POST['update-trener-id']);
        break;

        case 'updatetar': 
            mysqli_query($connection, "UPDATE `tarif` SET
                                            `name` = '".$_POST['update-tarif-name']."',
                                            `opis` = '".$_POST['update-tarif-opis']."',
                                            `cena` = '".$_POST['update-tarif-cena']."'
                                        WHERE `id_tarif` = ". $_POST['update-tarif-id']);
        break;

        case 'updateabon': 
            $idtar = mysqli_query($connection,"SELECT * FROM `tarif` WHERE id_tarif = ".$_POST['update-abon-tarif']);
            while ( ($idtar_one = mysqli_fetch_assoc($idtar)) ) { $srok = $idtar_one['srok']; }

            mysqli_query($connection, "UPDATE `abonement` SET
                                            `id_tarif` = '".$_POST['update-abon-tarif']."',
                                            `data_sozd` = '".date('m.d.Y')."',
                                            `data_okon` = '".date('d.m.Y',strtotime('+'.$srok.' month'))."'
                                        WHERE `id_abon` = ". $_POST['update-abon-id']);
        break;
    }

    mysqli_close($connection);


?>
