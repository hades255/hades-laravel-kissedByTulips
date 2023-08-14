<? require_once("../global/config.php"); 
require_once("check_access.php");

if(check_access('SETUP_COMMUNICATION') == 0 ){
	header("location:../index");
	exit;
}

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'FROM_NO';  
$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
				
$SEARCH = isset($_REQUEST['SEARCH']) ? mysql_real_escape_string($_REQUEST['SEARCH']) : '';
$offset = ($page-1)*$rows;
	
$result = array();
$where = " PK_COMPANY = '$_SESSION[PK_COMPANY]' ";
	
if($SEARCH != '')
	$where .= " AND (FROM_NO  like '%$SEARCH%' OR SID like '%$SEARCH%')";
	
$rs = $db->Execute("SELECT DISTINCT(PK_TEXT_SETTINGS) FROM TEXT_SETTINGS WHERE " . $where . " ");
$result["total"] = $rs->RecordCount();

$query = "SELECT PK_TEXT_SETTINGS,FROM_NO, SID, TOKEN,IF(ACTIVE = 1,'<i class=\'fa fa-square round_green icon_size_active\' ></i>','<i class=\'fa fa-square round_red icon_size_active\' ></i>') AS ACTIVE FROM TEXT_SETTINGS WHERE " . $where . " order by $sort $order ";
$rs = $db->Execute($query . " limit $offset,$rows");

$items = array();
while (!$rs->EOF) {
	$str  = '&nbsp;<a href="text_account?id=' . $rs->fields['PK_TEXT_SETTINGS'] . '" title="EDIT" class="btn edit-color btn-circle"><i class="far fa-edit"></i> </a>';
	$str .= '&nbsp;<a href="javascript:void(0);" onclick="delete_row(' . $rs->fields['PK_TEXT_SETTINGS'] . ')" title="DELETE" class="btn delete-color btn-circle"><i class="far fa-trash-alt"></i></a>';
	$rs->fields['ACTION'] = $rs->fields['ACTIVE'] . $str;
	array_push($items, $rs->fields);
	$rs->MoveNext();
}
$result["rows"] = $items;
echo json_encode($result);
