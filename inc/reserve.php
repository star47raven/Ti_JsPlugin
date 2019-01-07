<?php  
    define('ROOTDIR', "");
    require_once('php/consts.php');
	require_once('php/paths.php');
	require_once('php/tokener.php');
	header("Content-Type: text/json");
	$fx = file_get_contents($config_path_module);
	if ($fx)
		$confx = json_decode($fx);
	else 
		die;
	$enforceParams = array(
		'fullname' => null,
		'email' => null,
		'mobile' => null,
		'send_sms' => false,
		'send_email' => false,
		'cypherkey' => null
	);
	if ($confx->user->override) {
		$enforceParams['user_fullname'] = $confx->user->fullname;
		$enforceParams['user_email'] = $confx->user->email;
		$enforceParams['user_mobile'] = $confx->user->mobile;
	}
//	if (!empty($_GET['cypherkey'])) {
//		$userCypher = openCypherKey($_GET['cypherkey']);
//		if (empty($userCypher) && $confx->wordpress->forcelogin)
//			echo  '{"ok":false,"error":{"code":401,"message":"Need to login."}}';
//			die;
//	}
//	else
//		echo  '{"ok":false,"error":{"code":401,"message":"Need to login."}}';
//		die;

//	  if (!empty($_GET['cypherkey'])) {
	//		$userCypher = openCypherKey($_GET['cypherkey']);
		//	if (empty($userCypher))
			//	echo  '{"ok":false,"error":{"code":401,"message":"Need to login."}}';
				//die;
	  //}
		//	else if ($confx->wordpress->forcelogin)
			//	echo '{"ok":false,"error":{"code":401,"message":"Need to login."}}';
				//die;


    $params = "?";
    if (!isset($_GET['urn']))
    {
        echo  '{"ok":false,"error":{"code":400,"message":"Bad request."}}';
		die;
    }
    foreach ($_GET as $getKey => $getVal)
        if ($getKey != 'urn' && $getKey != 'cypherkey' && (!isset($enforceParams[$getKey]) || $enforceParams[$getKey] != null)) {
			$params .= $getKey . '=' . urlencode($getVal) . '&';
		}
    $head = array(
        'http' => array(
            'ignore_errors' => true,
            'method' => "GET",
            'header' => "Zb-Auth: " . _ZB_APPID . ':' . _ZB_SECRET
        )
    );
    $cont = stream_context_create($head);
    $uri = "https://store.zirbana.com/v2/" . $_GET['urn'] . "/reserve" . $params;
	$vrx = file_get_contents($uri, false, $cont);
	
		try {
		$jdat = json_decode($vrx);
		if ($jdat->ok) {
			$xpayload = array(
				'reserve' => $jdat->data->reserve_id,
				'trace' => $jdat->data->trace_number,
				'mode' => (empty($userCypher)) ? 'mx' : $userCypher['mode']
			);
			if (!empty($userCypher))
				$payload = array_merge($xpayload, $userCypher);
			else
			$payload = array_merge($xpayload, array(
				'fullname' => isset($_GET['fullname']) ? $_GET['fullname'] : $_GET['user_fullname'],
				'email' => isset($_GET['email']) ? $_GET['email'] : $_GET['user_email'],
				'mobile' => isset($_GET['mobile']) ? $_GET['mobile'] : $_GET['user_mobile']
      ));
			$payload['igni'] = time();
		
			$jdat->token = signReservePayload($payload);
		echo json_encode($jdat);
			die;
		}
		else
			echo $vrx;
			die;
	}
	catch (Exception $e) {
		echo '{"ok":false,"error":{"code":500,"message":"Response was not acceptable."}}';
		die;
	}
?>