---
layout: page
title: How To Handle Kaltura Server Notifications in PHP
---

Often applications require the ability to respond to asynchronous events that occurred on the Kaltura server. For example, when a Media Entry was uploaded, finished transcoding or any other status update. This guide will take you through the steps of listening to these events, called [Event Notifications](https://developer.kaltura.com/api-docs/#/eventNotificationTemplate), how to parse the data carried in these notifications, and how to respond properly in your applications.

Kaltura Notifications are HTTP POST requests that are sent by the Kaltura server to any defined accessible web URL whenever specific Kaltura events happen (e.g., Entry added, deleted, etc.).

Utilizing Kaltura Server Notifications allows applications to achieve the following:

*   Easily respond on a "push form" whenever media events occur on the Kaltura server.
*   Implement a synchronized local management instance of media related metadata and thumbnails for improving website performance. This may include local media searching and caching capabilities.

The full list of notifications sent by the Kaltura server are available in the [Kaltura Notifications API docs](https://developer.kaltura.com/recipes/backend_notifications#/start).

## Configuring The Kaltura API Notifications PHP Client  

The KalturaNotificationClient was developed by Kaltura as a helper class that was created to simplify the creation of the notification handler. 

The KalturaNotificationClient constructor takes in the [$_POST](http://php.net/manual/en/reserved.variables.post.php) params array and the Kaltura account Admin Secret. When created (instanced), the KalturaNotificationClient object verifies that the given $_POST array is a valid Kaltura Notification Object, builds a native PHP object and performs a basic [checksum](http://en.wikipedia.org/wiki/Checksum")
check to verify that the Notification signature is valid (this procedure verifies that the given $_POST array was not modified by a [man in the middle](http://en.wikipedia.org/wiki/Man-in-the-middle_attack) using the admin secret). 

### In which Situations Might the Same Notification be Sent Twice?  

An entry_add notification might be sent twice if it is set to be sent by both a client application (such as the Kaltura Contribution Wizard) and the Kaltura server.

Other notifications will not be sent twice in general, however the following scenario might occur: If the HTTP response of the notification_handler would not be 200, the Kaltura server will retry to send this notification.

### The Metadata Based API Notifications Handler Client  

This package is an example of using Kaltura notifications, you may implement your own handler classes following our example.

To use the API notifications client in your application, follow these steps:

1 . Unpack the zip file on a "public" web server accessible from the internet.

2 . Set up an instance Kaltura PHP 5.3 client library - Place contents of the 'Client' sub-folder found in the PHP 5.3 client library, under the <your handler web folder>\lib\Kaltura\Client.

3 . Set up the special synchronization Metadata field:

 a. Access the KMC, under settings/custom data add a new schema called apinotifications_sync_data
 
 b. Add the following field to the profile:

 ![Profile Field](./images/Defining a sync status custom metadata field.PNG)

4 . Make sure the configuration settings are properly populated:

 a. In session_config.php: Set up your partner id, admin secret and Kaltura service url

 b. In script_config.php: Set up the metadata field that will hold the synchronization status information for each entry

5 . Setting up notifications on Kaltura:
Access the KMC and set up notifications under Settings>Integration Settings>Notifications. Refer to the article [What types of notifications are there in the KMC?](http://knowledge.kaltura.com/node/167) for more details.

6 . Select the type of notification you want to be triggered and add the path the public server that host the nofication script

7 . To test your notification handler, open an entry in the KMC and update it (if you set up notification as "Update Entry" for instance). Kaltura should trigger a notification and execute your script on the public server where it has been installed

8 . To check if your notification handler went through, check the log in the "log" directory.

### Add Your Code to Handle the Notification  

1. Open the following file: lib/Kaltura/Notification/Handler/SyncEntry.php.
2. Find line 190 and add your code inline:

 ![Code inline](./images/Screen Shot 2012-11-29 at 6.49.04 PM.png)

### Set up the Notifications Handler Endpoint  

The last step in this process is to indicate the endpoint URL that will listen to the Kaltura Notifications.

To setup the Notifications endpoint, follow these steps:

1.  In the [Kaltura Management Console](http://www.kaltura.com/index.php/kmc), go to the Settings tab.
3.  Enter the Integration Settings sub-tab.
4.  In the "Enter Notification URL" field, paste the URL to your notifications handler script.

 ![Notification URL](./images/notifications.jpg)



## Multi-notifications  

Publisher accounts with high activity (many entries are being added and updated all the time), may opt to enable multi-notifications.

When multi-notifications is enabled, if a large amount of notifications for the same publisher account are aggregated in the queue and needs to be sent – the server can send all (or few) of them in a single combined HTTP request ("multi") to protect the publisher server from over-load, and potentially to reduce the delays.

>Note:  Multi-notifications is disabled by default on all publisher accounts. Kaltura SaaS edition customers - If you suspect that your account require multi-notifications, consult your Kaltura Account Manager on enabling multi-notifications.


### Enabling Multi-notifications on Kaltura Community and On Prem Editions  

To enable multi-notifications for a publisher account, follow these steps:

1.  Edit the Publisher Account Configuration Settings in the Admin Console (Choose Configure in the Actions menu).
2.  Check the box for "Allow multi-notifications" under the "Advanced Notification Settings".

### The splitMultiNotifications Method

When multi-notifications is enabled on the publisher account, the KalturaNotificationClient object will parse the multi-notifications received from the Kaltura server into an array of notifications, according to the prefixed POST parameters (for example: "not1\_entryId={},not1\_mediaType={},not2_entryId={},...").

The KalturaNotificationClient calls the splitMultiNotifications function in the constructor to create an array of notifications. Each element in the array is an associative array of the notification fields and values.
