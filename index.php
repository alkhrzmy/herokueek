<?php

date_default_timezone_set('Asia/Jakarta');

require_once('./line_class.php');
require_once('./unirest-php-master/src/Unirest.php');

$jam=date('H:i');

$channelAccessToken = 'lnM7vNx/FZ6lM/0RmHnCpwLxxki6Y1ZV2p4ICGuoifizwNcwaW2rRDkdTvozXNSiNe7S12gkYtJK60htIreuziweHwH0jl28/+3ECANcFNzKS3SV76PMTbcWYnMzfv3wifDjFoRJeUCqF2UQl3DwYQdB04t89/1O/w1cDnyilFU=';
$channelSecret = 'ef79c3f7de6d9fb3589a8d5c9dfc866a';

$client = new LINEBotTiny($channelAccessToken, $channelSecret);

$userId = $client->parseEvents()[0]['source']['userId'];
$groupId = $client->parseEvents()[0]['source']['groupId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp = $client->parseEvents()[0]['timestamp'];
$type = $client->parseEvents()[0]['type'];

$message = $client->parseEvents()[0]['message'];
$messageid = $client->parseEvents()[0]['message']['id'];

$profil = $client->profil($userId);
$profileName = $profil->displayName;
$profileURL = $profil->pictureUrl;
$profileStatus = $profil->statusMessage;
$roomId = $client->parseEvents()[0]['source']['roomId'];

$pesan_datang = explode(" ", $message['text']);

$commandSingle = strtolower($message['text']);
$command = $pesan_datang[0];
$options = $pesan_datang[1];

#----------POSTBACK------------#
// Jenis Pesan Postback
$datetime           = $client->parseEvents()[0]['postback']['params']['date'];
$postbackData = $client->parseEvents()[0]['postback']['data'];
$postbackPesan = explode(" ", strtolower($postbackData));
$commandPostback = $postbackPesan[0];
$optionsPostback = $postbackPesan[1];
if (count($postbackPesan) > 2) {
	for ($i = 2; $i < count($postbackPesan); $i++) {
		$optionsPostback .= '+';
		$optionsPostback .= $postbackPesan[$i];
	}
}
#----------END----------#


if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}
$path = "https://alkhrzmy.online/remindme/";
$IdAdmin = "U6492dbccec39e3db72af41aa3f0ebad5";

if($type=='join'){
    $balas=array(
        'replyToken'=>$replyToken,
        'messages'=>array(
			array (
  'type' => 'flex',
  'altText' => 'Halo! Terima kasih sudah mengundang',
  'contents' => 
  array (
    'type' => 'bubble',
    'direction' => 'ltr',
    'hero' => 
    array (
      'type' => 'image',
      'url' => 'https://imgbbb.com/images/2019/04/30/tanjirou_back2.png',
      'flex' => 1,
      'size' => 'full',
      'aspectRatio' => '20:13',
      'aspectMode' => 'cover',
    ),
    'body' => 
    array (
      'type' => 'box',
      'layout' => 'vertical',
      'spacing' => 'md',
      'contents' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'text' => 'Tanjirou\'s Bot',
          'margin' => 'xs',
          'size' => 'xl',
          'align' => 'center',
          'gravity' => 'top',
          'weight' => 'bold',
          'action' => 
          array (
            'type' => 'uri',
            'label' => 'None',
            'uri' => 'line://ti/p/~alkhoarizmy',
          ),
          'wrap' => true,
        ),
        1 => 
        array (
          'type' => 'text',
          'text' => 'Terima kasih sudah mengundang Tanjirou!',
          'flex' => 1,
          'size' => 'xs',
        ),
        2 => 
        array (
          'type' => 'text',
          'text' => 'Ketik Help atau klik tombol dibawah ini',
          'size' => 'xs',
        ),
      ),
    ),
    'footer' => 
    array (
      'type' => 'box',
      'layout' => 'vertical',
      'contents' => 
      array (
        0 => 
        array (
          'type' => 'button',
          'action' => 
          array (
            'type' => 'postback',
            'label' => 'Help',
            'data' => 'Help',
          ),
          'flex' => 1,
          'color' => '#2687E7',
          'height' => 'sm',
          'style' => 'primary',
          'gravity' => 'top',
        ),
      ),
    ),
  ),
)
            ));
}

if($type == 'follow') {
    $getNamez = json_decode(file_get_contents($path.'/name.php?userId='.$userId),TRUE);
    $getName = $getNamez['displayName'];
    $responses['to'] = $IdAdmin;
    $responses['messages']['0']['type'] = "text";
    $responses['messages']['0']['text'] = $getName." telah menambahkan bot ini sebagai teman";
    $result = json_encode($responses);
    $result_json = json_decode($result, TRUE);
    $client->pushMessage($result_json);
    
    $pushy = array(
        'replyToken'=>$replyToken,
        'messages'=>array(
                array (
  'type' => 'flex',
  'altText' => 'Trims!',
  'contents' => 
  array (
    'type' => 'bubble',
    'direction' => 'ltr',
    'hero' => 
    array (
      'type' => 'image',
      'url' => 'https://imgbbb.com/images/2019/04/30/tanjirou_back2.png',
      'size' => 'full',
      'aspectRatio' => '20:13',
      'aspectMode' => 'cover',
    ),
    'body' => 
    array (
      'type' => 'box',
      'layout' => 'vertical',
      'spacing' => 'md',
      'contents' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'text' => 'Terima Kasih',
          'size' => 'xl',
          'align' => 'center',
          'weight' => 'bold',
        ),
        1 => 
        array (
          'type' => 'text',
          'text' => 'Telah menambahkan aku sebagai teman',
          'size' => 'xs',
        ),
        2 => 
        array (
          'type' => 'text',
          'text' => 'Invite ke Group ya kak '.$getName,
          'size' => 'xs',
          'gravity' => 'top',
        ),
        3 => 
        array (
          'type' => 'text',
          'text' => 'Ketik help atau klik dibawah ini',
          'size' => 'xs',
          'gravity' => 'top',
        ),
      ),
    ),
    'footer' => 
    array (
      'type' => 'box',
      'layout' => 'vertical',
      'contents' => 
      array (
        0 => 
        array (
          'type' => 'button',
          'action' => 
          array (
            'type' => 'postback',
            'label' => 'Help',
            'data' => 'Help',
          ),
          'flex' => 2,
          'color' => '#196BBB',
          'height' => 'sm',
          'style' => 'primary',
          'gravity' => 'top',
        ),
      ),
    ),
  ),
)
                ));
    $client->replyMessage($pushy);
}







# PostBack Data Here

if ($type == 'postback'){
	if ($commandPostback == 'Help'){
		$balas = array(
			'replyToken' => $replyToken,
				'messages' => array(
					array (
  'type' => 'flex',
  'altText' => 'Help Message',
  'contents' => 
  array (
    'type' => 'bubble',
    'direction' => 'ltr',
    'header' => 
    array (
      'type' => 'box',
      'layout' => 'vertical',
      'contents' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'text' => 'Command List',
          'size' => 'lg',
          'align' => 'center',
          'weight' => 'bold',
          'color' => '#178BDB',
        ),
        1 => 
        array (
          'type' => 'separator',
          'color' => '#31B4D2',
        ),
      ),
    ),
    'body' => 
    array (
      'type' => 'box',
      'layout' => 'vertical',
      'contents' => 
      array (
        0 => 
        array (
          'type' => 'text',
          'text' => 'Anime',
          'flex' => 1,
          'size' => 'lg',
          'align' => 'center',
          'weight' => 'bold',
        ),
        1 => 
        array (
          'type' => 'separator',
        ),
        2 => 
        array (
          'type' => 'text',
          'text' => '> /anime-search [Judul Anime]',
          'size' => 'sm',
          'align' => 'start',
          'action' => 
          array (
            'type' => 'message',
            'label' => '/search one punch',
            'text' => '/search one punch',
          ),
        ),
        3 => 
        array (
          'type' => 'text',
          'text' => '> /anime-stats [Judul Anime]',
          'size' => 'sm',
          'action' => 
          array (
            'type' => 'message',
            'label' => '/anime-stats',
            'text' => '/anime-stats',
          ),
        ),
        4 => 
        array (
          'type' => 'text',
          'text' => '> /anime-moreinfo [Judul Anime]',
          'flex' => 1,
          'size' => 'sm',
        ),
        5 => 
        array (
          'type' => 'text',
          'text' => '> /anime-news',
          'size' => 'sm',
          'align' => 'start',
          'gravity' => 'center',
          'action' => 
          array (
            'type' => 'message',
            'label' => '/news',
            'text' => '/anime-news',
          ),
          'wrap' => true,
        ),
        6 => 
        array (
          'type' => 'text',
          'text' => '> /anime-genre [Judul Anime]',
          'flex' => 1,
          'size' => 'sm',
        ),
        7 => 
        array (
          'type' => 'text',
          'text' => 'Manga',
          'size' => 'lg',
          'align' => 'center',
          'weight' => 'bold',
        ),
        8 => 
        array (
          'type' => 'separator',
        ),
        9 => 
        array (
          'type' => 'text',
          'text' => '> /manga-search [Nama Manga]',
          'flex' => 1,
          'size' => 'sm',
        ),
        10 => 
        array (
          'type' => 'text',
          'text' => '> /manga-karakter [Nama Manga]',
          'size' => 'sm',
        ),
        11 => 
        array (
          'type' => 'text',
          'text' => '> /manga-moreinfo [Nama Manga]',
          'size' => 'sm',
        ),
        12 => 
        array (
          'type' => 'text',
          'text' => '> /manga-news',
          'flex' => 1,
          'size' => 'sm',
        ),
        13 => 
        array (
          'type' => 'text',
          'text' => 'More',
          'flex' => 1,
          'size' => 'lg',
          'align' => 'center',
          'weight' => 'bold',
        ),
        14 => 
        array (
          'type' => 'separator',
        ),
        15 => 
        array (
          'type' => 'text',
          'text' => '> /schedule',
          'flex' => 0,
          'size' => 'sm',
        ),
        16 => 
        array (
          'type' => 'text',
          'text' => '> /season [Musim]',
          'size' => 'sm',
          'weight' => 'regular',
          'action' => 
          array (
            'type' => 'message',
            'label' => '/season winter',
            'text' => '/season winter',
          ),
          'wrap' => true,
        ),
      ),
    ),
  ),
)
				),
		);
	}
}



# End
if (isset($balas)) {
    $result = json_encode($balas);
//$result = ob_get_clean();

    file_put_contents('./balasan.json', $result);


    $client->replyMessage($balas);
}
?>
