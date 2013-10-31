<?php
    // trackerimage.jpg.php
    
    // You are collecting some info about your users
    // in this case it's the email campaign they've opened...
    $campaignID = intval($_GET['campaignID']);
    // and the subscription ID - you saved that from your
    // double opt-in registration, right?
    $subscriptionID = intval($_GET['subscriptionID']);

    // load the Database abstractor
	require_once('settings.php');
    require_once('classes/EmailTracker.class.php');
    
    // someone accessed this script by opening an email
    // and displaying images.  Let's store that knowledge
    $EmailCampaign = new EmailCampaign($campaignID, $settings['mysql']);
    $EmailCampaign.emailOpenedBy($subscriptionID, time());


    // load the image
    $image = 'images/images.jpg';
    // getimagesize will return the mimetype for this image
    $imageinfo = getimagesize($image);
    $image_mimetype = $imageinfo['mime'];
    
    // tell the browser to expect an image
    header('Content-type: '.$image_mimetype);
    // send it an image
    echo file_get_contents($image);
    
?>
