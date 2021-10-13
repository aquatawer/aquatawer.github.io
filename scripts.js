

// Сортировка по загаловку
function sortTable(tabl, n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = tabl.parentElement.parentElement.parentElement;
    switching = true;
    for (i = 1; i < table.rows.length; i++) {
        if (table.rows[i].cells.length < 2) { table.rows[i].remove(); }
    }
    dir = "asc";
    while (switching) {
        switching = false;
        rows = table.rows;
        
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
    
            x = rows[i].cells[n].innerHTML;
            y = rows[i + 1].cells[n].innerHTML;
            
            if (n == 3) {
                if (x == '—') {x = '20.10.2200'}
                if (y == '—') {y = '20.10.2200'} 
                var x = (new Date(x.substring(6, 10), (x.substring(3, 5) - 1), x.substring(0, 2))).getTime();
                var y = (new Date(y.substring(6, 10), (y.substring(3, 5) - 1), y.substring(0, 2))).getTime();

                if (dir == "asc") { 
                    if (x > y) { shouldSwitch = true; break; }
                }else if (dir == "desc") {
                    if (x < y) { shouldSwitch = true; break; }
                }
            }else{
                if (dir == "asc") { 
                    if (x.toLowerCase() > y.toLowerCase()) { shouldSwitch = true; break; }
                }else if (dir == "desc") {
                    if (x.toLowerCase() < y.toLowerCase()) { shouldSwitch = true; break; }
                }
            }

        }//end cikla
    
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount ++;
        }else{
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }

    }//end cikla
}//end funkci



// multibox
document.querySelector('.header').onclick = async function(event) {
    if ( event.target.closest('.multibox-power') ) {
        document.querySelector('.multiboxpunktov').classList.add('multiboxpunktov-active');

        document.querySelector('.multiboxpunktov__container').innerHTML = '';

        let requr = await fetch("/punkt/multibox.php", {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin', 
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            redirect: 'follow',
            referrerPolicy: 'no-referrer',
            body: 'punkt='+event.target.getAttribute('name-punt'),
        })
        .then(data => {return data.text()});
        // .then(data => {console.log(data)}

        document.querySelector('.multiboxpunktov__container').insertAdjacentHTML("beforeEnd", requr); 
    }
}

document.querySelector('.multiboxpunktov__close').onclick = function(event) {
    document.querySelector('.multiboxpunktov').classList.remove('multiboxpunktov-active');
    document.querySelector('.multiboxpunktov__container').innerHTML = '';
}
// multibox end


// uchet
document.querySelector('.prihodjs').onclick = function(event) {
    document.querySelector('.adduchet').classList.add('adduchet-active');
    let vse_tr = document.querySelectorAll('.adduchet tr');
    for (var i = 0; i < vse_tr.length; i++) { vse_tr[i].style.background = ''; }
}

document.querySelector('.adduchet__close').onclick = function(event) {
    document.querySelector('.adduchet').classList.remove('adduchet-active');
}

document.querySelector('.adduchet').onclick = function(event) {
    if ( event.target.closest('.adduchet__table tr') ) {

        let vse_tr = document.querySelectorAll('.adduchet tr');
        for (var i = 0; i < vse_tr.length; i++) { vse_tr[i].style.background = ''; }

        event.target.parentElement.style.background = '#ffbe00d6';
        
        document.querySelector('input[name=adduchet__idcl]').value = event.target.parentElement.children[0].innerHTML;
    }
}
// uchet end







//delet 
document.querySelector('.multiboxpunktov').onclick = async function(event) {
    // forma
    if ( event.target.closest('.multiboxpunktov__add') ) {
        document.querySelector('.multiboxpunktov__form').style.display = "flex";
    }
    // forma end
    if ( event.target.closest('.multiboxpunktov__table-delet') ) {
        switch (this.querySelector('.multiboxpunktov__zag').innerHTML) {
            case 'Клиенты':
                await fetch("delet.php", {
                    method: 'POST',
                    mode: 'cors',
                    cache: 'no-cache',
                    credentials: 'same-origin', 
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    redirect: 'follow',
                    referrerPolicy: 'no-referrer',
                    body: 'idcl='+event.target.parentElement.parentElement.getAttribute('clientid')+'&tipdel=client',
                })
                event.target.parentElement.parentElement.remove();
                // .then(data => {return data.text()});
            break;

            case 'Абонементы':
                await fetch("delet.php", {
                    method: 'POST',
                    mode: 'cors',
                    cache: 'no-cache',
                    credentials: 'same-origin', 
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    redirect: 'follow',
                    referrerPolicy: 'no-referrer',
                    body: 'idab='+event.target.parentElement.parentElement.children[0].innerHTML+'&tipdel=abon',
                })
                event.target.parentElement.parentElement.remove();
            break;
            case 'Тренера':
                await fetch("delet.php", {
                    method: 'POST',
                    mode: 'cors',
                    cache: 'no-cache',
                    credentials: 'same-origin', 
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    redirect: 'follow',
                    referrerPolicy: 'no-referrer',
                    body: 'idtr='+event.target.parentElement.parentElement.getAttribute('trenerid')+'&tipdel=tren',
                })
                event.target.parentElement.parentElement.remove();
            break;
            case 'Тарифы':
                await fetch("delet.php", {
                    method: 'POST',
                    mode: 'cors',
                    cache: 'no-cache',
                    credentials: 'same-origin', 
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    redirect: 'follow',
                    referrerPolicy: 'no-referrer',
                    body: 'idtar='+event.target.parentElement.parentElement.getAttribute('tarifid')+'&tipdel=tar',
                })
                event.target.parentElement.parentElement.remove();
            break;
        }
    }
    // update
    if ( event.target.closest('.multiboxpunktov__table-update') ) {
        event.target.parentElement.parentElement.classList.add('updatevkl')
    }
    // update end

    //save 
    if ( event.target.closest('.multiboxpunktov__table-save') ) {
        switch (this.querySelector('.multiboxpunktov__zag').innerHTML) {
            case 'Клиенты':
                let idcl = event.target.parentElement.parentElement.getAttribute('clientid');
                let fam = event.target.parentElement.parentElement.querySelector('input[name=client-upd__fam]').value;
                let imya = event.target.parentElement.parentElement.querySelector('input[name=client-upd__imya]').value;
                let otch = event.target.parentElement.parentElement.querySelector('input[name=client-upd__otch]').value;
                let dataroj  = event.target.parentElement.parentElement.querySelector('input[name=client-upd__data_roj]').value;
                let pol = event.target.parentElement.parentElement.querySelector('input[name=client-upd__pol]').value;
                let nomer_tel = event.target.parentElement.parentElement.querySelector('input[name=client-upd__nomer_tel]').value;
                let trener = event.target.parentElement.parentElement.querySelector('select[name=client-upd__trener]').value;
                let trenername = event.target.parentElement.parentElement.querySelector('select[name=client-upd__trener]').options[event.target.parentElement.parentElement.querySelector('select[name=client-upd__trener]').selectedIndex].text;
                
                await fetch("update.php", {
                    method: 'POST',
                    mode: 'cors',
                    cache: 'no-cache',
                    credentials: 'same-origin', 
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    redirect: 'follow',
                    referrerPolicy: 'no-referrer',
                    body:   'update-client-id='+idcl+
                            '&update-client-fam='+fam+
                            '&update-client-imya='+imya+
                            '&update-client-otch='+otch+
                            '&update-client-data_rojd='+dataroj+
                            '&update-client-pol='+pol+
                            '&update-client-nomer_tel='+nomer_tel+
                            '&update-client-trener='+trener+
                            '&tipup=updatecl',

                })
                // .then(data => {return data.text()});
                event.target.parentElement.parentElement.querySelector('input[name=client-upd__fam]').previousElementSibling.innerHTML = fam;
                event.target.parentElement.parentElement.querySelector('input[name=client-upd__imya]').previousElementSibling.innerHTML = imya;
                event.target.parentElement.parentElement.querySelector('input[name=client-upd__otch]').previousElementSibling.innerHTML = otch;
                event.target.parentElement.parentElement.querySelector('input[name=client-upd__data_roj]').previousElementSibling.innerHTML = dataroj;
                event.target.parentElement.parentElement.querySelector('input[name=client-upd__pol]').previousElementSibling.innerHTML = pol;
                event.target.parentElement.parentElement.querySelector('input[name=client-upd__nomer_tel]').previousElementSibling.innerHTML = nomer_tel;
                event.target.parentElement.parentElement.querySelector('select[name=client-upd__trener]').previousElementSibling.innerHTML = trenername.replaceAll('-','');;
                event.target.parentElement.parentElement.classList.remove('updatevkl');
            break;

            case 'Тренера':
                let idtr = event.target.parentElement.parentElement.getAttribute('trenerid');
                let fam_tr = event.target.parentElement.parentElement.querySelector('input[name=trener-upd__fam]').value;
                let imya_tr = event.target.parentElement.parentElement.querySelector('input[name=trener-upd__imya]').value;
                let otch_tr = event.target.parentElement.parentElement.querySelector('input[name=trener-upd__otch]').value;
                let dataroj_tr = event.target.parentElement.parentElement.querySelector('input[name=trener-upd__data_roj]').value;
                let pol_tr = event.target.parentElement.parentElement.querySelector('input[name=trener-upd__pol]').value;
            
                await fetch("update.php", {
                    method: 'POST',
                    mode: 'cors',
                    cache: 'no-cache',
                    credentials: 'same-origin', 
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    redirect: 'follow',
                    referrerPolicy: 'no-referrer',
                    body:   'update-trener-id='+idtr+
                            '&update-trener-fam='+fam_tr+
                            '&update-trener-imya='+imya_tr+
                            '&update-trener-otch='+otch_tr+
                            '&update-trener-data_rojd='+dataroj_tr+
                            '&update-trener-pol='+pol_tr+
                            '&tipup=updatetr',
                })
                // .then(data => {return data.text()});
                event.target.parentElement.parentElement.querySelector('input[name=trener-upd__fam]').previousElementSibling.innerHTML = fam_tr;
                event.target.parentElement.parentElement.querySelector('input[name=trener-upd__imya]').previousElementSibling.innerHTML = imya_tr;
                event.target.parentElement.parentElement.querySelector('input[name=trener-upd__otch]').previousElementSibling.innerHTML = otch_tr;
                event.target.parentElement.parentElement.querySelector('input[name=trener-upd__data_roj]').previousElementSibling.innerHTML = dataroj_tr;
                event.target.parentElement.parentElement.querySelector('input[name=trener-upd__pol]').previousElementSibling.innerHTML = pol_tr;
                event.target.parentElement.parentElement.classList.remove('updatevkl');
            break;

            case 'Тарифы':
                let idtar = event.target.parentElement.parentElement.getAttribute('tarifid');
                let name_tar = event.target.parentElement.parentElement.querySelector('input[name=tarif-upd__name]').value;
                let opis_tar = event.target.parentElement.parentElement.querySelector('input[name=tarif-upd__opis]').value;
                let cena_tar = event.target.parentElement.parentElement.querySelector('input[name=tarif-upd__cena]').value;
            
                await fetch("update.php", {
                    method: 'POST',
                    mode: 'cors',
                    cache: 'no-cache',
                    credentials: 'same-origin', 
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    redirect: 'follow',
                    referrerPolicy: 'no-referrer',
                    body:   'update-tarif-id='+idtar+
                            '&update-tarif-name='+name_tar+
                            '&update-tarif-opis='+opis_tar+
                            '&update-tarif-cena='+cena_tar+
                            '&tipup=updatetar',
                })
                // .then(data => {return data.text()});
                event.target.parentElement.parentElement.querySelector('input[name=tarif-upd__name]').previousElementSibling.innerHTML = name_tar;
                event.target.parentElement.parentElement.querySelector('input[name=tarif-upd__opis]').previousElementSibling.innerHTML = opis_tar;
                event.target.parentElement.parentElement.querySelector('input[name=tarif-upd__cena]').previousElementSibling.innerHTML = cena_tar;
                event.target.parentElement.parentElement.classList.remove('updatevkl');
            break;

            case 'Абонементы':
                let idabon = event.target.parentElement.parentElement.children[0].innerHTML;
                let tarif = event.target.parentElement.parentElement.querySelector('select[name=abon-upd__tarif]').value;
                let tarifname = event.target.parentElement.parentElement.querySelector('select[name=abon-upd__tarif]').options[event.target.parentElement.parentElement.querySelector('select[name=abon-upd__tarif]').selectedIndex].text;
                // console.log(idabon + tarif + tarifname);
                await fetch("update.php", {
                    method: 'POST',
                    mode: 'cors',
                    cache: 'no-cache',
                    credentials: 'same-origin', 
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    redirect: 'follow',
                    referrerPolicy: 'no-referrer',
                    body:   'update-abon-id='+idabon+
                            '&update-abon-tarif='+tarif+
                            '&tipup=updateabon',
                })
                // .then(data => {return data.text()});
                event.target.parentElement.parentElement.querySelector('select[name=abon-upd__tarif]').previousElementSibling.innerHTML = tarifname;
                event.target.parentElement.parentElement.classList.remove('updatevkl');
            break;
        }
    }
    // save end
}
//delet end




// Поиск в таблице
function searchTable(searchText, selec) {
    var table = document.querySelector('.'+selec);
    var regPhrase = new RegExp(searchText.value, 'i');
    var flag = false;
    for (var i = 1; i < table.rows.length; i++) {
        flag = false;
        for (var j = table.rows[i].cells.length - 1; j >= 0; j--) {
            flag = regPhrase.test(table.rows[i].cells[j].innerHTML);
            if (flag) break;
        }
        if (flag) {
            table.rows[i].style.display = "";
        } else {
            table.rows[i].style.display = "none";
        }

    }
}



