<?php
if(@$_POST['add'])
{
    function add()
    {
        $a="You clicked on add fun";
        echo $a;
    }
    add();
}
else if (@$_POST['sub'])
{
    function sub()
    {
        $a="You clicked on sub funn";
        echo $a;
    }
    sub();
}
?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

    <input type="submit" name="delete_1" Value="Call Add fun">
    <input type="submit" name="delete_2" Value="Call Sub funn">
    <?php echo @$a; ?>

</form>