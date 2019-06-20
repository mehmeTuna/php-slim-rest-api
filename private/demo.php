<?php

?>


<!DOCTYPE html>
<html lang="tr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

  <script src="http://localhost:81/private/pdf/new/print.js" charset="utf-8"></script>
  <link rel="stylesheet" href="http://localhost:81/private/pdf/new/print.css">

  <!-- <script src="pdf/Print.js-1.0.61/src/js/print.js"></script> --->


  </head>
  <body>
    <button type="button" onclick="yazdir()">
	Tikla
</button>

<table id='ornek_table'>
  <tr>
    <th>Company</th>
    <th>Contact</th>
    <th>Country</th>
  </tr>
  <tr>
    <td>Alfreds Futterkiste</td>
    <td>Maria Anders</td>
    <td>Germany</td>
  </tr>
  <tr>
    <td>Centro comercial Moctezuma</td>
    <td>Francisco Chang</td>
    <td>Mexico</td>
  </tr>
  <tr>
    <td>Ernst Handel</td>
    <td>Roland Mendel</td>
    <td>Austria</td>
  </tr>
  <tr>
    <td>Island Trading</td>
    <td>Helen Bennett</td>
    <td>UK</td>
  </tr>
  <tr>
    <td>Laughing Bacchus Winecellars</td>
    <td>Yoshi Tannamuri</td>
    <td>Canada</td>
  </tr>
  <tr>
    <td>Magazzini Alimentari Riuniti</td>
    <td>Giovanni Rovelli</td>
    <td>Italy</td>
  </tr>
</table>

<script type="text/javascript">
  function yazdir(){
    printJS({
		printable: 'ornek_table',//yazdiralacak html kismin idsi
		type: 'html', // html icin type:'html' olmali
		header: '<h3 class="custom-h3">Kendi header kismim</h3>', // header belirtir
		htmlStyle: '.custom-h3 { color: red;backgroundColor: rgb(0,255,0);margin-top:300px}' ,
    headerStyle: 'font-weight: 600;' ,//hedaer style icin kullanilir
    maxWidth : 50 ,//max sayfa genisligi
    targetStyles: ['*'] ,
    documentTitle: 'dosya_ismi' , // kullanici dosya kaydetmek isterse bu isimle kaydedecektir
	  })
  }
</script>

  </body>
</html>
