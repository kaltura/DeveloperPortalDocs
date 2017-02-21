---
layout: page
title: Best Practices - Code Example for Configuring a Kaltura Session
---

<pre class="brush: as3;gutter: false; fontsize: 100; first-line: 1; ">&lt;?php

// include the KalturaClient PHP client library to be able to use its funtions/objects
require_once(dirname(__FILE__).'/lib/KalturaClient.php');


/*********************** ACCOUNT CONFIGURATION START ***********************/

// Kaltura account ID (partner ID)
define('KALTURA_PARTNER_ID', PARTNER_ID);

// Kaltura account admin secret
define('KALTURA_ADMIN_SECRET', ADMIN_SECRET);

// Kaltura service URL (can be changed to work with on-prem deployments)
define('KALTURA_SERVICE_URL', 'http://www.kaltura.com/');

/************************ ACCOUNT CONFIGURATION END ************************/

 

/**
* @return KalturaClient object with a valid KS according to the supplied parameters
* @param KalturaSessionType $sessionType
* @param string $userId
* @param int $sessionExpiry
* @param string $sessionPrivileges
*/
function getClient($sessionType, $userId = '', $sessionExpiry = 86400, $sessionPrivileges = '')
{
// Create KalturaClient object using the accound configuration
$config = new KalturaConfiguration(KALTURA_PARTNER_ID);
$config-&gt;serviceUrl = KALTURA_SERVICE_URL;
$client = new KalturaClient($config);

// Generate KS string locally, without calling the API
$ks = $client-&gt;generateSession(
  KALTURA_ADMIN_SECRET,
  $userId,
  $sessionType,
  $config-&gt;partnerId,
  $sessionExpiry,
  $sessionPrivileges
);

// Set the generated KS to be used for future API calls from this KalturaClient object
$client-&gt;setKs($ks);

// return the KalturaClient object
return $client;?&gt;</pre>
