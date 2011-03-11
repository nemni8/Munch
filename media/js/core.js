function admincheckbox($checkadmin) {
if (!document.getElementById('checkadmin').checked)
    document.getElementById('checksupadmin').checked=false;

};
function supadmincheckbox($checkadmin) {
if (document.getElementById('checksupadmin').checked)
    document.getElementById('checkadmin').checked=true;;
};