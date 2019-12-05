<?php
define("TI_EXTENDED_MARK", "{[{[TI_EXTENDED_MARK]}]}]}");

$_TI=["extend"=>false];
function ti_extend($viewname) {
    global $_TI;
    $_TI["extend"] = $viewname;
}

function ti_start_block($name) {
    global $_TI;
    $_TI["actual_block_name"] = $name;
    ob_start();
}

function ti_get_extended_block() {
    global $_TI;
    echo TI_EXTENDED_MARK;
}

function ti_end_block() {
    global $_TI;
    
    $buff = ob_get_clean();
    if ($_TI["extend"]) {
        $_TI["blocks"][$_TI["actual_block_name"]] = $buff;
    } else {
        if (isset($_TI["blocks"][$_TI["actual_block_name"]])) {
            $block = $_TI["blocks"][$_TI["actual_block_name"]];
            echo str_replace(TI_EXTENDED_MARK, $buff, $block);
        } else {
            echo $buff;
        }
    }
}

function ti_end_extend() {
    global $_TI;
    $viewname=$_TI["extend"];
    $_TI["extend"]=false;
    ob_start();
    require $viewname;
    echo ob_get_clean();
}
