<?		set_time_limit(12000);
		$strLoginData = 'user_id=sujinyue&password=123456' ;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://www.lydsy.com/JudgeOnline/login.php");
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/99.99 (compatible; MSIE 99.99; Windows XP 99.99)");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $strLoginData);
		curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_exec($ch);
		curl_close($ch);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
		curl_setopt($ch, CURLOPT_URL, "http://www.lydsy.com/JudgeOnline/problem.php?id=".$_GET['id']);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/99.99 (compatible; MSIE 99.99; Windows XP 99.99)");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $strSubmitData);
		$str=curl_exec($ch);
		curl_close($ch);
		?>