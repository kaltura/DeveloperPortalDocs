---
layout: page
---

## Offline Playback

Offline Playback refers to the ability to play downloaded content, although the device doesn't actually have to be offline (i.e., without network access) to use downloaded assets.

Setting up offline playback requires three steps:

1. Download the content.
2. Register the downloaded content with the SDK.
3. Play the downloaded content.

Download itself is out of scope for this article; you can use either [AVAssetDownloadTask](https://developer.apple.com/reference/avfoundation/avassetdownloadtask) (available in iOS 10 and up) or use a third party download manager.

The main SDK component responsible for local playback is the `LocalAssetsManager`. This class is used before and right after the download to make sure the SDK retrieves the DRM licenses for offline playback. It's also used when starting local playback, to link the downloaded content with a `MediaEntry` object playable by the SDK.

### Download and Register  

#### Downloading with AVAssetDownloadTask  

When using `AVAssetDownloadTask`, the application will need to create an `AVURLAsset` and link it to a download task. In addition, if the asset is protected with FairPlay DRM, a delegate on the asset must be set.

Before starting to download, the application should have a ready-to-use `MediaEntry` object, containing one or more `MediaSource`s. 

The application should then call `prepareForDownload(of mediaEntry: MediaEntry)`, which will pick the most suitable source for the download and return two values:

 * A downloadable `AVURLAsset`, configured with FairPlay if required
* The original `MediaSource` from which the `AVURLAsset` was built
 
At this point, the application can begin downloading the asset (typically mp4 or HLS).

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

For correct usage of this mechanism, please see the [Apple guide](https://developer.apple.com/library/content/documentation/AudioVideo/Conceptual/MediaPlaybackGuide/Contents/Resources/en.lproj/HTTPLiveStreaming/HTTPLiveStreaming.html) and a [sample application](https://developer.apple.com/library/content/samplecode/HLSCatalog/Introduction/Intro.html). 

#### Downloading with a Third-Party  Tool  

When the asset isn't downloadable by `AVAssetDownloadTask` (or if `AVAssetDownloadTask` isn't available), you can perform a download using either a third-party tool or a [`URLSessionDownloadTask`](https://developer.apple.com/reference/foundation/urlsessiondownloadtask). In these cases, there's no "preparation" step. Instead, the application calls `getPreferredDownloadableMediaSource(for mediaEntry: MediaEntry)` to pick the best source. It then downloads the source, and at the end calls `assetDownloadFinished(mediaSource: MediaSource, location: URL)`.

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


### Playing Back and Downloaded Asset    

To play back a downloaded asset, the application needs to wrap the asset with a `MediaEntry` object. `LocalAssetsManager` provides `createLocalMediaEntry(for assetId: String, localURL: URL)`. This function returns a suitable `MediaEntry`.

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


### Using a LocalDataStore  

The constructor of a `LocalAssetsManager` takes an optional [LocalDataStore]. This object is **required** if the application downloads or plays DRM-protected content. The protocol has three functions:
- `save(key: String, value: Data)`
- `load(key: String) -> Data`
- `remove(key: String)`

A simple implementation is provided in [DefaultLocalDataStore], but if the application has an existing persistent storage facility (such as a CoreData/SQLite db), it might be a good idea to provide a different implementation.


[LocalAssetsManager]: https://kaltura.github.io/playkit/api/ios/Classes/LocalAssetsManager.html
[LocalDataStore]: https://kaltura.github.io/playkit/api/ios/Protocols/LocalDataStore.html
[DefaultLocalDataStore]: https://kaltura.github.io/playkit/api/ios/Classes/DefaultLocalDataStore.html
[MediaEntry]: https://kaltura.github.io/playkit/api/ios/Classes/MediaEntry.html
[AVAssetDownloadTask]: https://developer.apple.com/reference/avfoundation/avassetdownloadtask
[URLSessionDownloadTask]: https://developer.apple.com/reference/foundation/urlsessiondownloadtask



## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.

