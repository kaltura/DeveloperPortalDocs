---
layout: page
title: Offline Playback - Integration Guide
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 
[![Android](https://img.shields.io/badge/Android-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)

The native mobile SDKs (Android and iOS) allow applications to play downloaded content when the device is offline. After reading this article, a developer integrating with Kaltura Player's Native SDKs will know how to configure offline playback and to use downloaded files with the Player.


## Scope
The SDK allows the player to play downloaded content. In addition, DRM-protected content must be registered with the SDK immediately after download, while the device is still online.

The SDK **does not** provide the download function or the download URL. This should be provided by the application.

### Overview
From the application's point-of-view, there are three parts to implementing offline playback:

1. Downloading the media files, including retrieving the URL of the content and downloading it.
2. Registering the downloaded files with the Player SDK (when the device is still online).
3. Overriding the streaming playback URL with the downloaded file.

## Integration Points
Playing back downloaded assets requires two integration points between the application and the SDK - **management** and **playback**.

### Asset Management
Local Assets are managed in `LocalAssetsManager`/`KPLocalAssetsManager`. The following Asset Management operations are available:

#### Register

The application notifies the SDK about a new downloaded asset. The SDK fetches important metadata and a DRM license,
if required.

{% plantuml %}

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

{% endplantuml %}

#### Check Status
This allows the application to verify that a downloaded asset is still playable. This applies mostly to DRM-protected
assets.

#### Refresh
If possible, refresh the metadata obtained in `Register`, including the DRM license.

#### Unregister
The application notifies the SDK that it has deleted the asset. The SDK cleans up related resources.

#### Arguments
All methods share the same set of arguments:

* `entry`: A configured `KPPlayerConfig` object that points at the asset, with all the parameters required for regular playback of the asset
* `flavor`: The flavor id of the downloaded file
* `localPath`: The *absolute* local path to the downloaded file

Additional arguments:

* Android: `Context`, listener
* iOS: callback block

### Asset Playback
To override the default (streaming) playback URL with a downloaded file, the application provides a delegate to the
player.

* Android: set `CustomSourceURLProvider` in `PlayerViewController` to an implementation of `PlayerViewController.SourceURLProvider`
* iOS: set `customSourceURLProvider` in `KPViewController` to an implementation of `KPSourceURLProvider`

The delegate contains a single method that, given an entryId, returns an alternative (local) asset URL. If the method
returns null, the player uses the default playback URL. The method is meant to be hooked to a Download Manager's
lookup function.

The Custom URL provider is called at the beginning of every playback. This allows the application to change
the playback source dynamically. For example:

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

## Download Location Guidelines
Application developers are free to choose download locations; however, Kaltura recommends the following locations:

### Android
Files can be downloaded to any directory accessible by the application, including the application's directory in the internal storage, and any directory in the external/shared storage.

It is recommended to store downloaded files in the directory returned by `context.getExternalFilesDir(Environment.DIRECTORY_DOWNLOADS)`. This directory is owned by the application, is deleted on uninstall, and typically resides on a relatively large partition. In addition, starting with `KITKAT`, this directory does not require read/write permissions to the shared storage (`WRITE_EXTERNAL_STORAGE`).

### iOS
Per Apple's current recommendation, downloaded video files should be stored in a subdirectory of the application's *Documents* directory – `[NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES) firstObject]`. The selected subdirectory **must** be excluded from backup.

For more information, see Apple's {% extlink File System Programming Guide > File System Basics > Where You Should Put Your App’s Files https://developer.apple.com/library/ios/documentation/FileManagement/Conceptual/FileSystemProgrammingGuide/FileSystemOverview/FileSystemOverview.html#//apple_ref/doc/uid/TP40010672-CH2-SW28 %}.

