---
layout: page
title: "What can you configure in the Integration Settings?"
date: 2011-12-24 20:22:51
---

<span style="color: #000000; font-family: Times New Roman; font-size: medium;"> </span><span class="mce-heading-2">Account Info</span>

The account info window displays account information. The Partner ID is your Kaltura account identification number. The Sub Partner ID is generally deprecated and kept for backward compatibility of older Kaltura based applications.

The Administrator Secret and User Secret are the API private keys used to generate authentication tokens for sessions with the Kaltura servers when using the API. Since the keys can be used to run API commands on your content in Kaltura, you should keep these secret. Usually, the user secret is enough for all activities and therefore this is the key that should be provided to parties wishing to access your Kaltura account via API. The Admin Secret can be used to login as an administrator, and therefore can be used to perform any action on your account.

<p class="mce-procedure">
  <a name="access"></a>To access the account info in the KMC, go to the Settings tab and select Integration Settings.
</p>

For more information, please refer to the <a href="http://knowledge.kaltura.com/kaltura-api-documentation-set" target="_blank">Kaltura API Documentation Set</a>.

<img src="../../assets/224.img">

<p class="mce-procedure">
  To view additional low-level account settings information
</p>

Click Advanced Settings to open the advanced Account Settings display. Changing the advanced settings will take effect only for new content ingested (from the moment changes have been saved) and is not retroactive.
