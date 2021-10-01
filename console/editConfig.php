<?php
if($_POST["host"] == null || $_POST["port"] == null || $_POST["pwd"] == null){
    header('Location: edit.html');
}
$file = fopen("config.php", 'w') or die("Impossible  d'ouvrir le fichier  de config! (lol)");
fwrite($file, "<?php\n");
fwrite($file, "\$rconHost = \"".$_POST['host']."\";\n");
fwrite($file, "\$rconPort = \"".$_POST['port']."\";\n");
fwrite($file, "\$rconPassword = \"".$_POST['pwd']."\";\n");
fwrite($file, "?>");
fclose($file);
echo '<br/>Written.<br/>Redirecting...';
?>
<script>
    window.location.replace('index.php');
</script>