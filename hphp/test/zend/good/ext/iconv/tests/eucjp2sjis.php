<?hh
/* include('test.inc'); */
/* charset=EUC-JP */

$str = "
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
日本語テキストとEnglish Text
";

$str = iconv("EUC-JP", "SJIS", $str);
$str = base64_encode($str);
echo $str."\n";

