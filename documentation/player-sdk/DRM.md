---
layout: page
title: DRM Support
---

# Overview
The Player SDK seamlessly supports playback of DRM content. Each platform support a slightly different set of DRM schemes and features.

# Android
* Widevine Modular
	* Supported in Android 4.3 and up
	* Online playback only
		* Offline playback will be supported in v2.6.0 of the Player SDK.
* Widevine Classic
	* Supported in Android 3.0 to 6.0, exclusive
	* Online and offline playback
	* Some Android 6.0 devices are still supported

# iOS
* FairPlay
	* Supported in iOS versions 8 and up
	* Online playback only
		* A future version of FairPlay/iOS *may* support offline. No commitment from Apple.
* Widevine Classic
	* Supported in iOS versions up to 10, exclusive
	* Online and offline playback

# Known Limitations
* Android:
	* Widevine Classic files cannot be served over http**s**.
* iOS:
	* Widevine Classic requires that iOS ATS is disabled for localhost URLs.



