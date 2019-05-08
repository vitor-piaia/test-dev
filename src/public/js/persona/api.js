var state = document.getElementById('content-capture');
var currentFormat = Fingerprint.SampleFormat.PngImage;

window.onload = function () {
    localStorage.clear();
    test = new FingerprintSdk();
    readersDropDownPopulate(true); //To populate readers for drop down selection
    // disableEnable(); // Disabling enabling buttons - if reader not selected
    //enableDisableScanQualityDiv("content-reader"); // To enable disable scan quality div
    window.setTimeout(onStart, 1700);
};

var FingerprintSdk = (function () {
    function FingerprintSdk() {
        // var _instance = this;
        // this.operationToRestart = null;
        this.acquisitionStarted = false;
        this.sdk = new Fingerprint.WebApi;
        this.sdk.onDeviceConnected = function (e) {
            // Detects if the deveice is connected for which acquisition started
            showMessage("Pronto para digitalizar");
        };
        this.sdk.onDeviceDisconnected = function (e) {
            // Detects if device gets disconnected - provides deviceUid of disconnected device
            showMessage("Dispositivo desconectado");
        };
        this.sdk.onCommunicationFailed = function (e) {
            // Detects if there is a failure in communicating with U.R.U web SDK
            showMessage("Falha na comunicação");
        };
        this.sdk.onSamplesAcquired = function (s) {
            // Sample acquired event triggers this function
            sampleAcquired(s);
        };
        this.sdk.onQualityReported = function (e) {
            // Quality of sample aquired - Function triggered on every sample acquired
            document.getElementById("qualityInputBox").value = Fingerprint.QualityCode[(e.quality)];
        }

    }

    FingerprintSdk.prototype.startCapture = function () {
        if (this.acquisitionStarted) // Monitoring if already started capturing
            return;
        var _instance = this;
        showMessage("");
        this.operationToRestart = this.startCapture;
        this.sdk.startAcquisition(currentFormat, myVal).then(function () {
            _instance.acquisitionStarted = true;

            //Disabling start once started
            disableEnableStartStop();

        }, function (error) {
            showMessage(error.message);
        });
    };

    FingerprintSdk.prototype.stopCapture = function () {
        if (!this.acquisitionStarted) //Monitor if already stopped capturing
            return;
        var _instance = this;
        showMessage("");
        this.sdk.stopAcquisition().then(function () {
            _instance.acquisitionStarted = false;

            //Disabling stop once stoped
            disableEnableStartStop();

        }, function (error) {
            showMessage(error.message);
        });
    };

    FingerprintSdk.prototype.getInfo = function () {
        var _instance = this;
        return this.sdk.enumerateDevices();
    };

    FingerprintSdk.prototype.getDeviceInfoWithID = function (uid) {
        var _instance = this;
        return  this.sdk.getDeviceInfo(uid);
    };


    return FingerprintSdk;
})();

function showMessage(message){
    var _instance = this;
    //var statusWindow = document.getElementById("status");
    x = state.querySelectorAll(".status-fg");
    if(x.length != 0){
        $(".status-fg").html(message);
    }
}

function readersDropDownPopulate(checkForRedirecting){ // Check for redirecting is a boolean value which monitors to redirect to content tab or not
    myVal = "";
    var allReaders = test.getInfo();
    allReaders.then(function (sucessObj) {
        var readersDropDownElement = document.getElementById("readersDropDown");
        readersDropDownElement.innerHTML ="";
        //First ELement
        var option = document.createElement("option");
        option.selected = "selected";
        option.value = "";
        option.text = "Selecione";
        readersDropDownElement.add(option);
        for (i=0;i<sucessObj.length;i++){
            var option = document.createElement("option");
            option.value = sucessObj[i];
            option.text = sucessObj[i];
            readersDropDownElement.add(option);
        }

        //Check if readers are available get count and  provide user information if no reader available,
        //if only one reader available then select the reader by default and sennd user to capture tab
        checkReaderCount(sucessObj,checkForRedirecting);

    }, function (error){
        showMessage(error.message);
    });
}

function checkReaderCount(sucessObj,checkForRedirecting){
    if(sucessObj.length == 0){
        alert("No reader detected. Please insert a reader.");
    }else if(sucessObj.length == 1){
        document.getElementById("readersDropDown").selectedIndex = "1";
    }

    selectChangeEvent(); // To make the reader selected
}

function selectChangeEvent(){
    var readersDropDownElement = document.getElementById("readersDropDown");
    myVal = readersDropDownElement.options[readersDropDownElement.selectedIndex].value;
    // disableEnable();
    onClear();
    // document.getElementById('imageGallery').innerHTML = "";

    //Make capabilities button disable if no user selected
    if(myVal == ""){
        $('#capabilities').prop('disabled', true);
    }else{
        $('#capabilities').prop('disabled', false);
    }
}

function sampleAcquired(s){
    if(currentFormat == Fingerprint.SampleFormat.PngImage){
        // If sample acquired format is PNG- perform following call on object recieved
        // Get samples from the object - get 0th element of samples as base 64 encoded PNG image
        var finger_area = document.getElementById("finger_area").value;
        localStorage.setItem("imageSrc", "");
        var samples = JSON.parse(s.samples);
        localStorage.setItem("imageSrc", "data:image/png;base64," + Fingerprint.b64UrlTo64(samples[0]));
        var vDiv = '';
        var image = document.createElement("img");
        if(state == document.getElementById("content-capture")){
            if(finger_area === '1'){
                vDiv = document.getElementById('imagediv-collector');
                vDiv.innerHTML = "";
                image.id = "image";
                image.src = localStorage.getItem("imageSrc");
                vDiv.appendChild(image);
            }else if(finger_area === '2'){
                vDiv = document.getElementById('imagediv-witness');
                vDiv.innerHTML = "";
                image.id = "image";
                image.src = localStorage.getItem("imageSrc");
                vDiv.appendChild(image);
            }else{
                vDiv = document.getElementById('imagediv');
                vDiv.innerHTML = "";
                image.id = "image";
                image.src = localStorage.getItem("imageSrc");
                vDiv.appendChild(image);
            }
        }

        disableEnableExport(false);
    }

    else if(currentFormat == Fingerprint.SampleFormat.Raw){
        // If sample acquired format is RAW- perform following call on object recieved
        // Get samples from the object - get 0th element of samples and then get Data from it.
        // Returned data is Base 64 encoded, which needs to get decoded to UTF8,
        // after decoding get Data key from it, it returns Base64 encoded raw image data
        localStorage.setItem("raw", "");
        var samples = JSON.parse(s.samples);
        var sampleData = Fingerprint.b64UrlTo64(samples[0].Data);
        var decodedData = JSON.parse(Fingerprint.b64UrlToUtf8(sampleData));
        localStorage.setItem("raw", Fingerprint.b64UrlTo64(decodedData.Data));

        var vDiv = document.getElementById('imagediv').innerHTML = '<div id="animateText" style="display:none">RAW Sample Acquired <br>'+Date()+'</div>';
        setTimeout('delayAnimate("animateText","table-cell")',100);

        disableEnableExport(false);
    }

    else if(currentFormat == Fingerprint.SampleFormat.Compressed){
        // If sample acquired format is Compressed- perform following call on object recieved
        // Get samples from the object - get 0th element of samples and then get Data from it.
        // Returned data is Base 64 encoded, which needs to get decoded to UTF8,
        // after decoding get Data key from it, it returns Base64 encoded wsq image
        localStorage.setItem("wsq", "");
        var samples = JSON.parse(s.samples);
        console.log(samples);
        var sampleData = Fingerprint.b64UrlTo64(samples[0].Data);
        var decodedData = JSON.parse(Fingerprint.b64UrlToUtf8(sampleData));
        localStorage.setItem("wsq","data:application/octet-stream;base64," + Fingerprint.b64UrlTo64(decodedData.Data));

        var vDiv = document.getElementById('imagediv').innerHTML = '<div id="animateText" style="display:none">WSQ Sample Acquired <br>'+Date()+'</div>';
        setTimeout('delayAnimate("animateText","table-cell")',100);

        disableEnableExport(false);
    }

    else if(currentFormat == Fingerprint.SampleFormat.Intermediate){
        // If sample acquired format is Intermediate- perform following call on object recieved
        // Get samples from the object - get 0th element of samples and then get Data from it.
        // It returns Base64 encoded feature set
        localStorage.setItem("intermediate", "");
        var samples = JSON.parse(s.samples);
        var sampleData = Fingerprint.b64UrlTo64(samples[0].Data);
        localStorage.setItem("intermediate", sampleData);

        var vDiv = document.getElementById('imagediv').innerHTML = '<div id="animateText" style="display:none">Intermediate Sample Acquired <br>'+Date()+'</div>';
        setTimeout('delayAnimate("animateText","table-cell")',100);

        disableEnableExport(false);
    }

    else{
        alert("Format Error");
        //disableEnableExport(true);
    }
}

function disableEnableStartStop(){
    if(!myVal == ""){
        if(test.acquisitionStarted){
            $('#start').prop('disabled', true);
            $('#stop').prop('disabled', false);
        }else{
            $('#start').prop('disabled', false);
            $('#stop').prop('disabled', true);
        }
    }
}

function onStart() {
    if(currentFormat == ""){
        alert("Please select a format.")
    }else{
        test.startCapture();
    }
}

function onClear() {
    var finger_area = document.getElementById("finger_area").value;
    var vDiv = '';
    if(finger_area === '1'){
        vDiv = document.getElementById('imagediv-collector');
    }else if(finger_area === '2'){
        vDiv = document.getElementById('imagediv-witness');
    }else{
        vDiv = document.getElementById('imagediv');
    }
    $('#image').val('');
    vDiv.innerHTML = "";
    localStorage.setItem("imageSrc", "");
    localStorage.setItem("wsq", "");
    localStorage.setItem("raw", "");
    localStorage.setItem("intermediate", "");

    disableEnableExport(true);
}

function disableEnableExport(val){
    if(val){
        $('#saveImagePng').addClass('invisible');
    }else{
        $('#saveImagePng').removeClass('invisible');
    }
}