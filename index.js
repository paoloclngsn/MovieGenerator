function sortTable(n, tableID){
    var table, rows, switching, i, x,y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById(tableID);
    switching = true;
    dir = "asc";
    while (switching){
        switching = false;
        rows = table.rows;
        for(i=1; i<(rows.length-1); i++){
            shouldSwitch = false;

            x = rows[i].getElementsByTagName(`TD`)[n];
            y = rows[i+1].getElementsByTagName(`TD`)[n];
            
            if(dir == "asc"){
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()){
                    shouldSwitch = true;
                    break;
            }
        } else if (dir == "desc"){
            if (x.inngerHTML.toLowerCase() < y.innerHTML.toLowerCase()){
                shouldSwitch = true;
                break;
            }
        }
    }
    if(shouldSwitch){
        rows[i].parentNode.insertBefore(rows[i+1], rows[i]);
        switching = true;
        switchcount++;
        } else{
            if(switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}

function sortNum(n, tableID){
    var table, rows, switching, i, x,y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById(tableID);
    switching = true;
    dir = "asc";
    while (switching){
        switching = false;
        rows = table.rows;
        for(i=1; i<(rows.length-1); i++){
            shouldSwitch = false;

            x = rows[i].getElementsByTagName(`TD`)[n];
            y = rows[i+1].getElementsByTagName(`TD`)[n];
            
            if (Number(x.innerHTML) > Number(y.innerHTML)) {
                shouldSwitch = true;
                break;
              }
    }
    if(shouldSwitch){
        rows[i].parentNode.insertBefore(rows[i+1], rows[i]);
        switching = true;
        switchcount++;
        } else{
            if(switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}


//document.getElementById("topHeader").textContent = `Hello`;