---
layout: page
title: Content Entitlements and Privacy Enforcement
weight: 103
---

Content Entitlements is a method for governing access of end-users to groups of content items (entries) using categories.  
Entitlements are configured at the category level, by setting a unique key to identify the applicative context in which to allow access to the category's entries.  

Applications such as [Kaltura MediaSpace](http://corp.kaltura.com/Products/Video-Applications/Kaltura-Mediaspace-Video-Portal) implement entitlements to achieve the concept of "Authenticated Content Channels".

Example use-cases based on content entitlements:

* Group collaboration based on channel membership
* Premium content - get access to channels/categories based on a paid subscription 

To learn about how to configure and work with Content Entitlements read the [Categories and Content Entitlements article](https://vpaas.kaltura.com/documentation/Secure_Control_and_Govern/Content-Categories-Management.html).  


The following diagram outlines the rules on which Kaltura bases and enforces content entitlements.  
You can configure the Kaltura system to be more restrictive or open in allowing access to your assets.  

{% include images/entitlements.svg %}

