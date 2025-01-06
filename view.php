<?php
    session_start();
    header("Cache-Control: no-store,no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Expires: 0");
    include "db_conn.php";
    $erp = "";$email ="";$bio ="";$internet ="";$infras = "";$page="";
    
    $error = "";$table ="";$type = "";$srepl="";
    
    $id = "";$dat = "";$reqFor = "";$dept ="";$loc = "";$contact = "";$audited = "PENDING";$status = "PENDING";$type = "";$soft_replacement = "";$hrepl = "";$oldHardName = "";$oldHardModel = "";$oldHardSerial = "";$oldTagNum = "";$oldHardCond = "";$newHardName = "";$newHardSerial = "";$newHardModel = "";$newHardCond = "";$softreqtype = "";$oldSoftModel = "";$oldSoftSerial = "";$oldSoftCond = "";$newSoftName = "";$newSoftModel = "";$newSoftSerial = "";$newSoftCond = "";$implementedby = "";$auditedby = "";$sres="";$hres="";$email="";$erpname="";$erppass="";$erprole="";$erpshop="";$sites="";$emailimprem="";
    $intimprem="";$bioimprem="";$softimprem="";$empcode="";$newImpHardName="";$reqsites="";$audrem="";$audStatus="";

    if($_SERVER['REQUEST_METHOD'] == "GET")
    {
        if(isset($_GET['id']) && isset($_GET['type']))
        {
            $id = $_GET['id'];
            $table = $_GET['type'];
            $page = $_GET['page'];
            
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
                    $oldHardName = $row['OldHardName'];$oldHardModel = $row['OldHardModel'];$oldHardSerial = $row['OldHardSerial'];$oldHardCond = $row['OldHardCond'];$softreqtype = $row['SoftReqType'];$oldSoftModel = $row['OldSoftModel'];$oldSoftSerial = $row['OldSoftSerial'];$oldSoftCond = $row['OldSoftCond'];$newHardName = $row['NewHardName'];$newHardModel = $row['NewHardModel'];$newHardSerial = $row['NewHardSerial'];$newHardCond = $row['NewHardCond'];$oldHardName = $row['OldHardName'];$newSoftName = $row['NewSoftName'];$newSoftModel = $row['NewSoftModel'];$newSoftSerial = $row['NewSoftSerial'];$newImpHardName = $row['NewImpHardName'];$oldTagNum = $row['OldTagNumber'];$hres = $row['HardReasonRep'];$softimprem = $row['ImpRem'];$audrem = $row['AudRem'];$audStatus = $row['Audited'];
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
                    $erpname = $row['ErpUsername'];$erppass = $row['ErpPassword'];$erprole = $row['ErpRole'];$erpshop = $row['ErpShop'];$audrem = $row['AudRem'];$audStatus = $row['Audited'];
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

        $id=clean($_POST['id']);$table=clean($_POST['table']);
        $requestedBy = clean($_POST["req"]);$dept = clean($_POST["dep"]);$loc = clean($_POST["loc"]);$contact = clean($_POST["con"]);$type = clean($_POST['type']);$soft_replacement = isset($_POST['oldsrepl']) ? $_POST['oldsrepl']:'';$hard_replacement = isset($_POST['oldhrepl']) ? $_POST['oldhrepl'] :'';$oldHardName = clean($_POST['oldhname']);$oldHardModel = clean($_POST['oldhmod']);$oldHardSerial = clean($_POST['oldhser']);$oldhTagNum = clean($_POST['oldhardtag']);$oldHardCond = clean($_POST['oldhcond']);$hres = clean($_POST['oldhreason']);$newHardName = clean($_POST['newhname']);$newHardModel = clean($_POST['newhmod']);$newHardCond = clean($_POST['newhcond']);$newHardSerial = clean($_POST['newhser']);$oldSoftName = clean($_POST['oldsname']);$oldSoftModel = clean($_POST['oldsmod']);$oldSoftSerial = clean($_POST['oldsser']);$oldSoftCond = clean($_POST['oldscond']);$sres = clean($_POST['oldsreason']);$newSoftName = clean($_POST['newsname']);$newSoftModel = clean($_POST['newsmod']);$newSoftSerial = clean($_POST['newsser']);$newSoftCond = clean($_POST['newscond']);
        $sql = "";


        do{
            if($table === 'infrastructure')
            {
                $sql = "UPDATE $table SET Requestedby='$requestedBy', Department='$dept', Location='$loc', Contact='$contact', OldHardName='$oldHardName', OldHardModel='$oldHardModel', OldHardSerial='$oldHardSerial', OldHardCond='$oldHardCond', HardReasonRep='$hres', OldSoftName='$oldSoftName', OldSoftModel='$oldSoftModel', OldSoftSerial='$oldSoftSerial', OldSoftCond='$oldSoftCond',SoftReasonRep='$sres', NewHardName='$newHardName', NewHardModel='$newHardModel', NewHardSerial='$newHardSerial', NewHardCond='$newHardCond', NewSoftName='$newSoftName', NewSoftModel='$newSoftModel', NewSoftSerial='$newSoftSerial', NewSoftCond='$newSoftCond', OldTagNumber='$oldhTagNum' WHERE Ticketid='$id'";

                $result = $conn->query($sql);
                if($result)
                {
                    header('Location: home.php');
                    exit;
                }
            }else{
                $sql = "UPDATE $table SET Requestedby='$requestedBy', Department='$dept', Location='$loc', Contact='$contact' WHERE Ticketid='$id'";

                $result = $conn->query($sql);
                if($result)
                {
                    header('Location: home.php');
                    exit;
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
    
<a style="margin: 50px; font-size: 18px;" href="home.php?page=<?php echo $page ?>"><i class="fa-solid fa-arrow-left-long"></i>  Back</a>

<div id="re" class="cont">
    <div class="data">
        <form method="post" id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" class="reqq">

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
                    <input type="hidden" value="<?php echo $id ?>" name="id">
                    <div class="column mb-3">
                        <label for="date" class="">Date of Request</label>
                        <div class="">
                            <input type="date" value="<?php echo $date ?>" name="date" id="date" class="form-control" disabled>
                        </div>
                        
                    </div>
                    <div class="column mb-3">
                        <label for="req" class="">Requested For* (Name)</label>
                        <div class="">
                            <input id="req" type="text" name="req" class="form-control" oninput="this.value = this.value.toUpperCase();" value="<?php echo $reqFor ?>" required>
                        </div>
                        
                    </div>
                </div>

                <div class="opt">
                    <div class="column mb-3">
                        <label for="dep" class="">Department*</label>
                        <div class="">
                            <input id="dep" type="text" name="dep" class="form-control" oninput="this.value = this.value.toUpperCase();" value="<?php echo $dept ?>" required>
                        </div>
                        
                    </div>
                    <div class="column mb-3">
                        <label for="loc" class="">Location*</label>
                        <div class="">
                            <input id="loc" value="<?php echo $loc ?>" type="text" name="loc" class="form-control" oninput="this.value = this.value.toUpperCase();">
                        </div>
                        
                    </div>
                </div>

                <div class="opt">

                    <div class="column mb-3">
                        <label for="num_inp" class="">Contact Information*</label>
                        <div class="">
                            <input id="num_inp" type="text" minlength="10" value="<?php echo $contact ?>" maxlength="10" name="con" class="form-control" oninput="this.value = this.value.toUpperCase();" required>
                            <span id="err" style="color: red; display: none">Please enter exactly 10 digits </span>
                        </div>
                    </div>

                    <div class="column mb-3">
                        <label for="loc" class="">Employee Code*</label>
                        <div class="">
                            <input id="loc" type="text" name="empcode" value="<?php echo $empcode ?>"  class="form-control" oninput="this.value = this.value.toUpperCase();">
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
                                <input id="reqsites" type="text" value="<?php echo $reqsites ?>"  name="reqsites" class="form-control" oninput="this.value = this.value.toUpperCase();">
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
                                            <input id="newsname" value="<?php echo $newSoftName?>" style="width:50%;" type="text" name="newsname" class="form-control" oninput="this.value = this.value.toUpperCase();">
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
                                            <input id="oldhname" type="text" name="oldhname" value="<?php echo $oldHardName?>" class="form-control" oninput="this.value = this.value.toUpperCase();">
                                            <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                        </div>
                                        
                                    </div>
                                    <div class="column mb-3">
                                        <label for="oldhser" class="">Serial Number*</label>
                                        <div class="">
                                            <input id="oldhser" type="text" name="oldhser" value="<?php echo $oldHardSerial?>"class="form-control" oninput="this.value = this.value.toUpperCase();">
                                            <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="opt">
                                    <div class="column mb-3">
                                        <label for="oldhmod" class="">Model*</label>
                                        <div class="">
                                            <input id="oldhmod" type="text" name="oldhmod" value="<?php echo $oldHardModel?>"class="form-control" oninput="this.value = this.value.toUpperCase();">
                                            <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                        </div>
                                        
                                    </div>
                                    <div class="column mb-3">
                                        <label for="oldhardtag" class="">Asset Tag Number (if applicable)</label>
                                        <div class="oldhardtag">
                                            <input id="oldhardtag" type="text" name="oldhardtag" value="<?php echo $oldTagNum?>"class="form-control" oninput="this.value = this.value.toUpperCase();">
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="column mb-3">
                                    <label for="oldhcond" class="col-sm-3 col-form-label">Condition of Current Hardware*</label>
                                    <div class="col-sm-6">
                                        <input id="oldhcond" type="text" name="oldhcond" value="<?php echo $oldHardCond?>"class="form-control" oninput="this.value = this.value.toUpperCase();" placeholder="e.g. Working, Needs Repair, Non-Functional">
                                        <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                    </div>

                                </div>

                                <div class=" mb-3">
                                    <label for="hard-ta" class="">Reason for Replacement</label>
                                    <div class="hard-text-area">
                                        <textarea name="oldhreason" oninput="this.value = this.value.toUpperCase();" id="hard-ta" class="form-control"><?php echo $hres?></textarea>
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
                                            <input id="newhname" type="text" name="newhname" value="<?php echo $newHardName?>" class="form-control" oninput="this.value = this.value.toUpperCase();">
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

            <div class="con mt-3">
                <?php
                if($status === 'APPROVED' || $status === 'DECLINED'|| $row["Status"] === 'Approved'
                || $row["Status"] === 'Declined')
                {
                ?><h4>Implementor Section</h4><?php
                if($table === 'erp')
                {
                ?>
                <div class="opt">
                    <div class="column mb-3">
                        <label for="oldhname" class="">Erp Id</label>
                        <div class="">
                            <input id="oldhname" type="text" name="oldhname" value="<?php echo $erpname?>" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                            <span id="err" style="color: red; display: none">Field cannot be empty</span>
                        </div>
                        
                    </div>
                    <div class="column mb-3">
                        <label for="oldhname" class="">Erp Password</label>
                        <div class="">
                            <input id="oldhname" type="text" name="oldhname" value="<?php echo $erppass?>" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                            <span id="err" style="color: red; display: none">Field cannot be empty</span>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="opt">
                    <div class="column mb-3">
                        <label for="erprole" class="">Erp Role</label>
                        <div class="">
                            <input id="erprole" type="text" name="erprole" value="<?php echo $erprole?>" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                            <span id="err" style="color: red; display: none">Field cannot be empty</span>
                        </div>
                        
                    </div>
                    <div class="column mb-3">
                        <label for="erpshop" class="">Erp Shop</label>
                        <div class="">
                            <input id="erpshop" type="text" name="erpshop" value="<?php echo $erpshop?>" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
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
                        <label for="oldhname" class="">Email Address</label>
                        <div class="">
                            <input id="oldhname" type="text" name="oldhname" value="<?php echo $email?>" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                            <span id="err" style="color: red; display: none">Field cannot be empty</span>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="opt">
                    <div class="column mb-3">
                        <label for="oldhname" class="">Implementor Remarks*</label>
                        <div class="">
                            <input id="oldhname" type="text" name="oldhname" value="<?php echo $emailimprem?>" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
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
                        <label for="oldhname" class="">Implementer Remarks</label>
                        <div class="">
                            <input id="oldhname" type="text" name="oldhname" value="<?php echo $bioimprem?>" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
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
                        <label for="oldhname" class="">Access Given Sites</label>
                        <div class="">
                            <input id="oldhname" type="text" name="oldhname" value="<?php echo $sites?>" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                            <span id="err" style="color: red; display: none">Field cannot be empty</span>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="opt">
                    <div class="column mb-3">
                        <label for="oldhname" class="">Implementor Remarks*</label>
                        <div class="">
                            <input id="oldhname" type="text" name="oldhname" value="<?php echo $intimprem?>" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
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
                                <label for="oldhname" class="">Implementor Remarks</label>
                                <div class="">
                                    <input id="oldhname" type="text" name="oldhname" value="<?php echo $softimprem?>" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                </div>
                                
                            </div>
                        </div>
                        <?php
                    }

                    if($type === 'HARDWARE' && $status === 'APPROVED' || $status === 'Approved')
                    {
                        ?>
                        <div id="new_hard" class="new_hard">
                            <h4>New Hardware Details</h4>
                            <div class="opt">

                                <div class="column mb-3">
                                    <label for="newhname" class="">New Item Description</label>
                                    <div class="">
                                        <input id="newhname" type="text" value="<?php echo $newImpHardName?>"  name="newhname" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                                        <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                    </div>
                                    
                                </div>
                                <div class="column mb-3">
                                    <label for="newhmod" class="">Model</label>
                                    <div class="">
                                        <input id="newhmod" type="text" value="<?php echo $newHardModel?>"  name="newhmod" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                                        <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="opt">
                                <div class="column mb-3">
                                    <label for="nhser" class="">New Serial Number</label>
                                    <div class="">
                                        <input id="nhser" type="text" value="<?php echo $newHardSerial?>"  name="newhser" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                                        <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                    </div>
                                    
                                </div>
                                <div class="column mb-3">
                                    <label for="newhcond" class="">Condition of New Item</label>
                                    <div class="">
                                        <input id="newhcond" type="text" value="<?php echo $newHardCond?>"  name="newhcond" class="form-control" oninput="this.value = this.value.toUpperCase();" placeholder="e.g. New, Used" disabled>
                                        <span id="err" style="color: red; display: none">Field cannot be empty</span> 
                                    </div>
                                    
                                </div>
                            </div>

                        </div>
                        <?php
                    }

                    if($type === 'HARDWARE' && $status === 'DECLINED' || $status === 'Declined'){
                        ?>
                        <div class="opt">
                            <div class="column mb-3">
                                <label for="oldhname" class="">Implementor Remarks</label>
                                <div class="">
                                    <input id="oldhname" type="text" name="oldhname" value="<?php echo $oldHardName?>" class="form-control" oninput="this.value = this.value.toUpperCase();" disabled>
                                    <span id="err" style="color: red; display: none">Field cannot be empty</span>
                                </div>
                                
                            </div>
                        </div>
                        <?php
                    }
                ?>
                <?php
                }
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
            
        </div>
                
        </form>
        <div id="space">

        </div>
    </div>
</div>

</div>
<script src="view.js"></script>
<script src="main.js"></script>
<script src="js/bootstrap.min.js"></script>
    
</body>
</html>