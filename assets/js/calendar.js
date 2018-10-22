function setStyle(id,style,value){
    id.style[style] = value;
}

function opacity(el,opacity){
    setStyle(el,"filter:","alpha(opacity="+opacity+")");
    setStyle(el,"-moz-opacity",opacity/100);
    setStyle(el,"-khtml-opacity",opacity/100);
    setStyle(el,"opacity",opacity/100);
}

function calendar(){
    var ddate = new Date();
    var day = ddate.getDate();
    var month = ddate.getMonth();
    var year = ddate.getYear();
    var endA = 0;
    var mth = ("0" + (ddate.getMonth() + 1)).slice(-2);
    var Dy = ("0" + ddate.getDate()).slice(-2);
    if(year<=200)
    {
        year += 1900;
    }
    months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    days_in_month = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
    if(year%4 == 0 && year!=1900)
    {
        days_in_month[1]=29;
    }
    total = days_in_month[month];
    var date_today = day+' '+months[month]+' '+year;
    beg_j = ddate;
    beg_j.setDate(1);
    if(beg_j.getDate()==2)
    {
        beg_j=setDate(0);
    }
    beg_j = beg_j.getDay();
    document.write('<table class="cal_calendar" onload="opacity(document.getElementById(\'cal_body\'),20);"><tbody id="cal_body"><tr><th colspan="7"><center>'+date_today+'</center></th></tr>');
    document.write('<tr class="cal_d_weeks"><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr><tr>');
    week = 0;
    for(j=1;j<=beg_j;j++){
        document.write('<td class="cal_days_bef_aft"><a href="#" onClick="getR('+j+');">'+(days_in_month[month-1]-beg_j+j)+'</a></td>');
        week++;
    }
    for(i=1;i<=total;i++){
        if(week==0){
            document.write('<tr>');
        }
        if(day==i){
            document.write('<td class="cal_today">'+i+'</td>');
            endA=1;
        }
        else{
            if(endA==1){document.write('<td>'+i+'</td>');}
            else{document.write('<td><a href="#" onClick="getR('+mth+''+i+');">'+i+'</a></td>');}
        }
        week++;
        if(week==7){
            document.write('</tr>');
            week=0;
        }
    }
    for(k=1;week!=0;k++){
        if (endA==1){document.write('<td class="cal_days_bef_aft">'+k+'</td>');}
        else{document.write('<td class="cal_days_bef_aft"><a href="#" onClick="getR('+mth+''+k+');">'+k+'</a></td>');}
        week++;
        if(week==7)
        {
            document.write('</tr>');
            week=0;
        }
    }
    document.write('</tbody></table>');
    opacity(document.getElementById('cal_body'),70);
    return true;
}

function readBody(xhr) {
    var data;
    if (!xhr.responseType || xhr.responseType === "text") {
        data = xhr.responseText;
    } else if (xhr.responseType === "document") {
        data = xhr.responseXML;
    } else {
        data = xhr.response;
    }
    //alert(data);
    var obj = JSON.parse(data);

    document.getElementById('a').innerHTML = '<b>'+obj['1']['nam']+'</b><br />Winning numbers  |  Machine numbers';
    document.getElementById('b').innerHTML = '<b>'+obj['2']['nam']+'</b><br />Winning numbers  |  Machine numbers';
    document.getElementById('c').innerHTML = '<b>'+obj['3']['nam']+'</b><br />Winning numbers  |  Machine numbers';

    document.getElementById('x').innerHTML = '<img width="20" height="20" src="images/numbers/' + obj['1']['num'].replace(/,/g, '.gif"/>&nbsp;<img width="20" height="20" src="images/numbers/') + '.gif"/>' + " | " + '<img width="20" height="20" src="images/numbers/' + obj['1']['mac'].replace(/,/g, '.gif"/>&nbsp;<img width="20" height="20" src="images/numbers/') + '.gif"/>';
    document.getElementById('y').innerHTML = '<img width="20" height="20" src="images/numbers/' + obj['2']['num'].replace(/,/g, '.gif"/>&nbsp;<img width="20" height="20" src="images/numbers/') + '.gif"/>' + " | " + '<img width="20" height="20" src="images/numbers/' + obj['2']['mac'].replace(/,/g, '.gif"/>&nbsp;<img width="20" height="20" src="images/numbers/') + '.gif"/>';
    document.getElementById('z').innerHTML = '<img width="20" height="20" src="images/numbers/' + obj['3']['num'].replace(/,/g, '.gif"/>&nbsp;<img width="20" height="20" src="images/numbers/') + '.gif"/>' + " | " + '<img width="20" height="20" src="images/numbers/' + obj['3']['mac'].replace(/,/g, '.gif"/>&nbsp;<img width="20" height="20" src="images/numbers/') + '.gif"/>';

    //document.getElementById('x').innerHTML = '|<img width="20" height="20" src="images/numbers/' + obj['1']['mac'].replace(/,/g, '.gif"/>&nbsp;<img width="20" height="20" src="images/numbers/') + '.gif"/>';
    //document.getElementById('y').innerHTML = '|<img width="20" height="20" src="images/numbers/' + obj['2']['mac'].replace(/,/g, '.gif"/>&nbsp;<img width="20" height="20" src="images/numbers/') + '.gif"/>';
    //document.getElementById('z').innerHTML = '|<img width="20" height="20" src="images/numbers/' + obj['3']['mac'].replace(/,/g, '.gif"/>&nbsp;<img width="20" height="20" src="images/numbers/') + '.gif"/>';
}

function getR(dy){
    var ddate = new Date();
    var month = ddate.getMonth();
    var year = ddate.getYear();
    if(month<10){month='0'+month;}else{month=''+month;}
    if(dy<10){month='0'+dy;}else{dy=''+dy;}
    if(year<=200){year += 1900;}

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            console.log(readBody(xhr));
        }
    }
    xhr.open('GET', 'http://www.lottoking.com.ng/admin/get.php?Dy='+dy, true);
    xhr.send(null);
    document.getElementById('xm').innerHTML = year +'-'+month+'-'+dy;
}