<?

$filename = "url.txt";

if (file_exists($filename)) 
{
$optiondata = file_get_contents($filename);
$option = $optiondata;
}

if($_GET[s] == 1)
{
header('Location: '.$option);
}

?>
<script type="text/javascript">
<!--
if (window != window.top)
top.location.href = location.href;

window.location = "link.php?s=1"
//-->
</script>
<p>Click <a href="<? echo $option; ?>">here</a> to be redirected.</p>