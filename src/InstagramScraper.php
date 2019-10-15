<?php
// require('API.php');
//require('/bot/vendor/autoload.php');

require_once __DIR__ . '/InstagramScraper/Instagram.php';
require_once __DIR__ . '/InstagramScraper/Endpoints.php';
require_once __DIR__ . '/InstagramScraper/InstagramQueryId.php';
require_once __DIR__ . '/InstagramScraper/Traits/ArrayLikeTrait.php';
require_once __DIR__ . '/InstagramScraper/Traits/InitializerTrait.php';
require_once __DIR__ . '/InstagramScraper/Model/AbstractModel.php';
require_once __DIR__ . '/InstagramScraper/Model/Account.php';
require_once __DIR__ . '/InstagramScraper/Model/CarouselMedia.php';
require_once __DIR__ . '/InstagramScraper/Model/Comment.php';
require_once __DIR__ . '/InstagramScraper/Model/Location.php';
require_once __DIR__ . '/InstagramScraper/Model/Media.php';
require_once __DIR__ . '/InstagramScraper/Model/Tag.php';
require_once __DIR__ . '/InstagramScraper/Exception/InstagramException.php';
require_once __DIR__ . '/InstagramScraper/Exception/InstagramAuthException.php';
require_once __DIR__ . '/InstagramScraper/Exception/InstagramNotFoundException.php';

function searchInfo($user){
  //echo $user;
  $instagram = new \InstagramScraper\Instagram();
  $userInfo = $instagram->getAccount($user);
  
  if(is_object($userInfo)){
  	//$extractor="\0*\0";
    //tmp array to get protected data
	$userInfotmp=array(
    	'id'=>$userInfo->getId(),
    	'username' =>$userInfo->getUsername(),
    	'fullName' =>$userInfo->getFullName(),
    	'biography' => $userInfo->getBiography(),
    	'proPicUrl' => $userInfo->getProfilePicUrlHd(),
    	'externalLink' => $userInfo->getExternalUrl(),
    	'nPost' => $userInfo->getMediaCount(),
    	'nFollow' => $userInfo->getFollowsCount(),
    	'nFollowers' => $userInfo->getFollowedByCount(),
    	'isPrivate' => $userInfo->isPrivate(),
    	'isVerified' => $userInfo->isVerified()
  	);
  	unset($userInfo);
  	//$responseData = new stdClass();
	//foreach ($userInfotmp as $key => $value)
	//	{
   	//		$responseData->$key = $value;
	//	}
    //unset($userInfotmp);
    if(is_array($userInfotmp)){
    	return $userInfotmp;
        unset($userInfotmp);
    }
   //unset($userData);
 }
}

function searchPost($user){
  $instagram = new \InstagramScraper\Instagram();
  $accountInfo = $instagram->getAccount($user);
  // json_encode($accountInfo);
  $medias = $instagram->getMedias($user, $accountInfo->getMediaCount());
  $data=array();
for($i=0;$i<$accountInfo->getMediaCount();$i++){
// Let's look at $media
$media = $medias[$i];

// foreach ($accountData['medias'] as $media) {
//
//echo "Media info: ".$i."<br>";
$id= $media->getId();
$Shortcode= $media->getShortCode();
$Created= $media->getCreatedTime();
$Caption=$media->getCaption();
$Comments= $media->getCommentsCount();
$likes= $media->getLikesCount();
$link= $media->getLink();
$url= $media->getImageHighResolutionUrl();
$type= $media->getType();

$data[$i]=array(
          		'createdAt' =>$Created,
          		'caption' => $Caption,
          		'nComment' => $Comments,
          		'nLike' => $likes,
          		'link' => $link,
          		'url' => $url,
          		'mediaType' =>$type,
          		'shortCode' =>$Shortcode
            );



//$id.$Shortcode.$Created.$Caption.$Comments.$likes.$link.$url.$type;
}
return $data;
}

    //else var_dump($accountData);
  //var_dump($accountInfo);
/**
  $userInfo=array(
    'fullName' =>$accountInfo->getFullName(),
    'biography' => $accountInfo->getBiography(),
    'proPicUrl' => $accountInfo->getProfilePicUrl(),
    'externalLink' => $accountInfo->getExternalUrl(),
    'totPost' => $accountInfo->getMediaCount(),
    'nFollow' => $accountInfo->getFollowsCount(),
    'nFollowers' => $accountInfo->getFollowedByCount(),
    'isPrivate' => $accountInfo->isPrivate(),
    'isVerified' => $accountInfo->isVerified()
  );*/

  /**for($i=0;$i<$accountInfo->getMediaCount();$i++){
    $media = $accountData[$i];
    $userData=
      array(
        [$i],
        array(
          'createdAt' =>$media->getCreatedTime(),
          'caption' => $media->getCaption(),
          'nComment' => $media->getCommentsCount(),
          'nLike' => $media->getLikesCount(),
          'link' => $media->getLink(),
          'url' => $media->getImageHighResolutionUrl(),
          'mediaType' => $media->getType(),
          'shortCode' => $media->getShortCode()
          )
      );
  }*/
  
  
  /**
  var_dump($accountInfo);
  	//for($i=0;$i<$accountInfo->getMediaCount();$i++){
  		echo "<br>";
  		var_dump($accountData);
  		//}
  }
  // for($i=0;$i<$accountInfo->getMediaCount();$i++){
  // // Let's look at $media
  // $media = $medias[$i];

// Available fields
// echo "Account info:<br>";
// echo "Id: {$accountInfo->getId()}<br>";
// echo "Username: {$accountInfo->getUsername()}<br>";
// echo "Full name: {$accountInfo->getFullName()}<br>";
// echo "Biography: {$accountInfo->getBiography()}<br>";
// echo "Profile picture url: {$accountInfo->getProfilePicUrl()}<br>";
// echo "External link: {$accountInfo->getExternalUrl()}<br>";
// echo "Number of published posts: {$accountInfo->getMediaCount()}<br>";
// echo "Number of follow: {$accountInfo->getFollowsCount()}<br>";
// echo "Number of followers: {$accountInfo->getFollowedByCount()}<br>";
// echo "Is private: {$accountInfo->isPrivate()}<br>";
// echo "Is verified: {$accountInfo->isVerified()}<br>";
//
// // $medias = $instagram->getMedias($user, $accountInfo->getMediaCount());
//
// // for($i=0;$i<$accountInfo->getMediaCount();$i++){
// // // Let's look at $media
// // $media = $medias[$i];
//
// foreach ($accountData['medias'] as $media) {
//
// echo "Media info: ".$i."<br>";
// echo "Id: {$media->getId()}<br>";
// echo "Shortcode: {$media->getShortCode()}\n";
// echo "Created at: {$media->getCreatedTime()}\n";
// echo "Caption: {$media->getCaption()}<br>";
// echo "Number of comments: {$media->getCommentsCount()}<br>";
// echo "Number of likes: {$media->getLikesCount()}<br>";
// echo "Get link: {$media->getLink()}";
// echo "High resolution image: {$media->getImageHighResolutionUrl()}<br>";
// echo "Media type (video or image): {$media->getType()}";
// $accountInfo = $media->getOwner();
// echo "Account info:\n";
// echo "Id: {$accountInfo->getId()}\n";
// echo "Username: {$accountInfo->getUsername()}\n";
// echo "Full name: {$accountInfo->getFullName()}\n";
// echo "Profile pic url: {$accountInfo->getProfilePicUrl()}\n";
// }

// $igBotUser='dwcq87@notua.com';
// $igBotPwd='Zxcvbnm01';
// // $igBotUser='';
// // $igBotPwd='';
//
//
// $instagram = \InstagramScraper\Instagram::withCredentials($igBotUser, $igBotPwd, '/cache');
// $instagram->login();
//
// $stories = $instagram->getStories();
// print_r($stories);
//







              #GET FOLOWER LIST
// $followers = [];
// $accountInfo = $instagram->getAccount($user);
// sleep(1);
// $followers = $instagram->getFollowers($accountInfo->getId(), 1000, 100, true); // Get 1000 followers of 'kevin', 100 a time with random delay between requests
// echo '<pre>' . json_encode($followers, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</pre>';
?>
