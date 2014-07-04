<?php

$url = 'http://rocky-brushlands-8739.herokuapp.com/rates';
$content = file_get_contents($url);
$json = $curencies = json_decode($content, true);

    echo 'Available Currency codes: <br />';
    echo '<ul>';
	foreach($json as $j){
            echo '<li>'.$j['code'].'</li>';
	}
    echo '</ul>';
    
    
    
// Function set    

//
function convert_any_curency($from, $to, $amt)
{
    return $from / $to * $amt;
}

//
function get_rate_by_code($code, $curencies = array())
{
    foreach($curencies as $curency)
    {
        if(in_array($code, $curency))
        {
            return $curency['rate'];
        }
    }
}
//
function check_code($code, $curencies = array())
{
    foreach($curencies as $curency)
    {
        if(in_array($code, $curency))
        {
            return true;
        }
        else {
            continue;
        }
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Currency Conversion</title>
  </head>
  <body>
    <h1>Currency Conversion</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

  <label for="text_val">Enter string (e.g. 'CONVERT 3 EUR to USD'):</label>
  <input type="text" name="text_val" value="" size="100" />

  <input type="submit" name="action" value="Submit" />

</form>
    <?php
        if(isset($_POST['action'])) 
        { 
            $pieces = explode(" ", $_POST['text_val']);
            
            if(count($pieces) === 5 )
            {
                $convert = $pieces[0];
                $how = (is_numeric($pieces[1])) ? $pieces[1]:'(this string '.$pieces[1].' is not numeric)';
                $from = (check_code($pieces[2], $curencies)) ? $pieces[2]:'(this '.$pieces[2].' is not curency code available)';
                $to = (check_code($pieces[4], $curencies)) ? $pieces[4]:'(this '.$pieces[4].' is not curency code available)';
                echo '<br />'.$convert.' '.$how.' '.$from.' to '.$to.':  '.convert_any_curency(get_rate_by_code($to, $curencies), get_rate_by_code($from, $curencies), $how);
            } else {
                echo 'String format is NOT VALID!';
            }
        }
    ?>
  </body>
</html>


