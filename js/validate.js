function validateForm() {
    var errormessage = "";
    alert("In the validate section")
    if (document.getElementbyId('firstName').value == "") {
        errormessage += "enter your first name /n";
        document.getElementById('fname').style.borderColor = "red";
    }
    if (document.getElementbyId('lastName').value == "") {
        errormessage += "enter your last name /n";
        document.getElementById('lname').style.borderColor = "red";
    }
    if (document.getElementsById('emailAddress').value == "") {
        errormessage += "enter your email /n";
        document.getElementById('emailAddress').style.borderColor = "red";
    }
    if (document.getElementbyId('passWord').value == "") {
        errormessage += "enter your password /n";
        document.getElementById('passWord').style.borderColor = "red";
    }
    if (document.getElementbyId('passWordRpt').value == "") {
        errormessage += "enter your password again/n";
        document.getElementById('passWordRpt').style.borderColor = "red";
    }
    if (errormessage != "") {
        alert(errormessage);
        return false;
    }
}