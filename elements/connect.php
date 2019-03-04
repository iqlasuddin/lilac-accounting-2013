<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$dbhost='localhost';

$dbuser='root'; $dbpass='';
$dbname='db_accounts_lilac';
$conn  = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error connecting to database. Please try again');
mysql_select_db($dbname);
date_default_timezone_set('Asia/Qatar');

//FUNCTION TO CHECK LOGIN
function check_login()
{
    session_start();
    if (!isset($_SESSION['uname'])) {
        header('location:login?id=Please Login first');
    }
}

//FUNCTION TO AUTHORISE USER
function login_authorize($uname, $password)
{
    if (!isset($_SESSION)) {
        session_start();
    }
    $loginqur="SELECT * FROM tbllogin WHERE u_email='$uname' and password='$password' and u_status=1";
    $runlogin=mysql_query($loginqur);

    $count   =mysql_num_rows($runlogin);
    $ranlogin=mysql_fetch_array($runlogin);
    $new_usr =$ranlogin['new'];
    if ($count == 1) {
        $_SESSION['uname'] =$uname;
        $_SESSION['logged']=$uname;
        if ($new_usr == 1) {
            //header('location:global-settings.php');
        } else {
            header('location:index');
        }
    } else {
        header('location:login?id=Wrong Username or Password');
    }
}

//FUNCTION LOGOUT
function user_logout()
{
    session_start();
    session_destroy();
    header('Location:login?id=Successfully Logged out');
}

//FUNCTION TO GET INVOICE NUMBER
function get_invoice_id()
{
    $query          =mysql_query("SELECT MAX(inv_id) as 'inv_id' FROM tblinvoice_direct");
    $curr_invoice_no=60000;
    if (mysql_num_rows($query) >= 0) {
        // while($rows=mysql_fetch_array($query))
        //{
        $rows           =mysql_fetch_array($query);
        $curr_invoice_no=$rows['inv_id'];
        //}
        return $curr_invoice_no + 1;
        // return $curr_invoice_no + 1;
    }
}

//FUNCTION TO GET INSTANT REC NUMBER
function get_instant_rec_no()
{
    $query          =mysql_query("SELECT MAX(instrec_no) as 'instrec_no' from tbl_instrec");
    $curr_instrec_no=4000;
    if (mysql_num_rows($query) >= 0) {
        //while($rows=mysql_fetch_array($query))
        // {
        $rows           =mysql_fetch_array($query);
        $curr_instrec_no=$rows['instrec_no'];
        // }
        return $curr_instrec_no + 1;
        // return $curr_invoice_no + 1;
    }
}

function getstamp()
{
    $timezone = new DateTimeZone('Asia/Riyadh');
    $date     = new DateTime();
    $date->setTimezone($timezone);
    $stamp = $date->format('d' . 'm' . 'y' . 'H' . 'i' . 's');

    return $stamp;
}

function prepare_query($array=[])
{
    $q=' ';
    foreach ($array as $column => $value) {
        $q .= $column . "='" . $value . "' ";
    }

    return $q;
}

function check_license()
{
    $datetime1              = new DateTime('2020-03-28 12:00:00');
    $_SESSION['expiry_date']=$datetime1;
    $datetime2              = new DateTime();
    $interval               = $datetime2->diff($datetime1);

    return $daysleft=str_replace('+', '', $interval->format('%R%a'));
}

function validate_license()
{
    $daysleft=check_license();
    if ($daysleft <= 0) {
        header('location:license-expired');
    }
}

function convert_number_to_words($number)
{
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = [
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    ];

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );

        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string    = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit     = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder    = $number % $baseUnit;
            $string       = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = [];
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
