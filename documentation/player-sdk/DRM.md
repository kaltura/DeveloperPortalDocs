---
layout: page
title: DRM Support
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 
[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)

This article describes the available DRM support for Android and iOS devices.

## Overview
The Player SDK seamlessly supports playback of DRM content. Each platform supports a slightly different set of DRM schemes and features.

### DRM Support in Android Devices
The following DRMs are supported in Android devices:
* Widevine Modular
	* Supported in Android 4.3 and up
	* Online playback only
		* Offline playback will be supported in v2.6.0 of the Player SDK.
* Widevine Classic
    * Supported in Android 3.0 to 6.0, exclusive
        * Google no longer requires Widevine Classic support in Android 6.0 devices, but some devices still support it.
    * Online and offline playback

### DRM Support in iOS Devices
The following DRMs are supported in iOS devices:
* FairPlay
	* Supported in iOS versions 8 and up
	* Online playback only
		* A future version of FairPlay/iOS *may* support offline. [No commitment from Apple](https://forums.developer.apple.com/message/18444).
* Widevine Classic
	* Supported in iOS versions up to 10, exclusive
	* Online and offline playback

## Known Limitations
* Android:
	* Widevine Classic files cannot be served over http**s**.
* iOS:
	* Widevine Classic requires that iOS ATS be disabled for localhost URLs.

## DRM Server
The Player SDK must communicate with a license server in order to get the license, for both online
and offline playback. The API between the SDK and the server is a simple http POST, where all required
identify/authorization parameters are provided in the query string.

The license URL is provided to the DRM client by `PlayerViewController`/`KPViewController` in online
mode (when playback is started), or by `LocalAssetManager`/`KPLocalAssetsManager` in offline mode (during
asset registration/refresh).

The following are the high level sequence diagrams. Please note that they are internal to the Player SDK, and are
provided here for informational purposes only.

### Online
{% plantuml %}

    @startuml
    participant App
    participant KalturaPlayer as Player
    participant KalturaServer
    participant DRMClient
    participant LicenseServer

    App->Player: play(entry)
    Player->PlaybackEngine: play(entry.playbaclUrl)
    Player->KalturaServer: getLicenseData(entry, flavorId)
    KalturaServer-->Player: licenseUri

    Player->DRMClient: acquireLicense(entry.playbackUrl, licenseUri)
    DRMClient->LicenseServer: acquireLicense(assetInfo, licenseUri)
    LicenseServer-->DRMClient: license
    DRMClient->DRMClient: processLicense(license)
    DRMClient->Player: acquired()

    Player->App: playing()
    @enduml

{% endplantuml %}

### Offline
{% plantuml %}

    @startuml
    participant App
    participant LocalAssetManager as LAM
    participant DRMClient
    participant KalturaServer
    participant LicenseServer

    App->LAM: registerAsset(entry, localPath, flavorId)
    LAM->KalturaServer: getLicenseData(entry, flavorId)
    KalturaServer-->LAM: licenseUri

    LAM->DRMClient: acquireLicense(localPath, licenseUri)
    DRMClient->LicenseServer: acquireLicense(assetInfo, licenseUri)
    LicenseServer-->DRMClient: license
    DRMClient->DRMClient: processLicense(license)
    DRMClient->LAM: acquired()

    LAM->App: registered()
    @enduml

{% endplantuml %}

