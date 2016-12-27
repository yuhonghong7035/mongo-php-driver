--TEST--
DateTime: negative
--XFAIL--
Depends on CDRIVER-1962
--DESCRIPTION--
Generated by scripts/convert-bson-corpus-tests.php

DO NOT EDIT THIS FILE
--FILE--
<?php

require_once __DIR__ . '/../utils/tools.php';

$bson = hex2bin('10000000096100C43CE7B9BDFFFFFF00');

// BSON to Canonical BSON
echo bin2hex(fromPHP(toPHP($bson))), "\n";

// BSON to Canonical extJSON
echo json_canonicalize(toJSON($bson)), "\n";

$json = '{"a" : {"$date" : "1960-12-24T12:15:30.500Z"}}';

// extJSON to Canonical extJSON
echo json_canonicalize(toJSON(fromJSON($json))), "\n";

$canonicalJson = '{"a" : {"$date" : {"$numberLong" : "-284643869500"}}}';

// Canonical extJSON to Canonical extJSON
echo json_canonicalize(toJSON(fromJSON($canonicalJson))), "\n";

// extJSON to Canonical BSON
echo bin2hex(fromJSON($json)), "\n";

// Canonical extJSON to Canonical BSON
echo bin2hex(fromJSON($canonicalJson)), "\n";

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
10000000096100c43ce7b9bdffffff00
{"a":{"$date":{"$numberLong":"-284643869500"}}}
{"a":{"$date":{"$numberLong":"-284643869500"}}}
{"a":{"$date":{"$numberLong":"-284643869500"}}}
10000000096100c43ce7b9bdffffff00
10000000096100c43ce7b9bdffffff00
===DONE===