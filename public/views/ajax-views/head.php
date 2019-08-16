<?php

define("HOMEDIR", "../../../");

require_once "../../../config/loading.php";

use loading as l;

l\configurepaths(HOMEDIR);

define("PATHS", (l\loadconfig("paths")));

l\loadconfig("autoload");