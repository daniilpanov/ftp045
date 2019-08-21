<?php

//require_once "head.php";

if (!$_POST || !$_POST['page'] || !$_POST['page']['content'])
{
    return false;
}

print($_POST['page']['content']);
?>
<script>
    changeTitle('<?=$_POST['page']['title']?>');
</script>
