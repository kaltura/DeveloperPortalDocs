temp
---
layout: page
title: Kaltura Player Support for the Chromecast Solution
weight: 411
---

This article describes the Kaltura Player support for the Chromecast solution.

## Overview  

### Player Compatibility  

The Kaltura player supports Chromecast on the following versions:
* **Mobile SDK V3** 
  * **iOS:** iOS 9, 10
  * **Android:** Android 4.2.2+
* **Web player** version 2.46+

### Cast API  

The Kaltura player supports Google’s Cast V3 APIs.

## Introduction to Chromecast  

Chromecast enables end users to cast media from their tablets, smartphones and chrome browsers to their TVs during viewing. Therefore, the assumption is that the end user owns and has attached a Chromecast device to their television.

### How does It Work?  

The Chromecast system consists of the following: 
*  A **Sender application** that is integrated within the player and is responsible for sending streaming requests to the Chromecast Receiver, 
*  A **Receiver application**, which is a separate HTML page that runs on the Chromecast dongle attached to the end user’s TV, and is responsible for receiving the streaming requests from the Sender application and presenting it on the TV.
Note that for Chromecast to work, the end user’s application and the Chromecast device must be connected to the **same wireless network**.

