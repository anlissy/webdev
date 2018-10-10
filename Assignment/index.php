<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
     * {
        font-family: sans-serif;
        font-size: 16px; 
        line-height: 1.5;
        }
     div {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
        margin: auto;
        padding-left: 150px;
        }
        
        </style>
    </head>
    <body>
        <div>
        <?php
        $watestdb = new PDO('mysql:host=127.0.0.1:8889;dbname=PersonRegister', 'WATestUser1', 'WATestPwd1');
        print "Person's name: ".htmlspecialchars($_POST["name"]).". <BR>"; // Job title: ".htmlspecialchars($_POST["title"]).". Working dates: ".htmlspecialchars($_POST["startdate"])." - ".htmlspecialchars($_POST["enddate"])." - ";
        
        // insert persons name
        $insert = $watestdb->prepare("insert into People (name) values (:name)");
        $insert->bindValue(":name", $_POST["name"]);
        $insert->execute();

        // get persons id
        $sql = "SELECT id FROM People WHERE name = '". $_POST["name"]."'";
        $result = $watestdb->query($sql);
        for ($i = 0; $i < $result->rowCount(); $i++)
        {
        $row = $result->fetch();
        $personid = $row["id"];
        }
        $result->closeCursor();

        //print " id is ".$personid;
        
        // insert persons job
        print " Person's job title: ".htmlspecialchars($_POST["title"]).".<BR>" ; 
        print " Start date of person's job: ".htmlspecialchars($_POST["startdate"]).".<BR>" ; 
        print " End date of person's job: ".htmlspecialchars($_POST["enddate"]).".<BR>" ; 
        $insert = $watestdb->prepare("insert into Jobs (personid,startdate, enddate, title) values (:personid, :startdate, :enddate, :title )");
        $insert->bindValue(":personid", $personid);
        $insert->bindValue(":startdate", $_POST["startdate"]);
        $insert->bindValue(":enddate", $_POST["enddate"]);
        $insert->bindValue(":title", $_POST["title"]);
        $insert->execute();
        
        
        print " Person's mother name: ".htmlspecialchars($_POST["mothername"]).".<BR>" ; 
        $insert = $watestdb->prepare("insert into people (name) values (:name)"); 
        $insert->bindValue(":name", $_POST["mothername"]); 
        $insert->execute(); 

        $sql = "SELECT id FROM People WHERE name = '". $_POST["mothername"]."'"; 
        $result = $watestdb->query($sql); 
        for ($i = 0; $i < $result->rowCount(); $i++) 
        { 
        $row = $result->fetch(); 
        $motherid = $row["id"]; 
        } 
        $result->closeCursor(); 
      
        print " Person's father name: ".htmlspecialchars($_POST["fathername"]).".<BR>" ; 
        $insert = $watestdb->prepare("insert into people (name) values (:name)"); 
        $insert->bindValue(":name", $_POST["fathername"]); 
        $insert->execute(); 

        $sql = "SELECT id FROM People WHERE name = '". $_POST["fathername"]."'"; 
        $result = $watestdb->query($sql); 
        for ($i = 0; $i < $result->rowCount(); $i++) 
        { 
        $row = $result->fetch(); 
        $fatherid = $row["id"]; 
        } 
        $result->closeCursor(); 
       
        

        $insert = $watestdb->prepare("insert into Child (childid,motherid,fatherid) values (:personid, :motherid, :fatherid)"); 
        $insert->bindValue(":personid", $personid); 
        $insert->bindValue(":motherid", $motherid); 
        $insert->bindValue(":fatherid", $fatherid); 
        $insert->execute(); 
        $insert=NULL;


        
        ?>
            </div>
    </body>
</html>
