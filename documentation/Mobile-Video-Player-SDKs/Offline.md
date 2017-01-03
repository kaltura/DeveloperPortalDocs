temp
---
layout: page
title: Offline Playback - Integration Guide
weight: 150
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 
[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-android)

The native mobile SDKs (Android and iOS) allow applications to play downloaded content when the device is offline. Read this article to learn how to configure offline playback and to use downloaded files with the Player.

> Note: The SDK **does not** provide the download function or the download URL. This should be provided by the application.

## Supported Use Case

This is the general supported use case for offline playback. Starting with a just-installed app, the following should work:

1. Play any video while online
2. Download and register another video
3. Go offline
4. Play the video that was downloaded in step 2.

> The requirement to play any video while online (step 1) is a limitation that will be fixed in a future version of the Player SDK.

## Implementing Offline Playback

From the application's point-of-view, there are three parts to implementing offline playback:

1. Downloading the media files, including retrieving the URL of the content and downloading it.
2. Registering the downloaded files with the Player SDK (when the device is still online).
3. Overriding the streaming playback URL with the downloaded file.

## Integration Points  

Playing back downloaded assets requires two integration points between the application and the SDK - **management** and **playback**.

### Asset Management  

Local assets are managed in `LocalAssetsManager`/`KPLocalAssetsManager`. The following Asset Management operations are available:

#### Register  

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

##### Local Content ID  

The `entryConfig` object provided must include an additional field that is not used when streaming: `localContentId`. This unique string is used to map registration information to playback. The same unique string must be provided for both registration and playback.
> Note: localContentId must **not** be set for online playback.

#### Check Status  

This allows the application to verify that a downloaded asset is still playable. This applies mostly to DRM-protected assets.

#### Refresh  

If possible, refresh the metadata obtained in `Register`, including the DRM license.

#### Unregister

The application notifies the SDK that it has deleted the asset. The SDK cleans up related resources.

#### Arguments  

All methods share the same set of arguments:

* `entry`: A configured `KPPlayerConfig` object that points at the asset, with all the parameters required for regular playback of the asset, in addition to `localContentId`
* `flavor`: The flavor id of the downloaded file
* `localPath`: The *absolute* local path to the downloaded file

Additional arguments:

* Android: `Context`, listener
* iOS: callback block

### Asset Playback  

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

## Download Location Guidelines  

Application developers are free to choose download locations, as allowed by the platform; however, Kaltura recommends the following locations:

### Android  

Store the downloaded files in a directory returned by `context.getExternalFilesDir(Environment.DIRECTORY_DOWNLOADS)` (or in a subdirectory of the directory). This directory is owned by the application, is deleted on uninstall, and typically resides on a relatively large partition. In addition, starting with `KITKAT`, this directory does not require read/write permissions to the shared storage (`WRITE_EXTERNAL_STORAGE`).

### iOS  

As per Apple's current recommendation, downloaded video files should be stored in a subdirectory of the application's *Documents* directory – `[NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES) firstObject]`:

> Put user data in Documents/. User data generally includes any files you might want to expose to the user—anything you might want the user to create, import, delete or edit. For a drawing app, user data includes any graphic files the user might create. For a text editor, it includes the text files. **Video and audio apps may even include files that the user has downloaded to watch or listen to later**.

The selected subdirectory [must be excluded from iCloud backup](https://developer.apple.com/library/ios/qa/qa1719/_index.html).

For more information, see the Apple guide: [File System Programming Guide > File System Basics > Where You Should Put Your App’s Files](https://developer.apple.com/library/ios/documentation/FileManagement/Conceptual/FileSystemProgrammingGuide/FileSystemOverview/FileSystemOverview.html#//apple_ref/doc/uid/TP40010672-CH2-SW28).
