// common.js

function displayFileName() {
    var fileInput = document.getElementById('fileUpload');
    var fileNameDisplay = document.getElementById('file-name');

    if (fileInput.files.length > 0) {
        var fileName = fileInput.files[0].name;
        fileNameDisplay.textContent = 'Selected File: ' + fileName;
    } else {
        fileNameDisplay.textContent = '';
    }
}

function validateForm() {
    var relevantInformationRadio = document.getElementsByName("relevantInformation");
    var selectedValue = false;

    for (var i = 0; i < relevantInformationRadio.length; i++) {
        if (relevantInformationRadio[i].checked) {
            selectedValue = true;
            break;
        }
    }

    var errorMsg = document.getElementById("error-msg");

    if (!selectedValue) {
        errorMsg.textContent = " * Please select Yes or No for relevant information.";
        errorMsg.style.color = "red";
        return false;
    } else {
        errorMsg.textContent = ""; 
    }

    return true;
}

function nextTab() {
    var tabLinks = document.getElementsByClassName("tablinks");
    var currentTab = document.querySelector(".next-tab") || tabLinks[0];

    var currentIndex = Array.from(tabLinks).indexOf(currentTab);
    var nextIndex = (currentIndex + 1) % tabLinks.length;

    tabLinks[nextIndex].click();
}

document.addEventListener("DOMContentLoaded", function () {
    var activeTab = window.location.hash.substr(1);

    if (activeTab) {
        openTab(null, activeTab);
    }
});

function openTab(event, tabName) {
    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }

    document.getElementById(tabName).style.display = "block";

    if (event) {
        event.currentTarget.classList.add("active");
    }
    document.querySelector('[onclick="openTab(event, \'' + tabName + '\')"]').classList.add("active");

    window.location.hash = tabName;
}

document.addEventListener('DOMContentLoaded', function () {
    var textarea = document.getElementById('description');
    var charCountElement = document.getElementById('char-count');

    textarea.addEventListener('input', function () {
        var currentCharCount = textarea.value.length;

        charCountElement.textContent = currentCharCount + '/2000 Characters Entered';
    });
});

