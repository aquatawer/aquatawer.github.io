<?php
    include ('../conect.php');

    switch ($_POST['punkt']) {
        case 'client': 
            $ruspunkt = 'Клиенты';
            $tablezagalovki = ' <tr>
                                    <th onclick="sortTable(this,0)">Фамилия</th>
                                    <th onclick="sortTable(this,1)">Имя</th>
                                    <th onclick="sortTable(this,2)">Отчество</th>
                                    <th onclick="sortTable(this,3)">Дата рождения</th>
                                    <th onclick="sortTable(this,4)">Пол</th>
                                    <th onclick="sortTable(this,5)">Номер телефона</th>
                                    <th onclick="sortTable(this,7)">Тренер</th>
                                    <th></th>
                                    <th></th>
                                </tr>';
            $request = "SELECT * FROM `client` 
                            LEFT OUTER JOIN `trener` ON trener.id_tr = client.id_tr";

        break;
        case 'trener': 
            $ruspunkt = 'Тренера';
            $tablezagalovki = ' <tr>
                                    <th onclick="sortTable(this,0)">Фамилия</th>
                                    <th onclick="sortTable(this,1)">Имя</th>
                                    <th onclick="sortTable(this,2)">Отчество</th>
                                    <th onclick="sortTable(this,3)">Дата рождения</th>
                                    <th onclick="sortTable(this,4)">Пол</th>
                                    <th></th>
                                    <th></th>
                                </tr>';
            $request = "SELECT * FROM `trener`";
        break;
        case 'abonement': 
            $ruspunkt = 'Абонементы'; 
            $tablezagalovki = ' <tr>
                                    <th onclick="sortTable(this,0)">ID абонемента</th>
                                    <th onclick="sortTable(this,1)">ФИО клиента</th>
                                    <th onclick="sortTable(this,2)">Номер телефона</th>
                                    <th onclick="sortTable(this,3)">Тариф</th>
                                    <th onclick="sortTable(this,4)">Дата создания</th>
                                    <th onclick="sortTable(this,5)">Дата окончания</th>
                                    <th></th>
                                    <th></th>
                                </tr>';
            $request = "SELECT * FROM `abonement` 
                            INNER JOIN `client` ON client.id_abon = abonement.id_abon
                            LEFT OUTER JOIN `tarif` ON tarif.id_tarif = abonement.id_tarif";
        break;
        case 'tarifi': 
            $ruspunkt = 'Тарифы'; 
            $tablezagalovki = ' <tr>
                                    <th onclick="sortTable(this,0)">Название</th>
                                    <th onclick="sortTable(this,1)">Описание</th>
                                    <th onclick="sortTable(this,2)">Цена</th>
                                    <th></th>
                                    <th></th>
                                </tr>';
            $request = "SELECT * FROM `tarif`";                   
        break;
    }

    $table = mysqli_query($connection, $request);
    $trener = mysqli_query($connection, "SELECT * FROM `trener`");
    $tarif = mysqli_query($connection, "SELECT * FROM `tarif`");
?>

<div class="multiboxpunktov__zag"><?php echo $ruspunkt; ?></div>
<input type="text" name="searchmulti" class="multiboxpunktov__search" placeholder="Поиск" onkeyup="searchTable(this, 'multiboxpunktov__table')">
<div class="multiboxpunktov__box">
    <table class="multiboxpunktov__table table-style">
        <?php echo $tablezagalovki; ?>
        <?php 
            switch ($_POST['punkt']) {
                case 'client': 
                    while ( ($table_one = mysqli_fetch_assoc($table)) ) { ?>
                        <tr clientid="<?php echo $table_one['id_cl']; ?>">
                            <td>
                                <span><?php echo $table_one['fam'] ?>        </span>
                                <input type="text" name="client-upd__fam" class="multiboxpunktov__update-input" value="<?php echo $table_one['fam']; ?>">
                            </td>
                            <td>
                                <span><?php echo $table_one['imya'] ?>       </span>
                                <input type="text" name="client-upd__imya" class="multiboxpunktov__update-input" value="<?php echo $table_one['imya']; ?>">
                            </td>
                            <td>
                                <span><?php echo $table_one['otch'] ?>       </span>
                                <input type="text" name="client-upd__otch" class="multiboxpunktov__update-input" value="<?php echo $table_one['otch']; ?>">
                            </td>
                            <td>
                                <span><?php echo $table_one['data_roj'] ?>   </span>
                                <input type="text" name="client-upd__data_roj" class="multiboxpunktov__update-input" value="<?php echo $table_one['data_roj']; ?>">
                            </td>
                            <td>
                                <span><?php echo $table_one['pol'] ?>        </span>
                                <input type="text" name="client-upd__pol" class="multiboxpunktov__update-input" value="<?php echo $table_one['pol']; ?>">
                            </td>
                            <td>
                                <span><?php echo $table_one['nomer_tel'] ?>  </span>
                                <input type="text" name="client-upd__nomer_tel" class="multiboxpunktov__update-input" value="<?php echo $table_one['nomer_tel']; ?>">
                            </td>
                            <td>
                                <span><?php echo $table_one['fam_tr'] ." ". $table_one['imya_tr']; ?> </span>
                                <?php mysqli_data_seek($trener, 0); ?>
                                <select name="client-upd__trener" class="multiboxpunktov__update-select">
                                    <option value="NULL">-</option>
                                    <?php  while ( ($trener_one = mysqli_fetch_assoc($trener)) ) { ?>
                                        <option value="'<?php echo $trener_one['id_tr'] ?>'" <?php if ($table_one['fam_tr'] == $trener_one['fam_tr']) {echo 'selected';} ?>>
                                            <?php echo $trener_one['fam_tr']." ".$trener_one['imya_tr'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <div class='multiboxpunktov__table-update'> &#9997; </div>  
                                <div class='multiboxpunktov__table-save'>&#128190; </div>
                            </td>
                            <td>
                                <div class='multiboxpunktov__table-delet'> &#10060; </div>
                            </td>
                        </tr>
                    <?php } ?> 
                        <tr> <td colspan='9'> <div class='multiboxpunktov__add knopka'>&#10010; Добавить клиента</div> </td> </tr>
                <?php 
                break;
                case 'trener': 
                    while ( ($table_one = mysqli_fetch_assoc($table)) ) { ?>
                        <tr trenerid="<?php echo $table_one['id_tr']; ?>">
                            <td>
                                <span><?php echo $table_one['fam_tr'] ?>     </span>
                                <input type="text" name="trener-upd__fam" class="multiboxpunktov__update-input" value="<?php echo $table_one['fam_tr'] ?>">
                            </td>
                            <td>
                                <span><?php echo $table_one['imya_tr'] ?>     </span>
                                <input type="text" name="trener-upd__imya" class="multiboxpunktov__update-input" value="<?php echo $table_one['imya_tr'] ?>">
                            </td>
                            <td>
                                <span><?php echo $table_one['otch_tr'] ?>     </span>
                                <input type="text" name="trener-upd__otch" class="multiboxpunktov__update-input" value="<?php echo $table_one['otch_tr'] ?>">
                            </td>
                            <td>
                                <span><?php echo $table_one['data_roj_tr'] ?> </span>
                                <input type="text" name="trener-upd__data_roj" class="multiboxpunktov__update-input" value="<?php echo $table_one['data_roj_tr'] ?>">
                            </td>
                            <td>
                                <span><?php echo $table_one['pol_tr'] ?>      </span>
                                <input type="text" name="trener-upd__pol" class="multiboxpunktov__update-input" value="<?php echo $table_one['pol_tr'] ?>">
                            </td>
                            <td>
                                <div class='multiboxpunktov__table-update'> &#9997; </div>   
                                <div class='multiboxpunktov__table-save'>&#128190;  </div>
                            </td>
                            <td> 
                                <div class='multiboxpunktov__table-delet'> &#10060;   </div>
                            </td>
                        </tr>
                    <?php } ?> 
                        <tr> <td colspan='7'> <div class='multiboxpunktov__add knopka'>Добавить тренера</div> </td>  </tr>
                <?php 
                break;
                case 'abonement': 
                    while ( ($table_one = mysqli_fetch_assoc($table)) ) { ?>
                        <tr>
                            <td> <?php echo $table_one['id_abon'] ?>  </td>
                            <td> <?php echo $table_one['fam']." ".$table_one['imya']." ".$table_one['otch'] ?>       </td>
                            <td> <?php echo $table_one['nomer_tel'] ?>  </td>
                            <td>
                                <span> <?php echo $table_one['name'] ?>       </span>
                                <?php mysqli_data_seek($tarif, 0); ?>
                                <select name="abon-upd__tarif" class="multiboxpunktov__update-select">
                                    <?php  while ( ($tarif_one = mysqli_fetch_assoc($tarif)) ) { ?>
                                        <option value="<?php echo $tarif_one['id_tarif'] ?>" <?php if ($table_one['id_tarif'] == $tarif_one['id_tarif']) {echo 'selected';} ?>>
                                            <?php echo $tarif_one['name']  ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td> <?php echo $table_one['data_sozd'] ?>  </td>
                            <td> <?php echo $table_one['data_okon'] ?>  </td>
                            <td>  
                                <div class='multiboxpunktov__table-update'> &#9997; </div>   
                                <div class='multiboxpunktov__table-save'>&#128190;  </div> 
                            </td>
                            <td> 
                                <div class='multiboxpunktov__table-delet'> &#10060;    </div> 
                            </td>
                        </tr>
                    <?php }
                break;
                case 'tarifi': 
                    while ( ($table_one = mysqli_fetch_assoc($table)) ) { ?>
                        <tr tarifid="<?php echo $table_one['id_tarif']; ?>">
                            <td>
                                <span> <?php echo $table_one['name'] ?>     </span>
                                <input type="text" name="tarif-upd__name" class="multiboxpunktov__update-input" value="<?php echo $table_one['name'] ?>">
                            </td>
                            <td>
                                <span> <?php echo $table_one['opis'] ?>     </span>
                                <input type="text" name="tarif-upd__opis" style="width: 100%;max-width: none;" class="multiboxpunktov__update-input" value="<?php echo $table_one['opis'] ?>">
                            </td>
                            <td>
                                <span> <?php echo $table_one['cena'] ?>     </span>
                                <input type="text" name="tarif-upd__cena" class="multiboxpunktov__update-input" value="<?php echo $table_one['cena'] ?>">
                            </td>
                            <td>  
                                <div class='multiboxpunktov__table-update'> &#9997; </div>   
                                <div class='multiboxpunktov__table-save'>&#128190;  </div> 
                            </td>
                            <td> 
                                <div class='multiboxpunktov__table-delet'> &#10060;   </div> 
                            </td>
                        </tr>
                    <?php } ?> 
                        <tr> <td colspan='5'> <div class='multiboxpunktov__add knopka'>Добавить тариф</div> </td> </tr>
                <?php      
                break;
            }
        ?>
    </table>
    <?php switch ($_POST['punkt']) {
            case 'client': ?>
                <form method="POST" action="add.php" class="multiboxpunktov__form">
                    <input type="text" name="client__fam" placeholder="Фамилия">
                    <input type="text" name="client__imya" placeholder="Имя">
                    <input type="text" name="client__otch" placeholder="Отчество">
                    <input type="text" name="client__data_roj" placeholder="Дата рождения">
                    <input type="text" name="client__pol" placeholder="Пол">
                    <input type="text" name="client__nomer_tel" placeholder="Номер телефона">
                    <?php mysqli_data_seek($trener, 0); ?>
                    <select name="client__trener">
                        <option value="NULL">-</option>
                        <?php  while ( ($trener_one = mysqli_fetch_assoc($trener)) ) { ?>
                            <option value="'<?php echo $trener_one['id_tr'] ?>'">
                                <?php echo $trener_one['fam_tr']." ".$trener_one['imya_tr']." ".$trener_one['otch_tr'] ?>
                            </option>
                        <?php } ?>
                    </select>
                    <?php mysqli_data_seek($tarif, 0); ?>
                    <select name="client__tarif">
                        <?php  while ( ($tarif_one = mysqli_fetch_assoc($tarif)) ) { ?>
                            <option value="<?php echo $tarif_one['id_tarif'] ?>">
                                <?php echo $tarif_one['name']  ?>
                            </option>
                        <?php } ?>
                    </select>
                    <input type="text" name="tip" value="client" hidden>
                    <button class="knopka">Добавить</button>
                </form>
        <?php break; 
            case 'trener': ?>
                <form method="POST" action="add.php" class="multiboxpunktov__form">
                    <input type="text" name="trener__fam" placeholder="Фамилия">
                    <input type="text" name="trener__imya" placeholder="Имя">
                    <input type="text" name="trener__otch" placeholder="Отчество">
                    <input type="text" name="trener__data_roj" placeholder="Дата рождения">
                    <input type="text" name="trener__pol" placeholder="Пол">
                    <input type="text" name="tip" value="trener" hidden>
                    <button class="knopka">Добавить</button>
                </form>   
        <?php break;
            case 'tarifi': ?>
                <form method="POST" action="add.php" class="multiboxpunktov__form">
                    <input type="text" name="tarif__name" placeholder="Название">
                    <input type="text" name="tarif__opis" placeholder="Описание">
                    <input type="text" name="tarif__srok" placeholder="Количество месяцев">
                    <input type="text" name="tarif__cena" placeholder="Цена в руб">
                    <input type="text" name="tip" value="tarif" hidden>
                    <button class="knopka">Добавить</button>
                </form> 
        <?php break;
    } ?>

</div>


