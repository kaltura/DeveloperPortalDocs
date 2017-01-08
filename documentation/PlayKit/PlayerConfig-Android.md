---
layout: page
title: Player Configuration on Android Devices
subcat: Android
weight: 291
---

The player configuration is the main data object of the Playkit SDK; this object is used for configuring all plugins and for creating and obtaining the media provider media entries that will play on the device.

## Media Entry - PKMediaEntry  

The PKMediaEntry contains information regarding the media that will be played. With this information, the Kaltura Mobile Video Player
prepares the source that will play the media, decides which type of player is required to play the media, and more.

### Methods for Creating the PKMediaEntry  

The PKMediaEntry can be created using one of the following methods:

1. **Manually** - Instantiate a new PKMediaEntry instance and fill the fields. 
   [Learn more here...](#PkMediaEntry breakdown).

2. **Using a MockMediaProvider** - Create a PKMediaEntry from a JSON input file or JsonObject.
   [Learn more here...](https://github.com/kaltura/DeveloperPortalDocs/tree/playkit/documentation/PlayKit/MediaEntryProvider.md#MockMediaProvider).

3. **Using a remote media provider** - Use one of the provided MediaEntryProvider implementations:
    For OVP environments, use "KalturaOvpMediaProvider".
    For OTT environments, use "PhoenixMediaProvider".

    To use this method, you'll need to do the following:
   
   a) Create an instance of one of the above mentioned providers.
   
   b) Set the mandatory parameters needed for fetching data, such as media id, SessionProvider, etc.
   
   c) Once your provider object is ready, activate its "load" method and pass a completion callback. If successful, the PKMediaEntry object will be provided in the response.
   
   [Learn more here...](PlayKit/MediaEntryProvider.md#RemoteMediaProviders)

Once you have a PKMediaEntry ready, you can build the player configuration and plugins, and continue to prepare the Kaltura Mobile Video Player for play.

### About the PKMediaEntry  


The PkMediaEntry holds information gathered from the media details and needed for the player, such as the URL to play, the DRM data, and duration.

Additional information includes:

* String id - correlates to the media/entry id
* long duration - the media duration in seconds
* MediaEntryType mediaType - indicates the type to be played (VOD, Live or Unknown)
* List<PKMediaSource> sources - list of source objects

The PKMediaEntry can be created with builder style instantiation, chain setters as follows:
   ```
   PKMediaEntry mediaEntry = new PKMediaEntry().setId(entry.getId())
                                            .setSources(sourcesList)
                                            .setDuration(entry.getDuration())
                                            .setMediaType(MediaTypeConverter.toMediaEntryType(entry.getType()));
   ```
To learn more, see [PKMediaEntry](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/PKMediaEntry.java).

### PKMediaSource  

The PKMediaEntry object contains a list of "PKMediaSources". All sources relate to the same media, but have different formats / qualities / flavors. The player determines which of the sources will actually be played.

To learn more, see [PKMediaSource](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/PKMediaSource.java)

#### Manually a Create Media Source  

PKMediaSource can be created with builder-like coding, by chaining setters:

   ```
   PKMediaSource pkMediaSource = new PKMediaSource().setId(sourceId)
                                                 .setUrl(sourceUrl)
                                                 .setDrmData(dramDataList);

   ```

* **_In OTT environments:_**
Each source represents one MediaFile (Media or AssetInfo contains list of MediaFile items. Each file represents a different format. HD, SD Download...)
Each file can point to a different video, like Trailer MediaFile and HD media file.
When playing on OTT environments, specific "format" (MediaFile), should be configured.


* **_In OVP environments:_**
PKMediaSource items are created according to several criteria:
  * Supported video format: url [.mp4], mpdash [.mpd], applehttp [.m3u8]
  * Flavors: defines the quality of the video.
  * Bit rate

A single "Entry" can have many media sources. The player determines which source to use according to the device's capability, connection quality, and other parameters, such as which of the sources is best for the current play. 

If the media is DRM-restricted, such as Widevine, the DRM information will be needed for playing.

### PKDrmParams

PKDrmParams represents a single DRM license info object. PKDrmParams contains the licenseUri that will be needed for the play. The PKMediaSource contains a list of "PKDrmParams" items. The player will select the source and the relevant DRM data according to device type, connectivity, supported formats, etc.

To learn more, see [PKDrmParams](https://github.com/kaltura/playkit-android/blob/develop/playkit/src/main/java/com/kaltura/playkit/PKDrmParams.java).

To learn more, read the [Media Providers](https://github.com/kaltura/DeveloperPortalDocs/tree/playkit/documentation/PlayKit/MediaProviders.md) article.
