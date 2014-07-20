<?php


session_start();
$_SESSION['isLoggedIn'] = true;
$_SESSION["moxiemanager.amazons3.buckets.scapi-dev.publickey"] = "AKIAIZZMIPSFLUSUJEKQ";
$_SESSION["moxiemanager.amazons3.buckets.scapi-dev.secretkey"] = "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";

$curlHeaderArray = array("SCAPI_AUTH_TOKEN: bac44f0517415a56043c20261a9916feb87e092dd9fdb35118707e70876510cb");


// develop
if (dirname($_SERVER["PHP_SELF"]) === '/simcommand-dev') {
 $urlroot="https://ganasa.com/scapi-dev";

 $_SESSION["moxiemanager.amazons3.buckets.scapi-dev.urlprefix"] = "https://scapi-dev.s3.amazonaws.com";
 $_SESSION["moxiemanager.filesystem.rootpath"] = "s3://scapi-dev";
}


// production
if (dirname($_SERVER["PHP_SELF"]) === '/simcommand') {
 $urlroot="https://ganasa.com/scapi";

 $_SESSION["moxiemanager.amazons3.buckets.scapi-dev.urlprefix"] = "https://scapi-pro.s3.amazonaws.com";
 $_SESSION["moxiemanager.filesystem.rootpath"] = "s3://scapi-pro";
}


// MFM
if (dirname($_SERVER["PHP_SELF"]) === '/simcommand-mfm') {
 $urlroot="https://ganasa.com/scapi-mfm";

 $_SESSION["moxiemanager.amazons3.buckets.scapi-dev.urlprefix"] = "https://scapi-mfm.s3.amazonaws.com";
 $_SESSION["moxiemanager.filesystem.rootpath"] = "s3://scapi-mfm";
}

var_dump($urlroot);
exit(1);


?>
