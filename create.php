<?php
    session_start();
    include "db_conn.php";
    $erp = "";$email ="";$bio ="";$internet ="";$infras = "";
    
    $error = "";
    
    $id = "";$date = "";$requestedBy = "";$reqfor="";$dept ="";$loc = "";$contact = "";$audited = "PENDING";$status = "PENDING";$type = "";$soft_replacement = "";$hard_replacement = "";$oldHardName = "";$oldHardModel = "";$oldHardSerial = "";$oldhTagNum = "";$oldHardCond = "";$newHardName = "";$newHardSerial = "";$newHardModel = "";$newHardCond = "";$softReqType = "";$oldSoftModel = "";$oldSoftSerial = "";$oldSoftCond = "";$newSoftName = "";$newSoftModel = "";$newSoftSerial = "";$newSoftCond = "";$implementedby = "";$auditedby = "";$empcode="";$reqsites="";
    
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        /*$erp = isset($_POST["erp"]) ? $_POST["erp"]:'';$email = isset($_POST["email"])? $_POST["email"]:'';$bio = isset($_POST["bio"])? $_POST["bio"]:'';$internet = isset($_POST["internet"])? $_POST["internet"]:'';$infras = isset($_POST["infras"])? $_POST["infras"]:'';*/

        $datetime = new DateTime("now", new DateTimeZone('UTC'));
        $datetime->setTimezone(new DateTimeZone('Africa/Accra'));
        $date = $datetime->format('Y-m-d H:i:s');

        function clean($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $requestedBy = clean($_SESSION['name']);$reqfor = clean($_POST['reqfor']);$dept = clean($_POST["dep"]);$loc = clean($_POST["loc"]);$contact = clean($_POST["con"]);$type = clean($_POST['type']);$hard_replacement = isset($_POST['oldhrepl']) ? $_POST['oldhrepl'] :'';$oldHardName = clean($_POST['oldhname']);$oldHardModel = clean($_POST['oldhmod']);$oldHardSerial = clean($_POST['oldhser']);$oldhTagNum = clean($_POST['oldhardtag']);$oldHardCond = clean($_POST['oldhcond']);$hardReason = clean($_POST['oldhreason']);$newHardName = clean($_POST['newhname']);$newSoftName = clean($_POST['newsname']);$softReqType = clean($_POST['stype']);
        $userid = $_SESSION['userid'];$empcode=clean($_POST['empcode']);$reqsites=clean($_POST['reqsites']);

        //sleep(3);

        if(isset($_POST['tab']))
        {
            $table = $_POST['tab'];
            $sql = "";

            foreach($table as $tab)
            {
                if($tab == 'erp')
                {
                    $sql = "INSERT INTO erp (Requestedby,ReqFor, Department, Location, Date,
                    Contact,Userid, Status, Audited,Implementedby,Auditedby,data_base,EmpCode) 
                    VALUES ('$requestedBy','$reqfor','$dept','$loc', '$date','$contact','$userid', '$status', '$audited','$implementedby','$auditedby','erp','$empcode')";

                    $key = array_search($tab, $table);
                    unset($table[$key]);
                    
                    
                }elseif($tab == 'email')
                {
                    $sql = "INSERT INTO email (Requestedby,ReqFor, Department, Location, 
                    Date, Contact,Userid,Status, Audited,Implementedby,Auditedby,data_base,EmpCode) 
                    VALUES ('$requestedBy','$reqfor','$dept','$loc', '$date','$contact','$userid', 
                    '$status', '$audited','$implementedby','$auditedby','email','$empcode')";
                    $key = array_search($tab, $table);
                    unset($table[$key]);
                    
                }elseif($tab == 'biometric')
                {
                    $sql = "INSERT INTO biometric (Requestedby,ReqFor, Department, Location, Date, Contact,Userid, Status, Audited,Implementedby,Auditedby,data_base,EmpCode) 
                    VALUES ('$requestedBy','$reqfor','$dept','$loc', '$date','$contact','$userid', '$status', '$audited','$implementedby','$auditedby','biometric','$empcode')";
                    $key = array_search($tab, $table);
                    unset($table[$key]);
                    
                }elseif($tab == 'internet')
                {
                    
                    $sql = "INSERT INTO internet (Requestedby,ReqFor, Department, Location, Date, Contact,Userid, Status, Audited,Implementedby,Auditedby,data_base,EmpCode,ReqSites) 
                    VALUES ('$requestedBy','$reqfor','$dept','$loc','$date','$contact','$userid','$status', '$audited','$implementedby','$auditedby','internet','$empcode','$reqsites')";
                    $key = array_search($tab, $table);
                    unset($table[$key]);
                    
                }elseif($tab == 'infrastructure')
                {
                    if($type == 'SOFTWARE'){
                        $sql = "INSERT INTO infrastructure (Requestedby,ReqFor, Department, Location, Date, Contact,Userid,Type,NewSoftName,SoftReqType,Status, Audited,Implementedby,Auditedby,data_base,EmpCode) 
                        VALUES ('$requestedBy','$reqfor','$dept','$loc','$date','$contact','$userid','$type','$newSoftName','$softReqType','$status', '$audited','$implementedby','$auditedby','infrastructure','$empcode')";
                    }else{
                        $sql = "INSERT INTO infrastructure (Requestedby,ReqFor, Department, Location, Date, Contact,Userid,Type,OldHardName,OldHardSerial,OldHardModel,OldHardCond,
                        HardReasonRep,HardReplacement,NewHardName,OldTagNumber,Status, Audited,Implementedby,Auditedby,data_base,EmpCode) 
                        VALUES ('$requestedBy','$reqfor','$dept','$loc','$date','$contact','$userid','$type','$oldHardName','$oldHardSerial','$oldHardModel','$oldHardCond','$hardReason','$hard_replacement','$newHardName','$oldhTagNum','$status', '$audited','$implementedby','$auditedby','infrastructure','$empcode')";
                    }
                    
                    $key = array_search($tab, $table);
                    unset($table[$key]);
                }
    
                
                if(isset($sql))
                {
                    $result = $conn->query($sql);
                    
                }
                
            }

            if(empty($table)){

                header('Location: home.php');
                exit;
            }
            
        }else{
            echo "<script> alert('Select at least one request type') </script>";
        }
        
    }
?>