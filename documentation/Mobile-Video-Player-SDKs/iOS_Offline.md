---
layout: page
title: Offline Playback on iOS Devices
subcat: SDK 3.0 (Beta) - iOS
weight: 300
---

# Overview

Offline Playback refers to the ability to play downloaded content. The device doesn't have to actually be offline (i.e. with no network access) to use downloaded assets.

Setting up offline playback involves a few steps:
1. Download the content
2. Register the downloaded content with the SDK
3. Play the downloaded content.

Download itself is out of scope for this document; it is done either by iOS [AVAssetDownloadTask] or by a third party download manager. 

The main SDK component responsible for local playback is [LocalAssetsManager]. This class is used before and right after the download to make sure the SDK retrieves DRM licenses for offline playback. It is also used when starting local playback, to link the downloaded content with a [MediaEntry] object playable by the SDK.

# Download and Register

## Downloading with AVAssetDownloadTask

When using AVAssetDownloadTask, an application has to create an AVURLAsset and link it to a download task. In addition, if the asset is protected with FairPlay DRM, a delegate on the asset must be set.

Before starting to download, the application should have a ready-to-use MediaEntry object, containing one or more `MediaSource`s. 

The application should then call `prepareForDownload(of mediaEntry: MediaEntry)` - which will pick the most suitable source for the download and return two values:
 - A downloadable `AVURLAsset`, configured with FairPlay if required
 - The original `MediaSource` from which the `AVURLAsset` was built.
 
At this point, the application can start downloading the asset (typically mp4 or HLS).

{% plantuml %}
    @startuml
	participant App
	participant LocalAssetsManager as LAM

    App->LAM: prepareForDownload(mediaEntry)
    LAM-->App: urlAsset, mediaSource
    
    App->AVAssetDownloadURLSession: makeAssetDownloadTask(asset: urlAsset)
    AVAssetDownloadURLSession-->App: AVAssetDownloadTask
    App->AVAssetDownloadTask: resume

    ...
    App->LAM: assetDownloadFinished(mediaSource, location)

    @enduml
{% endplantuml %}


## Downloading with a 3rd-party tool

When the asset isn't downloadable by AVAssetDownloadTask (or if AVAssetDownloadTask is not available), the download will be done either with a 3rd party tool or by a [URLSessionDownloadTask]. In those cases, there's no "prepare" step. Instead, the application calls `getPreferredDownloadableMediaSource(for mediaEntry: MediaEntry)` to pick the best source. It then downloads the source, and at the end calls `assetDownloadFinished(mediaSource: MediaSource, location: URL)`.

This case also applies to *Widevine Classic* assets.

{% plantuml %}
    @startuml
	participant App
	participant LocalAssetsManager as LAM

    App->LAM: getPreferredDownloadableMediaSource(mediaEntry)
    LAM-->App: mediaSource
    
    note over App: download mediaSource
    ...
    App->LAM: assetDownloadFinished(mediaSource, location)

    @enduml
{% endplantuml %}


# Playback

To play a downloaded asset, the application needs to wrap the asset with a MediaEntry object. `LocalAssetsManager` provides `createLocalMediaEntry(for assetId: String, localURL: URL)`. This function returns a suitable `MediaEntry`.

{% plantuml %}
    @startuml
	participant App
	participant LocalAssetsManager as LAM
	participant Player

    App->LAM: createLocalMediaEntry(assetId, localURL)
    LAM-->App: localMediaEntry
    App->Player: play(localMediaEntry)

    @enduml
{% endplantuml %}




# LocalDataStore

The constructor of LocalAssetsManager takes an optional [LocalDataStore]. This object is **require** if the application downloads or plays DRM-protected content. The protocol has 3 functions:
- `save(key: String, value: Data)`
- `load(key: String) -> Data`
- `remove(key: String)`

A simple implementation is provided in [DefaultLocalDataStore], but if the application has an existing persistent storage facility (such as a CoreData/SQLite db), it might be good idea to provide a different implementation.



[LocalAssetsManager]: https://kaltura.github.io/playkit/api/ios/Classes/LocalAssetsManager.html
[LocalDataStore]: https://kaltura.github.io/playkit/api/ios/Protocols/LocalDataStore.html
[DefaultLocalDataStore]: https://kaltura.github.io/playkit/api/ios/Classes/DefaultLocalDataStore.html
[MediaEntry]: https://kaltura.github.io/playkit/api/ios/Classes/MediaEntry.html
[AVAssetDownloadTask]: https://developer.apple.com/reference/avfoundation/avassetdownloadtask
[URLSessionDownloadTask]: https://developer.apple.com/reference/foundation/urlsessiondownloadtask