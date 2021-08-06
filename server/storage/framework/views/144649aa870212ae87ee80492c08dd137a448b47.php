<form onsubmit="return checkKey(this)" id="addKeyForm">
    <div class="modal-body">
        <p class="key-add-info"><?php echo e(__("Liman üzerindeki sunucuların eklentileri servisler üzerinden kullanabileceğiniz gibi, bazı eklentileri sunucuya bağlantı kurmadan kullanamazsınız.")); ?></p>
        <p class="key-add-info"><?php echo e(__("Bu sebeple, bir anahtar eklemek istiyorsanız öncelikle konuşma protokolünü seçin.")); ?></p>
        <label id="useKeyLabel" style="width: 100%; margin-bottom: 5px;">
            <input id="useKey" type="checkbox" onchange="keySettingsChanged()" checked>
            <?php echo e(__("Bir Anahtar Kullanmak İstiyorum")); ?>

        </label>
        <div id="keyDiv" style="display: none;"><br>
            <div class="form-group">
                <label class="text-md"><?php echo e(__("Anahtar Türü")); ?></label>
                <select name="key_type" class="form-control" disabled onchange="setPort(this)" id="keyType">
                    <option value="ssh" selected><?php echo e(__("SSH")); ?></option>
                    <option value="ssh_certificate"><?php echo e(__("SSH Anahtarı")); ?></option>
                    <option value="winrm"><?php echo e(__("WinRM")); ?></option>
                    <option value="winrm_insecure"><?php echo e(__("WinRM (SSL'siz)")); ?></option>
                    <option value="snmp"><?php echo e(__("SNMP")); ?></option>
                </select>
            </div><hr>
            <label class="text-md"><?php echo e(__("Kullanıcı Adı")); ?></label>
            <input id="keyUsername" name="username" type="text" class="form-control" placeholder="<?php echo e(__("Kullanıcı Adı")); ?>" required disabled autocomplete="off"><br>
            <label id="passwordPrompt" class="text-md"><?php echo e(__("Şifre")); ?></label>
            <label id="certificatePrompt" class="text-md"><?php echo e(__("SSH Private Key")); ?></label>
            <label id="certificateInformLabel" style="font-weight: 400"><?php echo e(__("Anahtarınızın çalışabilmesi için şifreli olmaması ve sudo komutlarını çalıştırması için sudoers dosyasında NOPASSWD olarak eklenmiş olması gerekmektedir.")); ?></label>
            <textarea class="form-control" name="password" id="keyPasswordCert" cols="30" rows="10" required disabled></textarea>
            <input id="keyPassword" name="password" type="password" class="form-control" placeholder="<?php echo e(__("Şifre")); ?>" required disabled autocomplete="off"><br>        </div>
        <label class="text-md"><?php echo e(__("Port")); ?></label>
        <small><?php echo e(__("Eğer bilmiyorsanız varsayılan olarak bırakabilirsiniz.")); ?></small>
        <input id="port" type="number" name="port" class="form-control snmp-input" placeholder="<?php echo e(__("Port")); ?>" required min="0" value="22"><br>
    </div>

    <div class="modal-footer">
        <button id="keySubmitButton" type="submit" class="btn btn-primary"><i class="fas fa-key"></i> <?php echo e(__("Ayarları Onayla")); ?></button>
    </div>
</form>
<script>
    var isKeyOK = false;
    $("#keyPasswordCert").fadeOut(0);
    $("#certificateInformLabel").fadeOut(0);
    $("#keyPassword").fadeIn(0);
    $("#certificatePrompt").fadeOut(0);
    $("#passwordPrompt").fadeIn(0);
    $(".key-add-info").fadeOut(0);
    function setPort(select) {
        if(select.value === "winrm"){
            $("#keyPasswordCert").fadeOut(0).attr("disabled","true");
            $("#certificateInformLabel").fadeOut(0);
            $("#keyPassword").fadeIn(0).removeAttr("disabled");
            $("#certificatePrompt").fadeOut(0);
            $("#passwordPrompt").fadeIn(0);
            $("#snmpWrapper").fadeOut();
            $(".snmp-input").attr("disabled","true");
            $("#port").val("5986").removeAttr("disabled");
        }else if(select.value === "winrm_insecure"){
            $("#keyPasswordCert").fadeOut(0).attr("disabled","true");
            $("#certificateInformLabel").fadeOut(0);
            $("#keyPassword").fadeIn(0).removeAttr("disabled");
            $("#certificatePrompt").fadeOut(0);
            $("#passwordPrompt").fadeIn(0);
            $("#snmpWrapper").fadeOut();
            $(".snmp-input").attr("disabled","true");
            $("#port").val("5985").removeAttr("disabled");
        }else if(select.value === "ssh"){
            $("#keyPasswordCert").fadeOut(0).attr("disabled","true");
            $("#keyPassword").fadeIn(0).removeAttr("disabled");
            $("#certificateInformLabel").fadeOut(0);
            $("#passwordPrompt").fadeIn(0);
            $("#certificatePrompt").fadeOut(0);
            $("#snmpWrapper").fadeOut();
            $(".snmp-input").attr("disabled","true");
            $("#port").val("22").removeAttr("disabled");
        }else if(select.value === "ssh_certificate"){
            $("#keyPasswordCert").fadeIn(0).removeAttr("disabled");
            $("#certificateInformLabel").fadeIn(0);
            $("#passwordPrompt").fadeOut(0);
            $("#keyPassword").fadeOut(0).attr("disabled","true");
            $("#certificatePrompt").fadeIn(0);
            $("#snmpWrapper").fadeOut();
            $(".snmp-input").attr("disabled","true");
            $("#port").val("22").removeAttr("disabled");
        }else if(select.value === "snmp"){
            $("#keyPasswordCert").fadeOut(0).attr("disabled","true");
            $("#certificateInformLabel").fadeOut(0).attr("disabled","true");
            $("#certificatePrompt").fadeOut(0).attr("disabled","true");
            $(".snmp-input").removeAttr("disabled");
            $("#snmpWrapper").fadeIn();
            $("#port").val("161").attr("disabled","true");
        }
    }
    function checkKey(form) {           
        var option = $("#useKey");
        if(option.is(':checked') === false){
            isKeyOK = true;
            $("#keyTab").css('color','green');
            $("#summaryTab").click();
            return false;
        }
        var data = new FormData(form);
        helper = data;
        data.append('ip_address',$("#serverHostName").val());
        showSwal('<?php echo e(__("Kontrol Ediliyor...")); ?>','info');
        return request('<?php echo e(route('server_verify_key')); ?>',data,function (response) {
            var json = JSON.parse(response);
            showSwal(json["message"],'success',2000);
            isKeyOK = true;
            <?php if(isset($success)): ?>
            <?php echo e($success); ?>

            <?php endif; ?>
            $("#keyTab").css('color','green');
            $("#summaryTab").click();
        },function (response) {
            var json = JSON.parse(response);
            showSwal(json["message"],'error',2000);
            isKeyOK = false;
            $("#keyTab").css('color','red');
        });
    }
    function keySettingsChanged(){
        var option = $("#useKey");
        if(option.is(':checked')){
            isKeyOK = false;
            $('#keyDiv').find('input, select').prop('disabled', false);
            $("#keyDiv").fadeIn(0);
        }else{
            isKeyOK = true;
            $("#keyTab").css('color','green');
            $("#summaryTab").click();
            $("#keyDiv").fadeOut(0);
            $('#keyDiv').find('input, select').prop('disabled', true);
        }
    }
    keySettingsChanged();
    
</script><?php /**PATH /liman/server/resources/views/keys/add.blade.php ENDPATH**/ ?>