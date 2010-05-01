<?php
function transform2forest($rows, $idName, $pidName){
    $children = array(); // children of each ID
    $ids = array();
    foreach ($rows as $i=>$r){
        $row =& $rows[$i];
        $id = $row[$idName];
        $pid = $row[$pidName];
        $children[$pid][$id] =& $row;
        if (!isset($children[$id])) $children[$id] = array();
        $row['childNodes'] =& $children[$id];
        $ids[$row[$idName]] = true;
        }
    // Root elements are elements with non-found PIDs.
    $forest = array();
    foreach ($rows as $i=>$r){
        $row =& $rows[$i];
        if (!isset($ids[$row[$pidName]])) 
        {
                $forest[$row[$idName]] =& $row;
                }
        #unset($row[$idName]); unset($row[$pidName]);
        }
    return $forest;
}

?>