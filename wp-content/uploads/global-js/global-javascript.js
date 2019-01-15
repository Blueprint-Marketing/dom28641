function printFunc() {
    var divToPrint = document.getElementById('DivIdToPrint');
    var newWin = window.open('', 'Print-Window');
    newWin.document.open();
      var htmlToPrint = '' +
        '<style type="text/css">' +
        'table th, table td {' +
        'border:1px solid #000;' +
        'padding;0.5em;' +
        '}' +
        '</style>';
 newWin.document.write('<html><body onload="window.print();">'+htmlToPrint+'<link rel="stylesheet" href="https://foodhandlersolutions.com/wp-content/themes/sparkling/print.css" type="text/css" media="print" />' + divToPrint.innerHTML + '</body></html>');
    newWin.document.close();
    setTimeout(function() {
        newWin.close()
    }, 10)
    }


function scaleItTo()
{
var a = document.getElementById("DivIdToPrint");
sx = 1.0;
sy = prompt("Scale To", 1.5);
if (sy != '')
if (sy != null)
{
if (validateFloat(sy) == false)
sy = 1.0;
a.setAttribute("transform", "scale(" + sx + "," + sy + ")")
}
}
function scaleIt(scaleTo)
{
var a = document.getElementById("diagram");
sx = 1.0;
//sy = prompt("Scale To", 1.5);
sy = scaleTo;
if (sy != '')
if (sy != null)
{
if (validateFloat(sy) == false)
sy = 1.0;
a.setAttribute("transform", "scale(" + sx + "," + sy + ")")
}
}
function validateFloat(iString)
{
// no leading 0s allowed
return (("" + parseFloat(iString)) == iString);
}
function printOut()
{
// Note: Changed the "window.print()" to "print()" on 3/29/2004 due to
// bug in IE6 running under Win 2000 - CM

var maxY = <%= yc %>;
// var tst = new Boolean(window.print);
// alert ("Value of 'window.print' is: '" + tst.toString() + "'...");
if (maxY > 755) // a little less than 768
{
var scaleTo = 755/maxY;
var scalePerCent = scaleTo*100;
scalePerCent = scalePerCent.toFixed(0);
var msg = "This SVG cannot be printed in one page.n" +
"It is being scaled down to " + scalePerCent + "%.";
alert(msg);
scaleIt(scaleTo);
// window.print();
top.SetPrintProperties();
print();
}
else
{
// window.print();
top.SetPrintProperties();
print();
}
}



