---
layout: page
title: Using Kaltura's API Developer Console Introduction
---

>Note: There are two versions to the Kaltura API, Partner Services 2 and 3, also known by the name api_v2 and api_v3.<br />Respectively, there are two versions of the TestMe Console. The <a href="https://developer.kaltura.com/console" class="bb-url">api_v2 TestMe</a> , which works with Version 2 of the API (api_v2), and <a href="https://developer.kaltura.com/console" class="bb-url">api_v3 TestMe</a> that is also a part of <a href="http://www.kaltura.org/project/kalturaCE" class="bb-url">KalturaCE</a> and is the recommended version of the API to use (api_v2 will be deprecated over time).

## Kaltura's API  

Like many recent web-based API implementations, Kaltura's API is constructed using "<a href="http://en.wikipedia.org/wiki/Representational_state_transfer" target="_blank">REST</a>" principles (it’s "RESTful"). REST provides a simpler architecture than API styles like SOAP. It is designed around the web's HTTP protocol itself by implementing a standard HTTP POST/GET URL encoded request/response structure.

Kaltura's API implementation had two major versions: “v2” and “v3”. API_v2 (aka Partner Services 2) is deprecated and should be avoided for all purposes other than backward compatible applications.

Kaltura API Responses by default are returned as XML text. JSON, JSONP and PHP Serialized are also available.

Kaltura's api\_v3 was designed to provide an OOP approach to Kaltura objects and services. In api\_v3 there is an hierarchy; Services represent the objects in the system. Services contain actions, and there is a clear separation between object types. For example, in api_v3 to retrieve an entry you should call the get action on the type of service you require (media, baseEntry, document, etc.) - i.e. to retrieve a media type entry - call media.get and to retrieve a category you should call category.get.

For more information about Kaltura's API v3, read: [Introduction to the Kaltura API Architecture][1].

 [1]: /introduction-kaltura-api-architecture

 
## Working with the Console    

Every Kaltura deployment includes a useful API developer tool named the “Test Me Console”. The API test console is availble at: *http://UrlToYourKalturaServer/api_v3/testme/* .

Next to the TestMe Console, you will also find the API Docs (automatically generated code docs) and the Client Libraries download page. To learn more, read the [Kaltura API Documentation Set][2].

 [2]: /kaltura-api-documentation-set

<p class="mce-heading-3">
  The TestMe Console UI
</p>

<img src="../../assets/223.img">

<p class="mce-note-graphic">
  Install the following Chrome extension to display TestMe XML responses correctly in a Chrome browser: <a href="https://chrome.google.com/extensions/detail/gbammbheopgpmaagmckhpjbfgdfkpadb" target="_blank">https://chrome.google.com/extensions/detail/gbammbheopgpmaagmckhpjbfgdfkpadb</a>
</p>

<span class="mce-heading-3">Services and Actions</span>

Kaltura’s API consists of several API service actions for querying, setting, updating and listing entities and for calling procedures within the Kaltura Platform.

Service actions are grouped as API services according to the entity type they apply on (e.g. Entry, Category, Playlist) and provide all actions relevant to the specific entity.

<img src="../../assets/219.img">

<p class="mce-heading-3">
  Creating a valid Kaltura Session
</p>

When working with the Kaltura API, a Kaltura Session (aka KS), represents the validation required to authenticate the user calling/performing the API action.

To create a KS, you need a Publisher Account in the Kaltura Server and that account should have API access.

There are two main methods for creating a Kaltura Session:

1.  Calling the <span style="font-family: 'courier new', courier;">session.start</span> action, providing a Partner ID and an Admin secret or User secret.
2.  Calling <span style="font-family: 'courier new', courier;">user.loginByLoginId</span>, providing a valid user login (email) and its password.

<p class="mce-procedure">
  To create a KS in the TestMe Console (using <em>session.start</em>)
</p>

1.  Select ***session*** from the <span>Select service</span> drop down list.  
    <img src="../../assets/220.img">
2.  Select the ***start*** from the Select action drop down list.  
    <img src="../../assets/221.img">
3.  Retrieve your API Admin secret or API User secrete from the <a href="http://www.kaltura.com/index.php/kmc/kmc4#account|integration" target="_blank">Integration Settings panel in KMC</a>.  
    <img src="../../assets/222.img">
4.  Insert your admin secret in the *secret (string)* text box.
5.  Select <span>ADMIN</span> from the *type (KalturaSessionType)* drop down list.
6.  Insert your Partner ID in the *partnerId (int)* text box.
7.  Click the ***Send button***.
8.  If you entered the right partner credentials, the result will be shown on the result panel and the ***KS field*** will show a string of random characters. Now you can proceed to performing API actions. 

 

<p class="mce-note-graphic">
  NOTE: As of api_v3, ADMIN KS can perform every action on the account (indicated by Partner ID). So be careful! - Do not expose your ADMIN secret generated KS to the public, only the USER type KS are safe to expose. <strong>And never expose your secret keys</strong>.
</p>

 

 
