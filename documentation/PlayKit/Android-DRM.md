---
layout: page
title: PlayKit Android DRM
subcat: Android Version 3.0
weight: 410
---

## DRM Support in Android Devices  

The following DRM schemes are supported in Android devices:

### Widevine Modular  

* Supported in Android 4.3 and up
* Online and offline playback

### Widevine Classic  

* Supported in Android 3.0 to 6.0, **exclusive**
    * Starting with Android 6, Google-certified Android devices are not required to support Widevine Classic
* Online and offline playback

## Known Limitations  

* Widevine Classic files (.wvm) cannot be served over https (SSL)
* Emulators
	* *Widevine Classic* does not work on the emulator
	* *Widevine Modular* only works on emulator with API level 23 and up

## Device Info

[Kaltura Device Info App](https://play.google.com/store/apps/details?id=com.kaltura.kalturadeviceinfo) can help in diagnosing DRM and Media-related problems.
