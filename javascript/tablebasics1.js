// mredkj.com
// 2005-08-15 - created
// 2006-05-14 - updated
function appendRow(tblId)
{
	var tbl = document.getElementById(tblId);
	var newRow = tbl.insertRow(tbl.rows.length);
	var newCell = newRow.insertCell(0);
	newCell.innerHTML = 'Hello World!';
}
function deleteLastRow(tblId)
{
	var tbl = document.getElementById(tblId);
	if (tbl.rows.length > 0) tbl.deleteRow(tbl.rows.length - 1);
}
function insertRow(tblId, txtIndex, txtError)
{
	var tbl = document.getElementById(tblId);
	var rowIndex = document.getElementById(txtIndex).value;
	try {
		var newRow = tbl.insertRow(rowIndex);
		var newCell = newRow.insertCell(0);
		newCell.innerHTML = 'Hello World! insert';
	} catch (ex) {
		document.getElementById(txtError).value = ex;
	}
}
function deleteRow(tblId, txtIndex, txtError)
{
	var tbl = document.getElementById(tblId);
	var rowIndex = document.getElementById(txtIndex).value;
	try {
		tbl.deleteRow(rowIndex);
	} catch (ex) {
		document.getElementById(txtError).value = ex;
	}
}
