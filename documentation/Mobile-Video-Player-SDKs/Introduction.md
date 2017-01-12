---
layout: page
title: Introduction to Kaltura Mobile Video SDK 2.0
weight: 100
---

The Kaltura Mobile SDKs for iOS and Android provide the framework and tools to help you easily embed the [Kaltura Video Player](http://player.kaltura.com/) into native environments in your iOS or Android applications, without having to build a Player UI, plugins, or capabilities from scratch. 

The SDK is essentially a native (i.e., Java or ObjectiveC-based code) wrapper that loads the same Kaltura Video Player inside a WebView. The Kaltura Video Player that is loaded into your native mobile application is essentially the **same** player that includes all of the customizations, themes, and plugins that are used on your website or web application. When the Kaltura Video Player loads into your native application, it seamlessly decides which is the best playback engine to leverage for playback (e.g., the native Media API of the device, a DRM provider’s API, etc.). This seamless behavior simplifies how you, the developer, build mobile video applications, by saving you the need to address video playback optimization, security, or (dz -ensuring the UI consistency) worry about maintaining the same UI across devices and platforms.

The Kaltura Vidoe Player SDK for iOS and Android supports:  

* DRM  
* IMA (DFP)  
* Chromecast  
* AirPlay  
* Offline Mode (including DRM)  
* PIP

and more...

## The Mobile SDK's Architecture Overview  

The Kaltura Video Player's architecture is designed to allow for a seamless integration experience, enabling you to connect mutltiple playback engines and platforms. The Kaltura Video Player wraps the playback engine with the same interface and events, thereby allowing the same plugin code to work across multiple platforms, including iOS, Android, and web.  

Each platform supports different types of streaming capabilites and DRMs. The Kaltura Video Player's technology determines the best streaming delivery method and DRM as needed. Plugins can be used with or without the UI, and can work cross-platform. Some plugins require native support, such as Chromecast, DRM and ads. The Kaltura Video Player-SDK provides the DRM, Chromecast, and ads features out-of-the-box.  

The Kaltura Video Player exposes APIs - both basic APIs and common - for all platforms. If you are an iOS developer and you have already worked with AVFoundation, you should expect the same API as if you used the native player API.  

The Player API supports sending notifications to the Kaltura Video Player, listening to events, and evaulating properties. 

Each Kaltura Video Video Player configuration includes the UICONF object, which includes the player configuration and indicates which plugins should be loaded. Every componenet of the layer is designed as a plugin.  

## The Kaltura Video Player Architecture

The following diagram visualizes the Kaltura Video Player architecture, and highlights its flexibility and robust capabilities across platforms and devices: 

![Kaltura Video Player Architecture Diagram](https://knowledge.kaltura.com/sites/default/files/styles/large/public/kaltura-player-toolkit.png)

As the diagram above illustrates, you can leverage native components for [iOS](https://github.com/kaltura/player-sdk-native-ios/) and [Android](https://github.com/kaltura/player-sdk-native-android) in conjunction with HTML5 runtime and Adobe Flash or Microsoft Silverlight plugins, to transcend platform limitations across devices and browsers, while delivering the full Kaltura Video Player v2 Toolkit experience. 

## When Should You Use Native Mobile SDKs?

What are the advantages of using native mobile SDKs? Here is a feature list that explains the advantages of using the Kaltura Video Player Toolkit in native environments:

| Player Feature | iOS WebView | iOS Native |Android WebView | Android Native |  
|:-------------  |:----------  |:---------- |:-------------- |:-------------- |  
|CSS skin      | Not supported on iPhone  | Supported  | Supported | Supported |  
|JS Plugins    | Supported                | Supported  | Supported | Supported |  
|Apple HLS Playback[AES] | Supported | Supported  | Broken support across fragmented | Supported |  
|MPEG-Dash |Unsupported | Supported via partners software players | Supported, with consistent experience across android versions | Supported |  
|AutoPlay     | Not supported  | Supported  | Not supported  | Supported |  
|Chromecast     | Not supported  | Supported  | supported  | Supported |  
|DRM     | Not supported  | Supported  | Not supported  | Supported |  
|Ads     | Supported without dual buffer | Supported  | Supported without dual buffer   | Supported |  

### Using and Configuring Player Objects - Native vs HTML5 controls  

One of the key features of the Player-SDK is the ability to use the HTML/CSS UI, which can be used on all platforms - iOS, Android and Web. As a developer you can choose if you want to:

* Work with the default skin  
* Develop your own skin
* Develop native controls  

#### Before You Begin  

Before getting started, we recommend you read the following article on [configuring the Kaltura Media Player](https://vpaas.kaltura.com/documentation/04_Web-Video-Player/Player-Configuration.html). You should also verify that you have your Player configured via KMC.

Additionally, the following article provides a detailed explanation on [accessing the iOS Player API base methods](https://vpaas.kaltura.com/documentation/05_Mobile-Video-Player-SDKs/Kaltura-iOS-player-API-Base-Methods.html).

#### Removing html5 UI Controls  

Use these commands to remove the html5 UI controls:

    [config addConfigKey:@"controlBarContainer.plugin" withValue:@"false"];
    [config addConfigKey:@"topBarContainer.plugin" withValue:@"false"];
    [config addConfigKey:@"largePlayBtn.plugin" withValue:@"false"];
    
#### Disabling the HTML Spinner and Controlling it with a Custom Spinner  

To disable the HTML Spinner and control it with a customer spinner, you will need to follow these configuration steps:

* To disable the HTML spinner, use the disable "loadingSpinner.plugin":

```
[config addConfigKey:@"loadingSpinner.plugin" withValue:@"false"];
```
* To start a buffering event, use "onAddPlayerSpinner":

```
[self.player addKPlayerEventListener:@"onAddPlayerSpinner" eventID:@"onAddPlayerSpinner" handler:^(NSString  
 *eventName, NSString *params) {
        //your code
    }];
```

* To stop a buffering event, use "onRemovePlayerSpinner":

```
[self.player addKPlayerEventListener:@"onRemovePlayerSpinner" eventID:@"onRemovePlayerSpinner" 
 handler:^(NSString *eventName, NSString *params) {
        //your code
    }];
```

#### Disabling Thumbnails

We can disable the loading of assets by setting uiconf:

```
[config addConfigKey:@"EmbedPlayer.HidePosterOnStart" withValue:@"true"];
[config addConfigKey:@"scrubber.sliderPreview" withValue:@"false"];
``` 

These settings will prevent loading the thumbnails assets.
Set this on your own discretion, as it is dependent of application usage (weather it uses web component scrubber or not, or if it needs poster on start or not).


## Player Version Managment  

The Mobile Video Player SDKs are native iOS and Android wrapper libraries for the [Kaltura Web Video Player Library](https://vpaas.kaltura.com/documentation/04_Web-Video-Player/Player-Configuration.html).  
We recommend using the latest version of both the Kaltura Web Video Player and the native Mobile Player SDKs.  

* You can upgrade the version of your Kaltura Web Video Player by using the [Player Studio](https://knowledge.kaltura.com/node/1148#Updating the Player) and clicking **Upgrade**.  
* To get the latest version of the Mobile Player SDK, always refer to the latest SDK tag on the github repository ([iOS SDK](https://github.com/kaltura/player-sdk-native-ios), [Android SDK](https://github.com/kaltura/player-sdk-native-android)).

## Kaltura Player Plugins  

Kaltura Player plugins use a combination of HTML, JavaScript and/or CSS to customize the Player, enabling you to use a plugin to add any feature that can be added to a web page. Plugins integrate with the Player by listening to and emitting events.

You can develop plugins to:
* Modify default behavior
* Add functionality
* Customize appearance

The Player-SDK provides an extensive selection of supported Player plugins. These plugins can be included via the Player studio by simply editing the **uiconf** object or changing the configuration in the **config** object.

The following are the Kaltura-provided plugins that you can implement in your system:

| Plugin  | Desciption | iOS  | Android |
|:------------- |:------------- |:---------------:| :-------------:|
| controlBarContainer | The controls container, can change the hover mode of this plugin      | V |         V |
| titleLabel    | Shows the title at the top        |    V |         V |
| logo |        |               V |         V |
| loadingSpinner |        |               V |         V |
| closedCaptions | Out of band caption        |               V |         V |
| watermark |        |               V |         V |
| theme | Custom style for the player - supported only for the web theme, Mobile is TBD       |               V |         V |
| infoScreen |        |               V |         V |
| share |  The share uses native capabilites for social networks     |               V |         V |
| youbora |  analytics plugin - add link      |               V |         V |
| DoubleClick | Ads - Full native support      |               V |         V |
| multiDrm | To enable DRM you'll need to enable this plugin       |               V |         V |
| Strings |  Used to overwrite player strings      |               V |         V |
| chromecast |  By default this plugin is enabled     |               V |         V |
| airPlay |  By default this plugin is enabled     |               V |         X |
| pipBtn | Picture-in-picture (PIP) -  By default this plugin is enabled and will work on supported devices   |               V |         X |

### How to Enable/Create a Plugin  
This section describes how to enable existing Kaltura plugins and how to create your own plugins.

##### Using an Existing Plugin

1. If you want to change or add a plugin, the key should begin with the plugin name, dot and the plugin attribute. Every plugin includes the plugin attributes required for enabling or disabling the plugin.
2. In order to add a plugin, use the addConfigKey function for [iOS](https://github.com/kaltura/player-sdk-native-ios/blob/master/KALTURAPlayerSDK/KPPlayerConfig.h#L57) or [Android](https://github.com/kaltura/player-sdk-native-android/blob/master/playerSDK/src/main/java/com/kaltura/playersdk/KPPlayerConfig.java#L86). Note that the first parameter takes the key name and the second takes the value.

In the example below, the loadingSpinner plugin has been disabled:

```
// objective_c
[config addConfigKey:@"loadingSpinner.plugin" withValue:@"false"];
```
```
// Java
config.addConfig("loadingSpinner.plugin", "false");
```

##### Creating Custom Plugins  

To create custom plugins, follow the steps in the article [Extending the Kaltura Web Video Player Functionality Using Plugins](https://vpaas.kaltura.com/documentation/Web-Video-Player/Player-Plugins.html).

#### How to Detect if Configured Plugins are Loaded  

1. Open the iOS Player API base by following the steps in the article [Accessing the iOS Player API Base Methods](https://github.com/kaltura/DeveloperPortalDocs/blob/master/documentation/05_Mobile-Video-Player-SDKs/Kaltura-iOS-player-API-Base-Methods.md).
2. Follow the instructions in * "Receiving  a Notification when the Player API is Ready" to detect if configured plugins are loaded.

#### How to Get Notified about Player Plugin-Related Callbacks  

1. Open the iOS Player API base by following the steps in the article [Accessing the iOS Player API Base Methods](https://github.com/kaltura/DeveloperPortalDocs/blob/master/documentation/05_Mobile-Video-Player-SDKs/Kaltura-iOS-player-API-Base-Methods.md).
2. Follow the instructions in * addKPlayerEventListener * to receive notifications about Player plugin-related callbacks.

## DRM Support  

The Player-SDK supports seamless playback of DRM content. Each platform supports a slightly different set of DRM schemes and features, which are detailed as follows.

* Emulators
	* *FairPlay* does not work on the iOS Simulator
	* *Widevine Classic* does not work on Android Emulator and iOS Simulator
	* *Widevine Modular* does not work on Android Emulator **with API level below 23**
		* On emulators with API level 23, it is considered a level-3 (L3) device

### DRM Server  

The Player-SDK must communicate with a license server in order to get the license, for both online and offline playback. The API between the SDK and the server is a simple http POST, where all required identify/authorization parameters are provided in the query string.

The license URL is provided to the DRM client by `PlayerViewController`/`KPViewController` in online mode (when playback is started), or by `LocalAssetManager`/`KPLocalAssetsManager` in offline mode (during asset registration/refresh).

The following are the high level sequence diagrams. Please note that they are internal to the Player-SDK, and are provided here for informational purposes only.

#### Online  

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

#### Offline  

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

### Offline Playback Integration  

The native mobile SDKs (Android and iOS) allow applications to play downloaded content when the device is offline. Read this section to learn how to configure offline playback and to use downloaded files with the Player.

> Note: The SDK **does not** provide the download function or the download URL. This should be provided by the application.

#### Supported Use Case

This is the general supported use case for offline playback. Starting with a just-installed app, the following should work:

1. Play any video while online
2. Download and register another video
3. Go offline
4. Play the video that was downloaded in step 2.

> The requirement to play any video while online (step 1) is a limitation that will be fixed in a future version of the Player SDK.

#### Implementing Offline Playback

From the application's point-of-view, there are three parts to implementing offline playback:

1. Downloading the media files, including retrieving the URL of the content and downloading it.
2. Registering the downloaded files with the Player SDK (when the device is still online).
3. Overriding the streaming playback URL with the downloaded file.

#### Integration Points  

Playing back downloaded assets requires two integration points between the application and the SDK - **management** and **playback**.

##### Asset Management  

Local assets are managed in `LocalAssetsManager`/`KPLocalAssetsManager`. The following Asset Management operations are available:

###### Register  

The application notifies the SDK about a new downloaded asset. The SDK fetches important metadata and a DRM license, if required.

{% plantuml %}
    @startuml
	participant App
	participant "Kaltura LocalAssetsManager" as LAM

	note over App: Downloads Media to //localPath//

	App->>LAM: registerAsset(entryConfig, flavorId, localPath)
	note over LAM: SDK acquires license
	alt Success
	LAM->>App: Success
	else Failure
	LAM->>App: Failure
	end
    @enduml
{% endplantuml %}

####### Local Content ID  

The `entryConfig` object provided must include an additional field that is not used when streaming: `localContentId`. This unique string is used to map registration information to playback. The same unique string must be provided for both registration and playback.
> Note: localContentId must **not** be set for online playback.

###### Check Status  

This allows the application to verify that a downloaded asset is still playable. This applies mostly to DRM-protected assets.

###### Refresh  

If possible, refresh the metadata obtained in `Register`, including the DRM license.

###### Unregister

The application notifies the SDK that it has deleted the asset. The SDK cleans up related resources.

###### Arguments  

All methods share the same set of arguments:

* `entry`: A configured `KPPlayerConfig` object that points at the asset, with all the parameters required for regular playback of the asset, in addition to `localContentId`
* `flavor`: The flavor id of the downloaded file
* `localPath`: The *absolute* local path to the downloaded file

Additional arguments:

* Android: `Context`, listener
* iOS: callback block

##### Asset Playback  

To override the default (streaming) playback URL with a downloaded file, the application provides a delegate to the Player.

* Android: Set `CustomSourceURLProvider` in `PlayerViewController` to an implementation of `PlayerViewController.SourceURLProvider`
* iOS: Set `customSourceURLProvider` in `KPViewController` to an implementation of `KPSourceURLProvider`

The delegate contains a single method that, given an entryId, returns an alternative (local) asset URL. If the method returns null, the Player uses the default playback URL. The method is meant to be hooked to a Download Manager's lookup function.

The Custom URL provider is called at the beginning of every playback. This allows the application to change the playback source dynamically. For example:

* Download files for the highest available quality, play downloaded files even when online
* Download files for medium quality (to save storage space), but when online, play ABR to get better quality.

{% plantuml %}

	participant App
	participant "Kaltura Player" as KP

	App->KP: setCustomURLProvider(localURLProvider)
	App->KP: setConfig(entryConfig)
	App->KP: play()
	KP->localURLProvider: getURL(entryId)
	localURLProvider-->KP: localPath

	note over KP: Plays the downloaded file

{% endplantuml %}

As mentioned above, the `entryConfig` object must include the `localContentId` that was used during the registration of the same asset.

#### Download Location Guidelines  

Application developers are free to choose download locations, as allowed by the platform; however, Kaltura recommends the following locations:

##### Android  

Store the downloaded files in a directory returned by `context.getExternalFilesDir(Environment.DIRECTORY_DOWNLOADS)` (or in a subdirectory of the directory). This directory is owned by the application, is deleted on uninstall, and typically resides on a relatively large partition. In addition, starting with `KITKAT`, this directory does not require read/write permissions to the shared storage (`WRITE_EXTERNAL_STORAGE`).

##### iOS  

As per Apple's current recommendation, downloaded video files should be stored in a subdirectory of the application's *Documents* directory – `[NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES) firstObject]`:

> Put user data in Documents/. User data generally includes any files you might want to expose to the user—anything you might want the user to create, import, delete or edit. For a drawing app, user data includes any graphic files the user might create. For a text editor, it includes the text files. **Video and audio apps may even include files that the user has downloaded to watch or listen to later**.

The selected subdirectory [must be excluded from iCloud backup](https://developer.apple.com/library/ios/qa/qa1719/_index.html).

For more information, see the Apple guide: [File System Programming Guide > File System Basics > Where You Should Put Your App’s Files](https://developer.apple.com/library/ios/documentation/FileManagement/Conceptual/FileSystemProgrammingGuide/FileSystemOverview/FileSystemOverview.html#//apple_ref/doc/uid/TP40010672-CH2-SW28).

