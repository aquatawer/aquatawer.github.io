<?php
    include ('conect.php');



    switch ($_POST['tip']) {
        case 'uchet': 
            mysqli_query($connection, "INSERT INTO uchet (id_cl,data_poseh) 
                                            VALUES ('" . $_POST['adduchet__idcl'] . "', '" . $_POST['adduchet__data'] . "')
            ");   
        break;

        case 'client': 
            $idtar = mysqli_query($connection,"SELECT * FROM `tarif` WHERE id_tarif = ".$_POST['client__tarif']);
            while ( ($idtar_one = mysqli_fetch_assoc($idtar)) ) { $srok = $idtar_one['srok']; }

            mysqli_query($connection, 
            "INSERT INTO abonement (
                id_tarif,
                data_sozd,
                data_okon)
             VALUES (
                '" . $_POST['client__tarif'] . "',
                '" . date('m.d.Y') . "',
                '" . date('d.m.Y',strtotime('+'.$srok.' month')) . "')
             ");

            $idtokabon = mysqli_insert_id($connection);

            mysqli_query($connection, 
            "INSERT INTO client (
                fam,
                imya,
                otch,
                data_roj,
                pol,
                nomer_tel,
                id_tr,
                id_abon) 
             VALUES (
                '" . $_POST['client__fam'] . "',
                '" . $_POST['client__imya'] . "',
                '" . $_POST['client__otch'] . "',
                '" . $_POST['client__data_roj'] . "',
                '" . $_POST['client__pol'] . "',
                '" . $_POST['client__nomer_tel'] . "',
                " . $_POST['client__trener'] . ",
                '" . $idtokabon . "')
             ");
        break;

        case 'trener': 
            mysqli_query($connection, 
            "INSERT INTO trener (
                fam_tr,
                imya_tr,
                otch_tr,
                data_roj_tr,
                pol_tr) 
             VALUES (
                '" . $_POST['trener__fam'] . "',
                '" . $_POST['trener__imya'] . "',
                '" . $_POST['trener__otch'] . "',
                '" . $_POST['trener__data_roj'] . "',
                '" . $_POST['trener__pol'] . "')
             ");
        break;

        case 'tarif': 
            mysqli_query($connection, 
            "INSERT INTO tarif (
                name,
                opis,
                srok,
                cena) 
             VALUES (
                '" . $_POST['tarif__name'] . "',
                '" . $_POST['tarif__opis'] . "',
                '" . $_POST['tarif__srok'] . "',
                '" . $_POST['tarif__cena'] . "')
             ");                
        break;
    }

    mysqli_close($connection);
    header('Location: /');

?>
