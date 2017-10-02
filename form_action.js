/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */       
$(window).unload(function () {
$('#cstaff').val(29); 
$('#cequip').val(8)}); 
function add()
{
    var ctr = document.getElementById("cstaff").value;
    console.log("ctr:",ctr);
    ctr++;
    var name = "name" + ctr;
    console.log("name:",name);
    var number = "number" + ctr;
    console.log("no:",number);
    var cat = "cat" + ctr;
    console.log("cat:",cat);
    var newTr = '<tr><td><a class="btn" onclick="del(this)"><i class="fa fa-trash-o fa-lg"></i></a></td><td><input type="text" class="form-control" name="'+ name +'"/></td><td><input type="text" class="form-control" name="'+ number +'"/></td><td><select name="'+ cat +'" class="form-control"><option value="0">Staff</option><option value="1">Skilled1</option><option value="2">Skilled2</option><option value="3">Skilled/Unskilled</option></select></td></tr>';
    console.log("newtr:",newTr);
    $('#table1 > tbody:last-child').append(newTr);
    $('#cstaff').val(ctr);
}
function add2()
{
    var ctr2 = document.getElementById("cequip").value;
    console.log("ctr2:",ctr2);
    ctr2++;
    var name = "type" + ctr2;
    var number = "num" + ctr2;
    var cat = "hrs" + ctr2;
    var newTr = '<tr><td><a class="btn" onclick="del(this)"><i class="fa fa-trash-o fa-lg"></i></a></td><td><input type="text" class="form-control" name="'+ name +'"/></td><td><input type="text" class="form-control" name="'+ number +'"/></td><td><input type="text" class="form-control" name="'+ cat +'"/></td></tr>';
    console.log("newtr:",newTr);
    $('#table2 > tbody:last-child').append(newTr);
    $('#cequip').val(ctr2);
}
function add3()
{
    var ctr3=document.getElementById("cwo").value;
    ctr3++;
    var wo = "wo" + ctr3;
    var tn = "tn" + ctr3;
    var rf = "rf" + ctr3;
    var ag = "ag" + ctr3;
    var ug = "ug" + ctr3;
    var ow = "ow" + ctr3;
    var newTr = '<tr><td><a class="btn" onclick="del(this)"><i class="fa fa-trash-o fa-lg"></i></a></td><td><input type="text" name="'+ wo +'" class="form-control"/></td><td><input type="text" class="form-control" name="'+ tn +'"/></td><td><input type="text" class="form-control" name="'+ rf +'"/></td><td><input type="text" class="form-control" placeholder="AG" name="' + ag + '"/></td><td><input type="text" placeholder="UG" class="form-control" name="'+ ug +'"/></td><td><textarea row="5" cols="17" name="'+ ow +'"></textarea></td></tr>';
    $('#table3 > tbody:last-child').append(newTr);
    $('#cwo').val(ctr3);
}
