<?php
class Strings
{
    static function fix_string( $a )
    {
        echo
            xdebug_call_class( 1 ).
            "::".
            xdebug_call_function( 1 ).
            " is called at ".
            xdebug_call_file( 1 ).
            ":".
            xdebug_call_line( 1 );
    }
}

$ret = Strings::fix_string( 'Derick' );
?>


<!---->
<!---->
<?php
//$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
//
//echo json_encode($arr);
//echo json_encode($arr);
//xdebug_enable();
//xdebug_var_dump($arr).
//xdebug_break();
//?>
