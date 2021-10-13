<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportClub 0.1</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>

    <?php
        //Подключение к БД
        include ('conect.php');
        $uchet = mysqli_query($connection, 'SELECT * FROM `uchet` 
            INNER JOIN `client` ON client.id_cl = uchet.id_cl 
            INNER JOIN `abonement` ON abonement.id_abon = client.id_abon 
            INNER JOIN `tarif` ON tarif.id_tarif = abonement.id_tarif
            LEFT OUTER JOIN `trener` ON trener.id_tr = client.id_tr WHERE uchet.data_poseh = "'.date('m.d.Y').'"'
        );

        $client = mysqli_query($connection,"SELECT * FROM `client`");
        
    ?>
    

    <div class="header">
        <div class="header__punkt knopka multibox-power" name-punt="client">Клиенты</div>
        <div class="header__punkt knopka multibox-power" name-punt="abonement">Абонементы</div>
        <div class="header__punkt knopka multibox-power" name-punt="trener">Тренера</div>
        <div class="header__punkt knopka multibox-power" name-punt="tarifi">Тарифы</div>
    </div>


    <div class="menu">
        <div class="menu__but knopka prihodjs">Приход клиента</div>
        <!-- <div class="menu__but knopka posehdatajs">Приходы на опредленную дату</div> -->
        <!-- <div class="menu__but knopka">Фильтр</div> -->
        <input type="text" name="search" class="menu__search" placeholder="Поиск" onkeyup="searchTable(this, 'table__uchet')">
    </div>


    <div class="adduchet">
        <div class="adduchet__close">╳</div>
        <input type="text" name="adduchet__search" class="adduchet__search" placeholder="Введите id либо другую информацию" onkeyup="searchTable(this, 'adduchet__table')">
        <table class="table-style adduchet__table">
            <tr>
                <th onclick="sortTable(this,0)">ID клиента</th>
                <th onclick="sortTable(this,0)">Фамилия</th>
                <th onclick="sortTable(this,1)">Имя</th>
                <th onclick="sortTable(this,2)">Отчество</th>
                <th onclick="sortTable(this,4)">Номер телефона</th>
            </tr>
    
            <?php while ( ($client_one = mysqli_fetch_assoc($client)) ) {
                echo "<tr>";
                    echo "<td>" . $client_one['id_cl'] . "</td>";
                    echo "<td>" . $client_one['fam'] . "</td>";
                    echo "<td>" . $client_one['imya'] . "</td>";
                    echo "<td>" . $client_one['otch'] . "</td>";
                    echo "<td>" . $client_one['nomer_tel'] . "</td>";
                echo "</tr>";
            } ?>
        </table>
        <form method="POST" action="add.php" class="adduchet__form">
            <input type="text" name="adduchet__idcl">
            <input type="text" name="tip" value="uchet">
            <input type="text" name="adduchet__data" value="<?php echo date('m.d.Y'); ?>">
            <button class="adduchet__butadd knopka">Пришел</button>
        </form>
    </div>


    <div class="posehdata">
        <div class="posehdata__close">╳</div>
        <input type="text" name="posehdata__data" class="posehdata__input" placeholder="Введите дату ДД.ММ.ГГГГ">
        <div class="posehdata__but knopka">Показать</div>
    </div>


    <div class="uchettablebox">
        <table class="table-style table__uchet">
            <tr>
                <th onclick="sortTable(this,0)">Фамилия</th>
                <th onclick="sortTable(this,1)">Имя</th>
                <th onclick="sortTable(this,2)">Отчество</th>
                <th onclick="sortTable(this,3)">Дата посещения</th>
                <th onclick="sortTable(this,4)">Номер телефона</th>
                <th onclick="sortTable(this,5)">Дата окончания абонимента</th>
                <th onclick="sortTable(this,6)">Название тарифа</th>
                <th onclick="sortTable(this,7)">Тренер</th>
            </tr>
    
            <?php while ( ($uchet_one = mysqli_fetch_assoc($uchet)) ) {
                echo "<tr>";
                    echo "<td>" . $uchet_one['fam'] . "</td>";
                    echo "<td>" . $uchet_one['imya'] . "</td>";
                    echo "<td>" . $uchet_one['otch'] . "</td>";
                    echo "<td>" . $uchet_one['data_poseh'] . "</td>";
                    echo "<td>" . $uchet_one['nomer_tel'] . "</td>";
                    echo "<td>" . $uchet_one['data_okon'] . "</td>";
                    echo "<td>" . $uchet_one['name'] . "</td>";
                    echo "<td>" . $uchet_one['fam_tr'] . " " . $uchet_one['imya_tr'] . "</td>";
                echo "</tr>";
            } ?>
        </table>
    </div>


    <div class="multiboxpunktov">
        <div class="multiboxpunktov__close">╳</div>
        <div class="multiboxpunktov__container"></div>
    </div>


                        




    <?php mysqli_close($connection); ?>
    <script src="scripts.js" type="text/javascript"></script>




</body>
</html>

