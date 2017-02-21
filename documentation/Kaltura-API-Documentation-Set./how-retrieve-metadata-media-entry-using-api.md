---
layout: page
title: How to Retrieve Metadata of a Media Entry using the API?
---

To get a specific video entry, call the API [media.get](https://developer.kaltura.com/api-docs/#/media.get), which provides the ID of the Kaltura Entry.

The media.get request will return the basic metadata and information associated a Kaltura Entry.

 

Using the Kaltura REST API, the media.get request will look as follows:[][1]

 [1]: http://www.kaltura.com/api_v3/index.php?service=media&action=get&entryId=yourentryId&ks=%7bks%7d

<pre class="brush: plain;fontsize: 100; first-line: 1; ">http://www.kaltura.com/api_v3/index.php?service=media&action=get&entryId={yourentryId}&ks={ks}</pre>

Where *{yourentryId}* is the id of the media entry you'd like to retrieve information about, and *{ks}* is a valid [Kaltura Session][2] of an entitled user who has access to that media entry.

 [2]: http://knowledge.kaltura.com/node/461

For a full list of the available Media Entry fields that will be returned by the media.get API, visit the <a href="https://developer.kaltura.com/api-docs/#/media.get" target="_blank">media.get API documents</a>.

 
