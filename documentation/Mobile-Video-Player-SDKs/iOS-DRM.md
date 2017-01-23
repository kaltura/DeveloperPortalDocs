---
layout: page
title: DRM Support in iOS Devices
subcat: SDK 3.0 (Beta) - iOS
weight: 295
---

The following DRM schemes are supported in iOS devices:

### FairPlay  

* Supported in iOS versions 8 and up
* Offline playback is supported in iOS 10 and up
  * Our interim solution for iOS 8 and 9 is Widevine Classic -- see below.

### Widevine Classic  

* Supported in iOS 8 and up
* Online and offline playback

## Known Limitations  
* DRM does not work on the iOS Simulator
* Widevine Classic:
  * Requires ATS to be disabled for 127.0.0.1
  * Requires Bitcode to be disabled (the core library does not support Bitcode)

