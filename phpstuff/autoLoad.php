<?php 

function __autoLoad($class)
{
  if(file_exists("..\phpstuff\ADO\\$class.class.php"))
    include_once "..\phpstuff\ADO\\$class.class.php";
  else if(file_exists("..\phpstuff\ADO\log\\$class.class.php"))
    include_once "..\phpstuff\ADO\log\\$class.class.php";
  else if(file_exists("..\phpstuff\ADO\dataBase\\$class.class.php")) 
    include_once "..\phpstuff\ADO\dataBase\\$class.class.php";
  
  else if(file_exists("phpstuff\ADO\dataBase\\$class.class.php")) 
    include_once "phpstuff\ADO\dataBase\\$class.class.php";
  else if(file_exists("phpstuff\ADO\\$class.class.php"))
    include_once "phpstuff\ADO\\$class.class.php";
  
}



?> 