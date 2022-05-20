<?php
require './c.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
    <style>
        *{
            margin: 0 ;
            padding: 0;
        }
        body{
            display: flex;
            flex-direction: column;
            padding: 30px;
            font-family: "Lato", sans-serif;
        }
        textarea{
            margin: 20px auto;
            width: 100%;
            height: 30vh;
            border: 2px black solid;
            padding: 10px;
            font-size: 18px;
            box-sizing: border-box;
            font-family: "Lato", sans-serif;
            resize: none;
        }
        button{
            padding: 10px ;
            font-weight: bold;
            width: 100%;
        }
        iframe{
            margin: 10px auto;
            width: 100%;
            height: 30vh;
            border: 2px black solid;
            font-family: "Lato", sans-serif;
            
        }
        input{
            margin: 20px auto;
            font-size: 16px;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        img{
            position: absolute;
            right: 50px;
            bottom: 30%;
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body onload="run()">
<?php

    if(IsAuthenticated()) {
        ?>

<form id='form' action='' method='post'>
    <textarea id="textarea" name="code" cols="30" rows="10"></textarea>
    <button>RUN</button>
    <input type="text" name="param" id="input" placeholder="Params">
</form>    
<img src="https://cdn0.iconfinder.com/data/icons/ui-glyph-1/100/ui-g-external_link-512.png" alt="k" onclick="j()">
<iframe id="iframe" frameborder="1"></iframe>

<?php

}else{

}
?>
</body>
<?php

    $param = "";
    $code = "";
    if (!file_exists("result.php")) {
        $fh = fopen("result.php", 'w');
        fclose($fh);
    } 

    if(isset( $_POST['param']) || isset( $_POST['code'])){

        $param = $_POST['param'];
        $code =  $_POST['code'];


        if($code==""){
            $code = "<?php require './c.php';?> \n<?php \necho 'Hello'; \n?>";
        }else{
            $code = "<?php require './c.php';?> \n".$_POST['code'];
        }

        $myFile = "result.php";
        $fh = fopen($myFile, 'w') or die("can't open file");
        fwrite($fh, $code);
        fclose($fh);
   }
?>


<script>
    function run(){
        var code = decodeURIComponent(`<?php print_r( rawurlencode(preg_replace('/^.+\n/', '',  file_get_contents("./result.php")))); ?>`);
        var param = decodeURIComponent(`<?php print_r( rawurlencode($param)); ?>`);

        document.getElementById("textarea").value = code;
        document.getElementById("input").value = param;

        document.getElementById("iframe").src = "./result.php" + param;
    }
    function j(){
        window.open(document.getElementById("iframe").src, '_blank');
    }

</script>
</html>
