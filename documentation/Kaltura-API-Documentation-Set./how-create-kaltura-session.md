---
layout: page
title: How to Create a Kaltura Session
weight: 103
---

The Kaltura API is <a href="http://en.wikipedia.org/wiki/Representational_state_transfer" target="_blank" title="Representational state transfer (REST) is a style of software architecture for distributed systems such as the World Wide Web. REST has emerged over the past few years as a predominant Web service design model. REST has increasingly displaced other design models such as SOAP and WSDL due to its simpler style.">REST</a> based and <a href="http://en.wikipedia.org/wiki/Stateless_protocol" target="_blank">stateless</a>. Every call (request) made to the Kaltura API requires an authentication key, the Kaltura Session (aka KS), identifying the account on which the action to be carried, the authenticated user and its role.

A Kaltura Session can be initiated in 3 different ways:

1.  Calling the session.start action, providing the account Partner ID and an Admin or User secret key.  
    <pre class="brush: php;fontsize: 100; first-line: 1; ">$ks = $client-&gt;session-&gt;start ($adminSecret, $anyUserName, KalturaSessionType::ADMIN, $partnerId);  
$client-&gt;setKS($ks);</pre>

2.  Calling the user.loginByLoginId action, providing a User login ID (email), its Password and the account Partner ID.  
    <pre class="brush: php;fontsize: 100; first-line: 1; ">$ks = $client-&gt;user-&gt;loginByLoginId($loginId, $password, $partnerId);  
$client-&gt;setKS($ks);</pre>

3.  Creating a session locally - Combine all the Kaltura Session details, and sign them using the shared secret.  
    <pre class="brush: php;fontsize: 100; first-line: 1; ">$ks = $client-&gt;generateSession($adminSecret, $userId, $type, $partnerId);  
$client-&gt;setKS($ks);</pre>

The examples above using the [Kaltura PHP5 Client Library](https://developer.kaltura.com/api-docs/#/Client%20Libraries).

 

>**Important Security Notes:**

1.  The ADMIN type KS provides super admin priveliges to the Kaltura account. If you're creating an application where the session will be exposed to the end-user, make sure that you are using a USER type KS and not ADMIN type. Exposing an ADMIN type KS in non-administrative context will expose your Kaltura account to risks of being used by malicious users with unrestricted access.</strong>
2.  Sharing the account API secret keys with 3rd party vendors should be avoided, as secret keys can not be regenerated or blocked for access. Kaltura API based application developers and 3rd party application vendors should build their application to leverage the user.loginByLoginId API and ask the publisher for their email, password and account Id (aka partnerId). Users can be easily created, removed or blocked and their password can easily be changed. </strong>

 

To learn more about the KS and its usage read the article [Kaltura's API Authentication and Security](https://vpaas.kaltura.com/documentation/VPaaS-API-Getting-Started/Kaltura_API_Authentication_and_Security.html).

 > Note: To use the Kaltura API, you will need a Publisher Account with API access. Start a [free Kaltura.com trial](http://corp.kaltura.com/free-trial) or [download Kaltura CE](http://www.kaltura.org/project/community_edition_video_platform).
