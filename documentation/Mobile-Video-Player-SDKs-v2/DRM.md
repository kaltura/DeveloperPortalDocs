test
---
layout: page
title: DRM Support
weight: 140
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 
[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-android)

The Player-SDK supports seamless playback of DRM content. Each platform supports a slightly different set of DRM schemes and features, which are detailed as follows.

### DRM Support in Android Devices  

The following DRM schemes are supported in Android devices:

#### Widevine Modular  

* Supported in Android 4.3 and up
* Online and offline playback

#### Widevine Classic  

* Supported in Android 3.0 to 6.0, exclusive
    * Google no longer requires Widevine Classic support in Android 6.0 devices, but some devices still support it.
* Online and offline playback

#### Device Info

[Kaltura Device Info App](https://play.google.com/store/apps/details?id=com.kaltura.kalturadeviceinfo) can help diagnosing DRM and Media-related problems.

### DRM Support in iOS Devices

The following DRM schemes are supported in iOS devices:

#### FairPlay  

* Supported in iOS versions 8 and up
* Online playback only
    * iOS 10, due in September 2016, supports offline. A future version of the Player SDK will support it.

#### Widevine Classic  

* Supported in iOS versions up to 10, exclusive
* Online and offline playback

## Known Limitations  

* Widevine Classic
	* iOS: ATS must be disabled for localhost URLs
	* Android: files can't be served over https (SSL)

* Emulators
	* *FairPlay* does not work on the iOS Simulator
	* *Widevine Classic* does not work on Android Emulator and iOS Simulator
	* *Widevine Modular* does not work on Android Emulator **with API level below 23**
		* On emulators with API level 23, it is considered a level-3 (L3) device

## DRM Server  

The Player-SDK must communicate with a license server in order to get the license, for both online and offline playback. The API between the SDK and the server is a simple http POST, where all required identify/authorization parameters are provided in the query string.

The license URL is provided to the DRM client by `PlayerViewController`/`KPViewController` in online mode (when playback is started), or by `LocalAssetManager`/`KPLocalAssetsManager` in offline mode (during asset registration/refresh).

The following are the high level sequence diagrams. Please note that they are internal to the Player-SDK, and are provided here for informational purposes only.

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

[More about offline playback](Offline).
