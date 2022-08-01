<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    let usersArr = [
        {username: 'Jan Kowalski', birthYear: 1983, salary: 4200},
        {username: 'Anna Nowak', birthYear: 1994, salary: 7500},
        {username: 'Jakub Jakubowski', birthYear: 1985, salary: 18000},
        {username: 'Piotr Kozak', birthYear: 2000, salary: 4999},
        {username: 'Marek Sinica', birthYear: 1989, salary: 7200},
        {username: 'Kamila Wiśniewska', birthYear: 1972, salary: 6800},
    ];

    $(document).ready(function() {
        welcomeUsers(usersArr);

        $('#data').change(function(){
            if($('#data').val != ''){
                $('#send').removeAttr('disabled');
            }else{
                $('#send').attr('disabled');
            }
        });

    });

    function welcomeUsers(data){
        let year = new Date().getFullYear();

        $.each(data, function (index, value) {
            if (value.salary > 15000){
                console.log('Witaj, prezesie!');
                return;
            }
            if(value.salary < 5000){
                console.log( value.username+', szykuj się na podwyżkę!');
                return;
            }

            let age = year - value.birthYear;
            if(age % 2 == 0){
                console.log('Witaj, '+value.username+'! W tym roku kończysz '+age+' lat!');
            }else{
                console.log(value.username+', jesteś zwolniony!');
            }
        });
    }
</script>
<form method="post" action="#">
    <select name="action">
        <option value="convertToNumeric">convertToNumeric</option>
        <option value="convertToString">convertToString</option>
    </select><br><br>
    <input type="text" name="data" id="data">
    <input type="submit" id="send" value="Submit">
</form>

<?php
include('PhoneKeyboardConverter.php');
$converter = new PhoneKeyboardConverter();

if (!isset($_SESSION)) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && filter_input(INPUT_POST, 'action') && filter_input(INPUT_POST, 'data')) {
    $_SESSION['postdata'] = $_POST;
    unset($_POST);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}
if(isset($_SESSION['postdata'])){
    echo $converter->checkType($_SESSION['postdata']);
}
if (array_key_exists('postdata', $_SESSION)) {
    unset($_SESSION['postdata']);
}

