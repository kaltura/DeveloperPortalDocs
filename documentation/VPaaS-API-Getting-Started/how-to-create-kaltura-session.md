---
layout: page
title: How to Create a Kaltura Session
weight: 103
---


The Kaltura API is representational state transfer (REST)(http://en.wikipedia.org/wiki/Representational_state_transfer)-based, which is a style of software architecture for distributed systems such as the World Wide Web. REST has emerged over the past few years as a predominant Web service design model. REST has increasingly displaced other design models such as SOAP and WSDL due to its simpler style and [statelessness](http://en.wikipedia.org/wiki/Stateless_protocol). Every call (request) made to the Kaltura API requires an authentication key, the Kaltura Session (aka KS), identifying the account on which the action to be carried, the authenticated user and its role.

### Methods for Generating a Kaltura Session  

There are three methods for generating a Kaltura Session:

* Calling the [session.start action](https://developer.kaltura.com/api-docs/Generate_API_Sessions/session/session_start): This method is recommended for scripts and applications to which you alone will have access.
* Calling the [user.loginByLoginId action](https://developer.kaltura.com/api-docs/Generate_API_Sessions/user_loginByLoginId): This method is recommended for managing registered users in Kaltura, and allowing users to log in using email and password. When you log in to the KMC, the KMC application calls the user.loginByLoginId action to authenticate you using your registered email and password.
* Using the [appToken service](https://developer.kaltura.com/api-docs/Generate_API_Sessions/appToken): This method is recommended when providing access to scripts or applications that are managed by others; this method provides tools to manage API tokens per application provider, revoke access to specific applications, and more.

The examples above use the [Kaltura PHP5 Client Library](https://developer.kaltura.com/api-docs/Client_Libraries).

> To learn more about the Kaltura Session, its algorithm, guidelines and options read the [Kaltura API Authentication and Security article](https://knowledge.kaltura.com/node/229).
 

## Important Security Notes  

1.  The ADMIN type KS provides super admin priveliges to the Kaltura account. If you're creating an application where the session will be exposed to the end-user, make sure that you are using a USER type KS and not ADMIN type. Exposing an ADMIN type KS in non-administrative context will expose your Kaltura account to risks of being used by malicious users with unrestricted access.</strong>
2.  Sharing the account API secret keys with 3rd party vendors should be avoided, as secret keys can not be regenerated or blocked for access. Kaltura API based application developers and 3rd party application vendors should build their application to leverage the user.loginByLoginId API and ask the publisher for their email, password and account Id (aka partnerId). Users can be easily created, removed or blocked and their password can be changed easily.

## Code Example for Configuring a Kaltura Session  

{% highlight php %}

// include the KalturaClient PHP client library to be able to use its functions/objects
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
$config->serviceUrl = KALTURA_SERVICE_URL;
$client = new KalturaClient($config);

// Generate KS string locally, without calling the API
$ks = $client->generateSession(
  KALTURA_ADMIN_SECRET,
  $userId,
  $sessionType,
  $config->partnerId,
  $sessionExpiry,
  $sessionPrivileges
);

// Set the generated KS to be used for future API calls from this KalturaClient object
$client->setKs($ks);

// return the KalturaClient object
return $client;

{% endhighlight %}

 > Note: To use the Kaltura API, you will need a Publisher Account with API access. Start a [free Kaltura.com trial](http://corp.kaltura.com/free-trial) or [download Kaltura CE](http://www.kaltura.org/project/community_edition_video_platform).
