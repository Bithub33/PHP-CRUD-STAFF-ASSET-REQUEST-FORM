<?php
    session_start();
    header("Cache-Control: no-store,no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Expires: 0");
    include "db_conn.php";
    $erp = "";$email ="";$bio ="";$internet ="";$infras = "";
    
    $error = "";$table ="";$type = "";$srepl="";
    
    $id = "";$dat = "";$reqFor = "";$dept ="";$loc = "";$contact = "";$audited = "PENDING";$status = "PENDING";$type = "";$soft_replacement = "";$hrepl = "";$oldHardName = "";$oldHardModel = "";$oldHardSerial = "";$oldTagNum = "";$oldHardCond = "";$newHardName = "";$newHardSerial = "";$newHardModel = "";$newHardCond = "";$softreqtype = "";$oldSoftModel = "";$oldSoftSerial = "";$oldSoftCond = "";$newSoftName = "";$newSoftModel = "";$newSoftSerial = "";$newSoftCond = "";$implementedby = "";$auditedby = "";$sres="";$hres="";$date="";$emailimprem="";$intimprem="";$bioimprem="";$softimprem="";$hardimprem="";$empcode="";$newImpHardName="";$pg="";$reqsites="";$audrem="";$audStatus="";$erpimprem="";$erpname="";


    if($_SERVER['REQUEST_METHOD'] == "GET")
    {
        if(isset($_GET['id']) && isset($_GET['type']))
        {
            $id = $_GET['id'];
            $table = strtolower($_GET['type']);
            $pg = $_GET['page'];
            
            $sql = "SELECT * FROM $table WHERE Ticketid='$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

            if($row)
            {
                $reqFor = $row['ReqFor'];
                $dat = $row['Date'];
                $date = date('Y-m-d', strtotime($dat));
                $dept = $row['Department'];
                $loc = $row['Location'];
                $contact = $row['Contact'];
                $status = $row['Status'];
                $empcode = $row['EmpCode'];
                if($table == 'infrastructure')
                {
                    $type = $row['Type'];
                    $srepl = $row['SoftReplacement'];
                    $hrepl = $row['HardReplacement'];
                    $oldHardName = $row['OldHardName'];$oldHardModel = $row['OldHardModel'];$oldHardSerial = $row['OldHardSerial'];$oldHardCond = $row['OldHardCond'];$softreqtype = $row['SoftReqType'];$oldSoftModel = $row['OldSoftModel'];$oldSoftSerial = $row['OldSoftSerial'];$oldSoftCond = $row['OldSoftCond'];$newHardName = $row['NewHardName'];$newHardModel = $row['NewHardModel'];$newHardSerial = $row['NewHardSerial'];$newHardCond = $row['NewHardCond'];$oldHardName = $row['OldHardName'];$newSoftName = $row['NewSoftName'];$newSoftModel = $row['NewSoftModel'];$newSoftSerial = $row['NewSoftSerial'];$newImpHardName = $row['NewImpHardName'];$oldTagNum = $row['OldTagNumber'];$hres = $row['HardReasonRep'];$softimprem = $row['ImpRem'];$audrem = $row['AudRem'];$audStatus = $row['Audited'];$hardimprem = $row['ImpRem'];
                }
                if($table == 'email')
                {
                    $email = $row['Email'];$emailimprem = $row['ImpRem'];$audrem = $row['AudRem'];$audStatus = $row['Audited'];
                }

                if($table == 'internet')
                {
                    $sites = $row['Sites'];$intimprem = $row['ImpRem'];$reqsites = $row['ReqSites'];$audrem = $row['AudRem'];$audStatus = $row['Audited'];
                }

                if($table == 'erp')
                {
                    $erpname = $row['ErpUsername'];$erppass = $row['ErpPassword'];$erprole = $row['ErpRole'];$erpshop = $row['ErpShop'];$erpimprem= $row['ImpRem'];$audrem = $row['AudRem'];$audStatus = $row['Audited'];
                }

                if($table == 'biometric')
                {
                    $bioimprem = $row['ImpRem'];$audrem = $row['AudRem'];$audStatus = $row['Audited'];
                }

            }

        }
    }else{

        function clean($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $id=clean($_POST['id']);$table=clean($_POST['table']);$name=$_SESSION['name'];$pg=$_POST['pg'];$type=clean($_POST['type']);


        $datetime = new DateTime("now", new DateTimeZone('UTC'));
        $datetime->setTimezone(new DateTimeZone('Africa/Accra'));
        $date = $datetime->format('Y-m-d H:i:s');


        do{
            if(isset($_POST['action']) && $_POST['action'] === 'approve')
            {
                if($table == 'erp')
                {
                    $erpusername=clean($_POST['erpid']);$erppass=clean($_POST['erppass']);$erprole=clean($_POST['erprole']);$erpshop=clean($_POST['erpshop']);$erpimprem=clean($_POST['erpimprem']);

                    $sql = "UPDATE $table SET Status='APPROVED', ErpUsername='$erpusername',ErpPassword='$erppass',ErpRole='$erprole',ErpShop='$erpshop', Implementedby='$name',ImpDate='$date', ImpRem='$erpimprem' WHERE Ticketid='$id'";

                    $result = $conn->query($sql);
                    if($result)
                    {
                        header("Location: home.php?page=$pg");
                        exit;
                    }
                }

                if($table == 'email')
                {
                    $email=clean($_POST['emailadd']); $imp=clean($_POST['emailimprem']);

                    $sql = "UPDATE $table SET Status='APPROVED',Email='$email', Implementedby='$name',ImpRem='$imp',ImpDate='$date' WHERE Ticketid='$id'";

                    $result = $conn->query($sql);
                    if($result)
                    {
                        header("Location: home.php?page=$pg");
                        exit;
                    }
                }

                if($table == 'biometric')
                {
                    $imp=clean($_POST['bioimprem']);

                    $sql = "UPDATE $table SET Status='APPROVED',ImpRem='$imp', Implementedby='$name',ImpDate='$date' WHERE Ticketid='$id'";

                    $result = $conn->query($sql);
                    if($result)
                    {
                        header("Location: home.php?page=$pg");
                        exit;
                    }
                }

                if($table == 'internet')
                {
                    $sites=clean($_POST['gsites']);$imp=clean($_POST['intimprem']);

                    $sql = "UPDATE $table SET Status='APPROVED', Sites='$sites',ImpRem='$imp', Implementedby='$name',ImpDate='$date' WHERE Ticketid='$id'";

                    $result = $conn->query($sql);
                    if($result)
                    {
                        header("Location: home.php?page=$pg");
                        exit;
                    }
                }


                if($table === 'infrastructure')
                {
                    if($type == 'HARDWARE'){

                        $newHardName = clean(isset($_POST['newhname']) ? $_POST['newhname']:'');$newHardModel = clean(isset($_POST['newhmod'])?$_POST['newhmod']:'');$newHardCond = clean(isset($_POST['newhcond']) ? $_POST['newhcond']:'');$newHardSerial = clean(isset($_POST['newhser'])?$_POST['newhser']:'');$newimphname=isset($_POST['newimphname']) ? $_POST['newimphname']:'';$imp = isset($_POST['hardimprem']) ? $_POST['hardimprem']:'';

                        $sql = "UPDATE $table SET Status='APPROVED',NewHardModel='$newHardModel',NewHardSerial='$newHardSerial',NewHardCond='$newHardCond',ImpRem='$imp',NewImpHardName='$newimphname', Implementedby='$name',ImpDate='$date' WHERE Ticketid='$id'";

                        $result = $conn->query($sql);
                        if($result)
                        {
                            header("Location: home.php?page=$pg");
                            exit;
                        }

                    }else{

                        $imp=clean(isset($_POST['softimprem']) ? $_POST['softimprem']:'');

                        $sql = "UPDATE $table SET Status='APPROVED',ImpRem='$imp',Implementedby='$name',ImpDate='$date' WHERE Ticketid='$id'";

                        $result = $conn->query($sql);
                        if($result)
                        {
                            header("Location: home.php?page=$pg");
                            exit;
                        }

                    }
                    
                }
                
            }else{
                if($table === 'erp')
                {
                    $erpusername=clean($_POST['erpid']);$erppass=clean($_POST['erppass']);$erprole=clean($_POST['erprole']);$erpshop=clean($_POST['erpshop']);$erpimprem=clean($_POST['erpimprem']);

                    if($erpusername === 'N/A' && $erppass === 'N/A' && $erprole === 'N/A' && $erpshop === 'N/A'){

                        $sql = "UPDATE $table SET Status='DECLINED', ErpUsername='$erpusername',ErpPassword='$erppass',ErpRole='$erprole',ErpShop='$erpshop', Implementedby='$name',ImpDate='$date',ImpRem='$erpimprem' WHERE Ticketid='$id'";

                        $result = $conn->query($sql);
                        if($result)
                        {
                            header("Location: home.php?page=$pg");
                            exit;
                        }

                    }
                }

                if($table == 'email')
                {
                    $email=clean($_POST['emailadd']); $imp=clean($_POST['emailimprem']);

                    if($email == 'N/A'){

                        $sql = "UPDATE $table SET Status='DECLINED',Email='$email', Implementedby='$name',ImpRem='$imp',ImpDate='$date' WHERE Ticketid='$id'";

                        $result = $conn->query($sql);
                        if($result)
                        {
                            header("Location: home.php?page=$pg");
                            exit;
                        }

                    }
                }

                if($table == 'biometric')
                {
                    $imp=clean($_POST['bioimprem']);

                    $sql = "UPDATE $table SET Status='DECLINED',ImpRem='$imp', Implementedby='$name',ImpDate='$date' WHERE Ticketid='$id'";

                    $result = $conn->query($sql);
                    if($result)
                    {
                        header("Location: home.php?page=$pg");
                        exit;
                    }
                    
                }

                if($table == 'internet')
                {
                    $sites=clean($_POST['gsites']);$imp=clean($_POST['intimprem']);

                    if($sites == 'N/A'){

                        $sql = "UPDATE $table SET Status='DECLINED', Sites='$sites',ImpRem='$imp', Implementedby='$name',ImpDate='$date' WHERE Ticketid='$id'";

                        $result = $conn->query($sql);
                        if($result)
                        {
                            header("Location: home.php?page=$pg");
                            exit;
                        }

                    }
                    
                }

                if($table === 'infrastructure')
                {
                    if($type == 'HARDWARE'){

                        $newHardName = clean(isset($_POST['newhname']) ? $_POST['newhname']:'');$newHardModel = clean(isset($_POST['newhmod'])?$_POST['newhmod']:'');$newHardCond = clean(isset($_POST['newhcond']) ? $_POST['newhcond']:'');$newHardSerial = clean(isset($_POST['newhser'])?$_POST['newhser']:'');$newimphname=isset($_POST['newimphname']) ? $_POST['newimphname']:'';$imp = isset($_POST['hardimprem']) ? $_POST['hardimprem']:'';

                        $sql = "UPDATE $table SET Status='DECLINED',NewHardModel='$newHardModel',NewHardSerial='$newHardSerial',NewHardCond='$newHardCond',ImpRem='$imp',NewImpHardName='$newimphname', Implementedby='$name',ImpDate='$date' WHERE Ticketid='$id'";

                        $result = $conn->query($sql);
                        if($result)
                        {
                            header("Location: home.php?page=$pg");
                            exit;
                        }

                    }else{

                        $imp=clean(isset($_POST['softimprem']) ? $_POST['softimprem']:'');

                        $sql = "UPDATE $table SET Status='DECLINED',ImpRem='$imp',Implementedby='$name',ImpDate='$date' WHERE Ticketid='$id'";

                        $result = $conn->query($sql);
                        if($result)
                        {
                            header("Location: home.php?page=$pg");
                            exit;
                        }

                    }
                    
                }
            }
            
            
        }while (false);
    }
    
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="layout.css">
    <link rel="stylesheet" href="css/all.min.css"/>
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="icon" href="favicon.png" type="image/png">
    <title>View</title>
</head>
<body>
<nav class="navbar">
    <div class="tit">
        <h4>Melcom</h4>
    </div>
</nav>
<div class="ma" style="padding: 30px;">
<a style="margin: 50px; font-size: 18px;" href="home.php?page=<?php echo $pg ?>"><i class="fa-solid fa-arrow-left-long"></i>  Back</a>

<div id="re" class="cont">
<div class="data">
<form method="post" id="forms" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" class="reqq">

<div class="con">
    <div class="list">
        <?php
        if($table === 'erp')
        {
        ?>
        <div class="items">
            <input type="checkbox" name="erp" value="erp" class="check" checked disabled>
            <h4>ERP Id Request</h4>
        </div>
        <?php
        }else{
        ?>
        <div class="items">
            <input type="checkbox" name="erp" value="erp" class="check" disabled>
            <h4>ERP Id Request</h4>
        </div>
        <?php
        }

        if($table === 'email')
        {
        ?>
        <div class="items">
            <input type="checkbox" name="email" value="email" class="check" checked disabled>
            <h4>Email Id Request</h4>
        </div>
        <?php
        }else{
            ?>
            <div class="items">
                <input type="checkbox" name="email" class="check" disabled>
                <h4>Email Id Request</h4>
            </div>
            <?php
        }

        if($table === 'biometric')
        {
        ?>
        <div class="items">
            <input type="checkbox" name="bio" value="biometric" class="check" checked disabled>
            <h4>Biometric Request</h4>
        </div>
        <?php
        }else{
            ?>
        <div class="items">
            <input type="checkbox" name="bio" value="internet" class="check" disabled>
            <h4>Biometric Request</h4>
        </div>
        <?php
        }

        if($table === 'internet')
        {
        ?>
        <div class="items">
            <input type="checkbox" name="internet" value="infrastructure" class="check" id="int" checked disabled>
            <h4>Internet Access Request</h4>
        </div>
        <?php
        }else{
            ?>
        <div class="items">
            <input type="checkbox" name="internet" class="check" id="int" disabled>
            <h4>Internet Access Request</h4>
        </div>
        <?php
        }

        if($table === 'infrastructure')
        {
        ?>
        <div class="items">
            <input type="checkbox" name="infras" class="check" id="inf" checked disabled>
            <h4>Infrastructure Request</h4>
        </div>
        <?php
        }else{
            ?>
        <div class="items">
            <input type="checkbox" name="infras" class="check" id="inf" disabled>
            <h4>Infrastructure Request</h4>
        </div>
        <?php
        }
        
        ?>
        
    </div>
</div>

<div class="content">
    <div class="staff-det">
        <h4>Personal Details</h4>   
        <div class="opt">

            <input type="hidden" value="<?php echo $table ?>" name="table">
            <input type="hidden" value="<?php echo $type ?>" name="type">
            <input type="hidden" value="<?php echo $id ?>" name="id">
            <input type="hidden" value="<?php echo $pg ?>" name="pg">
            <div class="column mb-3">
                <label for="date" class="">Date of Request</label>
                <div class="">
                    <input type="date" value="<?php echo $date ?>" name="date" id="date" class="form-control" disabled>
                </div>
                
            </div>
            <div class="column mb-3">
                <label for="req" class="">Requested For* (Name)</label>
                <div class="">
                    <input id="req" type="text" name="req" class="form-control" oninput="this.value = this.value.toUpperCase();" value="<?php echo $reqFor ?>" disabled>
                </div>
                
            </div>
        </div>

        <div class="opt">
            <div class="column mb-3">
                <label for="dep" class="">Department*</label>
                <div class="">
                    <input id="dep" type="text" name="dep" class="form-control" oninput="this.value = this.value.toUpperCase();" value="<?php echo $dept ?>" disabled>
                </div>
                
            </div>
            <div class="column mb-3">
                <label for="loc" class="">Location*</label>
                <div class="">
                    <input id="loc" value="<?php echo $loc ?>" type="text" name="loc" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                </div>
                
            </div>
        </div>

        <div class="opt">

            <div class="column mb-3">
                <label for="num_inp" class="">Contact Information*</label>
                <div class="">
                    <input id="num_inp" type="text" minlength="10" value="<?php echo $contact ?>" maxlength="10" name="con" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                    <span id="err" style="color: red; display: none">Please enter exactly 10 digits </span>
                </div>
            </div>

            <div class="column mb-3">
                <label for="loc" class="">Employee Code*</label>
                <div class="">
                    <input id="loc" type="text" name="empcode" value="<?php echo $empcode ?>"  class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                </div>
                
            </div>

        </div>
    </div>

    <?php
    if($table == 'internet')
    {
        ?>
        <div id="inter" class="inter" style="width: 50%">
            <div class="opt">
                <div class="column mb-3">
                    <label for="reqsites" class="">Requester Sites*</label>
                    <div class="">
                        <input id="reqsites" type="text" value="<?php echo $reqsites ?>"  name="reqsites" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                        <span id="err" style="color: red; display: none"></span>
                    </div>
                </div>

            </div>
        </div>
        <?php
    }
    ?>

    <div id="infras">
        <h4>Infrastructure Request Details</h4>
        <div class="type">
            <?php
            if($type === 'SOFTWARE'){
            ?>
            <div class="type_1">
                <h4>Software Request</h4>
                <input type="radio" name="type" value="SOFTWARE" id="soft_rad" checked disabled>
            </div>
            <?php
            }else{
            ?>
            <div class="type_1">
                <h4>Software Request</h4>
                <input type="radio" name="type" value="SOFTWARE" id="soft_rad" disabled>
            </div>
            <?php
            }

            if($type === 'HARDWARE'){
                ?>
                <div class="type_2">
                    <h4>Hardware Request</h4>
                    <input type="radio" name="type" value="HARDWARE" id="hard_rad" checked disabled>
                </div>
                <?php
                }else{
                ?>
                <div class="type_2">
                    <h4>Hardware Request</h4>
                    <input type="radio" name="type" value="HARDWARE" id="hard_rad" disabled>
                </div>
                <?php
                }
            
            ?>
            
        
        </div>
        
        <div class="inf_type">

            <?php
            if($type === 'SOFTWARE'){
            ?>
            <div id="infras_soft" class="active mt-4">

                <div id="soft_new" class="soft_new">

                    <h4>New Software Information</h4>
                    <div class="column mb-3">
                        <label for="drop" style="align-self: center;">Software Request Type</label>
                        <div class="">
                            <select style="width: 50%;" name="stype" onchange="this.form.submit()" class="form-select" id="drop" disabled>
                                <?php
                                if($softreqtype == 'Software Install')
                                {
                                    ?>
                                    <option value="Software Install" <?php if(isset($_GET['stype']) && $_GET['stype'] =='Software Install') echo 'selected';?>>Software Install</option>
                                    <?php
                                }
                                if($softreqtype == 'Software Update')
                                {
                                    ?>
                                    <option value="Software Update" <?php if(isset($_GET['stype']) && $_GET['stype'] =='Software Update') echo 'selected';?>>Software Update</option>
                                    <?php
                                }
                                ?>
                                
                            </select>
                        </div>
                    </div>
                    <div class="opt">

                            <div class="column mb-3">
                                <label for="newsname" class="">Software Details*</label>
                                <div class="">
                                    <input id="newsname" value="<?php echo $newSoftName?>" style="width:50%;" type="text" name="newsname" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                </div>
                                
                            </div>
                            
                    </div>

                </div>

            </div>
            <?php
            }

            if($type === 'HARDWARE')
            {
                ?>
                <div id="infras_hard" class="active mt-4">
                    <?php
                    if($hrepl === 'YES')
                    {
                    ?>
                    <div class="infras_rep" id="infras_rep">
                        <h4>Infrastructure Replacement</h4>
                        <input type="checkbox" name="oldhrepl" value="YES" id="inf_rep" checked disabled>
                    </div>
                    <?php
                    }
                    
                    ?>
                    
                    <?php
                    if($hrepl === 'YES'){
                    ?>
                    <div class="active repl" id="repl">
                        <h4>Current Hardware Information</h4>
                        <div class="opt">

                            <div class="column mb-3">
                                <label for="oldhname" class="">Item Name/Description*</label>
                                <div class="">
                                    <input id="oldhname" type="text" value="<?php echo $oldHardName?>" name="oldhname" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                </div>
                                
                            </div>
                            <div class="column mb-3">
                                <label for="oldhser" class="">Serial Number*</label>
                                <div class="">
                                    <input id="oldhser" type="text" name="oldhser" value="<?php echo $oldHardSerial?>"class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                </div>
                                
                            </div>
                        </div>

                        <div class="opt">
                            <div class="column mb-3">
                                <label for="oldhmod" class="">Model*</label>
                                <div class="">
                                    <input id="oldhmod" type="text" name="oldhmod" value="<?php echo $oldHardModel?>"class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                </div>
                                
                            </div>
                            <div class="column mb-3">
                                <label for="oldhardtag" class="">Asset Tag Number (if applicable)</label>
                                <div class="oldhardtag">
                                    <input id="oldhardtag" type="text" name="oldhardtag" value="<?php echo $oldTagNum?>"class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                                </div>
                                
                            </div>
                        </div>

                        <div class="column mb-3">
                            <label for="oldhcond" class="col-sm-3 col-form-label">Condition of Current Hardware*</label>
                            <div class="col-sm-6">
                                <input id="oldhcond" type="text" name="oldhcond" value="<?php echo $oldHardCond?>"class="form-control" oninput="this.value = this.value.toUpperCase();" placeholder="e.g. Working, Needs Repair, Non-Functional" disabled>
                                <span id="err" style="color: red; display: none">Field cannot be empty</span>
                            </div>

                        </div>

                        <div class=" mb-3">
                            <label for="hard-ta" class="">Reason for Replacement</label>
                            <div class="hard-text-area">
                                <textarea name="oldhreason" oninput="this.value = this.value.toUpperCase();" id="hard-ta" class="form-control" disabled><?php echo $hres?></textarea>
                            </div>
                                    
                        </div>

                    </div>
                    <?php
                    }
                    
                    ?>

                    <div id="new_hard" class="new_hard">
                        <h4>New Hardware Information</h4>
                        <div class="opt">

                            <div class="column mb-3">
                                <label for="newhname" class="">New Item Description*</label>
                                <div class="">
                                    <input id="newhname" type="text" name="newhname" value="<?php echo $newHardName?>"class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </div>
                <?php
            }
            
            ?>

        </div>
        
        
    </div>

    <div id="imp" class="con mt-3">
        <?php
        ?><h4>Implementor Section</h4><?php
        if($table === 'erp')
        {
        ?>
        <div class="opt">
            <div class="column mb-3">
                <label for="erpid" class="">ERP Username</label>
                <div class="">
                    <input id="erpid" type="text" value="<?php echo $erpname?>"  name="erpid" class="form-control" placeholder="Put N/A if declined" oninput="this.value = this.value.toUpperCase();" required>
                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                </div>
                
            </div>
            <div class="column mb-3">
                <label for="erppass" class="">ERP Password</label>
                <div class="">
                    <input id="erppass" type="text" value="<?php echo $erppass?>"  name="erppass" class="form-control" placeholder="Put N/A if declined" oninput="this.value = this.value.toUpperCase();" required>
                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                </div>
                
            </div>
            
        </div>
        <div class="opt">
            <div class="column mb-3">
                <label for="erprole" class="">ERP Role</label>
                <div class="">
                    <input id="erprole" type="text" value="<?php echo $erprole?>"  name="erprole" class="form-control" placeholder="Put N/A if declined" oninput="this.value = this.value.toUpperCase();" required>
                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                </div>
                
            </div>
            <div class="column mb-3">
                <label for="erpshop" class="">ERP Shop</label>
                <div class="">
                    <input id="erpshop" type="text" value="<?php echo $erpshop?>"  name="erpshop" class="form-control" placeholder="Put N/A if declined" oninput="this.value = this.value.toUpperCase();" required>
                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                </div>
                
            </div>
            
        </div>

        <div class="opt">
            <div class="column mb-3">
                <label for="erpimprem" class="">Implementor Remarks*</label>
                <div class="">
                    <textarea id="erpimprem" type="text" name="erpimprem" class="form-control" oninput="this.value = this.value.toUpperCase();" required><?php echo $erpimprem?></textarea>
                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                </div>
                
            </div>
            
        </div>
        <?php
        }

        if($table === 'email')
        {
        ?>
        <div class="opt">
            <div class="column mb-3">
                <label for="emailadd" class="">Email Address</label>
                <div class="">
                    <input id="emailadd" type="text" value="<?php echo $email?>" name="emailadd" class="form-control" placeholder="Put N/A if declined" oninput="this.value = this.value.toUpperCase();" required>
                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                </div>
                
            </div>
            
        </div>
        <div class="opt">
            <div class="column mb-3">
                <label for="emailimprem" class="">Implementor Remarks*</label>
                <div class="">
                    <textarea id="emailimprem" type="text" name="emailimprem" class="form-control" oninput="this.value = this.value.toUpperCase();" required><?php echo $emailimprem?></textarea>
                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                </div>
                
            </div>
            
        </div>
        
        <?php
        }

        if($table === 'biometric')
        {
        ?>
        <div class="opt">
            <div class="column mb-3">
                <label for="bioimprem" class="">Implementer Remarks</label>
                <div class="">
                    <textarea id="bioimprem" type="text" name="bioimprem" class="form-control" oninput="this.value = this.value.toUpperCase();" required><?php echo $bioimprem?></textarea>
                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                </div>
                
            </div>
            
        </div>
        <?php
        }

        if($table === 'internet')
        {
        ?>
        <div class="opt">
            <div class="column mb-3">
                <label for="gsites" class="">Access Given Sites</label>
                <div class="">
                    <input id="gsites" type="text" value="<?php echo $sites?>"  name="gsites" class="form-control" placeholder="Put N/A if declined" oninput="this.value = this.value.toUpperCase();" required>
                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                </div>
                
            </div>
            
        </div>
        <div class="opt">
            <div class="column mb-3">
                <label for="intimprem" class="">Implementor Remarks*</label>
                <div class="">
                    <textarea id="intimprem" type="text" name="intimprem" class="form-control" oninput="this.value = this.value.toUpperCase();" required><?php echo $intimprem?></textarea>
                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                </div>
                
            </div>
            
        </div>
        <?php
        }

        if($table === 'infrastructure')
        {
            if($type === 'SOFTWARE')
            {
                ?>
                <div class="opt">
                    <div class="column mb-3">
                        <label for="softimprem" class="">Implementor Remarks</label>
                        <div class="">
                            <textarea id="softimprem" type="text" name="softimprem" class="form-control" oninput="this.value = this.value.toUpperCase();" required><?php echo $softimprem?></textarea>
                            <span id="err" style="color: red; display: none">Field cannot be empty</span>
                        </div>
                        
                    </div>
                </div>
                <?php
            }

            if($type === 'HARDWARE')
            {
                ?>
                <div id="new_hard" class="new_hard">
                    <h4>New Hardware Information</h4>
                    <div class="opt">

                        <div class="column mb-3">
                            <label for="newhname" class="">New Item Description*</label>
                            <div class="">
                                <input id="newimphname" type="text" value="<?php echo $newImpHardName?>" name="newimphname" class="form-control" placeholder="Put N/A if declined" oninput="this.value = this.value.toUpperCase();" required>
                                <span id="err" style="color: red; display: none">Field cannot be empty</span>
                            </div>
                            
                        </div>
                        <div class="column mb-3">
                            <label for="newhmod" class="">Model*</label>
                            <div class="">
                                <input id="newhmod" type="text" value="<?php echo $newHardModel?>"  name="newhmod" class="form-control" placeholder="Put N/A if declined" oninput="this.value = this.value.toUpperCase();" required>
                                <span id="err" style="color: red; display: none">Field cannot be empty</span>
                            </div>
                            
                        </div>
                    </div>

                    <div class="opt">
                        <div class="column mb-3">
                            <label for="nhser" class="">New Serial Number*</label>
                            <div class="">
                                <input id="nhser" type="text" value="<?php echo $newHardSerial?>"  name="newhser" class="form-control" oninput="this.value = this.value.toUpperCase();" placeholder="Put N/A if declined" required>
                                <span id="err" style="color: red; display: none">Field cannot be empty</span>
                            </div>
                            
                        </div>
                        <div class="column mb-3">
                            <label for="newhcond" class="">Condition of New Item*</label>
                            <div class="">
                                <input id="newhcond" type="text" value="<?php echo $newHardCond?>"  name="newhcond" class="form-control" oninput="this.value = this.value.toUpperCase();" placeholder="e.g. New, Used / Put N/A if declined" required>
                                <span id="err" style="color: red; display: none">Field cannot be empty</span> 
                            </div>
                            
                        </div>
                    </div>

                    <div class="opt">
                        <div class="column mb-3">
                            <label for="hardimprem" class="">Implementor Remarks</label>
                            <div class="">
                                <textarea id="hardimprem" type="text" name="hardimprem" class="form-control" oninput="this.value = this.value.toUpperCase();" required><?php echo $hardimprem?></textarea>
                                <span id="err" style="color: red; display: none">Field cannot be empty</span>
                            </div>
                        
                        </div>
                    </div>

                </div>
                <?php
            }
        ?>
        <?php
        }
        if($audStatus == 'APPROVED' || $audStatus == 'DECLINED')
        {
            ?>
        <h4 style="margin-top: 20px;">Auditor Section</h4>
        <div class="opt" style="margin-top: 20px;">
            <div class="column mb-3">
                <label for="audrem" class="">Auditor Remarks*</label>
                <div class="">
                    <input style="width: 100%;" id="audrem" type="text" name="audrem" value="<?php echo $audrem?>" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                </div>
                
            </div>
            
        </div>

        <?php
        if($audStatus == 'APPROVED'){
            ?>
            <div class="opt" style="margin-top: 10px;">
                <div class="column mb-3">
                    <label for="audrem" class="">Audit Status</label>
                    <h2 style="color:green"><?php echo $audStatus ?></h2>
                    
                </div>
            </div>
            <?php
        }elseif($audStatus == 'DECLINED'){
            ?>
            <div class="opt" style="margin-top: 10px;">
                <div class="column mb-3">
                    <label for="audrem" class="">Audit Status</label>
                    <h2 style="color:red"><?php echo $audStatus ?></h2>
                    
                </div>
            </div>
            <?php
        }
        ?>
        <?php
        }
        
        ?>
    </div>

    <?php
    if($status == 'APPROVED' || $status == 'DECLINED' ||
     $status == 'Approved' || $status == 'Declined')
    {
        ?>
        <div class="row mb-3">
            <div class="col-sm-3 d-grid mt-5">
                <button id="approve" type="submit" name="action" value="approve" class="btn btn-primary" disabled>
                    Approve
                </button>
            </div>
            <div class="col-sm-3 d-grid mt-5">
                <button id="decline" type="submit" name="action" value="decline" class="bt btn btn-outline-primary" disabled>
                    Decline
                </button>
            </div>
        </div>
        <?php
    }else{
        ?>
        <div class="row mb-3">
            <div class="col-sm-3 d-grid mt-5">
                <button id="approve"  type="submit" name="action" value="approve" class="btn btn-primary">
                    Approve
                </button>
            </div>
            <div class="col-sm-3 d-grid mt-5">
                <button id="decline"  type="submit" name="action" value="decline" class="bt btn btn-outline-primary">
                    Decline
                </button>
            </div>
        </div>
        <?php
    }
    ?>
    
</div>
        
</form>
<div id="space">

</div>

</div>

</div>

</div>
<script src="js/bootstrap.min.js"></script>
<script src="imp_view.js"></script>
    
</body>
</html>