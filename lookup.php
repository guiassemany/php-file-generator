<?php

$sql = "SELECT * FROM Assemanyjhgut";
sc_lookup(rs, $sql);
if(!isset($rs[0][0])){
  $teste = "ahhaha";
}
