---
layout: page
title: How To Handle Kaltura Server Notifications in PHP
---

Often applications require the ability to respond to asynchronous events that occurred on the Kaltura server. For example, when a Media Entry was uploaded, finished transcoding or any other status update. This guide will take you through the steps of listening to these events, called [Event Notifications,][1] how to parse the data carried in these notifications and respond properly in your applications.

 [1]: https://developer.kaltura.com/api-docs/#/eventNotificationTemplate

Kaltura Notifications are HTTP POST requests that are sent by the Kaltura server to any defined accessible web URL whenever specific Kaltura events happen (e.g. Entry added, deleted, etc.).

Utilizing Kaltura Server Notifications allows applications to achieve the following:

*   Easily respond on a "push form" whenever media events occur on the Kaltura server.
*   Implement a synchronized local management instance of media related metadata and thumbnails for improving website performance. This may include local media searching and caching capabilities.

The full list of notifications sent by the Kaltura server are available on the <a href="https://developer.kaltura.com/recipes/backend_notifications#/start" target="_blank">Kaltura Notifications API docs</a>.

<p class="mce-heading-2">
  Configuring The Kaltura API Notifications PHP Client
</p>

The KalturaNotificationClient was developed by Kaltura. It is a helper class that was created to simplify the creation of the notification handler. 

The KalturaNotificationClient constructor takes in the <a href="http://php.net/manual/en/reserved.variables.post.php" target="_blank">$_POST</a> params array and the Kaltura account Admin Secret. When created (instanced), the KalturaNotificationClient object verifies that the given $_POST array is a valid Kaltura Notification Object, builds a native PHP object and performs a basic <a href="http://en.wikipedia.org/wiki/Checksum" target="_blank">checksum</a> check to verify that the Notification signature is valid (this procedure verifies that the given $_POST array was not modified by a "<a href="http://en.wikipedia.org/wiki/Man-in-the-middle_attack" target="_blank">man in the middle</a>" using the admin secret). 

<div class="mce-heading-3">
  <span style="font-size: 14pt;">What are the situations in which the same notification might be sent twice?</span>
</div>

<div>
  <br /><div>
    An entry_add notification might be sent twice if it is set to be sent by both a client application (such as the Kaltura Contribution Wizard) and the Kaltura server.
  </div>
  
  <div>
    Other notifications will not be sent twice in general, however the following scenario might occur: If the HTTP response of the notification_handler would not be 200, the Kaltura server will retry to send this notification.
  </div>
</div>

<div class="mce-heading-3">
  The Metadata Based API Notifications Handler Client<span style="color: #000000; font-size: 10px;"> </span>
</div>

<div>
  <p>
    This package is an example of using Kaltura notifications, you may implement your own handler classes following our example.
  </p>
  
  <p class="mce-procedure">
    To use the api notifications client in your application, follow these steps:
  </p>
  
  <ol>
    <li>
      Unpack the zip file on a "public" web server accessible from the internet.
    </li>
    <li>
      Set up an instance Kaltura PHP 5.3 client library - Place contents of the 'Client' sub-folder found in the PHP 5.3 client library, under the <your handler web folder>\lib\Kaltura\Client
    </li>
    <li>
      Set up the special synchronization Metadata field:
    </li>
    <ol>
      <li>
        Access the KMC, under settings/custom data add a new schema called apinotifications_sync_data
      </li>
      <li>
        Add the following field to the profile:<br /><img src="../../assets/878.img">
      </li>
    </ol>
    
    <li>
      Make sure the configuration settings are properly populated:
    </li>
    <ol>
      <li>
        In session_config.php: Set up your partner id, admin secret and Kaltura service url
      </li>
      <li>
        In script_config.php: Set up the metadata field that will hold the synchronization status information for each entry
      </li>
    </ol>
    
    <li>
      Setting up notifications on Kaltura:
    </li>
    <ol>
      <li>
        Access the KMC and set up notifications under Settings>Integration Settings>Notifications. Refer to the knowledge center for more details - http://knowledge.kaltura.com/node/167
      </li>
      <li>
        Select the type of notification you want to be triggered and add the path the public server that host the nofication script
      </li>
    </ol>
    
    <li>
      To test your notification handler, open an entry in the KMC and update it (if you set up notification as "Update Entry" for instance). Kaltura should trigger a notification and execute your script on the public server where it has been installed
    </li>
    <li>
      To check if your notification handler went through, check the log in the "log" directory.
    </li>
  </ol>
  
  <p class="mce-heading-3">
    Add Your Code to Handle the Notification
  </p>
  
  <ol>
    <li>
      Open the following file: lib/Kaltura/Notification/Handler/SyncEntry.php
    </li>
    <li>
      Find line 190 and add your code inline.<br /><img src="../../assets/879.img">
    </li>
  </ol>
</div>

<p class="mce-heading-2 mce-heading-3">
  Set up the Notifications Handler endpoint
</p>

The last step is to indicate the endpoint URL that will listen to the Kaltura Notifications.

<p class="mce-procedure">
    To setup the Notifications endpoint, follow these steps:
</p>

1.  In the <a href="http://www.kaltura.com/index.php/kmc" target="_blank">Kaltura Management Console (KMC)</a>.
2.  Enter the Settings tab.
3.  Enter the Integration Settings sub-tab.
4.  In the "Enter Notification URL" field, paste the URL to your notifications handler script.

 <img src="/sites/default/files/u16/notifications.jpg" border="0" width="500" height="354" />

<p class="mce-note-graphic">
  Kaltura version Eagle and below don't support more than a single site distribution of notifications per publisher account.
</p>

 

<p class="mce-heading-2">
  multi-notifications 
</p>

Publisher accounts with high activity (many entries are being added and updated all the time), may opt to enable multi-notifications.

When multi-notifications is enabled, if a large amount of notifications for the same publisher account are aggregated in the queue and needs to be sent – the server can send all (or few) of them in a single combined HTTP request ("multi") to protect the publisher server from over-load, and potentially to reduce the delays.

<p class="mce-note-graphic">
  multi-notifications is disabled by default on all publisher accounts. <br />Kaltura SaaS edition customers - If you suspect that your account require multi-notifications, consult your Kaltura Account Manager on enabling multi-notifications.<br /><br />
</p>

<p class="mce-heading-3">
  Enabling multi-notifications on Kaltura Community and On Prem Editions
</p>

<p class="mce-procedure">
    To enable multi-notifications for a publisher account, follow these steps:
</p>

1.  Edit the Publisher Account Configuration Settings in the Admin Console (Choose Configure in the Actions menu)
2.  Check the box for "Allow multi-notifications" under the "Advanced Notification Settings".

<p class="mce-heading-3">
  The splitMultiNotifications method
</p>

When multi-notifications is enabled on the publisher account, the KalturaNotificationClient object will parse the multi-notifications received from the Kaltura server into an array of notifications, according to the prefixed POST parameters (for example: "not1\_entryId={},not1\_mediaType={},not2_entryId={},...").

The KalturaNotificationClient calls the splitMultiNotifications function in the constructor to create an array of notifications. Each element in the array is an associative array of the notification fields and values.
