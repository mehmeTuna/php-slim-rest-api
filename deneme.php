<?php
$val = ["MEhmet" , "Tuna"];

if(is_array ($val)){
    foreach ($val as $result){
        echo $result . "<br>";
    }
}else {
    echo "array değil";
}